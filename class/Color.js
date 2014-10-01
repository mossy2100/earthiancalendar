///////////////////////////////////////////////////////////////////////////////
// Color class

function Color(red, green, blue)
{
	red = parseInt(red, 10);
	this.red = isNaN(red) ? 0 : red;
	green = parseInt(green, 10);
	this.green = isNaN(green) ? 0 : green;
	blue = parseInt(blue, 10);
	this.blue = isNaN(blue) ? 0 : blue;
}


///////////////////////////////////////////////////////////////////////////////
// Color class - static methods

Color.add = function(color1, color2)
{
	var red = color1.red + color2.red;
	var green = color1.green + color2.green;
	var blue = color1.blue + color2.blue;
	return new Color(red, green, blue);
};


Color.average = function(color1, color2)
{
	var red = Math.round((color1.red + color2.red) / 2);
	var green = Math.round((color1.green + color2.green) / 2);
	var blue = Math.round((color1.blue + color2.blue) / 2);
	return new Color(red, green, blue);
};


Color.clone = function(color)
{
	return new Color(color.red, color.green, color.blue); 
};


Color.fromHexString = function(hexColorString)
{
	// Matches #hhhhhh or hhhhhh
	var re = /^#?[0-9a-f]{6}$/i;
	if (!re.test(hexColorString))
	{
		return null;		
	}
	var color = new Color();
	// remove leading '#' if present:
	if (hexColorString.length == 7)
	{
		hexColorString = hexColorString.substr(1);
	}
	var red = parseInt(hexColorString.substr(0, 2), 16);
	var green = parseInt(hexColorString.substr(2, 2), 16);
	var blue = parseInt(hexColorString.substr(4, 2), 16);
	return new Color(red, green, blue);
};


Color.scale = function(color, factor)
{
	var red = Math.round(color.red * factor);
	var green = Math.round(color.green * factor);
	var blue = Math.round(color.blue * factor);
	return new Color(red, green, blue);
};


Color.subtract = function(color1, color2)
{
	var red = color1.red - color2.red;
	var green = color1.green - color2.green;
	var blue = color1.blue - color2.blue;
	return new Color(red, green, blue);
};


///////////////////////////////////////////////////////////////////////////////
// Color class - instance methods

Color.prototype.toHexString = function()
{
	var hexRed = twoDigits(dechex(this.red));
	var hexGreen = twoDigits(dechex(this.green));
	var hexBlue = twoDigits(dechex(this.blue));
	return "#" + hexRed + hexGreen + hexBlue;
};

