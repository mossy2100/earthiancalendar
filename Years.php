<?php
require "include/init.php";
require "tpl/TemplateTop.php";
require "$libDir/dtl.php";
?>

<style type="text/css">
<!--
.style1 {
  color: LimeGreen;
}

.style3 {
  font-weight: bold
}
-->
</style>

<h1>Years in the Earthian Calendar</h1>
<p>&nbsp;</p>
<h2>Start of Year</h2>
<p>The Earthian Calendar year begins right on the northern vernal equinox, which is the most
  important seasonal marker in Christian, Jewish, Iranian and Indian calendars. In astronomy, this
  is the point of 0&deg; longitude in the Earth's orbit around Sol. The Iranian and Indian
  National Calendars also begin the calendar year at this point in the seasonal cycle.</p>
<p>Because of this choice, and the superbly accurate leap year rule (described below), New Year's
  Eve in the Earthian Calendar will always be close to (within &plusmn;0.5 days of) the northern
  vernal equinox. This feature is easily remembered as <strong> NYE = NVE</strong> (New Year's Eve
  = Northern Vernal Equinox).</p>
<p>Note that the <em>northern vernal</em> equinox is equal to the <em>southern autumnal </em>equinox,
  because in the southern hemisphere the seasons are reversed.</p>
<p>&nbsp;</p>
<h2>Length of Years</h2>
<p>A common design goal for Earth calendars is for the average calendar year length to match the
  average length of the<em> northern vernal equinox year </em>(usually just called the <em>vernal
    equinox year</em>)<em>, </em>which is the time between successive northern vernal equinoxes.
  This approach is also taken in the Earthian Calendar.</p>
<p>Thus, like other solar calendars, the calendar defines years of 365 and 366 days in such a
  pattern that the average year length is equal to the vernal equinox year of 365.2424 days.</p>
<p>The average length of the vernal equinox year will remain about 365.2424 days for a few more
  millenia. According to the ultimate repository of all human wisdom, the <a
    href="http://en.wikipedia.org/wiki/Main_Page" target="_blank">Wikipedia</a>:</p>
<blockquote>
  <p><em>The number of mean solar days in a vernal equinox year has been oscillating between
      365.2424 and 365.2423 for several millennia and will likely remain near 365.2424 for a few
      more. This long-term stability is pure chance, because in our era the slowdown of the
      rotation, the acceleration of the mean orbital motion, and the effect at the vernal equinox
      of rotation and shape changes in the Earth's orbit, happen to almost cancel out.</em></p>
</blockquote>
<p>How convenient! This means we won't need to change the leap year rule for a few millenia, by
  which time humans will have been displaced by hyper-intelligent robots, so, from our perspective
  at least, it won't really matter.</p>
<p>&nbsp;</p>
<h2>Leap Years and Intercalary Days</h2>
<p>An intercalary day is an extra day added to the year every now and then to ensure that the
  calendar year remains synchronised with the seasons.</p>
<p>Why do we need intercalary days? It's simple: the average amount of time it takes for Earth to
  orbit the Sun is not an exact multiple of the average amount of time it takes for Earth to
  rotate on its axis. Or to put it more simply: <strong>a year is not a whole number of days
    long</strong>. However, <em>calendar </em>years <em>are </em>a whole number of days long -
  it's one of their main features.</p>
<p>To account for the 0.2424 days, we need some combination of years 365 and 366 days in length
  that produces an overall average of 365.2424. Generally speaking, most years have 365 days, with
  an <em>intercalary day</em> (also called a <em>leap day</em>) periodically added to the calendar
  to make 366.</p>
<p>There are 2 questions to be answered:</p>
<ol>
  <li>How often to add the intercalary day?</li>
  <li>Where to put it?</li>
</ol>
<h3>How often to add an intercalary day</h3>
<p>When to add the intercalary day can be determined using (a) astronomy, or (b) rules.</p>
<p>Using astronomy means calculating the moment of the vernal equinox each year, and generating a
  calendar based on that calculation. While this may be more precise, it then becomes difficult to
  predict in advance what the calendar for a future year will look like. A computer program to
  calculate future dates or generate calendars for future years would require elaborate and
  complex formulas, and since the formulas for calculating things like vernal equinoxes are
  non-standard and constantly being improved, different programs would produce different
  results.</p>
<p>This is why most solar calendars use rules for determining leap year patterns. This approach is
  sufficiently accurate for practical purposes, and can be used by computer programs to determine
  calendar dates well into the future.</p>
<p>For example, the Gregorian Calendar uses the following rules:</p>
<ol type="a">
  <li>A year is a leap year if it can be divided evenly by 4.</li>
  <li><em>Unless </em>it can be divided evenly by 100, in which case it is <em>not </em>a leap
    year.
  </li>
  <li><em>U</em><em>nless</em> it can be divided evenly by 400, in which case it <em>is</em> a
    leap year.
  </li>
