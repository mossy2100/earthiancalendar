<?php
require "include/init.php";
require "$libDir/dtl.php";
require "$libDir/arrays.php";
require "$libDir/colors.php";
require "$classDir/EarthianDate.php";

// load FPDF:
define('FPDF_FONTPATH', "$libDir/FPDF/font/");
require "$libDir/FPDF/fpdf.php";

// constants:
define('MM_PER_INCH', 25.4);
define('POINTS_PER_INCH', 72);
$pointsPerMm = POINTS_PER_INCH / MM_PER_INCH;

// all dimensions in mm:
$headingFontSize = 15;
$dayNameFontSize = 5;
$dateFontSize = 6;
$noteFontSize = 3;
$gregDateFontSize = 3.7;
$pageWidth = 297;
$pageHeight = 210;
$margin = 10;
$headingWidth = $pageWidth - (2 * $margin);
$headingHeight = 20;
$dayNamesHeight = 10;
$cellWidth = $headingWidth / 7;

// create the PDF:
$pdf = new FPDF('L', 'mm', 'A4');

// cell borders:
$borderColor = hex2rgb($_POST['borderColor']);
$pdf->SetDrawColor($borderColor['red'], $borderColor['green'], $borderColor['blue']);

// cell colors:
for ($i = 1; $i <= 7; $i++)
{
	$dayColors[$i] = hex2rgb($_POST["dayColors"][$i]);
}

// other month colors:
$otherMonthBgColor = hex2rgb("#f7f7f7");
$otherMonthTextColor = hex2rgb("#bbbbbb");

require_once "include/CalculatePages.php";
require_once "include/GetSeasonalMarkers.php";
require_once "include/GetLunarPhases.php";

$formattedYear = str_pad($year, 4, '0', STR_PAD_LEFT);

foreach ($pages as $month => $page)
{
	$pdf->AddPage();

	// heading:
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetFont('Arial', 'B', mm2points($headingFontSize));
	$pdf->SetXY($margin, $margin);
	$heading = $formattedYear.' '.EarthianDate::$monthNames[$month];
	$pdf->Cell($headingWidth, $headingHeight, $heading, 0, 0, 'C', false);

	// day names:
	$pdf->SetFont('Arial', 'B', mm2points($dayNameFontSize));
	foreach (EarthianDate::$dayNames as $dayOfWeek => $dayName)
	{
		$pdf->SetFillColor($dayColors[$dayOfWeek]['red'], $dayColors[$dayOfWeek]['green'], $dayColors[$dayOfWeek]['blue']);
		$pdf->SetXY($margin + (($dayOfWeek - 1) * $cellWidth), $margin + $headingHeight);
		$pdf->Cell($cellWidth, $dayNamesHeight, $dayName, 1, 0, 'C', true);
	}

	// dates:
	$cellHeight = ($pageHeight - (2 * $margin) - $headingHeight - $dayNamesHeight) / count($page);
	foreach ($page as $w => $week)
	{
		for ($dayOfWeek = 1; $dayOfWeek <= 7; $dayOfWeek++)
		{
			$earthDate = $week[$dayOfWeek];
			$gregDate = $earthDate->toGregorian();
			$isOtherMonth = $earthDate->month != $month;
			if ($isOtherMonth)
			{
				$pdf->SetTextColor($otherMonthTextColor['red'], $otherMonthTextColor['green'], $otherMonthTextColor['blue']);
				$pdf->SetFillColor($otherMonthBgColor['red'], $otherMonthBgColor['green'], $otherMonthBgColor['blue']);
				$pdf->SetFont('Arial', '', mm2points($dateFontSize));
				$text = EarthianDate::$abbrevMonthNames[$earthDate->month].' '.$earthDate->day;
			}
			else
			{
				$pdf->SetTextColor(0, 0, 0);
				$pdf->SetFillColor($dayColors[$dayOfWeek]['red'], $dayColors[$dayOfWeek]['green'], $dayColors[$dayOfWeek]['blue']);
				$pdf->SetFont('Arial', 'B', mm2points($dateFontSize));
				$text = $earthDate->day;
			}
			$x = $margin + (($dayOfWeek - 1) * $cellWidth);
			$y = $margin + $headingHeight + $dayNamesHeight + (($w - 1) * $cellHeight);
			$pdf->Rect($x, $y, $cellWidth, $cellHeight, 'DF');

			// Earthian date:
			$pdf->Text($x + 1, $y + $dateFontSize, $text);
			
			// Seasonal marker/lunar phase note:
			$note = getSeasonNote($gregDate);
			if ($note != "")
			{
				$note .= "\n"; 
			}
			$note .= getLunarNote($gregDate);
			$pdf->SetFont('Arial', '', mm2points($noteFontSize));
			$pdf->SetLeftMargin($x);
			$pdf->SetRightMargin($pageWidth - ($x + $cellWidth));
			$pdf->SetXY($x, $y + $dateFontSize + 1.5);
			$pdf->Write($noteFontSize + 0.5, $note);
			// reset the right margin:
			$pdf->SetRightMargin($margin);

			// Gregorian date:
			$strGreg = dtlFormat($gregDate, "Day D-Mon-YYYY");
			$pdf->SetFont('Arial', '', mm2points($gregDateFontSize));
			$strWidth = $pdf->GetStringWidth($strGreg);
			$pdf->Text($x + (($cellWidth - $strWidth) / 2), $y + $cellHeight - 2, $strGreg);
		}
	}
}

$pdf->Output();


// support functions:
function mm2points($mm)
{
	global $pointsPerMm;
	return $mm * $pointsPerMm;
}
?>