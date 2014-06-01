<?php

if (isset($argv[1]))
{
    //$value=$argv[1];
    $value=$argv[1];
    if ($value < 0 || $value > 32)
    {
        print "Please enter an integer between 0 and 32 only\n";
        exit;
    }
    $base=32-$value;
    $netsize=pow(2, $base);
    $hosts=$netsize-2;
    print "$hosts\n";
}

else
{
    print "Enter something\n";
}

?>
