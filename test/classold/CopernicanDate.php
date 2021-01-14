<?php
///////////////////////////////////////////////////////////////////////////////
// EarthianDate.php
// ==================
//
// Date/Time Library - Copernicus Calendar extension - PHP version
// by Shaun Moss, September 2008

// Notes
// =====
// Standard format for Earthian dates: [-]YYYY/MM/DD

class EarthianDate {
  /**
   * Variables to store the date.
   *
   * @var int
   */
  public $year;
  public $month;
  public $day;

  /**
   * Names of the days of the week in the Copernicus Calendar.
   *
   * @var string[]
   */
  public static $dayNames = [1 => 'Sunday', 'Lunaday', 'Marsday', 'Mercuryday', 'Jupiterday',
    'Venusday', 'Saturnday'];

  /**
   * Names of the months of the year in the Copernicus Calendar.
   *
   * @var string[]
   */
  public static $monthNames = [1 => 'Aries', 'Taurus', 'Gemini', 'Cancer', 'Leo', 'Virgo', 'Libra',
    'Scorpius', 'Sagittarius', 'Capricornus', 'Aquarius', 'Pisces'];

  /**
   * Abbreviated names of the months of the year in the Copernicus Calendar.
   *
   * @var string[]
   */
  public static $abbrevMonthNames = [1 => 'Ari', 'Tau', 'Gem', 'Cnc', 'Leo', 'Vir', 'Lib', 'Sco',
    'Sgr', 'Cap', 'Aqr', 'Psc'];

  /**
   * The Modified Julian Day number of the first date in the Copernicus Calendar.
   */
  const mjdDay0 = 54179;

  /**
   * Number of days in a generation (33-year cycle).
   */
  const daysPerGeneration = 12053;

  /**
   * Date separator.
   */
  const sep = '/';

  ///////////////////////////////////////////////////////////////////////////////
  // Constructor

  /**
   * Construct a Earthian date.
   * Accepts a variety of input parameters:
   * - 3 integers for year, month and day
   * - an array of 3 integers holding values for year, month and day (accepts both string and
   * numeric keys)
   * - a Unix timestamp
   * - a string that looks like a date
   */
  function __construct() {
    $this->year = 0;
    $this->month = 0;
    $this->day = 0;
    $args = func_get_args();
    $nArgs = count($args);
    if ($nArgs == 3) {
      $this->year = (int) $args[0];
      $this->month = (int) $args[1];
      $this->day = (int) $args[2];
    }
    elseif ($nArgs == 1) {
      if (is_array($args[0])) {
        // array of values:
        $aDate = $args[0];
        // get the year:
        if (is_set($aDate['year'])) {
          $this->year = (int) $aDate['year'];
        }
        elseif (is_set($aDate[0])) {
          $this->year = (int) $aDate[0];
        }
        // get the month:
        if (is_set($aDate['month'])) {
          $this->month = (int) $aDate['month'];
        }
        elseif (is_set($aDate[1])) {
          $this->month = (int) $aDate[1];
        }
        // get the day:
        if (is_set($aDate['day'])) {
          $this->day = (int) $aDate['day'];
        }
        elseif (is_set($aDate[2])) {
          $this->day = (int) $aDate[2];
        }
      }
      elseif (is_string($args[0]) &&
        preg_match("/^\d{4}\\" . self::sep . "\d{2}\\" . self::sep . "\d{2}$/", $args[0])) {
        // matches a string in the format Y.MM.DD
        $aDate = explode(self::sep, $args[0]);
        $this->year = (int) $aDate[0];
        $this->month = (int) $aDate[1];
        $this->day = (int) $aDate[2];
      }
    }
  }


  ///////////////////////////////////////////////////////////////////////////////
  // Class Methods

  /**
   * Add a certain number of days to a EarthianDate.
   * To subtract days, use this function with a -ve value for nDays.
   *
   * @param EarthianDate $date
   * @param int $nDays
   * @return  EarthianDate
   */
  public static function addDays($date, $nDays) {
    $mjd = $date->toMjd();
    $mjd += $nDays;
    return self::fromMjd($mjd);
  }

