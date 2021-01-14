<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";

////////////////////////////////////////////////////////////////////////////////////////////
/*
 * Notes:
 * =====
 *
 * There are several combinations of a and b that result in a minimum number of misses (16)
 * Which is the best?
 * Will have to refine the algorithm to determine what the smallest average variation is
 * between the NVE and the start of the calendar year.
 *
 */

$fp = fopen("$smDir/calendars/copernicus/VernalEquinoxDates.txt", "r");
if (!$fp) {
  echo "Couldn't open file.";
  exit;
}

$min = -1;
for ($a = 0; $a < 33; $a++) {
  rewind($fp);

  $dtlCopLeapYearOffset = $a;
  $count = 0;
  $totalDiff = 0;

  while (!feof($fp)) {
    $dtNVE = trim(fgets($fp));
    if (!dtlIsDateTimeStr($dtNVE)) {
      continue;
    }
    $gd = dtlGetDate($dtNVE);
    $t = dtlGetTime($dtNVE);
    $hour = dtlGetHours($t);
    $cd = dtlGregToCop($gd);
    $cda = dtlCopToArray($cd);
    $str = "$dtNVE = $cd $t";

    // get the date of Aries 1 for this NVE:
    $cdAries1 = dtlCopDate($cda['month'] == 12 ? $cda['year'] + 1 : $cda['year'], 1, 1);
    $str .= " &nbsp;&nbsp;$cdAries1";
    // convert to Gregorian:
    $gdAries1 = dtlCopToGreg($cdAries1);
    // get datetime:
    $dtAries1 = $gdAries1 . " 00:00:00";
    $str .= " &nbsp;&nbsp;$dtAries1";
    // cal difference between NVE and start of calendar year:
    $diff = abs(dtlDateTimeDiff($dtNVE, $dtAries1));
    $str .= " &nbsp;&nbsp;$diff";

    printbr($str);

    // tally up:
    $count++;
    $totalDiff += $diff;
  }

  // finished testing that combo of a and b:
  $avgDiff = $totalDiff / $count;
  printbr("a=$a : average diff = $avgDiff days");
  if ($min == -1 || $avgDiff < $min) {
    $min = $avgDiff;
    $minA = $a;
  }
}

fclose($fp);
printbr("lowest average was $min days, with a=$minA");

// result: lowest average was 0.2499139967138 days, with a=0 and b=2
