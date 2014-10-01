<?php
// requires strings.php

function copyArrayToClient($ar, $arName, $createVar = true)
{
	// copies array to the client, outputting javascript:
	// $arName must be the name of the array variable as a string, e.g. 'ar'
	if ($createVar)
		println("var $arName = new Array();");
	if (!$ar)
		return;
	foreach($ar as $key => $value)
	{
		if (!is_int($key))
			$key = "'$key'";
		print($arName."[".$key."] = ");

		if (is_int($value) || is_float($value))
			println("$value;");
		else if (is_string($value))
			println("'".addslashes_nl($value)."';");
		else if (is_bool($value))
			println(bool2str($value));
		else if (is_array($value))
		{
			println("new Array();");
			copyArrayToClient($value, $arName."[".$key."]", false);
		}
		else if (is_null($value))
			println("null;");
	}
}


/**
 * Works just like implode, except empty strings ignored.
 *
 * @param string $glue
 * @param string[] $pieces
 * @return string
 */
function implode_trim($glue, $pieces)
{
	if (func_num_args() > 2 || !is_array($pieces))
	{
		$pieces = func_get_args();
		unset($pieces[0]);
	}
	$result = '';
	foreach ($pieces as $piece)
	{
		if ($piece != '' && $piece != null)
		{
			if ($result != '')
			{
				$result .= $glue;
			}
			$result .= $piece;
		}
	}
	return $result;
}


/**
 * Joins all the pieces together, separated by commas.  Empty strings ignored.
 *
 * @param string[] $pieces
 * @return string
 */
function implode_commas($pieces)
{
	if (func_num_args() > 1 || !is_array($pieces))
	{
		$pieces = func_get_args();
	}
	// remove any trailing commas:
	foreach ($pieces as $i => $piece)
	{
		if (right($piece, 1) == ',')
		{
			$pieces[$i] = left($piece, strlen($piece) - 1);
		}
		$pieces[$i] = trim($pieces[$i]);
	}
	return implode_trim(', ', $pieces);
}


/**
 * Joins all the pieces together, separated by break tags.  Empty strings ignored.
 *
 * @param string[] $pieces
 * @return string
 */
function implode_br($pieces)
{
	if (func_num_args() == 1 && is_array($pieces))
	{
		return implode_trim('<br />', $pieces);
	}
	else
	{
		$pieces = func_get_args();
		return implode_trim('<br />', $pieces);
	}
}


/**
 * Same as implode commas, except that the last glue will be ' and ' instead of ', '.
 *
 * @param string[] $pieces
 * @return string
 */
function implode_and($pieces)
{
	$result = '';
	$pieces = array_values($pieces);
	for ($i = 0; $i < count($pieces); $i++)
	{
		if ($pieces[$i] != '')
		{
			if ($result != '')
			{
				$result .= ($i == count($pieces) - 1) ? ' and ' : ', ';
			}
			$result .= $pieces[$i];
		}
	}
	return $result;
}


function array_trim($ar)
{
	// removes all empty strings and null values from an array
	// (does not remove zeros or falses)
	foreach ($ar as $key => $val)
	{
		if ($val === '' || $val === null)
		{
			unset($ar[$key]);
		}
	}
	return $ar;
}


function array_is_empty($ar)
{
	// returns true if array full of empty/false values
	// i.e. false, 0, null, or ''
	if (!$ar)
		return true;
	$is_empty = true;
	foreach ($ar as $val)
	{
		if ($val)
		{
			$is_empty = false;
			break;
		}
	}
	return $is_empty;
}

?>