  /**
   * Generate a date selector.
   *
   * @param string $id
   * @param EarthianDate $selectedValue
   * @param array $attribs
   * @param int $minYear
   * @param int $maxYear
   * @return  string      XHTML code
   */
  public static function dateSelector($id, $selectedValue, $attribs, $minYear, $maxYear) {
    $daySelector = self::daySelector($id . "_day", $selectedValue->day, $attribs);
    $monthSelector = self::monthSelector($id . "_month", $selectedValue->month, $attribs);
    $yearSelector =
      self::yearSelector($id . "_year", $selectedValue->year, $attribs, $minYear, $maxYear);
    return $daySelector . $monthSelector . $yearSelector;
  }

  /**
   * Generate a day selector.
   *
   * @param string $id
   * @param int $selectedValue
   * @param array $attribs
   * @return  string  XHTML code
   * @todo This should return a Selector control.
   *
   */
  public static function daySelector($id, $selectedValue, $attribs) {
    $result = "<select id='$id' name='$id'";
    if (is_array($attribs)) {
      foreach ($attribs as $attrib => $value) {
        $result .= " $attrib='" . htmlspecialchars($value, ENT_QUOTES) . "'";
      }
    }
    $result .= ">\n";
    $result .= "<option value='0'></option>\n";
    for ($d = 1; $d <= 31; $d++) {
      $result .= "<option value='$d'";
      if ($d == $selectedValue) {
        $result .= " selected";
      }
      $result .= ">$d</option>\n";
    }
    $result .= "</select>";
    echo $result;
  }

  /**
   * Returns the number of days in a given month.
   * The year is also required for the case of Pisces (month 12), which can be 30 or 31 days
   * long depending on whether or not it's in a leap year.
   *
   * @param int $year
   * @param int $month
   * @return  int
   */
  public static function daysInMonth($year, $month) {
    return $month == 12 ? (self::isLeapYear($year) ? 31 : 30) : ($month % 2 == 1 ? 30 : 31);
  }

  /**
   * Returns the number of days in a given year.
   *
   * @param int $year
   * @return  int
   */
  public static function daysInYear($year) {
    return self::isLeapYear($year) ? 366 : 365;
  }

  /**
   * Returns the Earthian date of the first day in a given week.
   *
   * @param int $mixed Can be the year, the week of the year as an array, or a EarthianDate.
   * @param int $week
   * @return  EarthianDate
   */
  public static function firstDayOfWeek($mixed, $week = null) {
    if (is_object($mixed) && get_class($mixed) == 'EarthianDate' && $week == null) {
      $date = $mixed;
      $dayOfWeek = $date->dayOfWeek();
      if ($dayOfWeek == 1) {
        return $date;
      }
      return self::addDays($date, 1 - $dayOfWeek);
    }
    else {
      if (is_numeric($mixed) && is_numeric($week)) {
        $year = intval($mixed);
        $week = intval($week);
      }
      elseif (is_array($mixed) && is_numeric($mixed['year']) && is_numeric($mixed['week']) &&
        $week == null) {
        $year = intval($mixed['year']);
        $week = intval($mixed['week']);
      }
      else {
        trigger_error("Invalid parameters passed to firstDayOfWeek().  RTFM.");
        return null;
      }
      // Get date of first day of the given year:
      $firstDayOfYear = new EarthianDate($year, 1, 1);
      $dayOfWeek = $firstDayOfYear->dayOfWeek();
      $weekOfYear = $firstDayOfYear->weekOfYear();
      $weekOfYear = $weekOfYear['week'] == 1 ? 1 : 0;
      // Add weeks to find the first day of the specified week:
      $firstDayOfWeek =
        self::addDays($firstDayOfYear, 1 - $dayOfWeek + (($week - $weekOfYear) * 7));
      return $firstDayOfWeek;
    }
  }

  /**
   * Returns the Earthian date of the first day in a given year.
   * (trivial, only implemented to balance the lastDayOfYear function, below)
   *
   * @param int $year
   * @return  EarthianDate
   */
  public static function firstDayOfYear($year) {
    return new EarthianDate($year, 1, 1);
  }

  /**
   * Converts a Gregorian date string to a Earthian one.
   *
   * @param string $dGreg
   * @return  EarthianDate
   */
  public static function fromGregorian($dGreg) {
    return self::fromMjd(dtlDateToMJD($dGreg));
  }

