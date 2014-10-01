<?php
require "../include/init.php";
require "$libDir/dtl.php";

$dateTimePattern = "/([a-z]{3})\s{1,2}(\d{1,2})\s{1,2}(\d{1,2})\s{1,2}(\d{1,2})/i";

$lunarPhases = array();

$monthAbbrev2Number = array(
	'Jan' => 1,
	'Feb' => 2,
	'Mar' => 3,
	'Apr' => 4,
	'May' => 5,
	'Jun' => 6,
	'Jul' => 7,
	'Aug' => 8,
	'Sep' => 9,
	'Oct' => 10,
	'Nov' => 11,
	'Dec' => 12
);

$offset2Phase = array(
	4 => 'NewMoon',
	20 => 'FirstQuarter',
	36 => 'FullMoon',
	52 => 'LastQuarter'
);

$outputFile = "../data/LunarPhases.txt";
$fout = fopen($outputFile, "w");
fprintf($fout, "%10s%25s%25s%25s%25s\n", "Lunation", "New Moon", "First Quarter", "Full Moon", "Last Quarter");

$lunation = -2820;
$dtNewMoon = "";
$dtFirstQuarter = "";
$dtFullMoon = "";
$dtLastQuarter = "";
for ($year = 1695; $year <= 2035; $year++)
{
	$url = "http://aa.usno.navy.mil/cgi-bin/aa_moonphases.pl?year=$year";
	$lines = file($url);
	foreach ($lines as $line)
	{
		$nMatches = preg_match_all($dateTimePattern, $line, $matches, PREG_OFFSET_CAPTURE);
		if ($nMatches > 0)
		{
//			debug($matches);
			foreach ($matches[0] as $index => $match)
			{
				$month = $monthAbbrev2Number[$matches[1][$index][0]];
				$day = $matches[2][$index][0];
				$hour = $matches[3][$index][0];
				$minute = $matches[4][$index][0];
				$dts = dtlDateTimeStr($year, $month, $day, $hour, $minute);
				$phase = $offset2Phase[$match[1]];
				${"dt$phase"} = $dts;
			}
			// output a line to the data file:
			if ($phase == "LastQuarter")
			{
				fprintf($fout, "%10d%25s%25s%25s%25s\n", $lunation, $dtNewMoon, $dtFirstQuarter, $dtFullMoon, $dtLastQuarter);
				$dtNewMoon = "";
				$dtFirstQuarter = "";
				$dtFullMoon = "";
				$dtLastQuarter = "";
				$lunation++;
			}
		}
	}
}

// output last line to the data file:
if ($phase != "LastQuarter")
{
	fprintf($fout, "%10d%25s%25s%25s%25s\n", $lunation, $dtNewMoon, $dtFirstQuarter, $dtFullMoon, $dtLastQuarter);
}

println("<pre>");
readfile($outputFile);
println("</pre>");

fclose($fout);
?>