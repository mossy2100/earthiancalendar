<?php
// The purpose of this script is to parse the original data for NVE (northern vernal equinox) dates
// copied from http://www.ns1763.ca/equinox/eqindex.html and organise them into a more useful format.

require "include/init.php";
require "$libDir/dtl.php";

$numsPattern = str_repeat("(\s+\d{2})", 15); 

$regex = "|^\d{4}$numsPattern$|";

$fpIn = fopen("$smDir/calendars/copernicus/VernalEquinoxDatesIn.txt", "r");
$fpOut = fopen("$smDir/calendars/copernicus/VernalEquinoxDates.txt", "w");
if (!$fpIn || !$fpOut)
{
	echo "Couldn't open files.";
	exit;	
}

while (!feof($fpIn))
{
	$line = trim(fgets($fpIn));
	printbr($line);
	if (preg_match($regex, $line, $matches))
	{
//		debug($matches);
		$year = (int)trim($matches[0]);
		$month = 3;
		$day = (int)trim($matches[1]);
		$hour = (int)trim($matches[2]);
		$minute = (int)trim($matches[3]);
		$dt = dtlDateTimeStr($year, $month, $day, $hour, $minute, 0);
		fputs($fpOut, $dt."\n"); 
		printbr($dt);
		printbr(); 
	}
}

fclose($fpIn);
fclose($fpOut);


?>