/**
 * @todo Implement and test properly, with all parameters as provided by PHP.
 */
function preg_match(pattern, subject)
{
	var limitChar = pattern.charAt(0);
	var posEndPattern = pattern.lastIndexOf(limitChar);
	var flags = pattern.substr(posEndPattern + 1);
	pattern = pattern.substr(1, posEndPattern - 1);
//	alert("subject = " + subject + ", pattern = " + pattern + ", flags = " + flags);
	var rx = new RegExp(pattern, flags);
	return rx.test(subject) ? 1 : 0;
}