  /**
   * Converts a Modified Julian Day number to a EarthianDate.
   *
   * @param int $mjd
   * @return  EarthianDate
   */
  public static function fromMjd($mjd) {
    // find difference between mjd and mjdDay0
    $daysRemaining = $mjd - self::mjdDay0 - 1;
    // get number of whole generations:
    $nGenerations = intdiv($daysRemaining, self::daysPerGeneration);
    $daysRemaining -= $nGenerations * self::daysPerGeneration;
    // subtract days in remaining whole years:
    // groups of 4 years:
    $year = $nGenerations * 33;
    $nFourYears = intdiv($daysRemaining, 1461);
    $daysRemaining -= $nFourYears * 1461;
    $year += $nFourYears * 4;
    // any remaining years (max 3) do one at a time:
    $daysInYear = self::daysInYear($year);
    while ($daysRemaining >= $daysInYear) {
      $daysRemaining -= $daysInYear;
      $year++;
      $daysInYear = self::daysInYear($year);
    }
    // subtract days in remaining months:
    $nTwoMonths = intdiv($daysRemaining, 61);
    $month = ($nTwoMonths * 2) + 1;
    $daysRemaining -= $nTwoMonths * 61;
    if ($daysRemaining >= 30) {
      $month++;
      $daysRemaining -= 30;
    }
    // subtract remaining days:
    return new EarthianDate($year, $month, $daysRemaining + 1);
  }

  /**
   * Returns true if the given year is a leap year.
   *
   * @param int $year
   * @return  bool
   */
  public static function isLeapYear($year) {
    return $year % 33 % 4 == 2;
  }

  /**
   * Returns the Earthian date of the last day in a given year.
   *
   * @param int $year
   * @return  EarthianDate
   */
  public static function lastDayOfYear($year) {
    return new EarthianDate($year, 12, self::isLeapYear($year) ? 31 : 30);
  }

  /**
   * Generate a month selector.
   *
   * @param string $id
   * @param int $selectedValue
   * @param array $attribs
   * @todo This should return a Selector control.
   *
   */
  public static function monthSelector($id, $selectedValue, $attribs) {
    $result = "<select id='$id' name='$id'";
    if (is_array($attribs)) {
      foreach ($attribs as $attrib => $value) {
        $result .= " $attrib='" . htmlspecialchars($value, ENT_QUOTES) . "'";
      }
    }
    $result .= ">\n";
    $result .= "<option value='0'></option>\n";
    foreach (self::$monthNames as $mm => $monthName) {
      $result .= "<option value='$mm'";
      if ($mm == $selectedValue) {
        $result .= " selected";
      }
      $result .= ">$monthName</option>\n";
    }
    $result .= "</select>";
    echo $result;
  }

  /**
   * Generate a year selector.
   *
   * @param string $id
   * @param int $selectedValue
   * @param array $attribs
   * @param int $minYear
   * @param int $maxYear
   * @todo This should return a Selector control.
   *
   */
  public static function yearSelector($id, $selectedValue, $attribs, $minYear, $maxYear) {
    $result = "<select id='$id' name='$id' style='text-align: right'";
    if (is_array($attribs)) {
      foreach ($attribs as $attrib => $value) {
        $result .= " $attrib='" . htmlspecialchars($value, ENT_QUOTES) . "'";
      }
    }
    $result .= ">\n";
    //		$result .= "<option value='0'></option>\n";
    for ($y = $minYear; $y <= $maxYear; $y++) {
      $result .= "<option value='$y'";
      if ($y == $selectedValue) {
        $result .= " selected";
      }
      $result .= ">$y</option>\n";
    }
    $result .= "</select>";
    echo $result;
  }


  ///////////////////////////////////////////////////////////////////////////////
  // Object Methods

  /**
   * Outputs the EarthianDate in the format YYYY~MM~DD
   *
   * @return string
   */
  public function __toString() {
    return sign($this->year) . str_pad(abs($this->year), 4, '0', STR_PAD_LEFT) .
      self::sep . str_pad($this->month, 2, '0', STR_PAD_LEFT) .
      self::sep . str_pad($this->day, 2, '0', STR_PAD_LEFT);
  }

  /**
   * Return the name of the day of the week for this date.
   *
   * @return string
   */
  public function dayOfWeekName() {
    $i = $this->dayOfWeek();
    return self::$dayNames[$i];
  }

