<?php
$SubmenuVisible = $_SESSION["SubmenuVisible"];
?>
<div id='menu'>
    <ul id='ulTextItems'>
		<li><a href='index.php'>Introduction and Summary</a></li>
		<li><a href='DateConvert.php'>Date Converter (Find Your Birthday)</a></li>
		<li><a href='Generator.php'>PDF &amp; HTML Calendar Generator</a></li>
    <li><a href="Design.php">Design Principles</a></li>
    <li><a href="CalendarTypes.php">Solar, Lunar and Lunisolar Calendars</a></li>
    <li><a href="Years.php">Years and Leap Years</a></li>
    <li><a href="Months.php">Months</a></li>
    <li><a href="Weeks.php">Weeks and Days of the Week</a></li>
    <li><a href='Holidays.php'>Holy Days and Holidays</a></li>
    <li><a href='Compare.php'>Calendar Comparison</a></li>
    <li><a href="Units.php">Units</a></li>
    <li><a href="Notation.php">Notation</a></li>
    <li><a href="Modulo.php">Modulo Operator  Explained</a></li>
		<li><a href="Background.php">Background</a></li>
		<li><a href="Glossary.php">Glossary</a></li>
	</ul>
</div>

<script type="text/javascript">

var isScrolling = new Array();


function showSubmenu(menuName)
{
	// if it's already showing, nothing to do:
	var submenu = el(menuName + 'Submenu');
	if (isScrolling[menuName] || submenu.style.display == "block")
	{
		return;
	}
	// point the submenu arrow down:
	var arrow = el(menuName + 'SubmenuArrow');
	arrow.src = "images/arrowDown.png";
	// show the submenu:
	submenu.style.display = "block";
	submenu.style.height = "10px";
	scrollSubmenuDown(menuName);
}


function scrollSubmenuDown(menuName)
{
	var submenu = el(menuName + 'Submenu');
	var ulSubmenu = el('ul' + menuName + 'Submenu');
	var hDiv = submenu.offsetHeight;
	var hUl = ulSubmenu.offsetHeight;
	if (hDiv >= hUl)
	{
		isScrolling[menuName] = false;
		return;
	}
	else
	{
		isScrolling[menuName] = true;
		hDiv += Math.min(10, hUl - hDiv);
		submenu.style.height = hDiv + "px";
		setTimeout("scrollSubmenuDown('" + menuName + "')", 20);
	}
}


function scrollSubmenuUp(menuName)
{
	var submenu = el(menuName + 'Submenu');
	var hDiv = submenu.offsetHeight;
	if (hDiv < 10)
	{
		submenu.style.display = "none";
		// point the submenu arrow down:
		var arrow = el(menuName + 'SubmenuArrow');
		arrow.src = "images/arrowRight.png";
		isScrolling[menuName] = false;
		return;
	}
	else
	{
		isScrolling[menuName] = true;
		hDiv -= 10;
		submenu.style.height = hDiv + "px";
		setTimeout("scrollSubmenuUp('" + menuName + "')", 20);
	}
}


function submenuArrowClick(menuName)
{
	// if it's already showing, nothing to do:
	if (isScrolling[menuName])
	{
		return;
	}
	var submenu = el(menuName + 'Submenu');
	var makeVisible = submenu.style.display == "none";
	// Tell the server the new menu state:
	$.get("SetSubmenuState.php", {menuName: menuName, visible: makeVisible});
	// Show/hide the submenu:
	if (makeVisible)
	{
		showSubmenu(menuName);
	}
	else
	{
		scrollSubmenuUp(menuName);
	}
}
</script>
