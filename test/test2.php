<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";

// generate dates for all of first 4 years in calendar:
for ($y = 0; $y < 4; $y++)
{
	for ($m = 1; $m <= 12; $m++)
	{
		$dim = EarthianDate::daysInMonth($y, $m);
		for ($day = 1; $day <= $dim; $day++)
		{
			$cd = new EarthianDate($y, $m, $day);
			$mjd = $cd->MJD();
			$gd = dtlMJDToDate($mjd);
			$cd2 = EarthianDate::createFromMJD($mjd);
			$gd2 = $cd->Gregorian();
			printbr("$cd => $mjd => $gd => $cd2 => $gd2");
			if ($gd != $gd2)
			{
				printbr("error");
				exit;
			}
		}
	}
}

?>