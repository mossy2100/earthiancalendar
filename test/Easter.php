<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";

$dayCount = [];
$year1 = 2007;

for ($y = $year1; $y < 10000; $y++) {
  $gregDate = dtlEaster($y);
  $mjd = dtlDateToMJD($gregDate);
  if ($y == $year1) {
    $mjdXmas1 = $mjd;
    $diff = 0;
    $avg = 0;
  }
  else {
    $diff = $mjd - $mjdXmas1;
    $avg = $diff / ($y - $year1);
  }
  $earthDate = EarthianDate::fromGregorian($gregDate);
  $len = EarthianDate::daysInYear($earthDate->year);
  $isLeapYear = $len == 366;
  if ($isLeapYear) {
    print "<font color='red'>";
  }
  printbr("$gregDate = $mjd = $earthDate, diff = $diff, years = " . ($y - $year1) .
    ", len = $len, avg = $avg");
  if ($isLeapYear) {
    print "</font>";
  }
  $dayCount[twoDigits($earthDate->month) . '-' . twoDigits($earthDate->day)]++;
}

ksort($dayCount);
debug($dayCount);
