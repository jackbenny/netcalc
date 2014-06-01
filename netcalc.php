<?php
$version="0.1";

function print_usage()
{
    print "netcalc.php $GLOBALS[version]\n";
    print "Jack-Benny Persson <jack-benny@cyberinfo.se>\n";
    print "\n";
    print "Usage: php netcalc.php <netmask>\n";
    print "Example: php netcalc.php 24\n";
}

// Check if first argument is set and and if not, print usage
if (!isset($argv[1]))
{
    print_usage();
    exit(1);
}

$value=$argv[1];

// Check if our argument was a numeric value or not
if (!is_numeric($value)) 
{
    print "Please enter numbers only (between 0 and 32)\n";
    exit(1);
}

// Check if the value is between 0 and 32
if ($value < 0 || $value > 32)
{
    print "Please enter an integer between 0 and 32 only\n";
    exit(1);
}

// Calculate the diffrent values
$base=32-$value;
$netsize=pow(2, $base);
$hosts=$netsize-2;
if ($hosts < 0)
{
    $hosts = 0;
}

// And now, finally, print the values
print "Netmask: $value\n";
print "Total number of addresses: $netsize\n";
print "Number of usable addresses for hosts: $hosts\n";
exit(0);

?>
