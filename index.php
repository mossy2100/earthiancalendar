<?php
require "include/init.php";
require "tpl/TemplateTop.php";
require "$libDir/dtl.php";
?>

<style>
.lengths
{
	padding: 10px;
	margin: 10px auto 10px auto;
	border-collapse: collapse;
}

.lengths td, .lengths th
{
	border: solid 1px Navy;
	text-align: center;
}

td.blank
{
	border-width: 0px;
}

.month
{
	font-weight: bold;
}

.week
{
	width: 60px;
}

.periodName
{
	text-align: left;
}

.short
{
	color: Green;
}

.long
{
	color: Navy;
}

.longMonth
{
	background-color: #eee;
}

.spring
{
	background-color: #CCFFCC;
}

.summer
{
	background-color: #FFFFCC;
}

.autumn
{
	background-color: #FFCCCC;
}

.winter
{
	background-color: #CCDDFF;
}


.calendarPage
{
	border-collapse: collapse;
	margin: auto;
}

.calendarPage th
{
	border: solid 1px Navy;
	text-align: center;
}

.calendarPage td
{
	width: 60px;
	border: solid 1px Navy;
}

.calendarPage td.empty
{
	border-width:0px;
}

.dayNum
{
	font-size: 10px;
	height: 50px;
	text-align: left;
	font-weight: bold;
	vertical-align: top;
	color: Black;
}

.dayName
{
	font-size: 10px;
}
</style>

<h1>Introduction</h1>

<p>Hi, and welcome to the Earthian Calendar, designed and published in
2008 (Gregorian Common Era). This is probably the best calendar ever designed for Earth.
It's exceptionally straightforward and easy to use, easy to adopt, and offers a
range of improvements over other Earth calendars in use.</p>

<p>The primary improvements are as follows:</p>
<ol>
  <li>The year begins on the northern vernal equinox, thus months are very closely aligned with seasons.</li>
  <li>Month lengths follow a simple alternating pattern of 30, 31, 30, 31...</li>
  <li>There is only one leap year rule, which offers improved accuracy over the existing set of rules.</li>
</ol>
<p>&nbsp;</p>
<h2>Summary</h2>
<p>This section provides a no-frills explanation of the calendar, just enough
  information to define it. If you would like to learn more about the design,
  convert dates, or create a printable version, please use the menu to the right.</p>
<ol>
	<li>The year begins on the northern vernal equinox, following the convention
    in astronomy and astrology. Months are therefore aligned with seasons.</li>
	<li>Like other solar calendars, calendar years are either 365 days (common years)
    or 366 days (leap years) in length.
  <li>Leap years are determined by one simple rule: It's a leap year if
    <strong>year mod 33 mod 4 = 2</strong> (See: <a href='Modulo.php'>Modulo Operator Explained</a>).
    Thus, in every sequence of 33 years there are 8 leap years, in the
    symmetrical pattern 001000100010001000100010001000100.  This rule gives an
    average calendar year length of 365.2424 days, equal to the average length
    of the vernal equinox year. A period of 33 years is referred to as a
    <em>generation</em>.</li>
  <li>The first day of the calendar (1 Aries 0000, or 0000/01/01) equals 21 March 2007 (2007-03-21) in the Gregorian Calendar. This date was chosen because:
		<ol type='a'>
			<li>This is very close to the current year, and</li>
			<li>The NVE occured at almost exactly midnight (00:09) on that date.</li>
		</ol>
		This means we are currently (as at October 2008) in the Earthian year 0001.</li>
	<li>Years before the year 1 are numbered 0, -1, -2... etc., like ordinary integers, following the convention in astronomy.</li>
  <li>The year is divided evenly into 12 months.</li>
  <li>Month lengths follow an alternating pattern of 30 and 31 days. Pisces has 30 days in common years, and 31 in leap years.<br />
  <br />
    <table class='lengths' border="1" cellspacing="0" cellpadding="5" align="center">
      <tr class='headings'>
        <th>#</th>
        <th>Name</th>
        <th>Abbrev.</th>
        <th>Length</th>
        <th>Northern Season</th>
        <th>Southern Season</th>
      </tr>
      <tr>
        <td>1</td>
        <td class="month">Aries</td>
        <td>Ari</td>
        <td class="short">30</td>
        <td class="spring" rowspan="3" align="center">Spring</td>
        <td class="autumn" rowspan="3" align="center">Autumn/Fall</td>
      </tr>
      <tr class="longMonth">
        <td>2</td>
        <td class="month">Taurus</td>
        <td>Tau</td>
        <td class="long">31</td>
      </tr>
      <tr>
        <td>3</td>
        <td class="month">Gemini</td>
        <td>Gem</td>
        <td class="short">30</td>
      </tr>
      <tr class="longMonth">
        <td>4</td>
        <td class="month">Cancer</td>
        <td>Cnc</td>
        <td class="long">31</td>
        <td class="summer" rowspan="3" align="center">Summer</td>
        <td class="winter" rowspan="3" align="center">Winter</td>
      </tr>
      <tr>
        <td>5</td>
        <td class="month">Leo</td>
        <td>Leo</td>
        <td class="short">30</td>
      </tr>
      <tr class="longMonth">
        <td>6</td>
        <td class="month">Virgo</td>
        <td>Vir</td>
        <td class="long">31</td>
      </tr>
      <tr>
        <td>7</td>
        <td class="month">Libra</td>
        <td>Lib</td>
        <td class="short">30</td>
        <td class="autumn" rowspan="3" align="center">Autumn/Fall</td>
        <td class="spring" rowspan="3" align="center">Spring</td>
      </tr>
      <tr class="longMonth">
        <td>8</td>
        <td class="month">Scorpius</td>
        <td>Sco</td>
        <td class="long">31</td>
      </tr>
      <tr>
        <td>9</td>
        <td class="month">Sagittarius</td>
        <td>Sgr</td>
        <td class="short">30</td>
      </tr>
      <tr class="longMonth">
        <td>10</td>
        <td class="month">Capricornus</td>
        <td>Cap</td>
        <td class="long">31</td>
        <td class="winter" rowspan="3" align="center">Winter</td>
        <td class="summer" rowspan="3" align="center">Summer</td>
      </tr>
      <tr>
        <td>11</td>
        <td class="month">Aquarius</td>
        <td>Aqr</td>
        <td class="short">30</td>
      </tr>
      <tr class="longMonth">
        <td>12</td>
        <td class="month">Pisces</td>
        <td>Psc</td>
        <td><span class="short">30</span>/<span class="long">31</span></td>
      </tr>
    </table>
  </li>
  <li>Months names are the same as in the Gregorian Calendar, with the advantage that September equals the 7th month, October the 8th, and so on.</li>
  <li>Weeks have 7 days, as usual, and the days of the week have not changed.</li>
	<li>The days of the week are number from 1-7, with Sunday being 1 and Saturday being 7.</li>
	<li>Weeks within a year are numbered from 1 to 52 or 53.  For weeks on year boundaries, the week belongs to the year that contains 4 or more of its days.</li>
	<li>Dates are written as YYYY/MM/DD, with month and day padded with an extra 0 if necessary to make 2 digits,
		and years padded to 4 digits.  For example: 0001/02/25 (today), or -0036/08/10 (my birthday).
		The date can optionally be followed by &quot;GE&quot; for "Golden Era" (c.f. &quot;CE&quot; for "Common Era").
		There is no abbreviation "BGE" for "Before Golden Era"; a minus sign is used instead.</li>
</ol>

<p>&nbsp;</p>
<?php
require "tpl/TemplateBottom.php";
?>