</ol>
<p>Having one leap year out of every 4 as in rule (a) gives a fraction of 0.25, or an average
  calendar length of 365.25 days. This was the only rule used in the Julian Calendar, the
  predecessor to the Gregorian Calendar. Adding rule (b) subtracts a fraction of 1 in 100, or
  0.01, making the average year length 365.24. Adding rule (c) means adding another day every 400
  years, which is 1 in 400, or 0.0025, giving a final average of 365.2425 days per year, very
  close to the vernal equinox year.</p>
<p>365 + 0.25 - 0.01 + 0.0025 = 365.2425</p>
<p>There is, however, a <em>single fraction</em> that is even more accurate than this combination
  of rules. It comes from the Iranian Calendar:</p>
<p><sup>8</sup>/<sub>33</sub> = 0.242424<span style="text-decoration: overline;">24</span> (that
  overscore means &quot;recurring&quot;). </p>
<p>Adding 8 intercalary days every 33 years thus gives an average year length of 365 +
  0.242424<span style="text-decoration: overline;">24</span> = 365.242424<span
    style="text-decoration: overline;">24</span> days.</p>
<p>This is even closer to the vernal equinox year length. Thus, a <em>single rule </em>can be used
  to create a leap year pattern with a greater degree of synchronization with the vernal equinox
  year than the Gregorian Calendar has with its 3 rules, <em>and</em> over a much shorter cycle.
</p>
<p>To implement this rule requires a pattern of 365 and 366 day years in which there are 8 leap
  years in every 33. While designing this calendar I wrote several computer programs to determine
  the optimal way to distribute the 8 leap years in a 33 year period, with the basic requirement
  being to keep New Year's Eve as close as possible (within &plusmn;12 hours) to the northern
  vernal equinox. Using the following pattern produces the best result:</p>
<p align='center'>0 0 <span class='style1'>1 </span>0 0 0 <span class='style1'>1 </span>0 0 0
  <span class='style1'>1 </span>0 0 0 <span class='style1'>1 </span>0 0 0 <span
    class='style1'>1 </span>0 0 0 <span class='style1'>1 </span>0 0 0 <span
    class='style1'>1 </span>0 0 0 <span class='style1'>1 </span>0 0</p>
<p>Perhaps as expected, this pattern is <em>symmetrical</em>. Generally speaking, there are 4
  years between leap days, except between the last leap day of a 33-year cycle (a period I've
  named a &quot;<em>generation</em>&quot;) and the first in the next generation, in which case
  there are 5.</p>
<p>This pattern can be implemented mathematically by one simple formula:</p>
<h4 align="center">LEAP YEAR RULE FOR THE EARTHIAN CALENDAR</h4>
<p align="center">A year is a leap year if: <em>year</em> <strong>mod</strong> 33
  <strong>mod</strong> 4 = 2</p>
<p>Or in C code:</p>
<pre>bool isLeapYear(int year)
{
  return year % 33 % 4 == 2;
}
</pre>
<p>(NOTE: If the &quot;mod&quot; operator seems like Greek to you, please be aware that it is
  actually very simple and most people use it all the time. Please refer to: <a href="Modulo.php">Modulo
    Operator Explained</a>.)</p>
<p>The symmetrical pattern of common and leap years within a 33-year generation is most accurate
  when it starts at a vernal equinox close to midnight Universal Time, such as occured at March
  21, 2007.</p>
<p>The main drawback with this rule is that few people can do &quot;mod 33&quot; in their heads,
  whereas someone who knew all 3 rules from the Gregorian Calendar could probably work out whether
  a year is a leap year in their heads, since division by 4, 100 or 400 is relatively simple.
  However, this is not something people do very often. Most people don't know all 3 leap year
  rules, and these days we usually just look at the computer or a printed calendar.</p>
<h3>Less Drift</h3>
<p>Apart from the obvious simplicity, there is another advantage that this rule has over the
  current rules of the Gregorian Calendar. Namely, because the gap between leap years is only ever
  4 or 5 years, drift from the vernal equinox is minimised. From the basic pattern of 1 leap year
  out of every 4, when we need to compensate for that slight difference between 0.25 and 0.2424 we
  simply skip one year at the end of each 33-year cycle.</p>
<p>However, because in the Gregorian Calendar leap years are always divisible by 4, there can be
  gaps of up to 8 years between leap years. For example, there was a leap year in 1896. But 1900
  was not leap year; the next leap year was in 1904. Similarly, there will be an 8 year gap
  between the leap years of 2096 and 2104. Although the Gregorian Calendar leap year rules may
  seem just as accurate as the Earthian Calendar for practical purposes, these larger gaps between
  successive leap years means that the Gregorian Calendar drifts up to about 18 hours farther from
  the seasonal markers.</p>
