<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";

for ($y = 2000; $y <= 2100; $y++)
{
	$len = EarthianDate::daysInYear($y);
	$isLeapYear = $len == 366;
	if ($isLeapYear) print "<font color='red'>"; 
	printbr("Length of year $y = $len");
	if ($isLeapYear) print "</font>"; 
}

?>