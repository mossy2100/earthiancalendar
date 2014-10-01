<?php
require "include/init.php";
require "tpl/TemplateTop.php";
require "$libDir/dtl.php";
require "$libDir/arrays.php";
require "$classDir/EarthianDate.php";

// default to current month and year:
$today = dtlToday();
$earthToday = EarthianDate::fromGregorian($today);

$cellColours = array("#ffffff", "#e5e5e5", "#ffcccc", "#ffe5cc", "#ffffcc", "#e5ffcc", "#ccffcc", "#ccffe5",
	"#ccffff", "#cce5ff", "#ccccff", "#e5ccff", "#ffccff", "#ffcce5");
$borderColors = array("#ffffff", "#000000", "#ff0000", "#ff8000", "#ffff00", "#80ff00", "#00ff00", "#00ff80",
	"#00ffff", "#0080ff", "#0000ff", "#8000ff", "#ff00ff", "#ff0080");

$form = $_SESSION['Generator'];
//debug($form);
?>

<style>
.colorRadio
{
	margin: 2px;
	cursor: pointer;
}

.colorOption
{
	padding: 10px;
	text-align: center;
	vertical-align: middle;
	float: left;
	border: solid 1px White;
	margin-right: 3px;
}

#tblForm
{
	width: 100%;
	border: solid 1px Silver;
}

#tblForm th
{
	text-align: left;
	background-color: transparent;
	color: Black;
	font-weight: normal;
}

.dayName
{
	background-color: White;
	border: solid 1px White;
	width: 80px;
	text-align: center;
	font-weight: bold;
}
</style>

<h1>Calendar Generator</h1>

<p>This page enables you to create a calendar in either HTML format for on-screen display, or PDF format for
printing.  You can generate a calendar page for a single month, or for an entire year.  The Gregorian date is
shown for each day in the calendar.</p>

<p>Data for seasonal markers comes from <a href="http://www.hermetic.ch/cal_sw/ve/ve.php" target="_blank">this web page</a>,
and is available for CE years -100 to 4200.  The author of that page states that because perturbations are not
factored into the calculations, times could be out by up to 20 minutes. (This will have to suffice until I write
my own functions to calculate seasonal markers.) <a href='data/SeasonalMarkers.txt'>Download data</a></p>
 
<p>Data for lunar phases comes from <a href="http://aa.usno.navy.mil/data/docs/MoonPhase.php" target="_blank">this web page</a>
(US Naval Observatory), and is available for CE years 1695-2035.  These times are presumably accurate.
<a href='data/LunarPhases.txt'>Download data</a></p>
<br />

<form id='formGenerator' name='formGenerator' class='tblForm' action='GeneratorPost-HTML-Continuous.php' method='post'>
<table id='tblForm' border='0' cellspacing='0' cellpadding='10'>
<tr>
	<th width='140'>Ouput mode:</th>
	<td>
		<input type='radio' id='modeHTML' name='mode' value='HTML' <?php if ($form['mode'] != 'PDF') echo "checked"; ?> onclick='modeClick()' /><label for='modeHTML'> HTML</label>
		<input type='radio' id='modePDF' name='mode' value='PDF' <?php if ($form['mode'] == 'PDF') echo "checked"; ?> onclick='modeClick()' /><label for='modePDF'> PDF</label>
	</td>
</tr>
<tr>
	<th>Whole year?</th>
	<td><input type='checkbox' id='wholeYear' name='wholeYear' <?php if (str2bool($form['wholeYear'])) echo 'checked'; ?> onclick='wholeYearClick()' /></td>
</tr>
<tr id='trMonth'>
	<th>Month:</th>
	<td>
		<select id='month' name='month' class='control'>
		<?php
		$selectedMonth = isset($form['month']) ? $form['month'] : $earthToday->month;
		foreach (EarthianDate::$monthNames as $mm => $monthName)
		{
			print "<option value='$mm'";
			if ($mm == $selectedMonth) print "selected";
			println(">$monthName</option>");
		}
		?>
		</select>
	</td>
