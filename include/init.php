<?php
session_start();

// Error settings:
error_reporting(E_ALL & ~E_STRICT & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
ini_set('log_errors', 1);

// find directory:
$local = strpos($_SERVER['HTTP_HOST'], 'earthiancalendar.info') === FALSE;
if ($local) {
	$baseUrl = "http://earthiancalendar.local";
	$smUrl = "http://shaunmoss.local";
}
else {
	$baseUrl = "https://earthiancalendar.info";
	$smUrl = "https://shaunmoss.com";
}

$baseDir = substr(__DIR__, 0, strlen(__DIR__) - strlen('/include'));
$imagesUrl = "$baseUrl/images";
$imagesDir = "$baseDir/images";
$libUrl = "$baseUrl/lib";
$libDir = "$baseDir/lib";
$classUrl = "$baseUrl/class";
$classDir = "$baseDir/class";

// standard includes:
require_once "$libDir/strings.php";
require_once "$libDir/debug.php";
require_once "$libDir/urls.php";
$debugMode = true;
