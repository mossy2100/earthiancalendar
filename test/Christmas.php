<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";

$dayCount = array();
$year1 = 2007;

for ($y = $year1; $y < $year1 + 2000; $y++)
{
	$gregDate = dtlDateStr($y, 12, 25);
	$mjd = dtlDateToMJD($gregDate);
	if ($y == $year1)
	{
		$mjdXmas1 = $mjd;
		$diff = 0;
		$avg = 0;
	}
	else
	{
		$diff = $mjd - $mjdXmas1; 
		$avg = $diff / ($y - $year1);
	}
	$earthDate = EarthianDate::fromGregorian($gregDate);
	$len = EarthianDate::daysInYear($earthDate->year);
	$isLeapYear = $len == 366;
	if ($isLeapYear) print "<font color='red'>"; 
	printbr("$gregDate = $mjd = $earthDate, diff = $diff, years = ".($y - $year1).", len = $len, avg = $avg");
	if ($isLeapYear) print "</font>"; 
	$dayCount[$earthDate->day]++;
}

ksort($dayCount);
debug($dayCount);
$total = array_sum($dayCount);
foreach ($dayCount as $day => $nDays)
{
	$dayCount[$day] = number_format($nDays / $total * 100, 1).'%'; 
}
debug($dayCount);

?>