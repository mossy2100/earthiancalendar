<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";

/*
$year1 = 0;
for ($y = $year1; $y <= $year1 + 990; $y++)
{
	$earthDate = new EarthianDate($y, 1, 1);
	$mjd = $earthDate->toMjd();
	$earthDate2 = EarthianDate::fromMjd($mjd);
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
	$len = EarthianDate::daysInYear($earthDate->year);
	$isLeapYear = $len == 366;
	if ($isLeapYear) print "<font color='red'>";
	printbr("$earthDate = $mjd = $earthDate2, diff = $diff, years = ".($y - $year1).", len = $len, avg = $avg");
	if (!$earthDate->isEqualTo($earthDate2)) printbr("*****");
	if ($isLeapYear) print "</font>";
}
*/

for ($mjd = EarthianDate::mjdDay0; $mjd <= EarthianDate::mjdDay0 + 12053; $mjd++) {
  $earthDate = EarthianDate::fromMjd($mjd);
  $mjd2 = $earthDate->toMjd();
  printbr("$mjd = $earthDate = $mjd2");
  if ($mjd != $mjd2) {
    printbr("*****");
  }
}
