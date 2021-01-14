///////////////////////////////////////////////////////////////////////////////
// EarthianDate.js
// =================
//
// Date/Time Library - Earthian Calendar extension - JavaScript version
// by Shaun Moss, September 2008

// Notes
// =====
// Standard format for Earthian dates: [-]YYYY/MM/DD

///////////////////////////////////////////////////////////////////////////////
// Constructor

/**
 * Construct a Earthian date.
 * Accepts a variety of input parameters:
 * - 3 integers for year, month and day
 * - an array of 3 integers holding values for year, month and day (accepts both string and numeric keys)
 * - a Unix timestamp
 * - a string that looks like a date
 */
function EarthianDate() {
  // initialise date parts:
  this.year = 0;
  this.month = 0;
  this.day = 0;
  var nArgs = arguments.length;
  var paramsOk = false;
  var oDate;
  if (nArgs == 3) {
    this.year = parseInt(arguments[0], 10);
    this.month = parseInt(arguments[1], 10);
    this.day = parseInt(arguments[2], 10);
    paramsOk = true;
  } else if (nArgs == 1) {
    if (typeof arguments[0] == 'object' && arguments[0] !== null) {
      // array of values:
      oDate = arguments[0];
      // get the year:
      paramsOk = true;
      if (oDate.year !== undefined) {
        this.year = strtoint(oDate.year);
      } else if (oDate[0] !== undefined) {
        this.year = strtoint(oDate[0]);
      } else {
        paramsOk = false;
      }
      // get the month:
      if (paramsOk) {
        if (oDate.month !== undefined) {
          this.month = strtoint(oDate.month);
        } else if (oDate[1] !== undefined) {
          this.month = strtoint(oDate[1]);
        } else {
          paramsOk = false;
        }
      }
      // get the day:
      if (paramsOk) {
        if (oDate.day !== undefined) {
          this.day = strtoint(oDate.day);
        } else if (oDate[2] !== undefined) {
          this.day = strtoint(oDate[2]);
        } else {
          paramsOk = false;
        }
      }
    }
    // @todo test behaviour of preg_match here
    else if (typeof arguments[0] == 'string') {
      // this pattern matches -YYYY/MM/DD:
      var rx = '/^\-?\d{4}\\' + EarthianDate.sep + '\d{2}\\' + EarthianDate.sep + '\d{2}$/ig';
      if (preg_match(rx, arguments[0])) {
        oDate = explode(EarthianDate.sep, arguments[0]);
        this.year = strtoint(oDate[0]);
        this.month = strtoint(oDate[1]);
        this.day = strtoint(oDate[2]);
        paramsOk = true;
      }
    }
  }
  if (!paramsOk) {
    throw new Error('Invalid parameter(s) passed to EarthianDate constructor.');
  }
}

///////////////////////////////////////////////////////////////////////////////
// Class Constants

/**
 * Names of the days of the week in the Earthian Calendar.
 *
 * @var string[]
 */
EarthianDate.dayNames =
  [undefined, 'Sunday', 'Lunaday', 'Marsday', 'Mercuryday', 'Jupiterday', 'Venusday', 'Saturnday'];

/**
 * Names of the months of the year in the Earthian Calendar.
 *
 * @var string[]
 */
EarthianDate.monthNames = [
  undefined,
  'Aries',
  'Taurus',
  'Gemini',
  'Cancer',
  'Leo',
  'Virgo',
  'Libra',
  'Scorpius',
  'Sagittarius',
  'Capricornus',
  'Aquarius',
  'Pisces'
];

/**
 * The Modified Julian Day number of day 0 of the Earthian Calendar,
 * i.e. -1,12,30, the day before the first day of the calendar.
 */
EarthianDate.mjdDay0 = 54179; // to align with Gregorian years, use -678863

/**
 * Number of days in a generation (33-year cycle).
 */
EarthianDate.daysPerGeneration = 12053;

/**
 * Date separator.
 */
EarthianDate.sep = '/';

///////////////////////////////////////////////////////////////////////////////
// Class Methods

/**
 * Adjusts the options in a day selector based on which month and year are selected.
 *
 * @param  string  id    The id of the day selector.
 * @param  int    year  The year.
 * @param  int    month  The month.
 */
