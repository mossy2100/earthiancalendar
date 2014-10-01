<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";


$a = 8; // must be from 0..32


function IsLeapYear($year)
{
	global $a;
	return ($year + $a) % 33 % 4 == 2;
}


$basicPattern = "001000100010001000100010001000100";


$basicPattern = "";
for ($a = 0; $a < 100; $a++)
{
	$basicPattern .= (int)($a % 33 % 4 == 2);
}
printbr("basic pattern = $basicPattern");



$patterns = array();
$offsets = array();

for ($a = 0; $a < 33; $a++)
{
	$twoGenerations = $basicPattern.$basicPattern;
	$pattern = substr($twoGenerations, $a, 33);
//	printbr($pattern);
}




$patterns = array();
$offsets = array();

for ($a = 0; $a < 33; $a++)
{
	$pattern = "";
	for ($y = 0; $y < 33; $y++)
	{
		$ly = (int)IsLeapYear($y);
		$pattern .= $ly;
	}
	if (!in_array($pattern, $patterns, true))
	{
		// add to results:
		$patterns[] = $pattern;
		$offsets[] = array('pattern' => $pattern, 'a' => $a, 'b' => $b);	
	}
}


foreach ($offsets as $offset)
{
	$pattern = str_replace('0000', "<span style='color:green'>0000</span>", $offset['pattern']);
	printbr("a={$offset['a']}, b={$offset['b']} => <span style='color:red'>$pattern</span><span style='color:blue'>$pattern</span>"); 
}
//debug($offsets);





?>