<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";

// last thing to do (curiousity)
// list of leap years, from year 0-32
for ($y = 0; $y <= 32; $y++) {
  $ly = dtlCopIsLeapYear($y);
  $color = $ly ? 'red' : 'blue';
  printbr("<span style='color:$color'>$y is " . ($ly ? '' : 'not') . ' a leap year</span>');
}
