<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";

println("<table border=1 cellspacing=0 cellpadding=3>");
println("<tr>");
println("<th>MJD</th>");
println("<th>CopDate</th>");
println("<th>Day of week</th>");
println("<th>Week#</th>");
println("</tr>");

for ($mjd = EarthianDate::mjdDay0 - 3653 + 1; $mjd < EarthianDate::mjdDay0 + 3653; $mjd++) {
  $earthDate = EarthianDate::fromMjd($mjd);
  $copWeekOfYear = $earthDate->weekOfYear();
  if ($copWeekOfYear['week'] <= 2 || $copWeekOfYear['week'] >= 51) {
    println("<tr>");
    println("<td>$mjd</td>");
    $color = $earthDate->year % 2 == 0 ? 'blue' : 'red';
    println("<td style='color:$color'>$earthDate</td>");
    $color = ($copWeekOfYear['week'] % 2 == 1) ? 'green' : 'magenta';
    println("<td style='color:$color'>" . $earthDate->dayOfWeek() . "</td>");
    println("<td style='color:$color'>{$copWeekOfYear['week']} of {$copWeekOfYear['year']}</td>");
    println("</tr>");
  }
}
println("</table>");
