<?php
///////////////////////////////////////////////////////////////////////////
// functions to generate client-side date, time, and datetime selectors:

function dtlSelector($name, $dts, $format, $onchange, $minYear, $maxYear, $increment)
{
	// * outputs a date, time, or datetime selector in the given format
	// * format codes supported:
	//   YYYY, M, MM, Mon, mon, MON, Month, month, MONTH, D, DD, Dth, HH, H, mm, ss
	// * any other characters printed as literals
	// * maximum of 1 selector for year, month, day, hours, minutes, and seconds
	// * $increment specifies the increments in minutes (or seconds if included)
	// * 2-digit years not supported
	// * 12-hour time not supported
	// * returns false if $dts not a DateStr, TimeStr, or DateTimeStr
	print("<input type='hidden' id='$name' name='$name' value='$dts' onchange=\"$onchange\">");

	// get the date and/or time component:
	$dta = dtlStrToArray($dts);
	extract($dta);
	if (dtlIsDateStr($dts))
	{
		$updateFunction = 'dtlUpdateDateSelector';
	}
	else if (dtlIsTimeStr($dts))
	{
		$updateFunction = 'dtlUpdateTimeSelector';
	}
	else if (dtlIsDateTimeStr($dts))
	{
		$updateFunction = 'dtlUpdateDateTimeSelector';
	}
	else
		return false;

	// specific date processing:
	if ($date)
	{
		// initial days in month:
		if (!$nDays = dtlDaysInMonth($year, $month))
			$nDays = 31;
		$yearFound = false;
		$monthFound = false;
		$dayFound = false;
		$monthFormats = array('Month', 'month', 'MONTH', 'Mon', 'mon', 'MON', 'MM', 'M');
		$dayFormats = array('Dth', 'DD', 'D');
	}

	// specific time processing:
	if ($time)
	{
		// does $increment refer to seconds or minutes?
		if (strpos($format, 'ss') !== false)
		{
			// seconds to be displayed:
			$minutesIncrement = 1;
			$secondsIncrement = $increment;
		}
		else
		{
			// seconds not displayed, $increment refers to minutes:
			$minutesIncrement = $increment;
		}
		$hoursFound = false;
		$minutesFound = false;
		$secondsFound = false;
		$hoursFormats = array('HH', 'H');
	}

	$pos = 0;
	$len = strlen($format);
	while ($pos < $len)
	{
		$ch = $format{$pos};
		$replacement = false;

		if ($date)
		{
			if (!$yearFound && $ch == 'Y')
			{
				if (substr($format, $pos, 4) == 'YYYY')
				{
					$yearFound = true;
					dtlYearSelector($name.'_year', $year, $minYear, $maxYear, "$updateFunction('$name')");
					$pos += 4;
					$replacement = true;
				}
			}
			else if (!$monthFound && ($ch == 'M' || $ch == 'm'))
			{
				for ($j = 0; $j < count($monthFormats); $j++)
				{
					$monthFormat = $monthFormats[$j];
					if (substr($format, $pos, strlen($monthFormat)) == $monthFormat)
					{
						$monthFound = true;
						break;
					}
				}
				if ($monthFound)
				{
					dtlMonthSelector($name.'_month', $month, $monthFormat, "$updateFunction('$name')");
					$pos += strlen($monthFormat);
					$replacement = true;
				}
			}
			else if (!$dayFound && $ch == 'D')
			{
				for ($j = 0; $j < count($dayFormats); $j++)
				{
					$dayFormat = $dayFormats[$j];
					if (substr($format, $pos, strlen($dayFormat)) == $dayFormat)
					{
						$dayFound = true;
						break;
					}
				}
				if ($dayFound)
				{
					dtlDayOfMonthSelector($name.'_day', $day, $nDays, $dayFormat, "$updateFunction('$name')");
					$pos += strlen($dayFormat);
					$replacement = true;
				}
			}
		}

		if ($time)
		{
			if (!$hoursFound && $ch == 'H')
			{
				$hoursFound = true;
				if (substr($format, $pos, 2) == 'HH')
					$hoursFormat = 'HH';
				else
					$hoursFormat = 'H';
				dtlHoursSelector($name.'_hours', $hours, $hoursFormat, "$updateFunction('$name')");
				$pos += strlen($hoursFormat);
				$replacement = true;
			}
			else if (!$minutesFound && $ch == 'm')
			{
				if (substr($format, $pos, 2) == 'mm')
				{
					$minutesFound = true;
					dtlMinutesSelector($name.'_minutes', $minutes, $minutesIncrement, "$updateFunction('$name')");
					$pos += 2;
					$replacement = true;
				}
			}
			else if (!$secondsFound && $ch == 's')
			{
				if (substr($format, $pos, 2) == 'ss')
				{
					$secondsFound = true;
					dtlSecondsSelector($name.'_seconds', $seconds, $secondsIncrement, "$updateFunction('$name')");
					$pos += 2;
					$replacement = true;
				}
			}
		}
	
		if (!$replacement)
		{
			print $ch;
			$pos++;
		}
	}

	// output hidden fields for date/time parts not specified in format:
	if ($date)
	{
		if (!$yearFound)
			print("<input type=hidden name='{$name}_year' value='$year'>");
		if (!$monthFound)
			print("<input type=hidden name='{$name}_month' value='$month'>");
		if (!$dayFound)
			print("<input type=hidden name='{$name}_day' value='$day'>");
	}
	if ($time)
	{
		if (!$hoursFound)
			print("<input type=hidden name='{$name}_hours' value='$hours'>");
		if (!$minutesFound)
			print("<input type=hidden name='{$name}_minutes' value='$minutes'>");
		if (!$secondsFound)
			print("<input type=hidden name='{$name}_seconds' value='$seconds'>");
	}
}


