<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";

$fp = fopen("$baseDir/data/VernalEquinoxDates.txt", "r");
if (!$fp) {
  echo "Couldn't open file.";
  exit;
}

rewind($fp);

$earliestDate = null;
$earliestTime = "23:59:59";

$latestDate = null;
$latestTime = "00:00:00";

while (!feof($fp)) {
  $dtNVE = trim(fgets($fp));
  if (!dtlIsDateTimeStr($dtNVE)) {
    continue;
  }
  $gregDate = dtlGetDate($dtNVE);
  $earthDate = EarthianDate::fromGregorian($gregDate);
  $time = dtlGetTime($dtNVE);

  $first = EarthianDate::firstDayOfYear($earthDate->year);
  $last = EarthianDate::lastDayOfYear($earthDate->year);

  if ($earthDate->month == 1 && $earthDate->isLaterThan($first)) {
    print("<font color='red'>");
  }
  if ($earthDate->month == 12 && $earthDate->isEarlierThan($last)) {
    print("<font color='blue'>");
  }
  printbr($dtNVE . ' = ' . $earthDate . ' ' . $time);
  if (($earthDate->month == 1 && $earthDate->isLaterThan($first)) ||
    ($earthDate->month == 12 && $earthDate->isEarlierThan($last))) {
    print("</font>");
  }
  if ($earthDate->month == 1 && $earthDate->isLaterThanOrEqualTo($first) && $time > $latestTime) {
    $latestDate = $earthDate;
    $latestTime = $time;
  }
  if ($earthDate->month == 12 && $earthDate->isEarlierThanOrEqualTo($last) &&
    $time < $earliestTime) {
    $earliestDate = $earthDate;
    $earliestTime = $time;
  }
}

printbr("latest = $latestDate $latestTime");
printbr("earliest = $earliestDate $earliestTime");

fclose($fp);
