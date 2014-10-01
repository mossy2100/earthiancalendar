/**
 * Get the page element with a given id.
 *
 * @param	string	id	The element's id
 * @return	object		The page element
 */
function el(id)
{
	return document.getElementById(id);
}


/**
 * Gets the inner HTML of a span or similar element with a given id.
 *
 * @param	string	id	The element's id
 * @return	string		The inner HTML
 */  
function getInnerHTML(id)
{
	var obj = el(id);
	return obj ? obj.innerHTML : null;
}


/**
 * Gets the value of a form field with a given id.
 *
 * @param	string	id	The element's id
 * @return	string		The value
 */  
function getValue(id)
{
	var obj = el(id);
	return obj ? obj.value : null;
}


/**
 * Sets the inner HTML of a span or similar element with a given id.
 *
 * @param	string	id	The element's id
 * @param	var			The HTML
 */  
function setInnerHTML(id, val)
{
	var obj = el(id);
	if (obj)
	{
		obj.innerHTML = val;
	}
}


/**
 * Sets the value of a form field with a given id.
 *
 * @param	string	id	The element's id
 * @param	var			The value
 */  
function setValue(id, val)
{
	var obj = el(id);
	if (obj)
	{
		obj.value = val;
	}
}


/**
 * Returns true if the checkbox with the given id is checked.
 *
 * @param	string	id	The element's id
 * @return	bool		True if thecheckbox is checked, otherwise false
 */  
function isChecked(id)
{
	var obj = el(id);
	return obj ? obj.checked : null;
}


/**
 * Sets the check state of a checkbox with a given id.
 *
 * @param	string	id				The element's id
 * @param	bool	isChecked=true	True if the checkbox is to be checked, false if unchecked 
 */  
function check(id, isChecked)
{
	// set default value for isChecked:
	if (typeof(isChecked) == 'undefined')
	{
		isChecked = true;
	}
	var obj = el(id);
	obj.checked = isChecked;
}


/**
 * Unchecks the checkbox with a given id.
 *
 * @param	string	id	The element's id
 */  
function uncheck(id)
{
	var obj = el(id);
	obj.checked = false;
}


/**
 * Gets the style of a page element with a given id.
 *
 * @param	string	id	The element's id
 * @return	object		The element's style
 */  
function getStyle(id)
{
	var obj = el(id);
	return obj ? obj.style : null;
}


/**
 * Shows a page element with a given id.  The second param can be true or false, or it can be a string
 * for the display value (i.e. none, block, inline) 
 *
 * @param	string	id		The element's id
 * @param	bool or string	Whether or not to display the element
 */  
function show(id, display)
{
	// set default value for display:
	if (display == undefined || display === true)
	{
		display = '';
	}
	else if (display === false)
	{
		display = 'none';
	}
	var style = getStyle(id);
	style.display = display;
}


/**
 * Hides a page element with a given id.
 *
 * @param	string	id	The element's id
 */  
function hide(id)
{
	var style = getStyle(id);
	style.display = 'none';
}


/**
 * Enables (default) or disables a page element with a given id.
 *
 * @param	string	id				The element's id
 * @param	bool	enabled = true	Whether or not the element is enabled
 */  
function enable(id, enabled)
{
	// set default value for enabled:
	if (enabled === undefined)
	{
		enabled = true;
	}
	var obj = el(id);
	obj.disabled = !enabled;
}


/**
 * Disables a page element with a given id.
 *
 * @param	string	id	The element's id
 */  
function disable(id)
{
	var obj = el(id);
	obj.disabled = true;
}


/**
 * Submits a form with a given id.
 *
 * @param	string	id	The form's id
 */  
function submit(id)
{
	el(id).submit();
}