function dtlDateSelector($name, $ds = "0000-00-00", $format = 'DMonYYYY', $onchange = '', $minYear = 2001, $maxYear = 2010)
{
	// * outputs a date selector in the given format
	// * format codes supported: YYYY, M, MM, Mon, mon, MON, Month, month, MONTH, D, DD, Dth
	// * any other characters printed as literals
	// * 2-digit years not supported
	if ($ds == '')
		$ds = '0000-00-00';
	if ($format == '')
		$format = 'DMonYYYY';
	dtlSelector($name, $ds, $format, $onchange, $minYear, $maxYear, 0);
}


function dtlTimeSelector($name, $ts = "00:00:00", $format = 'HH:mm', $onchange = '', $increment = 5)
{
	// * outputs a time selector in the given format
	// * format codes supported: HH, H, mm, ss
	// * any other characters printed as literals
	// * $increment specifies the increments in minutes (or seconds if included)
	// * 12-hour time not supported
	if ($ts == '')
		$ts = '00:00:00';
	if ($format == '')
		$format = 'HH:mm';
	dtlSelector($name, $ts, $format, $onchange, 0, 0, $increment);
}


function dtlDateTimeSelector($name, $dts = "0000-00-00 00:00:00", $format = 'DMonYYYY HH:mm', $onchange = '', $minYear = 2001, $maxYear = 2010, $increment = 5)
{
	if ($dts == '') $dts = '0000-00-00 00:00:00';
	if ($format == '') $format = 'DMonYYYY HH:mm';
	dtlSelector($name, $dts, $format, $onchange, $minYear, $maxYear, $increment);
}


function dtlYearSelector($name, $year = 0, $minYear = 2001, $maxYear = 2010, $onchange = '')
{
	print("<select id='$name' name='$name'");
	if ($onchange != '')
		print(" onchange=\"$onchange\"");
	print(">\n");
	print("<option value=0></option>\n");
	for ($y = $minYear; $y <= $maxYear; $y++)
	{
		print("<option value=$y");
		if ($year == $y)
			print(" selected");
		print(">$y</option>\n");
	}
	print("</select>");
}


