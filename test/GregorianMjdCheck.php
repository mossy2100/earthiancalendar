<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";

/*
$year1 = 2000;

for ($y = $year1; $y <= $year1 + 2000; $y+=4)
{
	$gregDate = dtlDateStr($y, 1, 1);
	$mjd = dtlDateToMJD($gregDate);
	if ($y == $year1)
	{
		$mjd1 = $mjd;
		$diff = 0;
		$avg = 0;
	}
	else
	{
		$diff = $mjd - $mjd1;
		$avg = $diff / ($y - $year1);
	}
	$len = dtlDaysInYear($y);
	$isLeapYear = $len == 366;
	if ($isLeapYear) print "<font color='red'>"; 
	printbr("$gregDate = $mjd, diff = $diff, years = ".($y - $year1).", len = $len, avg = $avg");
	if ($isLeapYear) print "</font>"; 
}
*/

for ($mjd = EarthianDate::mjdDay0; $mjd <= EarthianDate::mjdDay0 + 12053; $mjd++)
{
	$gregDate = dtlMJDToDate($mjd);
	$mjd2 = dtlDateToMJD($gregDate);
	printbr("$mjd = $gregDate = $mjd2");
	if ($mjd != $mjd2) printbr("*****");
}
?>