EarthianDate.adjustDaySelector = function (id, year, month) {
  var daySelector = el(id);
  var nDays = EarthianDate.daysInMonth(year, month);
  var maxDay = daySelector.options[daySelector.options.length - 1].value;
  if (nDays < maxDay) {
    // if day 31 is selected, move selection to day 30:
    if (daySelector.options[daySelector.selectedIndex].value == 31) {
      daySelector.selectedIndex--;
    }
    // remove day 31 from selector:
    daySelector.options.length = daySelector.options.length - 1;
  } else if (nDays > maxDay) {
    // add day 31 to selector:
    var option = document.createElement('option');
    option.value = 31;
    option.text = '31';
    daySelector.options[daySelector.options.length] = option;
  }
};

/**
 * Generate a date selector.
 *
 * @param  string      id
 * @param  EarthianDate  selectedValue
 * @param  array      attribs
 * @param  int      minYear
 * @param  int      maxYear
 * @return  string
 */
EarthianDate.dateSelector = function (id, selectedValue, attribs, minYear, maxYear) {
  var daySelector = EarthianDate.daySelector(id + '_day', selectedValue.day, attribs);
  var monthSelector = EarthianDate.monthSelector(id + '_month', selectedValue.month, attribs);
  var yearSelector = EarthianDate.yearSelector(id + '_year', selectedValue.year, attribs, minYear,
    maxYear);
  return daySelector + monthSelector + yearSelector;
};

/**
 * Generate a day selector.
 * @todo This should return a Selector control.
 *
 * @param string id
 * @param int selectedValue
 * @param array attribs
 */
EarthianDate.daySelector = function (id, selectedValue, attribs) {
  var result = '<select id=\'' + id + '\' name=\'' + id + '\'' + attributeString(attribs) + '>\n';
  result += '<option value=\'0\'></option>\n';
  for (var d = 1; d <= 31; d++) {
    result += '<option value=\'d\'';
    if (d == selectedValue) {
      result += ' selected';
    }
    result += '>' + d + '</option>\n';
  }
  result += '</select>';
  return result;
};

/**
 * Returns the number of days in a given month +
 * The year is also required for the case of Pisces (month 12), which can be 30 or 31 days
 * long depending on whether or not it's in a leap year +
 *
 * @param int year
 * @param int month
 * @return int
 */
EarthianDate.daysInMonth = function (year, month) {
  return month == 12 ? (EarthianDate.isLeapYear(year) ? 31 : 30) : (month % 2 == 1 ? 30 : 31);
};

/**
 * Returns the number of days in a given year.
 *
 * @param int year
 * @return int
 */
EarthianDate.daysInYear = function (year) {
  return EarthianDate.isLeapYear(year) ? 366 : 365;
};

/**
 * Returns the Earthian date of the first day in a given year +
 * (trivial, only implemented to balance the lastDayOfYear function, below)
 *
 * @param int year
 * @return EarthianDate
 */
EarthianDate.firstDayOfYear = function (year) {
  return new EarthianDate(year, 1, 1);
};

/**
 * Formats a year as [-]YYYY
 *
 * @param  int        $year
 * @return  string
 */
EarthianDate.formatYear = function (year) {
  return sign(year) + str_pad(Math.abs(year), 4, '0', STR_PAD_LEFT);
};

/**
 * Converts a Gregorian date string to a Earthian one.
 *
 * @param string dGreg
 * @return EarthianDate
 */
EarthianDate.fromGregorian = function (dGreg) {
  return EarthianDate.fromMjd(dtlDateToMJD(dGreg));
};

/**
 * Converts a Modified Julian Day number to a EarthianDate.
 *
 * @param int mjd
 * @return EarthianDate
 */
EarthianDate.fromMjd = function (mjd) {
  // find difference between mjd and mjdDay0
  var daysRemaining = mjd - EarthianDate.mjdDay0 - 1;
  // get number of whole generations:
  var nGenerations = intdiv(daysRemaining, EarthianDate.daysPerGeneration);
  daysRemaining -= nGenerations * EarthianDate.daysPerGeneration;
  // subtract days in remaining whole years:
  // groups of 4 years:
  var year = nGenerations * 33;
  var nFourYears = intdiv(daysRemaining, 1461);
  daysRemaining -= nFourYears * 1461;
  year += nFourYears * 4;
  // any remaining years (max 3) do one at a time:
  var daysInYear = EarthianDate.daysInYear(year);
  while (daysRemaining >= daysInYear) {
    daysRemaining -= daysInYear;
    year++;
    daysInYear = EarthianDate.daysInYear(year);
  }
  // subtract days in remaining months:
  var nTwoMonths = intdiv(daysRemaining, 61);
  var month = (nTwoMonths * 2) + 1;
  daysRemaining -= (nTwoMonths * 61);
  if (daysRemaining >= 30) {
    month++;
    daysRemaining -= 30;
  }
  // subtract remaining days:
  return new EarthianDate(year, month, daysRemaining + 1);
};

