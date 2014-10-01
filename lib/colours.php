<?
// functions for working with colours:

function hex2rgb($hex)
{
	// converts a colour in 3-byte format (000000-FFFFFF) into RGB components (0..255, 0..255, 0..255)
	// result is an array with 3 keys: 'red', 'green', 'blue'
	if (strlen($hex) == 7)
	{
		$hex = substr($hex, 1);
	}
	$result['red'] = hexdec(substr($hex, 0, 2));
	$result['green'] = hexdec(substr($hex, 2, 2));
	$result['blue'] = hexdec(substr($hex, 4, 2));
	return $result;
}


function hex2frac($hex)
{
	// converts a colour in 3-byte format (000000-FFFFFF) into RGB components (0..255, 0..255, 0..255)
	// result is an array with 3 keys: 'red', 'green', 'blue'
	$result = hex2rgb($hex);
	$result['red'] = $result['red'] / 255;
	$result['green'] = $result['green'] / 255;
	$result['blue'] = $result['blue'] / 255;
	return $result;
}


function rgb2hex($red, $green, $blue)
{
	// converts RGB components (0..255, 0..255, 0..255) into a colour in 3-byte format (000000-FFFFFF)
	// result is a 6-character string
	$rr = str_pad(base_convert($red, 10, 16), 2, '0', STR_PAD_LEFT);
	$gg = str_pad(base_convert($green, 10, 16), 2, '0', STR_PAD_LEFT);
	$bb = str_pad(base_convert($blue, 10, 16), 2, '0', STR_PAD_LEFT);
	return $rr.$gg.$bb;
}
?>
