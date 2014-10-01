<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";

// vernal equinox at beginning of year 0000 in Copernicus Calendar:
$dt = "2007-03-21 00:07:00";

// 1 Aries 0000 in Gregorian:
$d = "2007-03-21";

$mjd = dtlDateToMJD($d);

printbr($mjd);

$mjd = 54180;

?>