/**
 * Returns true if the given year is a leap year.
 *
 * @param int year
 * @return bool
 */
EarthianDate.isLeapYear = function (year) {
  if (year < 0) {
    year = -year - 1;
  }
  return year % 33 % 4 == 2;
};

/**
 * Returns the Earthian date of the last day in a given year +
 *
 * @param int year
 * @return EarthianDate
 */
EarthianDate.lastDayOfYear = function (year) {
  return new EarthianDate(year, 12, EarthianDate.isLeapYear(year) ? 31 : 30);
};

/**
 * Generate a month selector.
 * @todo This should return a Selector control.
 *
 * @param string id
 * @param int selectedValue
 * @param array attribs
 */
EarthianDate.monthSelector = function (id, selectedValue, attribs) {
  var result = '<select id=\'' + id + '\' name=\'' + id + '\'' + attributeString(attribs) + '>\n';
  result += '<option value=\'0\'></option>\n';
  for (var mm = 1; mm < 12; mm++) {
    var monthName = EarthianDate.monthNames[mm];
    result += '<option value=\'' + mm + '\'';
    if (mm == selectedValue) {
      result += ' selected';
    }
    result += '>' + monthName + '</option>\n';
  }
  result += '</select>';
  return result;
};

/**
 * Sets a Earthian date selector to a new value.
 *
 * @param string      id      The id of the selector.
 * @param EarthianDate  earthDate  The new selected value.
 */
EarthianDate.setDateSelector = function (id, earthDate) {
  setValue(id + '_year', earthDate.year);
  setValue(id + '_month', earthDate.month);
  EarthianDate.adjustDaySelector(id + '_day', earthDate.year, earthDate.month);
  setValue(id + '_day', earthDate.day);
};

/**
 * Generate a year selector.
 * @todo This should return a Selector control.
 *
 * @param string  id
 * @param int    selectedValue
 * @param array  attribs
 * @param int    minYear
 * @param int    maxYear
 */
EarthianDate.yearSelector = function (id, selectedValue, attribs, minYear, maxYear) {
  var result = '<select id=\'' + id + '\' name=\'' + id + '\'' + attributeString(attribs) + '>\n';
  for (var y = minYear; y <= maxYear; y++) {
    result += '<option value=\'' + y + '\'';
    if (y == selectedValue) {
      result += ' selected';
    }
//		var displayYear = (y < 0 ? '-' : '') + str_pad(Math.abs(y), 4, '0', STR_PAD_LEFT);
    result += '>' + y + '</option>\n';
  }
  result += '</select>';
  return result;
};

///////////////////////////////////////////////////////////////////////////////
// Object Methods

/**
 * Add a certain number of days to a EarthianDate.
 * To subtract days, use this function with a -ve value for nDays.
 *
 * @param  int        nDays
 * @return  EarthianDate
 */
EarthianDate.prototype.addDays = function (nDays) {
  var mjd = this.toMjd();
  mjd += nDays;
  return EarthianDate.fromMjd(mjd);
};

/**
 * Return the day of the week for this date (1..7).
 *
 * @return int
 */
EarthianDate.prototype.dayOfWeek = function () {
  var mjd = this.toMjd();
  return (mjd + 3) % 7 + 1;
};

/**
 * Return the name of the day of the week for this date.
 *
 * @return string
 */
EarthianDate.prototype.dayOfWeekName = function () {
  var i = this.dayOfWeek();
  return EarthianDate.dayNames[i];
};

/**
 * Returns the day of the year, from 1..366.
 *
 * @return int
 */
EarthianDate.prototype.dayOfYear = function () {
  var nTwoMonths = intdiv(this.month - 1, 2);
  var days = nTwoMonths * 61;
  if (this.month % 2 == 0) {
    days += 30;
  }
  days += this.day;
  return days;
};

/**
 * Returns true if this is before the given date.
 *
 * @param  EarthianDate  earthDate
 * @return  bool
 */
EarthianDate.prototype.isEarlierThan = function (earthDate) {
  return this.toMjd() < earthDate.toMjd();
};

