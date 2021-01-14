<?php
require "include/init.php";
require "tpl/TemplateTop.php";
require "$libDir/dtl.php";
?>

<h1>Notation</h1>
<p>Dates are written as YYYY/MM/DD, or -YYYY/MM/DD for negative dates. This is a fairly
  recognisable international format for date notation, similar to the ISO8601 format for Gregorian
  dates (YYYY-MM-DD). It has the most significant units appearing first, which is convenient when
  comparing dates in computer programs.</p>
<p>Months can be specified as YYYY/MM, and anually recurring dates can be specified as MM/DD.</p>
<p>Single-digit days and months are therefore padded with a leading 0 to make 2 digits. Years are
  similarly padded to 4 digits (at least until the year 10,000, anyway), which is familiar, and
  distinguishes them from other parts of the date. The century is always shown, to avoid Y2K-type
  issues.</p>
<h2>Separator character</h2>
<p>The forward slash character '/' is used as the date separator, for several reasons:</p>
<ul>
  <li>This character is commonly understood as a date separator, yet at present is only used in
    DD/MM/YYYY or MM/DD/YYYY formats; never in YYYY/MM/DD. The padding of years to 4 digits
    distinguishes Earthian dates from these other formats.
  </li>
  <li>The hyphen '-' plays the role of an optional leading minus sign (to indicate a negative
    year), plus, using hyphens as the separator character would make the date look like an ISO
    Gregorian date.
  </li>
  <li>Using periods '.' would cause confusion if the year or day was omitted from the date format,
    e.g. 1000.05 looks like an ordinary number, not a month.
  </li>
  <li>Similarly with commas ',' since this character is the decimal point in some countries.</li>
  <li>Colons ':' would make dates look like times.</li>
  <li>Semi-colons ';', vertical bars '|', back-ticks '`', squiggles '~', carats '^', octothorpes
    '#', backslashes '\' and pretty much any other punctuation characters simply look weird, not
    like date separators.
  </li>
  <li>There are few other options that would be convenient to use in writing as well as typing.
  </li>
</ul>
<p>The only real downside of this choice of separator is that if a date is written without the
  year or day, e.g. 12/25, then it could be interpreted as a fraction. But this should not happen
  very often.</p>
<h2>Golden Era Notation</h2>
<p>The date can optionally be followed by &quot;GE&quot; for &quot;Golden Era&quot;, to further
  distinguish it from dates in Gregorian or other calendars. The full format specification for a
  date is therefore as follows: [-]YYYY/MM/DD[ GE]</p>
<p>&nbsp;</p>

<?php
require "tpl/TemplateBottom.php";
