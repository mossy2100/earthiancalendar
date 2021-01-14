/**
 * money.js
 * ========
 * A variety of handy functions for working with money.
 *
 * @author		Shaun Moss
 * @lastUpdate	2008-09-05
 * @requires	numbers.js
 * @requires	php-strings.js
 */


function moneyFormat(number)
{
	if (round(number, 2) == round(number))
		return numberFormat(number, 0);
	else
		return numberFormat(number, 2);
}


function formatMoneyField(form, fieldName, negativesAllowed)
{
	// formats a money field to either whole dollars or cents:
	// get value:
	var value = strtonum(form[fieldName].value);
	// if an integer, then round off to an integer, else 2 decimal places:
	var min = negativesAllowed ? -Infinity : 0;
	if (round(value, 2) == round(value))
		formatNumberField(form, fieldName, 0, min);
	else
		formatNumberField(form, fieldName, 2, min);
}


function moneyToWords(amount)
{
	var dollars = Math.floor(amount);
	var cents = Math.round((amount - dollars) * 100);
	var result = numberToWords(dollars) + " Australian Dollar";
	if (dollars != 1)
		result += "s";
	if (cents > 0)
		result += " and " + numberToWords(cents) + " Cent";
	if (cents > 1)
		result += "s";
	return result;
}


function extractPrice(displayPrice)
{
	// extracts an actual number from the displayPrice
	// returns an empty string if no price found
	var re = /[\d,.]+(k|M| Million)?/i;
	var matches = displayPrice.match(re);
	//debug_r(matches);
	var prices = [0, 0];
	if (matches)
	{
		prices[0] = matches[0];
		var rem = displayPrice.substr(matches.lastIndex);
		matches = rem.match(re);
		if (matches)
			prices[1] = matches[0];
	}
	else
		return prices;
	//alert('loPrice=' + prices[0] + '; hiPrice=' + prices[1]);
	// process matches - convert strings to numbers:
	var i, price, mult;
	for (i = 0; i <= 1; i++)
	{
		price = (prices[i] + '').toLowerCase();
		if (price.indexOf(' million') != -1)
		{
			price = str_replace(' million', '', price);
			mult = 1000000;
		}
		else if (price.indexOf('k') != -1)
		{
			price = str_replace('k', '', price);
			mult = 1000;
		}
		else if (price.indexOf('m') != -1)
		{
			price = str_replace('m', '', price);
			mult = 1000000;
		}
		else
			mult = 1;
		prices[i] = strtonum(price) * mult;
	}
	// multiply first number to make both numbers the same order of magnitude:
	while (prices[0] < prices[1] / 10)
		prices[0] *= 10;
	return prices;
}
