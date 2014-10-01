<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";

for ($y = -33; $y <= 70; $y++)
{
	$isLeapYear = EarthianDate::isLeapYear($y);
	$color = $isLeapYear ? 'blue' : 'red';
	printbr("<span style='color:$color'>year $y ".bool2str($isLeapYear)."</span>");
}

?>