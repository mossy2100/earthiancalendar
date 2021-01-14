<?php
$fp = fopen("data/LunarPhases.txt", "r");
$dateTimePattern = "/\d{4}\-\d\d\-\d\d \d\d:\d\d:\d\d/";
$lunarPhases = [];

$offset2Phase = [
  16 => 'NewMoon',
  41 => 'FirstQuarter',
  66 => 'FullMoon',
  91 => 'LastQuarter'
];

if ($fp) {
  while (!feof($fp)) {
    $line = fgets($fp);
    $nMatches = preg_match_all($dateTimePattern, $line, $matches, PREG_OFFSET_CAPTURE);
    if ($nMatches > 0) {
//			debug($matches);
      foreach ($matches[0] as $index => $match) {
        $dateTime = $match[0];
        $parts = explode(' ', $dateTime);
        $date = $parts[0];
        $time = $parts[1];
        $phase = $offset2Phase[$match[1]];
        $lunarPhases[$date] = ['phase' => $phase, 'time' => $time];
      }
    }

  }
}
//debug($lunarPhases);

function getLunarNote($gregDate) {
  global $lunarPhases, $showLunarPhases, $showAllPhases;
  if ($showLunarPhases && isset($lunarPhases[$gregDate])) {
    $time = substr($lunarPhases[$gregDate]['time'], 0, 5);
    switch ($lunarPhases[$gregDate]['phase']) {
      case 'NewMoon':
        return "New Moon $time UTC";
      case 'FirstQuarter':
        if ($showAllPhases) {
          return "First Quarter $time UTC";
        }
        break;
      case 'FullMoon':
        return "Full Moon $time UTC";
      case 'LastQuarter':
        if ($showAllPhases) {
          return "Last Quarter $time UTC";
        }
        break;
    }
  }
  return "";
}
