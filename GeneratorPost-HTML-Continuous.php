<?php
require "include/init.php";
require "tpl/TemplateTop.php";
require "$libDir/dtl.php";
require "$libDir/arrays.php";
require "$libDir/colors.php";
require "$classDir/EarthianDate.php";

// Get post values:
//debug($_POST);

// cell colors:
for ($i = 1; $i <= 7; $i++)
{
	$hexDayColours[$i] = $_POST["dayColors"][$i];
	$rgbDayColors[$i] = hex2rgb($_POST["dayColors"][$i]);
}
$borderColor = $_POST['borderColor'];
?>

<style>
.control
{
	color: Black;
	background-color: White;
	border: solid 1px DarkGray;
}

.calendarPage
{
	width: 100%;
	border-collapse: collapse;
	margin: auto;
}

.calendarPage th
{
	border: solid 1px <?php echo $borderColor; ?>;
	text-align: center;
	font-size: 13px;
	color: Black;
	padding: 5px 0;
}

.calendarPage td
{
	width: 10%;
	height: 60px;
	border: solid 1px <?php echo $borderColor; ?>;
}

.calendarPage td.empty
{
	border-width:0px;
}

.dayNum
{
	width: 100%;
	text-align: left;
	font-weight: bold;
	vertical-align: top;
	color: Black;
}

.note
{
	width: 100%;
	height: 60px;
	padding: 0;
	margin: 0;
	font-size: 10px;
}

.greg
{
	width: 100%;
	color: Black;
	font-weight: normal;
	font-size: 9px;
	float: right;
	text-align: center;
}

.otherMonth
{
	background-color: #f7f7f7;
	color: #BBBBBB;
}

.month
{
	width: 95%;
	margin: auto;
	margin-bottom: 20px;
	padding: 3px;
}

.month h2
{
	padding: 0px;
	margin: 10px;
	color: Black;
	font-size: 20px;
}

.odd
{
	background-color: White;
}

#tblForm
{
	background-color: #EEE;
	padding: 10px;
	border: solid 1px Silver;
}

#tblForm th
{
	text-align: left;
	background-color: transparent;
	color: Black;
	font-weight: normal;
}

.oddMonthWeekday
{
	background-color: #ffcccc;
}

.oddMonthWeekend
{
	background-color: #ffffcc;
}

.evenMonthWeekday
{
	background-color: #cce5ff;
}

.evenMonthWeekend
{
	background-color: #ccffcc;
}
</style>

<?php
require_once "include/CalculatePages.php";
require_once "include/GetSeasonalMarkers.php";
require_once "include/GetLunarPhases.php";

$formattedYear = str_pad($year, 4, '0', STR_PAD_LEFT);
$firstDay = $wholeYear ? EarthianDate::firstDayOfYear($year) : EarthianDate::firstDayOfMonth($year, $month);
$lastDay = $wholeYear ? EarthianDate::lastDayOfYear($year) : EarthianDate::lastDayOfMonth($year, $month);

println("<div class='month'>");
println("<h2 align='center'>$formattedYear</h2>");
println("<table align='center' class='calendarPage' cellspacing='1' cellpadding='3'>");
// day names:
println("<tr>");
foreach (EarthianDate::$dayNames as $dayOfWeek => $dayName)
{
	$class = 'evenMonthWeek'.($dayOfWeek == 1 || $dayOfWeek == 7 ? 'end' : 'day'); 
	println("<th class='$class'>$dayName</th>");
}
println("</tr>");

$done = false;
$earthDate = EarthianDate::firstDayOfWeek($firstDay);
while (!$done)
{
	for ($dayOfWeek = 1; $dayOfWeek <= 7; $dayOfWeek++)
	{
		if ($dayOfWeek == 1)
		{
			println("<tr>");
		}
		$gregDate = $earthDate->toGregorian();

		// Make the note:
		$note = getSeasonNote($gregDate);
		if ($note != "")
		{
			$note .= "<br />"; 
		}
		$note .= getLunarNote($gregDate);
		
		$id = str_replace(EarthianDate::sep, '_', $earthDate->__toString());
		$class = ($earthDate->month % 2 ? 'odd' : 'even').'MonthWeek'.($dayOfWeek == 1 || $dayOfWeek == 7 ? 'end' : 'day');
		println("<td class='$class'>");
		println("<div id='$id' class='dayNum'>".(EarthianDate::$abbrevMonthNames[$earthDate->month].' '.$earthDate->day)."</div>");
		println("<div class='note'>$note</div>");
		println("<div class='greg'>".dtlFormat($gregDate, "Day D Mon YYYY")."</div>");
		println("</td>");
		if ($dayOfWeek == 7)
		{
			println("</tr>");
		}
		$earthDate = $earthDate->addDays(1);
	}
	$done = $earthDate->isLaterThanOrEqualTo($lastDay);
}
println("</table>");
println("</div>");

includeJavaScript("$libUrl/dtl.js");
includeJavaScript("$classUrl/EarthianDate.js");

require "tpl/TemplateBottom.php";
?>