<h3>Improved Gregorian Leap Year Rules</h3>
<p>It is worth mentioning that another possible solution was considered, which was to add one more
  rule to the three existing rules used in the Gregorian Calendar. The complete set of rules would
  look like this:</p>
<ol type="a">
  <li>A year is a leap year if it can be divided evenly by 4.</li>
  <li><em>Unless </em>it can be divided evenly by 100, in which case it is <em>not </em>a leap
    year.
  </li>
  <li><em>U</em><em>nless</em> it can be divided evenly by 400, in which case it <em>is</em> a
    leap year.
  </li>
  <li><span class="style3"><em>Unless</em> it can be divided evenly by 10000, in which case it is <em>not</em> a leap year.</span>
  </li>
</ol>
<p>This results in a fraction of <sup>1</sup>/<sub>4</sub> - <sup>1</sup>/<sub>100</sub> +
  <sup>1</sup>/<sub>400</sub> - <sup>1</sup>/<sub>10000</sub> = 0.25 - 0.1 + 0.0025 - 0.0001 =
  0.2424.</p>
<p>At first, this would appear to be a more accurate solution. (It also has a nice pattern of +4,
  -100, +400, -10000.)</p>
<p>However, this option was not chosen for 4 reasons:</p>
<ol>
  <li>The single <sup>8</sup>/<sub>33</sub> rule is much simpler, for both humans and computer
    programmers.
  </li>
  <li>The single <sup>8</sup>/<sub>33</sub> rule is more than accurate enough for practical
    purposes. We are talking about a difference of 0.000024 days (about 2 seconds) per year. We
    can't know the vernal equinox year to that degree of accuracy, because it changes. It isn't
    <em>exactly</em> 365.2424, but, as mentioned before, it will be <em>about</em> that for a
    couple thousand years or so.
  </li>
  <li>The single <sup>8</sup>/<sub>33</sub> rule maintains accuracy over a 33-year cycle (a single
    generation), whereas the improved Gregorian rules above require a 10,000 year cycle.
  </li>
  <li>The 8-year gaps between leap years defined by the Gregorian rules cause the calendar to
    drift farther from the vernal equinox.
  </li>
</ol>
<h3>Where to put the intercalary day in the calendar year?</h3>
<p>Several approaches are taken by other solar calendars:</p>
<ol>
  <li>End of 1st month (Indian National)</li>
  <li>End of 2nd month (Gregorian)</li>
  <li>End of 6th month (World)</li>
  <li>End of 12th month (Iranian)</li>
</ol>
<p>The simplest solution is to append the intercalary day at the end of the year. This makes the
  pattern of month lengths much easier to remember: A leap year will have a perfectly regular
  pattern of 30, 31, 30, 31, 30, 31, 30, 31, 30, 31, 30, 31; a common year simply has one less day
  in the last month of the year.</p>
<p>Another key advantage to adding the intercalary day at the end of the year, is that any date in
  the calendar will always map to the same day of the year. Pisces 30 is always the 365th day of
  the year, and Pisces 31, when it appears, is always the 366th. Compare this with the Gregorian
  Calendar, in which March 1 is the 60th day of the year in common years, and the 61st day of the
  year in leap years.</p>
<p>&nbsp;</p>
<h2>Epoch</h2>
<p>The <sup>8</sup>/<sub>33</sub> leap year pattern has maximum accuracy when year 0000 begins
  right on the northern vernal equinox. This is the reason why the northern vernal equinox of 21
  March 2007 was selected as the first day of year 0000, as the vernal equinox occured at about
  00:09 UTC on that date.</p>
<p>This choice also means that the calendar has been designed and published in Earthian year
  0001.</p>
<p>&nbsp;</p>
<h2>Year Numbering</h2>
<p>This is an <em>astronomical</em> calendar, and, as is the custom in astronomy, years can be
  positive, zero or negative, just like any ordinary integer. Negative year numbers are used
  instead of notation such as &quot;BC&quot; (Before Christ) or &quot;BCE&quot; (Before Common
  Era).</p>
<p>The year 0000 started on 21 March 2007. The year before that is year -0001, and the current
  year, which began on 20 March 2008, is 0001.</p>
<p>&nbsp;</p>
<h2>The Golden Era</h2>
<p>The &quot;era&quot; of the Copernican Calendar is called the &quot;Golden Era&quot; (GE), to
  contrast with &quot;Common Era&quot; (CE) or &quot;Anno Domini&quot; (AD, year of our Lord) as
  used in the Gregorian Calendar. Dates can therefore be written as 0001/06/28 GE, which can help
  to distinguish Copernican Calendar dates from other dates. See <a
    href="Notation.php">Notation</a>.</p>
<p>&nbsp;</p>

<?php
require "tpl/TemplateBottom.php";
