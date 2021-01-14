<?php
require "include/init.php";
require "tpl/TemplateTop.php";
require "$libDir/dtl.php";
?>

<style>
.compare td, .compare th, .compare td ul li {
  font-size: 10px;
}

.compare td ul {
  padding: 0;
  margin: 0 0 0 15px;
}

.compare td ul li {
  margin: 0;
  padding: 0;
}

.coolest {
  background-color: #e5ffe5;
}
</style>

<h1>Comparison of Earth Calendars</h1>
<table class='compare' width="100%" border="1" cellspacing="0" cellpadding="3">
  <tr>
    <th>Name</th>
    <th>Type</th>
    <th>Perpetual</th>
    <th>months/year</th>
    <th>days/month</th>
    <th>days/week</th>
    <th>Status</th>
    <th>Pros *</th>
    <th>Cons *</th>
  </tr>
  <tr class="coolest">
    <td><a href="<?php echo $baseUrl; ?>/index.php">Earthian</a></td>
    <td>solar</td>
    <td>no</td>
    <td>12</td>
    <td>30-31</td>
    <td>7</td>
    <td>proposed</td>
    <td>
      <ul>
        <li>Uses simple, easy-to-learn patterns and rules.</li>
        <li>One simple and accurate leap year rule, with a short cycle of only 33 years.</li>
        <li>Calendar year begins on northern vernal equinox.</li>
        <li>Months closely aligned with seasonal markers.</li>
        <li>Calendar year can be accurately divided by 2, 3, 4, 6, or 12 on month boundaries.</li>
      </ul>
    </td>
    <td></td>
  </tr>
  <tr>
    <td><a class='wiki' href="http://en.wikipedia.org/wiki/Gregorian_calendar" target="_blank">Gregorian</a>
    </td>
    <td>solar</td>
    <td>no</td>
    <td>12</td>
    <td>28-31</td>
    <td>7</td>
    <td>current</td>
    <td>
      <ul>
        <li>Widely used. Most people know it.</li>
      </ul>
    </td>
    <td>
      <ul>
        <li>Overly variable month lengths with inconsistent pattern.</li>
        <li>Months not aligned with either seasonal markers or lunar cycle.</li>
        <li>Slightly complex leap year rules that cause calendar year to drift from seasonal markers
          over a century.
        </li>
      </ul>
    </td>
  </tr>
  <tr class='alt'>
    <td><a class='wiki'
        href="http://en.wikipedia.org/wiki/Chinese_calendar" target="_blank">Traditional Chinese</a>
    </td>
    <td>lunisolar</td>
    <td>no</td>
    <td>12-13</td>
    <td>29-30</td>
    <td>7</td>
    <td>current</td>
    <td>
      <ul>
        <li>Months equal to lunations.</li>
      </ul>
    </td>
    <td>
      <ul>
        <li>Complex intercalation rules.</li>
        <li>Includes both lunisolar and solar components.</li>
        <li>13-month years cannot be easily divided by 2, 3 or 4.</li>
      </ul>
    </td>
  </tr>
  <tr>
    <td><a class='wiki' href="http://en.wikipedia.org/wiki/Hebrew_calendar"
        target="_blank">Hebrew</a></td>
    <td>lunisolar</td>
    <td>no</td>
    <td>12-13</td>
    <td>29-30</td>
    <td>7</td>
    <td>current</td>
    <td>
      <ul>
        <li>Months equal to lunations.</li>
        <li>Uses rules for month intercalation (based on the Metonic cycle) rather than lunar
          observation, which is better for computer programs.
        </li>
      </ul>
    </td>
    <td>
      <ul>
        <li>Inconsistent pattern of month lengths.</li>
        <li>13-month years cannot be easily divided by 2, 3 or 4.</li>
      </ul>
    </td>
  </tr>
  <tr class='alt'>
    <td><a class='wiki' href="http://en.wikipedia.org/wiki/Islamic_calendar"
        target="_blank">Islamic</a></td>
    <td>lunar</td>
    <td>no</td>
    <td>12</td>
    <td>29-30</td>
    <td>7</td>
    <td>current</td>
    <td>
      <ul>
        <li>Months equal to lunations.</li>
      </ul>
    </td>
    <td>
      <ul>
        <li>No month length rules. Months determined by lunar observation, which is a problem for
          computer programs.
        </li>
        <li>Calendar year is 11 days shorter than the tropical year, hence seasons occur later each
          year.
        </li>
      </ul>
    </td>
  </tr>
  <tr>
    <td><a class='wiki' href="http://en.wikipedia.org/wiki/Iranian_calendar"
        target="_blank">Iranian</a></td>
    <td>solar</td>
    <td>no</td>
    <td>12</td>
    <td>29-31</td>
    <td>7</td>
    <td>current</td>
    <td>
      <ul>
        <li>Calendar year begins on northern vernal equinox.</li>
        <li>Months closely aligned with seasonal markers.</li>
      </ul>
    </td>
    <td>
      <ul>
        <li>First 6 months 31 days; second 6 months 30 days. Year cannot be accurately divided into
          equal parts on month boundaries.
        </li>
        <li>No leap year rules; year beginning determined by northern vernal equinox, which is a
          problem for computer programs.
        </li>
      </ul>
    </td>
  </tr>
  <tr class='alt'>
    <td><a class='wiki' href="http://en.wikipedia.org/wiki/Indian_national_calendar"
        target="_blank">Indian National</a></td>
    <td>solar</td>
    <td>no</td>
    <td>12</td>
    <td>30-31</td>
    <td>7</td>
    <td>current</td>
    <td>
      <ul>
        <li>Calendar year begins on northern vernal equinox.</li>
        <li>Months closely aligned with seasonal markers.</li>
      </ul>
    </td>
    <td>
      <ul>
        <li>First 6 months 31 days; second 6 months 30 days. Year cannot be accurately divided into
          equal parts on month boundaries.
        </li>
      </ul>
    </td>
  </tr>
  <tr>
    <td><a class='wiki' href="http://en.wikipedia.org/wiki/Buddhist_calendar" target="_blank">Buddhist</a>
    </td>
    <td>lunisolar</td>
    <td>no</td>
    <td>12-13</td>
    <td>29-30</td>
    <td>7</td>
    <td>current</td>
    <td>
      <ul>
        <li>Months equal to lunations.</li>
      </ul>
    </td>
    <td>
      <ul>
        <li>Average year length longer than tropical year.</li>
        <li>13-month years cannot be easily divided by 2, 3 or 4.</li>
      </ul>
    </td>
  </tr>
  <tr class='alt'>
    <td><a class='wiki' href="http://en.wikipedia.org/wiki/Julian_calendar"
        target="_blank">Julian</a></td>
    <td>solar</td>
    <td>no</td>
    <td>12</td>
    <td>28-31</td>
    <td>7</td>
    <td>deprecated</td>
    <td></td>
    <td>
      <ul>
        <li>Highly variable month lengths with no consistent pattern.</li>
        <li>Average year length slightly longer than tropical year.</li>
        <li>Months not aligned with either seasonal markers or lunar cycle.</li>
      </ul>
    </td>
  </tr>
  <tr>
    <td><a href="http://en.wikipedia.org/wiki/Egyptian_calendar" target="_blank">Egyptian,</a> <a
        class='wiki' href="http://en.wikipedia.org/wiki/French_republican_calendar" target="_blank">French
        Republican</a></td>
    <td>solar</td>
    <td>yes</td>
    <td>12 + 5-6 days</td>
    <td>30</td>
    <td>10</td>
    <td>deprecated</td>
    <td>
      <ul>
        <li>Equal month lengths (not counting 5-6 surplus days).</li>
        <li>Decimal weeks.</li>
      </ul>
    </td>
    <td>
      <ul>
        <li>5-6 day &quot;mini-month&quot; requires special handling.</li>
      </ul>
    </td>
  </tr>

  <tr class='alt'>
    <td><a class='wiki' href="http://en.wikipedia.org/wiki/World_calendar" target="_blank">World</a>
    </td>
    <td>solar</td>
    <td>yes</td>
    <td>12 + 1-2 days</td>
    <td>30-31</td>
    <td>7</td>
    <td>proposed</td>
    <td>
      <ul>
        <li>Equal quarter lengths (not counting 1-2 surplus days).</li>
      </ul>
    </td>
    <td>
      <ul>
        <li>1-2 days per year outside of months require special notation.</li>
        <li>Perpetual, but with varying month pages.</li>
      </ul>
    </td>
  </tr>
  <tr>
    <td><a class='wiki' href="http://en.wikipedia.org/wiki/Positivist_calendar" target="_blank">Positivist</a>
    </td>
    <td>solar</td>
    <td>yes</td>
    <td>13 + 1-2 days</td>
    <td>28</td>
    <td>7</td>
    <td>proposed</td>
    <td>
      <ul>
        <li>Equal month lengths (not counting 1-2 surplus days).</li>
      </ul>
    </td>
    <td>
      <ul>
        <li>1-2 days per year outside of months require special notation.</li>
        <li>13-month years cannot be easily divided by 2, 3 or 4.</li>
      </ul>
    </td>
  </tr>
  <tr class='alt'>
    <td><a href="http://www.newearthcalendar.com/" target="_blank">New Earth</a></td>
    <td>solar</td>
    <td>yes</td>
    <td>13</td>
    <td>28</td>
    <td>7</td>
    <td>proposed</td>
    <td>
      <ul>
        <li>Equal month lengths (not counting intercalary week).</li>
      </ul>
    </td>
    <td>
      <ul>
        <li>Intercalary week embiggens leap baby problem.</li>
        <li>13-month years cannot be easily divided by 2, 3 or 4.</li>
      </ul>
    </td>
  </tr>