</tr>
<tr>
	<th>Year:</th>
	<td>
		<select id='year' name='year' class='control'>
		<?php		
		$selectedYear = isset($form['year']) ? $form['year'] : $earthToday->year;
		for ($yy = 0; $yy < 100; $yy++)
		{
			print "<option value='$yy'";
			if ($yy == $selectedYear)
			{
				print "selected";
			}
			$fy = str_pad($yy, 4, '0', STR_PAD_LEFT);
			$gy = $yy + 2007;
			$gy2 = $gy + 1;
			println(">$fy ($gy-$gy2)</option>");
		}
		?>
		</select>
	</td>
</tr>
<tr>
	<th>Show seasonal markers?</th>
	<td>
		<input type='checkbox' id='showSeasonalMarkers' name='showSeasonalMarkers' <?php if (str2bool($form['showSeasonalMarkers'])) echo 'checked'; ?> onclick='showSeasonalMarkersClick()' />
		<span id='hemisphereGroup'>
			<input type='radio' id='hemisphere_northern' name='hemisphere' value='northern' <?php if ($form['hemisphere'] != 'southern') echo 'checked'; ?> /><label for='hemisphere_northern'> Northern hemisphere</label>
			<input type='radio' id='hemisphere_southern' name='hemisphere' value='southern' <?php if ($form['hemisphere'] == 'southern') echo 'checked'; ?> /><label for='hemisphere_southern'> Southern hemisphere</label>
		</span>
	</td>
</tr>
<tr>
	<th>Show lunar phases?</th>
	<td>
		<input type='checkbox' id='showLunarPhases' name='showLunarPhases' <?php if (str2bool($form['showLunarPhases'])) echo 'checked'; ?> onclick='showLunarPhasesClick()' />
		<span id='phasesToShowGroup'>
			<input type='radio' id='phasesToShow_newAndFull' name='phasesToShow' value='newAndFull' <?php if ($form['phasesToShow'] != 'all') echo 'checked'; ?> /><label for='phasesToShow_newAndFull'> New and full moons only</label>
			<input type='radio' id='phasesToShow_all' name='phasesToShow' value='all' <?php if ($form['phasesToShow'] == 'all') echo 'checked'; ?> /><label for='phasesToShow_all'> All</label>
		</span>
	</td>
</tr>

<tr>
	<td colspan='2' align='right'><input type='submit' value='Go' class='button' /></td>
</tr>
</table>
<p>&nbsp;</p>
<!--
<p><strong>Options to add:</strong></p>
<p>Show new and full moons.</p>
<p>Show seasonal markers (choose northern or southern hemisphere).</p>
<p>Show these things in person's time zone.</p>
 -->
</form>


<?php
includeJavaScript("$libUrl/radioButtons.js");
includeJavaScript("$classUrl/Color.js");
?>
<script type='text/javascript'>

<?php
copyArrayToClient($cellColours, 'cellColours');
?>


function wholeYearClick()
{
	var wholeYear = el('wholeYear').checked;
	var trMonth = el('trMonth');
	if (wholeYear)
	{
		trMonth.style.display = 'none';
	}
	else
	{
		trMonth.style.display = '';
	}
}


function showSeasonalMarkersClick()
{
	var showSeasonalMarkers = isChecked('showSeasonalMarkers');
	show('hemisphereGroup', showSeasonalMarkers);
}


function showLunarPhasesClick()
{
	var showLunarPhases = isChecked('showLunarPhases');
	show('phasesToShowGroup', showLunarPhases);
}


function modeClick()
{
	var formGenerator  = el('formGenerator');
	var mode = rbGetSelectedValue('mode');
	if (mode == 'HTML')	{
		formGenerator.action = 'GeneratorPost-HTML-Continuous.php';
	}
	else {
		formGenerator.action = 'GeneratorPost-PDF.php';
	}
}


// initialise:
wholeYearClick();
showSeasonalMarkersClick();
showLunarPhasesClick();
</script>

<?php
require "tpl/TemplateBottom.php";
?>