
/**
 * Returns the value of the selected radio button in the specified group.
 * Returns false if the group is not found or none of the buttons are selected.
 *
 * @param string name
 * @return string
 */
function rbGetSelectedValue(name)
{
	var radioButtons = document.getElementsByName(name);
	if (!radioButtons.length)
	{
		return false;
	}
	var rb;
	for (var i in radioButtons)
	{
		rb = radioButtons[i];
		if (rb.checked)
		{
			return rb.value;
		}
	}
	return false;
}


/**
 * Returns the id of the radio button identified by name and value.
 * Returns false if the radio button cannot be found.
 *
 * @param string name
 * @param string value
 * @return string
 */
function rbGet(name, value)
{
	var radioButtons = document.getElementsByName(name);
	if (!radioButtons.length)
	{
		return false;
	}
	var rb;
	for (var i in radioButtons)
	{
		rb = radioButtons[i];
		if (rb.value == value)
		{
			return rb;
		}
	}
	return false;
}


/**
 * Returns the selected (checked) radio button in the group identified by name.
 * Returns null if none selected.
 *
 * @param string name
 * @return object (radio button)
 */
function rbGetSelected(name)
{
	var radioButtons = document.getElementsByName(name);
	if (!radioButtons.length)
	{
		return false;
	}
	var rb;
	for (var i = 0; i < radioButtons.length; i++)
	{
		rb = radioButtons[i];
		if (rb.checked)
		{
			return rb;
		}
	}
	return null;
}


/**
 * Selects the radio button with value=value in the group specified by name.
 * Returns false if the radio button could not be found.  Returns true otherwise.
 *
 * @param string name
 * @param string value
 * @return bool
 */
function rbCheck(name, value)
{
	var rb;
	if (rb = rbGet(name, value))
	{
		rb.checked = true;
		return true;
	}
	return false;
}


/**
 * Unchecks the radio button identified by id.
 * Returns false if the radio button could not be found.  Returns true otherwise.
 *
 * @param string name
 * @param string value
 * @return bool
 */
function rbUncheck(name, value)
{
	var rb;
	if (rb = rbGet(name, value))
	{
		rb.checked = false;
		return true;
	}
	return false;
}


/**
 * Unchecks all the radio buttons in a group.
 * Returns false if the radio button group could not be found.  Returns true otherwise.
 *
 * @param string name
 * @return bool
 */
function rbUncheckAll(name)
{
	var radioButtons = document.getElementsByName(name);
	if (!radioButtons.length)
	{
		return false;
	}
	var rb;
	for (var i in radioButtons)
	{
		rb = radioButtons[i];
		rb.checked = false;
	}
	return true;
}


/**
 * Enables (default) or disables a given radio button.
 * Returns false if the radio button could not be found.  Returns true otherwise.
 *
 * @param string name
 * @param string value
 * @param bool enable Optional parameter, defaults to true.
 * @return bool
 */
function rbEnable(name, value, enable)
{
	// check optional param:
	if (enable == null)
	{
		enable = true;
	}
	var rb;
	if (rb = rbGet(name, value))
	{
		rb.disabled = !enable;
		return true;
	}
	return false;
}


/**
 * Enables (default) or disables all the radio buttons in a group.
 * Returns false if the radio button group could not be found.  Returns true otherwise.
 *
 * @param string name
 * @param bool enable Optional parameter, defaults to true.
 * @return bool
 */
function rbEnableAll(name, enable)
{
	// check optional param:
	if (enable == null)
	{
		enable = true;
	}
	var radioButtons = document.getElementsByName(name);
	if (!radioButtons.length)
	{
		return false;
	}
	var rb;
	for (var i in radioButtons)
	{
		rb = radioButtons[i];
		rb.disabled = !enable;
	}
	return true;
}


/**
 * Disables a radio button.
 * Returns false if the radio button could not be found.  Returns true otherwise.
 *
 * @param string name
 * @param string value
 * @param bool enable Optional parameter, defaults to true.
 * @return bool
 */
function rbDisable(name, value)
{
	return rbEnable(name, value, false);
}


/**
 * Disables all the radio buttons in a group.
 * Returns false if the radio button group could not be found.  Returns true otherwise.
 *
 * @param string name
 * @return bool
 */
function rbDisableAll(name)
{
	rbEnableAll(name, false);
}
