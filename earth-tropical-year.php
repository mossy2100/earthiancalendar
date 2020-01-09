<?php

/**
 * Laskar's expression for the average duration of the tropical year.
 *
 * This currently uses UTC but it may need to be modified to use TT. However, the small offset (number of seconds) is
 * probably unlikely to affect the result (at least, not very much).
 */
function average_tropical_year_length(DateTime $d = NULL): float {
  $utc = new DateTimeZone('UTC');
  if ($d === NULL) {
    $d = new DateTime('now', $utc);
  }
  $d1 = new DateTime('2000-01-01 12:00:00', $utc);
  $di = date_diff($d, $d1);
  $t = $di->days / 36525;
  echo "Number of Julian centuries since 2000-01-01T12:00:00UTC is $t<br>";
  return 365.2421896698 - 6.15359e-6 * $t - 7.29e-10 * $t**2 + 2.64e-10 * $t**3;
}

echo "Current average tropical year length is " . average_tropical_year_length() . " days<br>";
