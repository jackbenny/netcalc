<?php

/*
Copyright (C) 2014 Jack-Benny Persson <jack-benny@cyberinfo.se>

   This program is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with this program; if not, write to the Free Software
   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
*/

/* Netcalc is a simple PHP CLI script to calculate the size of a network
   from a given netmask in slash notation */

$version="0.1";

function print_usage()
{
    print "netcalc.php $GLOBALS[version]\n";
    print "Jack-Benny Persson <jack-benny@cyberinfo.se>\n";
    print "\n";
    print "Usage: php netcalc.php <netmask>\n";
    print "Example: php netcalc.php 24\n";
}

function print_netmask($number)
{
    $number = $number-1;
    $mask = $number+1;

    $ones = 1;
    $zeros = 0;

    $num_zeros = 32-$number-2;

    // Itterate the binary ones, adding one 1 for every run
    for ($i = 0; $i < $number; $i++) 
    {
        $ones .= 1;
    }
    unset($i);

    // Itterate the binary zeros, adding one 0 for every run
    for ($i = 0; $i < $num_zeros; $i++)
    {
        $zeros .= 0;
    }
    unset($i);

    // Special cases when netmask is 0 or 32
    if ($mask == 0)
    {
        // If the network mask is 0, then just put 32 zeros in the string
        $binary = "00000000000000000000000000000000";
    }
    elseif ($mask == 32)
    {
        // If the network mask is 32, then just put 32 ones in the string
        $binary = "11111111111111111111111111111111";
    }
    else
    {
        // Else put the ones and zeros together in a binary string
        $binary = "$ones$zeros";
    }

    // Make it dotted binary format
    $dotted_binary = substr_replace($binary, ".", 8, 0);
    $dotted_binary = substr_replace($dotted_binary, ".", 17, 0);
    $dotted_binary = substr_replace($dotted_binary, ".", 26, 0);

    // Make it dotted decimal format
    $firstOctet = base_convert(substr($binary, 0, 8), 2, 10);
    $secondOctet = base_convert(substr($binary, 8, 8), 2, 10);
    $thirdOctet = base_convert(substr($binary, 16, 8), 2, 10);
    $forthOctet = base_convert(substr($binary, 24, 8),2, 10);

    // Print it in different formats
    print "Netmask\n" ;
    print "-------\n";
    print "In slash notation: $mask\n";
    print "In dotted decimal: $firstOctet.$secondOctet.$thirdOctet.$forthOctet\n";
    print "In dotted binary: $dotted_binary";
    print "\n\n";
}

function print_values($value)
{
    // Calculate the network size and usable addresses
    $base=32-$value;
    $netsize=pow(2, $base);
    $hosts=$netsize-2;

    // We don't want negative values
    if ($hosts < 0)
    {
        $hosts = 0;
    }

    // Print the network size and usable addresses
    print "Network size\n";
    print "------------\n";
    print "Total number of addresses: $netsize\n";
    print "Number of usable addresses for hosts: $hosts\n";
}

// MAIN
// Check if first argument is set and and if not, print usage
if (!isset($argv[1]))
{
    print_usage();
    exit(1);
}

$input=$argv[1];

// Check if our argument was a numeric value or not
if (!is_numeric($input)) 
{
    print "Please enter numbers only (between 0 and 32)\n";
    exit(1);
}

// Check if the value is between 0 and 32
if ($input < 0 || $input > 32)
{
    print "Please enter an integer between 0 and 32 only\n";
    exit(1);
}

// Print the netmask first
print_netmask($input);

// And now, finally, print the network size and usable addresses
print_values($input);

exit(0);

?>
