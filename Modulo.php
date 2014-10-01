<?php
require "include/init.php";
require "tpl/TemplateTop.php";
require "$libDir/dtl.php";

$colors = array("#ffcccc", "#ffe5cc", "#ffffcc", "#ccffcc",	"#ccffff", "#cce5ff", "#ccccff", "#ffccff", "#e5e5e5");
?>

<style>
#modDemo td
{
	text-align: center;
}
</style>

<h1>Modulo Operator  Explained</h1>
<p>The leap year rule in the Earthian Calendar uses a mathematical operator that may at first seem  unfamiliar to some readers. However, in actual fact almost everyone has encountered this operator in primary school (US: &quot;grade school&quot;) mathematics, and we use it in day-to-day life without even realising. &quot;mod&quot; is just a formal mathematical notation for a simple calculation that we do all the time.</p>
<p>The mod operator simply means &quot;remainder after division&quot;. Remember when we were at school, and we first started learning to divide numbers and didn't know anything about fractions and decimal points, we used to talk about the &quot;remainder&quot;. For example, we would say:</p>
<blockquote>
  <p>7 &divide; 3 = 2 <strong>remainder 1</strong></p>
</blockquote>
<p>because</p>
<blockquote>
  <p>7 = (2 &times; 3) <strong>+ 1</strong></p>
</blockquote>
<p>Now, if we are only interested in the <em>remainder</em> part of the result, we can use the modulo operator like this:</p>
<blockquote>
  <p>7 <strong>mod</strong> 3 = 1</p>
</blockquote>
<p>&nbsp;</p>
<p>We already use the modulo operator in the leap year rules for the Gregorian Calendar. For example, when we say &quot;it's a leap year if the year is divisible by 4&quot;, what we are really saying is &quot;it's a leap year if <em>year </em><strong>mod</strong> 4 = 0&quot;. It means that if we can divide the year by 4 <em>with no remainder</em>, then it will be a leap year.</p>
<p>So, we know that the year 2008 is a leap year, because</p>
<blockquote>
  <p>2008 &divide; 4 = 502 <strong>remainder 0</strong></p>
</blockquote>
<p>or in other words:</p>
<blockquote>
  <p>2008 <strong>mod</strong> 4 = 0</p>
</blockquote>
<p>Similarly, we know that 2009 will <em>not</em> be a leap year, because if we divide it by 4, there will be a remainder of 1:</p>
<blockquote>
  <p>2009 <strong>mod</strong> 4 = 1</p>
</blockquote>
<p>&nbsp;</p>
<h2>Usage of mod in the Earthian Calendar leap year rule</h2>
<p>The modulo operator is used in the Earthian Calendar to create a 33-year cycle that includes 8 evenly-spaced leap years.</p>
<p>When we use the mod operator, the result is always limited to a number less than the divisor. For example, when we divide by 4, the remainder will always be 0, 1, 2 or 3. To illustrate:</p>
<blockquote>
  <p>2008 <strong>mod</strong> 4 = 0<br />
  2009 <strong>mod</strong> 4 = 1<br />
  2010 <strong>mod</strong> 4 = 2<br />
  2011 <strong>mod</strong> 4 = 3<br />
  2012 <strong>mod</strong> 4 = 0<br />
  2013 <strong>mod</strong> 4 = 1<br />
  2014 <strong>mod</strong> 4 = 2<br />
  2015 <strong>mod</strong> 4 = 3</p>
</blockquote>
<p>Note how &quot;mod 4&quot; creates a repeating pattern of 4 years.</p>
<p>The Earthian Calendar leap year rule states that it's a leap year if:</p>
<blockquote>
  <p><em>year</em> <strong>mod</strong> 33 <strong>mod</strong> 4 = 2</p>
</blockquote>
<p>Consider the first part of the equation &quot;year mod 33&quot;. This always returns a result from 0-32, which gives us our 33-year cycle. The second mod operator &quot;mod 4&quot; gives a result from 0-3, which creates a repeating 4-year cycle <em>within the 33-year cycle</em>. By specifying that a leap year occurs when the result of the equation equals 2, we get the required 8 leap years per 33 years in the symmetrical pattern 001000100010001000100010001000100.</p>
<p>The following table shows how the formula generates the required leap year pattern over the first 3 generations of the calendar:</p>
<table id='modDemo' border='1' cellspacing='0' cellpadding='3' align='center' width='400'>
<tr>
	<th width='25%'>year</th>
	<th width='25%'>year mod 33</th>
	<th width='25%'>year mod 33 mod 4</th>
	<th width='25%'>a leap year?</th>
</tr>
<?php
for ($year = 0; $year < 99; $year++)
{
	$yearMod33 = $year % 33;
	$yearMod33Mod4 = $year % 33 % 4;
	$isLeapYear = $yearMod33Mod4 == 2; 
	$generation = intdiv($year, 33);
	$fourYear = intdiv($yearMod33, 4);
	$leapYearColor = $isLeapYear ? '#ccffcc' : 'White';
	println("<tr>");
	println("<td style='background-color:$leapYearColor'>$year</td>");
	println("<td style='background-color:{$colors[$generation * 2]}'>$yearMod33</td>");
	println("<td style='background-color:{$colors[$fourYear]}'>$yearMod33Mod4</td>");
	println("<td style='background-color:$leapYearColor'>".($isLeapYear ? 'YES' : 'no')."</td>");
	println("</tr>");
}
?>
</table>

<p>&nbsp;</p>
<?php
require "tpl/TemplateBottom.php";
?>