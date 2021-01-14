<?php
// Create a data structure to display calendar pages.

// Store the form:
$_SESSION['Generator'] = $_POST;

//debug($_POST);
$wholeYear = str2bool($_POST['wholeYear']);
$month = (int) $_POST['month'];
$year = (int) $_POST['year'];
$showSeasonalMarkers = str2bool($_POST['showSeasonalMarkers']);
$southernHemisphere = $_POST['hemisphere'] == 'southern';
$showLunarPhases = str2bool($_POST['showLunarPhases']);
$showAllPhases = $_POST['phasesToShow'] == 'all';

// Each page has a set of weeks (0-6), and each week has a set of 7 dates.
$pages = [];

// Default to current month and year:
$today = dtlToday();
$earthToday = EarthianDate::fromGregorian($today);

if ($year === null) {
  $year = $earthToday->year;
}

if ($wholeYear) {
  $minMonth = 1;
  $maxMonth = 12;
}
else {
  if ($month === null) {
    $month = $earthToday->month;
  }
  $minMonth = $month;
  $maxMonth = $month;
}

for ($month = $minMonth; $month <= $maxMonth; $month++) {
  $pages[$month] = [];
  // Find the first day of the first week of the month:
  $day1 = new EarthianDate($year, $month, 1);
  $earthDate = EarthianDate::firstDayOfWeek($day1);
  $week = 1;
  $dayOfWeek = 1;
  $daysInMonth = EarthianDate::daysInMonth($year, $month);
  //debug("EarthianDate::daysInMonth($year, $month) = $daysInMonth");
  $monthDone = false;
  $pageDone = false;
  while (!$pageDone) {
    if ($dayOfWeek == 1) {
      $pages[$month][$week] = [];
    }
    // store the date:
    $pages[$month][$week][$dayOfWeek] = $earthDate;
    // check if the month is done:
    if (!$monthDone && $earthDate->month == $month && $earthDate->day == $daysInMonth) {
      $monthDone = true;
    }
    // check if the page is done:
    if ($dayOfWeek == 7) {
      $pageDone = $monthDone;
      $dayOfWeek = 1;
      $week++;
    }
    else {
      $dayOfWeek++;
    }
    $earthDate = $earthDate->addDays(1);
  }
}
