<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";

/*
Synodic month lengths (lunations) may vary between 29.27 and 29.83 days.
However, the long-term average duration is 29.530589 days.
 */


$lunation = 29.530589; // days

for ($n = 1; $n <= 1000; $n++)
{
	$x = ($lunation - 29) * $n;
	$x2 = round($x, 2);
	$x0 = round($x, 0);
	$x3 = round($x, 3);
	if ($x0 == $x2)
	{
		printbr("In a cycle of $n lunations, we would need $x3 long months.  Fraction = ".($x/$n));
	}
}

// Most accurate result is 3261/6146.
// Simplest result is 26/49.


// i.e. 23 short months
printbr();
$realDays = 0;
$calendarDays = 0;
$shortMonth = 29;
$longMonth = 30;
$mPattern1 = "";
$prev = "";
for ($m = 0; $m < 6146; $m++)
{
	$realDays += $lunation;
	$shortDiff = abs($calendarDays + $shortMonth - $realDays);
	$longDiff = abs($calendarDays + $longMonth - $realDays);
	if ($shortDiff < $longDiff)
	{
		$calendarDays += $shortMonth;
		print("Month $m has 29 days &nbsp;&nbsp;&nbsp;");
		$ch = "0";
	}
	elseif ($shortDiff > $longDiff)
	{
		$calendarDays += $longMonth;
		print("Month $m has 30 days &nbsp;&nbsp;&nbsp;");
		$ch = "1";	
	}
	else
	{
		printbr("This is unusual...");	
	}
	printbr("(Real days = $realDays, Calendar days = $calendarDays)");
	if ($ch == "1" && $prev == "1")
	{
		$mPattern1 .= "<br />";
	}
	$mPattern1 .= $ch;
	$prev = $ch;
}
printbr();
//printbr($mPattern1);

printbr();
$runs = explode("<br />", $mPattern1);

printbr("There are ".count($runs)." runs of either 15 or 17 lunations.");

$cPattern1 = "";

foreach ($runs as $run)
{
	$len = strlen($run);
	print("$len, ");
	$cPattern1 .= strlen($run) == 15 ? "0" : "1";
}

printbr($cPattern1);
printbr(strlen($cPattern1));


function isLongCycle($x, $offset)
{
	return (($x + $offset) % 107 % 55 % 3) != 1;
}

for ($offset = 0; $offset < 376; $offset++)
{ 
	$cPattern2 = "";
	for ($y = 0; $y < 376; $y++)
	{
		$cPattern2 .= isLongCycle($y, $offset) ? '1' : '0';
	}
	printbr($cPattern2);
	if ($cPattern1 == $cPattern2)
	{
		printbr("Offset = $offset");
	}
}

exit;

/*
// Symmetrical pattern:
printbr();
$realDays = $lunation;
$calendarDays = 29;
$shortMonth = 29;
$longMonth = 30;
$pattern = "0";
printbr("Month 25 has 29 days &nbsp;&nbsp;&nbsp;(Real days = $realDays, Calendar days = $calendarDays)");
for ($m = 1; $m <= 24; $m++)
{
	print("Months ".(25 - $m)." and ".(25 + $m)." have ");
	$realDays += ($lunation * 2);
	$shortDiff = abs($calendarDays + (2 * $shortMonth) - $realDays);
	$longDiff = abs($calendarDays + (2 * $longMonth) - $realDays);
	if ($shortDiff < $longDiff)
	{
		$calendarDays += (2 * $shortMonth);
		print($shortMonth);
		$pattern = "0" . $pattern . "0";	
	}
	elseif ($shortDiff > $longDiff)
	{
		$calendarDays += (2 * $longMonth);
		print($longMonth);	
		$pattern = "1" . $pattern . "1";	
	}
	printbr(" days &nbsp;&nbsp;&nbsp; Real days = $realDays, Calendar days = $calendarDays)");
}
printbr();
printbr($pattern);
*/

function isLongMonth($month)
{
	return ($month + 3956) % 1749 % 899 % 49 % 17 % 2 == 0;	
}


$prev = '';
$mPattern3 = '';
$nDays = 0;
for ($m = 0; $m < 6146; $m++)
{
	$longMonth = isLongMonth($m); 
	$ch = $longMonth ? '1' : '0';
	if ($prev == '1' && $ch == '1')
	{
		$mPattern3 .= "<br />";
	}
	$mPattern3 .= $ch;
	$prev = $ch;
	$nDays += ($longMonth ? 30 : 29);
}
printbr("Total number of days in 6146 months = $nDays");

//printbr($mPattern3);
printbr();
$runs = explode("<br />", $mPattern3);

$cPattern3 = "";
foreach ($runs as $run)
{
	print(strlen($run).", ");
	$cPattern3 .= strlen($run) == 15 ? "0" : "1";
}

printbr($cPattern1);
printbr($cPattern2);
printbr($cPattern3);
printbr($cPattern1 == $cPattern2 ? 'Cycle pattern 1 == Cycle pattern 2' : 'Cycle pattern 1 != Cycle pattern 2');
printbr($cPattern1 == $cPattern3 ? 'Cycle pattern 1 == Cycle pattern 3' : 'Cycle pattern 1 != Cycle pattern 3');
printbr($cPattern2 == $cPattern3 ? 'Cycle pattern 2 == Cycle pattern 3' : 'Cycle pattern 2 != Cycle pattern 3');

//printbr($mPattern1);
//printbr($mPattern3);
printbr($mPattern1 == $mPattern3 ? 'Month pattern 1 == Month pattern 3' : 'Month pattern 1 != Month pattern 3');

// 10101010101010101	17 lunations
// 101010101010101		15 lunations
// 10101010101010101	17 lunations

?>