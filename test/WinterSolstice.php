<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";


$fp = fopen("../data/SeasonalMarkers.txt", "r");
$dateTimePattern = "/[\-\d]+ \d\d:\d\d/";
$seasonalMarkers = array();

$dayCount = array();
if ($fp)
{
	while (!feof($fp))
	{
		$line = fgets($fp);
		$nMatches = preg_match_all($dateTimePattern, $line, $matches);
		if ($nMatches == 4)
		{
			$winterSolstice = $matches[0][3]; 
			$dtParts = explode(' ', $winterSolstice);
			$date = $dtParts[0];
			$time = $dtParts[1];
			// fix the year format:
			if ($date[0] == '-')
			{
				// We'll skip the -ve years for now:
				continue;					
			}
			while (strpos($date, '-') != 4)
			{
				$date = '0'.$date;
			}
			$year = dtlGetYear($date);
			if ($year >= 2007 && $year < 4007)
			{
				$earthDate = EarthianDate::fromGregorian($date);	
				$dayCount[$earthDate->day]++;
			}	 
		}
	}
}

ksort($dayCount);
debug($dayCount);
$total = array_sum($dayCount);
foreach ($dayCount as $day => $nDays)
{
	$dayCount[$day] = number_format($nDays / $total * 100, 1).'%'; 
}
debug($dayCount);
?>