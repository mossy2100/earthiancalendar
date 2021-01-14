<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";

/*
Synodic month lengths (lunations) may vary between 29.27 and 29.83 days.
However, the long-term average duration is 29.530589 days.
 */

$lunation = 29.530589; // days

for ($n = 1; $n <= 2000; $n++) {
  $x = ($lunation - 29) * $n;
  $x2 = round($x, 2);
  $x0 = round($x, 0);
  $x3 = round($x, 3);
  if ($x0 == $x2) {
    printbr("In a cycle of $n lunations, we would need $x3 long months.");
  }
}

// Simplest result is 26 long months per 49 lunations.
// i.e. 23 short months
printbr();
$realDays = 0;
$calendarDays = 0;
$shortMonth = 29;
$longMonth = 30;
$pattern = "";
for ($m = 0; $m < 49; $m++) {
  $realDays += $lunation;
  $shortDiff = abs($calendarDays + $shortMonth - $realDays);
  $longDiff = abs($calendarDays + $longMonth - $realDays);
  if ($shortDiff < $longDiff) {
    $calendarDays += $shortMonth;
    print("Month $m has 29 days &nbsp;&nbsp;&nbsp;");
    $pattern .= "0";
  }
  elseif ($shortDiff > $longDiff) {
    $calendarDays += $longMonth;
    print("Month $m has 30 days &nbsp;&nbsp;&nbsp;");
    $pattern .= "1";
  }
  else {
    printbr("This is unusual...");
  }
  printbr("(Real days = $realDays, Calendar days = $calendarDays)");
}
printbr();
printbr($pattern);

// Symmetrical pattern:
printbr();
$realDays = $lunation;
$calendarDays = 29;
$shortMonth = 29;
$longMonth = 30;
$pattern = "0";
printbr("Month 25 has 29 days &nbsp;&nbsp;&nbsp;(Real days = $realDays, Calendar days = $calendarDays)");
for ($m = 1; $m <= 24; $m++) {
  print("Months " . (25 - $m) . " and " . (25 + $m) . " have ");
  $realDays += ($lunation * 2);
  $shortDiff = abs($calendarDays + (2 * $shortMonth) - $realDays);
  $longDiff = abs($calendarDays + (2 * $longMonth) - $realDays);
  if ($shortDiff < $longDiff) {
    $calendarDays += (2 * $shortMonth);
    print($shortMonth);
    $pattern = "0" . $pattern . "0";
  }
  elseif ($shortDiff > $longDiff) {
    $calendarDays += (2 * $longMonth);
    print($longMonth);
    $pattern = "1" . $pattern . "1";
  }
  printbr(" days &nbsp;&nbsp;&nbsp; Real days = $realDays, Calendar days = $calendarDays)");
}
printbr();
printbr($pattern);

// 10101010101010101	17 lunations
// 101010101010101		15 lunations
// 10101010101010101	17 lunations