/**
 * Returns true if this is before or the same as the given date.
 *
 * @param  EarthianDate  earthDate
 * @return  bool
 */
EarthianDate.prototype.isEarlierThanOrEqualTo = function (earthDate) {
  return this.toMjd() <= earthDate.toMjd();
};

/**
 * Returns true if this is after the given date.
 *
 * @param  EarthianDate  earthDate
 * @return  bool
 */
EarthianDate.prototype.isLaterThan = function (earthDate) {
  return this.toMjd() > earthDate.toMjd();
};

/**
 * Returns true if this is after or the same as the given date.
 *
 * @param  EarthianDate  earthDate
 * @return  bool
 */
EarthianDate.prototype.isLaterThanOrEqualTo = function (earthDate) {
  return this.toMjd() >= earthDate.toMjd();
};

/**
 * Returns true if the date is valid.
 *
 * @return bool
 */
EarthianDate.prototype.isValid = function () {
  var ok = looksLikeInt(this.year) && looksLikeInt(this.month) && looksLikeInt(this.day) &&
    this.month >= 1 && this.month <= 12 &&
    this.day >= 1 && this.day <= EarthianDate.daysInMonth(this.year, this.month);
  return ok;
};

/**
 * Converts a EarthianDate to a Gregorian one.
 *
 * @return string
 */
EarthianDate.prototype.toGregorian = function () {
  return dtlMJDToDate(this.toMjd());
};

/**
 * Converts a EarthianDate to a Modified Julian Day number.
 *
 * @return int
 */
EarthianDate.prototype.toMjd = function () {
  // start at "Day 0", i.e. last day of the year -0001, the day before beginning of calendar:
  var mjd = EarthianDate.mjdDay0;
  // add days for the cycles of 33 years (generations):
  var nGenerations = intdiv(this.year, 33);
  mjd += nGenerations * EarthianDate.daysPerGeneration;
  // add days for "quads" (1 quad = 4 years):
  var year = this.year - (nGenerations * 33);	// year: 0..32
  var nFourYears = intdiv(year, 4);			// nFourYears: 0..8
  mjd += nFourYears * 1461;
  // add days for remaining years:
  year = (nGenerations * 33) + (nFourYears * 4);
  for (var y = year; y < this.year; y++) {
    mjd += EarthianDate.daysInYear(y);
  }
  // add days for months:
  var nTwoMonths = intdiv(this.month - 1, 2);
  mjd += nTwoMonths * 61;
  mjd += (this.month - 1) % 2 * 30;
  // add remaining days:
  mjd += this.day;
  return mjd;
};

/**
 * Outputs the EarthianDate in the format YYYY.MM.DD
 *
 * @return string
 */
EarthianDate.prototype.toString = function () {
  return fourDigits(this.year) + EarthianDate.sep + twoDigits(this.month) + EarthianDate.sep +
    twoDigits(this.day);
};

/**
 * Returns the week number, from 1..53.
 *
 * @return int
 */
EarthianDate.prototype.weekOfYear = function () {
  var dayOfYear = this.dayOfYear();
  var dayOfWeek = this.dayOfWeek();
  // This formula gives the first whole week as week 1:
  var week = intdiv(dayOfYear - dayOfWeek + 7, 7);
  // Add 1 if the year started on Lunaday, Marsday or Mercuryday:
  var year = this.year;
  var firstDayOfYear = EarthianDate.firstDayOfYear(year);
  var firstDayOfYear_dayOfWeek = firstDayOfYear.dayOfWeek();
  if (firstDayOfYear_dayOfWeek >= 2 && firstDayOfYear_dayOfWeek <= 4) {
    week++;
  }
  // Check for beginning of year:
  if (week == 0) {
    year--;
    var lastDayOfPreviousYear = EarthianDate.lastDayOfYear(year);
    return lastDayOfPreviousYear.weekOfYear();
  }
  // Check for end of year:
  var daysInYear = EarthianDate.daysInYear(year);
  var lastDayOfYear = EarthianDate.lastDayOfYear(year);
  var lastDayOfYear_dayOfWeek = lastDayOfYear.dayOfWeek();
  if (lastDayOfYear_dayOfWeek <= 3 && daysInYear - dayOfYear < lastDayOfYear_dayOfWeek) {
    // It's the first week of the following year:
    year++;
    week = 1;
  }
  return {year: year, week: week};
};

///////////////////////////////////////////////////////////////////////////////
