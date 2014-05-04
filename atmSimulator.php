<?php

/*
 * Simple file just contains algorithm can be run from command line
 */
$iniCount = 0;
$requestedAmt = 0;
$dispensedNumber = 0;
$amountLeft = 0;
$requestedAmt = $argv[1];

//if initial count passed through
//assume that both 20 & 50 start with same count
if (isset($argv[2])&&($argv[2] != ''))
	$iniCount = $argv[2];
else
	$iniCount = 1000;

//initialise array
$denominationArr = array('20'=>$iniCount,'50'=>$iniCount);
echo " INITIAL COUNT\n";
echo "************************\n";
echo " Number of 20 notes: ".$denominationArr['20']."\n";
echo " Number of 50 notes: ".$denominationArr['50']."\n";
echo "************************\n";
echo " Amount requested:".$requestedAmt."\n";

echo " DISPENSED COUNT\n";
echo "************************\n";
$dispensed20 = $requestedAmt/20;
$dispensed50 = $requestedAmt/50;
if ($denominationArr['20']<=0)
	echo " PLEASE NOTE: There are no more 20 notes left \n";
if ($denominationArr['50']<=0)
	echo " PLEASE NOTE: There are no more 50 notes left \n";

if (($requestedAmt % 20 ==0)&&(($denominationArr['20']>0)&&($denominationArr['20']-$dispensed20 >=0)))
{
    $dispensedNumber = $requestedAmt/20;
    echo " DISPENSED NUMBER OF 20 NOTES: ".$dispensedNumber."\n";
    $denominationArr['20'] = $iniCount - $dispensedNumber; 
    echo " AVAILABLE NUMBER OF 20 NOTES: ".$denominationArr['20']."\n";
}
else if (($requestedAmt % 50 == 0)&&(($denominationArr['50']>0)&&($denominationArr['50']-$dispensed50 >=0)))
{
    $dispensedNumber = $requestedAmt/50;
    echo " DISPENSED NUMBER OF 50 NOTES: ".$dispensedNumber."\n";
    $denominationArr['50'] = $iniCount - $dispensedNumber;
    echo " AVAILABLE NUMBER OF 50 NOTES: ".$denominationArr['50']."\n";
}
else
{
    $amountLeft = $requestedAmt % 50;
    if ($amountLeft % 20 == 0)
	{
        $dispensedNumber = ($requestedAmt - $amountLeft)/50;
	echo " DISPENSED NUMBER OF 50 NOTES: ".$dispensedNumber."\n";
	$denominationArr['50'] = $iniCount - $dispensedNumber;
	echo " AVAILABLE NUMBER OF 50 NOTES: ".$denominationArr['50']."\n";
	$dispensedNumber = $amountLeft/20;
	echo " DISPENSED NUMBER OF 20 NOTES: ".$dispensedNumber."\n";
	$denominationArr['20'] = $iniCount - $dispensedNumber;
	echo " AVAILABLE NUMBER OF 20 NOTES: ".$denominationArr['20']."\n";
	}
    else 
	echo "UNABLE TO DISPENSE AMOUNT ".$requestedAmt.". PLEASE ENTER MULTIPLES OF 20 OR 50! \n";
}
echo "************************\n";
?>