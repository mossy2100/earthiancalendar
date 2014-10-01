<?php
session_start();

// Error settings:
error_reporting(E_ALL & ~E_STRICT & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
ini_set('log_errors', 1);

// find directory:
$local = strpos($_SERVER['HTTP_HOST'], 'earthcalendar.info') === FALSE && strpos($_SERVER['HTTP_HOST'], 'earthcalendar.com') === FALSE;
if ($local) {
	$baseUrl = "http://earthcalendar.local";
	$baseDir = "/Users/shaun/Dropbox/Projects/Calendars/Earth Calendar/earthcalender.info";
	$smUrl = "http://shaunmoss.local";
}
else {
	$baseUrl = "http://earthcalendar.info";
	$baseDir = "/var/aegir/platforms/earthcalendar.info";
	$smUrl = "http://shaunmoss.com";
}

$imagesUrl = "$baseUrl/images";
$imagesDir = "$baseDir/images";
$libUrl = "$baseUrl/lib";
$libDir = "$baseDir/lib";
$classUrl = "$baseUrl/class";
$classDir = "$baseDir/class";

// standard includes:
require_once "$libDir/strings.php";
require_once "$libDir/numbers.php";
require_once "$libDir/debug.php";
require_once "$libDir/urls.php";
$debugMode = true;
