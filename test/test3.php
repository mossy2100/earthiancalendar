<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";

$fp = fopen("$smDir/calendars/earth/VernalEquinoxDates.txt", "r");
if (!$fp)
{
	echo "Couldn't open file.";
	exit;
}

/*
 * Note that this file was originally written to test a value for 'a', as an offset for the
 * leap year formula.  However, the formula is now set, so $a doesn't do anything at the moment.
 * The outer loop is redundant.
 */


$min = -1;
for ($a = 0; $a < 33; $a++)
{
	rewind($fp);

	print("a=$a : ");

	$dtlCopLeapYearOffset = $a;
	$nYears = 0;
	$missed = 0;

	while (!feof($fp))
	{
		$dt = trim(fgets($fp));
		printbr($dt);
		if (!dtlIsDateTimeStr($dt))
		{
			continue;
		}
		$gd = dtlGetDate($dt);
		$t = dtlGetTime($dt);
		$hour = dtlGetHours($t);
		$cd = EarthianDate::fromGregorian($gd);
		$strCop = $cd->__toString();
		printbr($cd);

		$str = "$dt = $strCop $t";

		if ($cd->month == 12)
		{
			$year = $cd->year;
			$dLast = EarthianDate::lastDayOfYear($year);
			$str .= "&nbsp;&nbsp; $dLast ";
			$ok = $dLast == $strCop && $hour >= 12;
		}
		else
		{
			$year = $cd->year;
			$dFirst = EarthianDate::firstDayOfYear($year);
			$str .= "&nbsp;&nbsp; $dFirst ";
			$ok = $dFirst == $strCop && $hour < 12;
		}

		if ($ok)
		{
			$str .= "OK";
		}
		else
		{
			$str .= "NOT";
			$missed++;
		}
		$nYears++;

		printbr($str);
		printbr();
	}
	printbr("missed $missed out of $nYears");
	if ($min == -1 || $missed < $min)
	{
		$min = $missed;
		$minA = $a;
	}
}

fclose($fp);
printbr("minimum missed = $min, with a=$minA");

// result: minimum missed = 4 with a=0
