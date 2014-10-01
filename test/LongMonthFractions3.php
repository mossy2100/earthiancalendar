<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";

/*
Synodic month lengths (lunations) may vary between 29.27 and 29.83 days.
However, the long-term average duration is 29.530589 days.
 */


$lunation = 29.530589; // days

$lunation = 29.530588853 + (0.000000002162 * 2008);
printbr($lunation);

for ($n = 1; $n <= 1000; $n++)
{
	$x = ($lunation - 29) * $n;
	$x2 = round($x, 2);
	$x0 = round($x, 0);
	$x3 = round($x, 3);
	if ($x0 == $x2)
	{
		printbr("In a cycle of $n lunations, we would need $x3 long months.  Fraction = ".($x0/$n));
	}
}

// 1. Simplest fraction is 26/49.
// 2. Most accurate result is 3261/6146.
// 3. Better accuracy, and not as complex, is 477/899 


printbr();
$realDays = 0;
$calendarDays = 0;
$shortMonth = 29;
$longMonth = 30;
$mPattern1 = "";
$prev = "";
for ($m = 0; $m < 899; $m++)
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
//		$mPattern1 .= "<br />";
	}
	$mPattern1 .= $ch;
	$prev = $ch;
}
printbr();
printbr($mPattern1);

$cycles = explode("<br />", $mPattern1);
$cPattern1 = "";
foreach ($cycles as $cycle)
{
	$cPattern1 .= strlen($cycle) == '15' ? '0' : '1';
}
printbr("cycle pattern: $cPattern1");


function isLongCycle($x)
{
	return $x % 55 % 28 % 27 % 3 != 1;
}

for ($i = 0; $i < 165; $i++)
{
	print(isLongCycle($i) ? '1' : '0');
	if (($i + 1) % 55 == 0)
	{
		printbr();
	}
}
printbr();


/*
// Symmetrical pattern:
printbr();
$realDays = $lunation;
$calendarDays = 29;
$shortMonth = 29;
$longMonth = 30;
$pattern = "0";
printbr("Month 25 has 29 days &nbsp;&nbsp;&nbsp;(Real days = $realDays, Calendar days = $calendarDays)");
for ($m = 1; $m <= 449; $m++)
{
	print("Months ".(450 - $m)." and ".(450 + $m)." have ");
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
	$years = $realDays / 365.2424;
	printbr(" days &nbsp;&nbsp;&nbsp; Real days = $realDays, Calendar days = $calendarDays, years = $years)");
}
printbr();
printbr($pattern);
*/

function isFullMonth($x)
{
	return (($x % 899 % 458 % 441) + 17) % 49 % 17 % 2 == 0;
}

$mPattern2 = '';
for ($m = 0; $m < 2697; $m++)
{
	$long = isFullMonth($m);
	$mPattern2 .= $long ? '1' : '0';
	if (($m + 1) % 899 == 0)
	{
		$mPattern2 .= "<br />";
	}
}
printbr($mPattern2);

$parts = explode("<br />", $mPattern2);
debug($mPattern1 == $parts[0]);
debug($mPattern1 == $parts[1]);
debug($mPattern1 == $parts[2]);



?>