  /**
   * Return the day of the week index for this date (1..7).
   *
   * @return int
   */
  public function dayOfWeek() {
    $mjd = $this->toMjd();
    return ($mjd + 3) % 7 + 1;
  }

  /**
   * Returns the day of the year, from 1..366.
   *
   * @return int
   */
  public function dayOfYear() {
    $nTwoMonths = intdiv($this->month - 1, 2);
    $days = $nTwoMonths * 61;
    if ($this->month % 2 == 0) {
      $days += 30;
    }
    $days += $this->day;
    return $days;
  }

  /**
   * Returns true if $this is before the given date.
   *
   * @param EarthianDate $earthDate
   * @return  bool
   */
  public function isEarlierThan($earthDate) {
    return $this->toMjd() < $earthDate->toMjd();
  }

  /**
   * Returns true if $this is before or the same as the given date.
   *
   * @param EarthianDate $earthDate
   * @return  bool
   */
  public function isEarlierThanOrEqualTo($earthDate) {
    return $this->toMjd() <= $earthDate->toMjd();
  }

  /**
   * Returns true if $this is the same as the given date.
   *
   * @param EarthianDate $earthDate
   * @returns bool
   */
  public function isEqualTo($earthDate) {
    return $this->toMjd() == $earthDate->toMjd();
  }

  /**
   * Returns true if $this is after the given date.
   *
   * @param EarthianDate $earthDate
   * @return  bool
   */
  public function isLaterThan($earthDate) {
    return $this->toMjd() > $earthDate->toMjd();
  }

  /**
   * Returns true if $this is after or the same as the given date.
   *
   * @param EarthianDate $earthDate
   * @return  bool
   */
  public function isLaterThanOrEqualTo($earthDate) {
    return $this->toMjd() >= $earthDate->toMjd();
  }

  /**
   * Returns true if the date is valid.
   *
   * @return bool
   */
  public function isValid() {
    $ok = looksLikeInt($this->year) && looksLikeInt($this->month) && looksLikeInt($this->day) &&
      $this->month >= 1 && $this->month <= 12 &&
      $this->day >= 1 && $this->day <= self::daysInMonth($this->year, $this->month);
    return $ok;
  }

  /**
   * Converts a EarthianDate to a Gregorian one.
   *
   * @return string
   */
  public function toGregorian() {
    return dtlMJDToDate($this->toMjd());
  }

  /**
   * Converts a EarthianDate to a Modified Julian Day number.
   *
   * @return int
   */
  public function toMjd() {
    // start at "Day 0", i.e. last day of the year -1, the day before beginning of calendar:
    $mjd = self::mjdDay0;
    // add days for the cycles of 33 years (generations):
    $nGenerations = intdiv($this->year, 33);
    $mjd += $nGenerations * self::daysPerGeneration;
    // add days for "quads" (1 quad = 4 years):
    $year = $this->year - ($nGenerations * 33);  // year: 0..32
    $nFourYears = intdiv($year, 4);              // nFourYears: 0..8
    $mjd += $nFourYears * 1461;
    // add days for remaining years:
    $year = ($nGenerations * 33) + ($nFourYears * 4);
    for ($y = $year; $y < $this->year; $y++) {
      $mjd += self::daysInYear($y);
    }
    // add days for months:
    $nTwoMonths = intdiv($this->month - 1, 2);
    $mjd += $nTwoMonths * 61;
    $mjd += ($this->month - 1) % 2 * 30;
    // add remaining days:
    $mjd += $this->day;
    return $mjd;
  }

  /**
   * Returns the week number, from 1..53.
   *
   * @return int
   */
  public function weekOfYear() {
    $dayOfYear = $this->dayOfYear();
    $dayOfWeek = $this->dayOfWeek();
    $weekOfYear = intdiv($dayOfYear - $dayOfWeek + 3, 7) + 1;
    $year = $this->year;
    if ($weekOfYear == 0) {
      $year--;
      $lastDayOfPreviousYear = self::lastDayOfYear($year);
      $weekOfYear = $lastDayOfPreviousYear->weekOfYear();
    }
    return ['year' => $year, 'week' => $weekOfYear];
  }
}
