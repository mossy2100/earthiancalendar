<?php
require "include/init.php";
require "tpl/TemplateTop.php";
require "$libDir/dtl.php";
?>

<h1>Benefits</h1>
<p>This incredibly brilliant calendar offers several significant benefits over other calendars
currently in use on Earth, or any others proposed!</p>

<ol>
	<li>Because extra days are distributed perfectly evenly throughout the calendrical cycle, it becomes possible to easily divide a year or month into equal fractions <em>with an accuracy within one day</em>:
		<table class='grey' border='0' cellspacing='1' cellpadding='5'>
		<tr>
			<th>years</th>
			<th>seasons</th>
			<th>months</th>
			<th>weeks</th>
			<th>days</th>
		</tr>
		<tr class='lighter'>
			<td>1/96</td>
			<td></td>
			<td>1/8</td>
			<td>1/2</td>
			<td>3 or 4</td>
		</tr>
		<tr class='light'>
			<td>1/48</td>
			<td></td>
			<td>1/4</td>
			<td>1</td>
			<td>7 or 8</td>
		</tr>
		<tr class='lighter'>
			<td>1/24</td>
			<td></td>
			<td>1/2</td>
			<td>2</td>
			<td>15 or 16</td>
		</tr>
		<tr class='light'>
			<td>1/12</td>
			<td>1/3</td>
			<td>1</td>
			<td>4</td>
			<td>30 or 31</td>
		</tr>
		<tr class='lighter'>
			<td>1/8</td>
			<td>1/2</td>
			<td>1.5</td>
			<td>6</td>
			<td>45 or 46</td>
		</tr>
		<tr class='lighter'>
			<td>1/6</td>
			<td></td>
			<td>2</td>
			<td>8</td>
			<td>60 or 61</td>
		</tr>
		<tr class='light'>
			<td>1/4</td>
			<td>1</td>
			<td>3</td>
			<td>12</td>
			<td>91 or 92</td>
		</tr>
		<tr class='lighter'>
			<td>1/3</td>
			<td></td>
			<td>4</td>
			<td>16</td>
			<td>121 or 122</td>
		</tr>
		<tr class='lighter'>
			<td>1/2</td>
			<td>2</td>
			<td>6</td>
			<td>24</td>
			<td>183 or 184</td>
		</tr>
		<tr class='light'>
			<td>1</td>
			<td>4</td>
			<td>12</td>
			<td>48</td>
			<td>365 or 366</td>
		</tr>
		</table>
	</li>
	<li>The calendar is <i>perpetual</i>, which means it looks the same every year.  Every calendar page
	  	looks the same each year, with the exception of Pisces, which has one extra day (the 31st) in leap
	  	years.  A perpetual calendar means that any given day of the month will always match the same day
	  	of the week, <i>no matter what month or year</i>. For example, the 1st, 9th, 16th or 24th day of any
	  	month is always Sunday; the 2nd, 10th, 17th or 25th day of any month is always Monday, and so on.
	  	The 8th, 23rd or 31st (if there is one) day of any month is Earthday.
	  	<a href='<?php echo $baseUrl; ?>/Generator.php'>Click here</a> to view the calendar
	  	page for the current month.
  	</li>
	<li>The calendar is very <i>accurate</i>.  The leap year rule (year % 33 % 4 == 2), adapted from the
		Iranian Calendar, is slightly more accurate than the rules used in the Gregorian Calendar, while also
		being much simpler.  This one rule will keep the calendar aligned with the northern vernal equinox
		for many centuries to come.  Furthermore, because the lengths of months and seasons are practically
		equal all through the year, they align almost perfectly with the seasonal markers.  Months mark off
		twelfths of a year more accurately than any calendar currently in use; similarly, weeks are aligned
		almost exactly with 1/48 fractions of a year.
	</li>
	<li>The calendar is a <i>solar</i> calendar, which means it is aligned with the movement of the Earth
		around the Sun.  Solar calendars use 1/12 years as months, rather than 1 lunation, as used in lunisolar
		calendars.  Solar calendars have an advantage of having only one "special" date that occurs
		infrequently, about every 4 years (in the Gregorian Calendar, this is February 29).  On the other hand,
		lunisolar calendars have a whole month worth of dates (the "leap" month) that only occur approximately
		every 2nd year.  People born on a leap day (such as February 29, or Pisces 31 in this calendar), or
		during the leap month, have to use an alternative date for their birthday.  The same problem exists
		for other anniversaries, such as wedding anniversaries.  In a solar calendar, far fewer people are
		affected by this problem than in a lunisolar calendar.
	</li>
	<li>The northern vernal equinox is always within half a day of New Year's Eve, so the calendar months
		are almost exactly aligned with seasonal markers and the seasons.
		<table class='grey' border='0' cellspacing='1' cellpadding='5'>
		<tr>
			<th>Northern Season</th>
			<th>Southern Season</th>
			<th colspan='3'>Months</th>
		</tr>
		<tr class='lighter'>
			<td>Spring</td>
			<td>Autumn</td>
			<td>Aries</td>
			<td>Taurus</td>
			<td>Gemini</td>
		</tr>
		<tr class='light'>
			<td>Summer</td>
			<td>Winter</td>
			<td>Cancer</td>
			<td>Leo</td>
			<td>Virgo</td>
		</tr>
		<tr class='lighter'>
			<td>Autumn</td>
			<td>Spring</td>
			<td>Libra</td>
			<td>Scorpio</td>
			<td>Sagittarius</td>
		</tr>
		<tr class='light'>
			<td>Winter</td>
			<td>Summer</td>
			<td>Capricorn</td>
			<td>Aquarius</td>
			<td>Pisces</td>
		</tr>
		</table>
	</li>
		
	<li>One advantage of a perpetual 
  
  </li>
</ol>
<?php
require "tpl/TemplateBottom.php";
?>