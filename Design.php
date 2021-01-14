<?php
require "include/init.php";
require "tpl/TemplateTop.php";
require "$libDir/dtl.php";
?>

<h1>Design of the Earthian Calendar</h1>
<p>One important thing was learned during the design of this calendar: namely, that the most
  popular calendar in the world - the Gregorian - is really not that bad after all! After
  experimenting with various calendar types, month and week lengths, leap year rules and patterns,
  the end result is a calendar not overly different from the one most of us are familiar with.</p>
<p>Almost all calendar reform involves creating <em>perpetual</em> calendars, in which months and
  weeks are synchronised, and thus calendar dates map to specific days of the week. While
  perpetual calendars are neat and pretty, and at first glance appear superior, on deeper
  investigation their benefits always come at a cost. As is explained here, because a 12-month
  solar calendar is the most useful arrangement, and because the 7-day week is virtually
  impossible to change, the ultimate result is a calendar that is <em>not</em> perpetual.</p>
<p> Humans have gravitated towards the structure of the Gregorian Calendar for valid reasons;
  however, there still remains a few things we can do to tune it, tweak it, and make it as good as
  it can possibly be. The Earthian Calendar addresses these issues.</p>
<p>&nbsp;</p>
<h2>Basic Principles</h2>
<p>Several basic principles were used in the design of the Earthian Calendar:</p>
<ol>
  <li>Strive for an optimal balance between simplicity, accuracy and practicality.</li>
  <li>Use simple, easily-remembered patterns (e.g. alternating 30 and 31-day months).</li>
  <li>Number things, such as months of the year, days of the month, days of the week and weeks of
    the year, from 1, not 0.
  </li>
  <li>Minimize the difference from the status quo, to assist acceptance of the calendar. Only
    change the things that need to be changed.
  </li>
  <li>Make the calendar as scientific and international as possible, with little or no bias
    towards any nation, religion or culture.
  </li>
</ol>
<p>&nbsp;</p>

<?php
require "tpl/TemplateBottom.php";