</table>
<p>* There are a few advantages and disadvantages common to certain types of calendars, so in the
  interest of avoiding repeating myself I have listed them below instead of in the &quot;Pros&quot;
  and &quot;Cons&quot; columns:</p>
<h2>Pros:</h2>
<ol>
  <li>All solar calendars are synchronised with the seasonal cycle.</li>
  <li>All lunar and lunisolar calendars are synchronised with the lunar cycle.</li>
  <li>In perpetual calendars dates always map to the same day of the week, regardless of the year,
    which can be very convenient. Because the same calendar can be used every year, this saves paper
    and is therefore good for the environment.
  </li>
</ol>
<h2>Cons:</h2>
<ol>
  <li>Months in solar calendars are not aligned with the lunar cycle.</li>
  <li>In lunar and lunisolar calendars, calendar years are not aligned with seasonal markers. The
    year length also varies in length by up to 30 days (354 - 384 days), thus causing a large leap
    baby problem.
  </li>
  <li>Non-perpetual calendars require many different page layouts for calendar months. The Gregorian
    Calendar is probably the worst, with 28 possible page layouts. This is less tidy or convenient,
    plus it wastes paper. (It is good for the printing business, however.)
  </li>
</ol>
<p>&nbsp;</p>

<?php
require "tpl/TemplateBottom.php";
