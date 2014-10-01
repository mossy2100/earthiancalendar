<?php
require "../include/init.php";
require "$libDir/dtl.php";
require "$classDir/EarthianDate.php";

println("<table border=1 cellspacing=0 cellpadding=3>");
println("<tr>");
println("<th>MJD</th>");
println("<th>GregDate</th>");
println("<th>Day of week</th>");
println("<th>Day of week</th>");
println("<th>Week#</th>");
println("</tr>");

for ($mjd = EarthianDate::mjdDay0 + 1; $mjd < EarthianDate::mjdDay0 + 3653; $mjd++)
{
	$gregDate = dtlMJDToDate($mjd);
	$gregWeekOfYear = dtlGetWeekOfYear($gregDate);
	if ($gregWeekOfYear['week'] <= 2 || $gregWeekOfYear['week'] >= 51)
	{
		println("<tr>");
		println("<td>$mjd</td>");
		$color = dtlGetYear($gregDate) % 2 == 0 ? 'blue' : 'red';
		println("<td style='color:$color'>$gregDate</td>");
		$color = $gregWeekOfYear['week'] % 2 == 0 ? 'green' : 'magenta';
		$dayOfWeek = dtlGetDayOfWeek($gregDate);
		println("<td style='color:$color'>$dayOfWeek</td>");
		println("<td style='color:$color'>".dtlGetDayName($gregDate)."</td>");
		println("<td style='color:$color'>{$gregWeekOfYear['week']} of {$gregWeekOfYear['year']}</td>");
		println("</tr>");
	}
}
println("</table>");

?>