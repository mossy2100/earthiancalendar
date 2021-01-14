<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";

for ($mjd = 54700; $mjd < 55100; $mjd++) {
  printbr("$mjd == " . EarthianDate::fromMjd($mjd));
}
