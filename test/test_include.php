<?php

require "../lib/debug.php";
require "../lib/strings.php";
require "../lib/urls.php";
require "../lib/dtl.php";

$debugMode = true;

debug($_SERVER);


for ($i = -10; $i <= 10; $i++)
{
	$d = dtlMJDToDate($i);
	$dow = dtlGetDayOfWeek($d);
	printbr("MJD = $i, date = $d, dayofweek = ".$dtlLanguages['EN']['dayNames'][$dow]);
}



?>