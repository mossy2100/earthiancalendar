<?php
/*
 * @todo
 * - test fromMjd and toMjd on the server.
 * - update isLeapYear in PHP version and test
 * - fix function in DTL that determines day of the week (client and server-side)
 */

require_once "include/init.php";
require_once "tpl/TemplateTop.php";
require_once "$libDir/dtl.php";
require_once "$libDir/dtlSelect.php";
require_once "$classDir/EarthianDate.php";
?>

<style>
#tblForm {
	border-collapse: separate;
	margin: auto;
}

#tblForm td.dateType {
	background-color: #EEE;
	padding: 15px;
	border: solid 1px Silver;
	width: 220px;
	text-align: center;
}

#tblForm td.convertMenu {
	text-align: left;
}

#tblForm h3 {
	margin: 0px;
}

#tblForm p {
	margin-bottom: 0px;
}

#mjd {
	width: 75px;
	background-color: White;
	border: solid 1px Silver;
}

select {
	background-color: White;
	border: solid 1px Silver;
	height: 18px;
}

.dateType
{
	line-height: 20px;
}

.dateType span
{
	color: ForestGreen;
}

.arrow
{
	width: 20px;
	height: 20px;
	background-color: #ddd;
	color: Black;
	border: solid 1px #fff;
	border-bottom-color: #aaa; 
	border-right-color: #aaa; 
	padding: 1px;
}

a.arrow:hover
{
	background-color: #b2e0f9;
	color: Black;
	text-decoration: none;
}
</style>

<h1>Date Converter</h1>
<p>Here you can convert Gregorian dates to Earthian and vice-versa.
To find out your Earthian birth date, enter the date you were born, including the year, in the Gregorian Date selector - then click the &quot;Convert&quot; button below.</p>

<form id='formConvert'>
<table id='tblForm' border='0' cellspacing='10' cellpadding='5'>
<tr>
	<td class='dateType'>
		<h3>Gregorian Date</h3>
		<p><a class='arrow' href="javascript:gregorianPreviousDay()">&lt;</a><?php
			dtlDateSelector('gregDate', '0000-00-00', 'YYYYMonthD', '', 1900, 2100); ?><a class='arrow'
			href="javascript:gregorianNextDay()">&gt;</a></p>
		<p><input type="button" value="Convert" onclick="convertGregorian()" /></p>
		<p>
			<span id="gregDayOfWeekName"></span><br />
			Day <span id="gregDayOfYear"></span> of year <span id="gregYear"></span><br />
			Day <span id="gregDayOfWeek"></span> of week <span id="gregWeekOfYear_week"></span>
			of year <span id="gregWeekOfYear_year"></span>
		</p>
		<p><a href="javascript:setGregYearBegin()">Beginning of year</a> -
		<a href="javascript:setGregYearEnd()">End of year</a></p>
	</td>
	<td class='dateType'>
		<h3>Earthian Date</h3>
		<p><a class='arrow' href="javascript:earthianPreviousDay()">&lt;</a><?php
			$attribs = array('onchange' => 'checkDaySelector();');
			echo EarthianDate::dateSelector("earthDate", null, $attribs, -108, 93); ?><a class='arrow' href="javascript:earthianNextDay()">&gt;</a></p>
		<p><input type="button" value="Convert" onclick="convertEarthian()" /></p>
		<p>
			<span id="earthDayOfWeekName"></span><br />
			Day <span id="earthDayOfYear"></span> of year <span id="earthYear"></span><br />
			Day <span id="earthDayOfWeek"></span> of week <span id="earthWeekOfYear_week"></span>
			of year <span id="earthWeekOfYear_year"></span>
		</p>
		<p><a href="javascript:setEarthYearBegin()">Beginning of year</a> -
		<a href="javascript:setEarthYearEnd()">End of year</a></p>
	</td>
</tr>
<tr>
	<td class='dateType'>
		<a href="javascript:setToday()">Today</a> -
		<a href="javascript:setEaster()">Easter</a> -
		<a href="javascript:setChristmas()">Christmas</a>
	</td>
	<td class='dateType'>
		Modified Julian Day: <input id="mjd" value="" onchange="convertMjd()" />
	</td>
</tr>
</table>
</form>
<br />


<?php
includeJavaScript("$libUrl/strings.js");
includeJavaScript("$libUrl/numbers.js");
includeJavaScript("$libUrl/arrays.js");
includeJavaScript("$libUrl/php-strings.js");
includeJavaScript("$libUrl/php-pcre.js");
includeJavaScript("$libUrl/dtl.js");
includeJavaScript("$classUrl/EarthianDate.js");
// code behind:
includeJavaScript("DateConvert.js");
require "tpl/TemplateBottom.php";
?>