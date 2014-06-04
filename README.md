# Netcalc #
This is a simple CLI network calculator made in PHP. Usage is pretty straight
forward. For example, let say you want to know how many usable addresses you
will get with a 26 bit netmask, simply run the script as below:

    php netcalc.php 26

Or you `chmod +x netcalc.php` and run it as below:

    ./netcalc.php 26

The above command will give you the following outut:

    Netmask
    -------
    In slash notation: 26
    In dotted decimal: 255.255.255.192
    In dotted binary: 11111111.11111111.11111111.11000000

    Network size
    ------------
    Total number of addresses: 64
    Number of usable addresses for hosts: 62

## Copyright ##
Netcalc is written by Jack-Benny Persson and released under GNU GPL version 2.


