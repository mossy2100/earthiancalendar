<?php
$fp = fopen("data/SeasonalMarkers.txt", "r");
$dateTimePattern = "/[\-\d]+ \d\d:\d\d/";
$seasonalMarkers = [];

if ($fp) {
  while (!feof($fp)) {
    $line = fgets($fp);
    $nMatches = preg_match_all($dateTimePattern, $line, $matches);
    if ($nMatches == 4) {
      foreach ($matches[0] as $index => $dateTime) {
        $dtParts = explode(' ', $dateTime);
        $date = $dtParts[0];
        $time = $dtParts[1];
        // fix the year format:
        if ($date[0] == '-') {
          // We'll skip the -ve years for now:
          continue;
        }
        while (strpos($date, '-') != 4) {
          $date = '0' . $date;
        }
        $seasonalMarkers[$date] = ['index' => $index, 'time' => $time];
      }
    }

  }
}
//debug($seasonalMarkers);

function getSeasonNote($gregDate) {
  global $seasonalMarkers, $southernHemisphere, $showSeasonalMarkers;
  if ($showSeasonalMarkers && isset($seasonalMarkers[$gregDate])) {
    $time = $seasonalMarkers[$gregDate]['time'];
    switch ($seasonalMarkers[$gregDate]['index']) {
      case 0: // northern vernal equinox
        return ($southernHemisphere ? "Autumnal" : "Vernal") . " Equinox $time UTC";
      case 1: // northern summer solstice
        return ($southernHemisphere ? "Winter" : "Summer") . " Solstice $time UTC";
      case 2: // northern autumnal equinox
        return ($southernHemisphere ? "Vernal" : "Autumnal") . " Equinox $time UTC";
      case 3: // northern winter equinox
        return ($southernHemisphere ? "Summer" : "Winter") . " Solstice $time UTC";
    }
  }
  else {
    return "";
  }
}
