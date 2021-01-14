<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";

///////////////////////////////////////////////////////////////////////////////////////////
/*
 * Last test
 * =========
 *
 * Want to know
 * which has the lowest maximum difference between the NVE and NYE.
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
  $maxDiff = 0;

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

    // tally up:
    if ($diff > $maxDiff) {
      $maxDiff = $diff;
    }
    printbr($str);
  }

  printbr("maxDiff for a=$a is $maxDiff days");
  if ($min == -1 || $maxDiff < $min) {
    $min = $maxDiff;
    $minA = $a;
  }
}

fclose($fp);
printbr("minimum maximum difference = $min, with a=$minA");
// minimum maximum difference = 0.5534722222219, with a=7 and b=1
// but actually it's the same for all 3 combinations we wer trying to test:
// a=7, b=1
// a=8, b=2
// a=9, b=3

// CHOOSE a=8, b=2, since this is the median, and easy to remember