function dtlMonthSelector($name, $month = 0, $format = 'MM', $onchange = '')
{
	print("<select id='$name' name='$name'");
	if ($onchange != '')
		print(" onchange=\"$onchange\"");
	print(">\n");
	print("<option value=0></option>\n");
	for ($m = 1; $m <= 12; $m++)
	{
		print("<option value=$m");
		if ($month == $m)
			print(" selected");
		print(">");
		if ($format == 'M')
			print($m);
		else if ($format == 'MM')
			print(dtlZeroPad($m));
		else if ($format == 'Mon')
			print(dtlAbbrevMonthName($m));
		else if ($format == 'mon')
			print(strtolower(dtlAbbrevMonthName($m)));
		else if ($format == 'MON')
			print(strtoupper(dtlAbbrevMonthName($m)));
		else if ($format == 'Month')
			print(dtlMonthName($m));
		else if ($format == 'month')
			print(strtolower(dtlMonthName($m)));
		else if ($format == 'MONTH')
			print(strtoupper(dtlMonthName($m)));
		print("</option>\n");
	}
	print("</select>");
}


function dtlDayOfMonthSelector($name, $day = 0, $maxDay = 31, $format = 'DD', $onchange = '')
{
	print("<select id='$name' name='$name'");
	if ($onchange != '')
		print(" onchange=\"$onchange\"");
	print(">\n");
	print("<option value=0></option>\n");
	for ($d = 1; $d <= $maxDay; $d++)
	{
		print("<option value=$d");
		if ($d == $day)
			print(" selected");
		print(">");
		if ($format == 'D')
			print($d);
		else if ($format == 'DD')
			print(dtlZeroPad($d));
		else if ($format == 'Dth')
			print(dtlOrdinalSuffix($d));
		print("</option>\n");
	}
	print("</select>");
}


function dtlDayOfWeekSelector($name, $dow = 0, $format = 'Dayofweek', $onchange = '')
{
	print("<select id='$name' name='$name'");
	if ($onchange != '')
		print(" onchange=\"$onchange\"");
	print(">\n");
	print("<option value=0></option>\n");
	for ($d = 1; $d <= 7; $d++)
	{
		print("<option value=$d");
		if ($d == $dow)
			print " selected";
		print(">");
		if ($format == 'Dayofweek')
			print dtlDayName($d);
		else if ($format == 'dayofweek')
			print strtolower(dtlDayName($d));
		else if ($format == 'DAYOFWEEK')
			print strtoupper(dtlDayName($d));
		else if ($format == 'Day')
			print dtlAbbrevDayName($d);
		else if ($format == 'day')
			print strtolower(dtlAbbrevDayName($d));
		else if ($format == 'DAY')
			print strtoupper(dtlAbbrevDayName($d));
		print("</option>\n");
	}
	print("</select>");
}


function dtlHoursSelector($name, $hours = 0, $format = 'HH', $onchange = '')
{
	print("<select id='$name' name='$name'");
	if ($onchange != '')
		print(" onchange=\"$onchange\"");
	print(">\n");
	for ($h = 0; $h < 24; $h++)
	{
		print("<option value=$h");
		if ($hours == $h)
			print(" selected");
		print(">");
		if (strlen($format) == 2)
			print(dtlZeroPad($h));
		else
			print($h);
		print("</option>\n");
	}
	print("</select>");
}


function dtlMinutesSelector($name, $minutes = 0, $increment = 5, $onchange = '')
{
	print("<select id='$name' name='$name'");
	if ($onchange != '')
		print(" onchange=\"$onchange\"");
	print(">\n");
	for ($m = 0; $m < 60; $m += $increment)
	{
		print("<option value=$m");
		if ($minutes == $m)
			print(" selected");
		print(">".dtlZeroPad($m)."</option>\n");
	}
	print("</select>");
}


function dtlSecondsSelector($name, $seconds = 0, $increment = 5, $onchange = '')
{
	print("<select id='$name' name='$name'");
	if ($onchange != '')
		print(" onchange=\"$onchange\"");
	print(">\n");
	for ($s = 0; $s < 60; $s += $increment)
	{
		print("<option value=$s");
		if ($seconds == $s)
			print(" selected");
		print(">".dtlZeroPad($s)."</option>\n");
	}
	print("</select>");
}
?>
