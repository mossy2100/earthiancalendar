<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";

$veyl = 365.2424;

for ($n = 1; $n <= 2000; $n++) {
  $x = ($veyl - 365) * $n;
  $x2 = round($x, 2);
  $x0 = round($x, 0);
  $x3 = round($x, 3);
  if ($x0 == $x2) {
    printbr("In a cycle of $n years, we would need $x3 leap years.");
  }
}
