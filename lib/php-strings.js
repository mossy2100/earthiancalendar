/**
 * Constants.
 *
 * @todo This function needs testing.  Test with pad_string more than 1 char and compare with PHP.
 */
var STR_PAD_LEFT = 0;
var STR_PAD_RIGHT = 1;
var STR_PAD_BOTH = 2;
var ENT_NOQUOTES = 0;
var ENT_COMPAT = 2;
var ENT_QUOTES = 3;


/**
 * Replicates PHP function with the same name.
 *
 * @param string str
 * @param int quote_style
 */
function htmlspecialchars(str, quote_style)
{
	var result = str;
	result = str_replace('<', '&lt;', result);
	result = str_replace('>', '&gt;', result);
	if (quote_style != ENT_NOQUOTES)
	{
		result = str_replace('"', '&quot;', result);
	}
	if (quote_style == ENT_QUOTES)
	{
		result = str_replace("'", '&#039;', result);
	}
	result = str_replace('&', '&amp;', result);
	return result;
}


/**
 * @todo This function needs testing.  Test with pad_string more than 1 char and compare with PHP.
 */
function str_pad(input, pad_length, pad_string, pad_type)
{
	if (pad_length < 0 || pad_length <= input.length)
	{
		return input;
	}
	input = String(input);
	var nPadChars = pad_length - input.length;
	var nCopies = Math.ceil(nPadChars / pad_string.length);
	var padStr = str_repeat(pad_string, nCopies);
	padStr = substr(padStr, 0, nPadChars);
	if (pad_type == STR_PAD_LEFT)
	{
		return padStr + input;
	}
	else if (pad_type == STR_PAD_RIGHT)
	{
		return input + padStr;
	}
	else if (pad_type == STR_PAD_BOTH)
	{
		var nPadCharsLeft = Math.round(nPadChars / 2);
		return substr(padStr, 0, nPadCharsLeft) + input + substr(padStr, nPadCharsLeft); 
	}
}


/**
 * This function could possibly be made faster by using string doubling instead of just adding.
 * But probably not necessary.
 * @todo Test.
 */
function str_repeat(input, multiplier)
{
	var result = "";
	for (var i = 0; i < multiplier; i++)
	{
		result += input;
	}
	return result;
}


/**
 * Replaces every occurence of 'search' with 'replace' in 'subject'.
 */
function str_replace(search, replace, subject)
{
	var result = subject;
	var left, right;
	var minSearchPos = 0;
	var searchPos = result.indexOf(search);
	while (searchPos >= minSearchPos)
	{
		// get whatever is to the left of search string:
		left = result.substring(0, searchPos);
		right = result.substr(searchPos + search.length);
		// update result:
		result = left + replace + right;
		// move the minimum search pos to just past the new replacement:
		minSearchPos = searchPos + replace.length;
		// look for search string again:
		searchPos = right.indexOf(search) + minSearchPos;
	}
	return result;
}


function substr(str, start, length)
{
	return str.substr(start, length);
}

