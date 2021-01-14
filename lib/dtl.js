// PLEASE NOTE
// this file must be in a specific format:
// 1. there should only be functions - at present, variables aren't loaded
// 2. all function-specific comments should go inside the functions (although not imperative)
// 3. function end curly brace } must be on a line by itself
//    so the parser can find the end of the function.
// IMPORTANT:
// this means that any other curly braces (that do not signify the end of a function) MUST be indented
// 4. if you want to refer to functions in the comments, make sure the comment line starts with //
//    and that the whole line is a comment (i.e. not a comment after a statement).
//    The reason for this is so that function names in comments don't get treated like prerequisites.

function dtlChristmas(year) {
  year = parseInt(year);
  if (isNaN(year)) {
    year = dtlGetYear();
  }
  return dtlDateStr(year, 12, 25);
}

function dtlEaster(year) {
  // * returns date of Easter Sunday in the given year
  // * returns false if invalid year input
  // * if year not provided, uses current year
  // code got from here: http://aa.usno.navy.mil/faq/docs/easter.html
  // Algorithm by J.-M. Oudin (1940) and is reprinted in the
  // Explanatory Supplement to the Astronomical Almanac,
  // ed. P. K. Seidelmann (1992). See Chapter 12, "Calendars", by L. E. Doggett.
  year = parseInt(year);
  if (isNaN(year)) {
    year = dtlGetYear();
  }
  var c = dtlIntDiv(year, 100);
  var n = year - 19 * dtlIntDiv(year, 19);
  var k = dtlIntDiv(c - 17, 25);
  var i = c - dtlIntDiv(c, 4) - dtlIntDiv(c - k, 3) + 19 * n + 15;
  i = i - 30 * dtlIntDiv(i, 30);
  i = i - dtlIntDiv(i, 28) * (1 - dtlIntDiv(i, 28) * dtlIntDiv(29, i + 1) * dtlIntDiv(21 - n, 11));
  var j = year + dtlIntDiv(year, 4) + i + 2 - c + dtlIntDiv(c, 4);
  j = j - 7 * dtlIntDiv(j, 7);
  var l = i - j;
  var month = 3 + dtlIntDiv(l + 40, 44);
  var day = l + 28 - 31 * dtlIntDiv(month, 4);
  return dtlDateStr(year, month, day);
}

function dtlFormatYear(year) {
  return str_pad(year, 4, '0', STR_PAD_LEFT);
}

function dtlInArray(needle, haystack, strict) {
  // * behaves the same as the PHP in_array() function:
  var found = false;
  for (key in haystack) {
    if (haystack[key] == needle &&
      (!strict || (strict && typeof (haystack[key]) == typeof (needle)))) {
      found = true;
      break;
    }
  }
  return found;
}

/**
 * Integer division.
 * Returns false for invalid input
 *
 * @param  int  n  numerator
 * @param  int  d  denominator
 * @return  int
 */
function dtlIntDiv(n, d) {
  if (!dtlIsInt(n) || !dtlIsInt(d)) {
    return false;
  }
  return parseInt(n / d);
}

function dtlIsInt(n) {
  // * returns true if n is an integer or a string that looks like an integer:
  if (typeof (n) == 'number' && n == Math.round(n)) {
    return true;
  } else return typeof (n) == 'string' && n == dtlToInt(n);
}

function dtlToInt(n) {
  return n / 1;
}

function dtlIsInRange(n, min, max) {
  // * returns true if n is an integer in the range min..max
  return dtlIsInt(n) && n >= min && n <= max;
}

function dtlDigits(dts) {
  // * will remove any non-digit chars from a string
  dts += '';
  var result = '';
  var ch;
  for (i = 0; i < dts.length; i++) {
    ch = dts.charAt(i);
    if (ch >= '0' && ch <= '9') {
      result += ch;
    }
  }
  return result;
}

function dtlZeroPad(n, nDigits) {
  // * pads n with zeroes on the left-hand-side
  // * return a string at least nDigits long (default = 2)
  if (!dtlIsInt(n) && n >= 0) {
    return false;
  }
  if (nDigits == undefined) {
    nDigits = 2;
  }
  // convert n to a string:
  var result = n + '';
  // add pad characters until desired width is reached:
  while (result.length < nDigits) {
    result = '0' + result;
  }
  return result;
}

function dtlAbbrev(str, nChars) {
  // * returns the first nChars letters of str (default = 3)
  // * supports HTML special character codes (required for languages like Russian)
  var result = '';
  var p = 0; // position in str
  var strlen = str.length;
  var length = 0; // number of chars - a HTML char code such as &lt; is counted as one char
  if (!nChars) {
    nChars = 3;
  } // default
  var ch;
  while (length < nChars && p < strlen) {
    // get the next char from str and append to result:
    ch = str.charAt(p++);
    result += ch;
    if (ch == '&') {
      // keep copying chars until ; found
      while (ch != ';') {
        ch = str.charAt(p++);
        result += ch;
      }
    }
    length++;
  }
  return result;
}

function dtlOrdinalSuffix(n) {
  // * returns number with ordinal suffix appended, e.g., 1st, 2nd, 3rd, 4th
  // * returns false if n is not a positive integer
  if (!dtlIsInt(n) || n <= 0) {
    return false;
  }
  if (n % 10 == 1 && n % 100 != 11) {
    return n + 'st';
  } else if (n % 10 == 2 && n % 100 != 12) {
    return n + 'nd';
  } else if (n % 10 == 3 && n % 100 != 13) {
    return n + 'rd';
  } else {
    return n + 'th';
  }
}

function dtlDateStr(year, month, day) {
  // * creates a DateStr from the parameters (0000-00-00 .. 9999-99-99)
  // * year can be in the range 0..9999
  // * month can be in the range 0..99
  // * day can be in the range 0..99
  // * returns false if any parameters are out of range
  // * parameters do not have to represent a valid date, this function is just for building strings
  // * (therefore support is provided for 0000-00-00 (MySQL))
  // * to check if a date is valid use dtlIsValidDate()
  if (typeof (year) == 'undefined') {
    year = 0;
  }
  if (typeof (month) == 'undefined') {
    month = 0;
  }
  if (typeof (day) == 'undefined') {
    day = 0;
  }
  if (!dtlIsInRange(year, 0, 9999) || !dtlIsInRange(month, 0, 99) || !dtlIsInRange(day, 0, 99)) {
    return false;
  }
  return dtlZeroPad(year, 4) + '-' + dtlZeroPad(month) + '-' + dtlZeroPad(day);
}

function dtlTimeStr(hours, minutes, seconds) {
  // * creates a TimeStr from the parameters (00:00:00 .. 99:99:99)
  // * hours can be in the range 0..99
  // * minutes can be in the range 0..99
  // * seconds can be in the range 0..99
  // * returns false if any parameters are out of range
  // * parameters do not have to represent a valid time, this function is just for building strings
  // * to check if a time is valid use dtlIsValidTime()
  if (typeof (hours) == 'undefined') {
    hours = 0;
  }
  if (typeof (minutes) == 'undefined') {
    minutes = 0;
  }
  if (typeof (seconds) == 'undefined') {
    seconds = 0;
  }
  if (!dtlIsInRange(hours, 0, 99) || !dtlIsInRange(minutes, 0, 99) ||
    !dtlIsInRange(seconds, 0, 99)) {
    return false;
  }
  return dtlZeroPad(hours) + ':' + dtlZeroPad(minutes) + ':' + dtlZeroPad(seconds);
}

function dtlDateTimeStr(year, month, day, hours, minutes, seconds) {
  // * creates a DateStr from the parameters (0000-00-00 00:00:00 .. 9999-99-99 99:99:99)
  // * returns false if any parameters are out of range
  // * parameters do not have to represent a valid datetime, this function is just for building strings
  // * to check if a datetime is valid use dtlIsValidDateTime()
  var ds = dtlDateStr(year, month, day);
  if (!ds) {
    return false;
  }
  var ts = dtlTimeStr(hours, minutes, seconds);
  if (!ts) {
    return false;
  }
  return ds + ' ' + ts;
}

function dtlIsDateStr(ds) {
  // * returns true if the DateStr ds is a string in the format YYYY-MM-DD
  // * does not check for validity of the date (use dtlIsValidDate())
  return typeof (ds) == 'string' && ds.length == 10 && (ds.match(/\d\d\d\d-\d\d-\d\d/)).length == 1;
}

function dtlIsTimeStr(ts) {
  // * returns true if the TimeStr ts is a string in the format HH:mm:ss
  // * does not check for validity of the time (use dtlIsValidTime())
  return typeof (ts) == 'string' && ts.length == 8 && (ts.match(/\d\d:\d\d:\d\d/)).length == 1;
}

function dtlIsDateTimeStr(dts) {
  // * returns true if the DateTimeStr dts is a string in the format YYYY-MM-DD HH:mm:ss
  // * does not check for validity of the datetime (use dtlIsValidDateTime())
  return typeof (dts) == 'string' && dts.length == 19 &&
    (dts.match(/\d\d\d\d-\d\d-\d\d \d\d:\d\d:\d\d/)).length == 1;
}

function dtlIsZero(dts) {
  if (dtlIsDateStr(dts)) {
    return dts == '0000-00-00';
  } else if (dtlIsTimeStr(dts)) {
    return dts == '00:00:00';
  } else if (dtlIsDateTimeStr(dts)) {
    return dts == '0000-00-00 00:00:00';
  } else {
    return false;
  }
}

function dtlDaysInMonth(year, month) {
  // * returns the number of days in the specified month
  // * returns false for invalid input:
  if (!dtlIsInRange(month, 1, 12)) {
    return false;
  }
  if (dtlInArray(month, [1, 3, 5, 7, 8, 10, 12])) {
    return 31;
  } else if (dtlInArray(month, [4, 6, 9, 11])) {
    return 30;
  } else // month == 2
  {
    return dtlIsLeapYear(year) ? 29 : 28;
  }
}

function dtlIsLeapYear(year) {
  // * returns true if year is a leap year, otherwise false
  // * also returns false for invalid year
  if (!dtlIsInRange(year, 0, 9999)) {
    return false;
  }
  if (year % 400 == 0) {
    return true;
  } else if (year % 100 == 0) {
    return false;
  } else return year % 4 == 0;
}

function dtlDateStrToArray(ds) {
  // * creates an array with year, month, and day, extracted from the DateStr ds:
  if (!dtlIsDateStr(ds)) {
    return false;
  }
  var dateParts = ds.split('-');
  var da = [];
  da['date'] = ds;
  da['year'] = dtlToInt(dateParts[0]);
  da['month'] = dtlToInt(dateParts[1]);
  da['day'] = dtlToInt(dateParts[2]);
  return da;
}

function dtlTimeStrToArray(ts) {
  // * creates an array with hours, minutes, and seconds, extracted from the TimeStr ts:
  if (!dtlIsTimeStr(ts)) {
    return false;
  }
  var timeParts = ts.split(':');
  var ta = [];
  ta['time'] = ts;
  ta['hours'] = dtlToInt(timeParts[0]);
  ta['minutes'] = dtlToInt(timeParts[1]);
  ta['seconds'] = dtlToInt(timeParts[2]);
  return ta;
}

function dtlDateTimeStrToArray(dts) {
  // * returns an array containing the different datetime parts as integers
  // * works with any DateTimeStr in the format YYYY-MM-DD HH:mm:ss, even if invalid
  // * returns false if dts not in the proper format
  if (!dtlIsDateTimeStr(dts)) {
    return false;
  }
  var dtParts = dts.split(' ');
  var dta = [];
  dta['date'] = dtParts[0];
  dta['time'] = dtParts[1];
  var dateParts = dta['date'].split('-');
  dta['year'] = dtlToInt(dateParts[0]);
  dta['month'] = dtlToInt(dateParts[1]);
  dta['day'] = dtlToInt(dateParts[2]);
  var timeParts = dta['time'].split(':');
  dta['hours'] = dtlToInt(timeParts[0]);
  dta['minutes'] = dtlToInt(timeParts[1]);
  dta['seconds'] = dtlToInt(timeParts[2]);
  return dta;
}

function dtlIsValidDate(ds) {
  // * returns true if parameters represents a valid Gregorian date, otherwise false
  // * earliest valid date is 0000-01-01 and latest is 9999-12-31
  // get date parts:
  if (!dtlIsDateStr(ds)) {
    return false;
  }
  var da = dtlDateStrToArray(ds);
  // check limits:
  if (!dtlIsInRange(da['year'], 0, 9999) || !dtlIsInRange(da['month'], 1, 12) ||
    !dtlIsInRange(da['day'], 1, 31)) {
    return false;
  }
  return da['day'] >= 1 && da['day'] <= dtlDaysInMonth(da['year'], da['month']);
}

function dtlIsValidTime(ts) {
  // * returns true if parameters represent a valid time, otherwise false
  // * leap seconds not supported
  // get time parts:
  if (!dtlIsTimeStr(ts)) {
    return false;
  }
  var ta = dtlTimeStrToArray(ts);
  return dtlIsInRange(ta['hours'], 0, 23) && dtlIsInRange(ta['minutes'], 0, 59) &&
    dtlIsInRange(ta['seconds'], 0, 59);
}

function dtlIsValidDateTime(dts) {
  // * returns true if parameters represent a valid datetime, otherwise false
  // * leap seconds not supported
  // get datetime parts:
  if (!dtlIsDateTimeStr(dts)) {
    return false;
  }
  var dta = dts.split(' ');
  return dtlIsValidDate(dta[0]) && dtlIsValidTime(dta[1]);
}

function dtlLocalDate() {
  // * returns local date:
  var dNow = new Date();
  return dtlDateStr(dNow.getFullYear(), dNow.getMonth() + 1, dNow.getDate());
}

function dtlToday() {
  return dtlLocalDate();
}

function dtlLocalDateTime() {
  // * returns local date time:
  var dNow = new Date();
  return dtlDateTimeStr(dNow.getFullYear(), dNow.getMonth() + 1, dNow.getDate(), dNow.getHours(),
    dNow.getMinutes(), dNow.getSeconds());
}

function dtlNow() {
  return dtlLocalDateTime();
}

///////////////////////////////////////////////////////////////////
// currently only support for English in the Javascript DTL

var dtlLanguages = {};
dtlLanguages.EN = {};
dtlLanguages.EN.monthNames = [
  undefined,
  'January',
  'February',
  'March',
  'April',
  'May',
  'June',
  'July',
  'August',
  'September',
  'October',
  'November',
  'December'
];
dtlLanguages.EN.dayNames =
  [undefined, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

function dtlMonthName(month) {
  // * returns the name of the month in English
  // * month specified by 1..12
  // * returns false if invalid month number
  if (!dtlIsInRange(month, 1, 12)) {
    return false;
  }
  return dtlLanguages.EN.monthNames[month];
}

function dtlAbbrevMonthName(month) {
  return dtlAbbrev(dtlMonthName(month));
}

function dtlDayName(dow) {
  // * returns the name of the day in the language designated by languageCode
  // * day of week specified by dow, 1..7
  // * if languageCode not specified then default language code is used
  // * returns false if invalid language code or day of week number
  if (!dtlIsInt(dow)) {
    return false;
  }
  return dtlLanguages.EN.dayNames[dow];
}

function dtlAbbrevDayName(day) {
  return dtlAbbrev(dtlDayName(day));
}

///////////////////////////////////////////////////////////////////
// conversion between DateStr and Javascript Date object (JSD)

function dtlJSDToDateStr(jsd) {
  // * converts a javascript Date object into a DateStr
  // * looks at  values
  // * will fail if jsd is not a javascript Date object
  return dtlZeroPad(jsd.getFullYear(), 4) + '-' + dtlZeroPad(jsd.getMonth() + 1) + '-' +
    dtlZeroPad(jsd.getDate());
}

function dtlDateStrToJSD(ds) {
  // * converts a DateStr into a javascript Date object
  if (!dtlIsValidDate(ds)) {
    return false;
  }
  var da = dtlDateStrToArray(ds);
  return new Date(da['year'], da['month'] - 1, da['day']);
}

function dtlDateTimeStrToJSD(ds) {
  // * converts a DateTimeStr into a javascript Date object
  if (!dtlIsValidDateTime(ds)) {
    return false;
  }
  var da = dtlDateTimeStrToArray(ds);
  return new Date(da['year'], da['month'] - 1, da['day'], da['hours'], da['minutes'],
    da['seconds']);
}

///////////////////////////////////////////////////////////////////////////
// conversion between DateStr and Modified Julian Date (MJD)

function dtlDateToMJD(ds) {
  // * returns a Modified Julian Date given a valid DateStr
  // * returns false for invalid input
  if (!dtlIsValidDate(ds)) {
    return false;
  }
  var da = dtlDateStrToArray(ds);
  var year = da['year'];
  // in the Gregorian calendar there are 146097 days per 400 years
  // which 400 year cycle is year in?
  var cycle400 = Math.floor((year - 1) / 400);
  // a 400 year cycle goes from 1..400, 401..800, 801..1200, 1201..1600, 1601..2000, etc.
  // MJD at end of 2000 = 51909 (cycle400 = 4)
  // MJD at end of previous 400-year cycle:
  var mjd = 51909 + ((cycle400 - 5) * 146097);
  // MJD at end of previous 100-year cycle:
  year -= cycle400 * 400;
  var century = Math.floor((year - 1) / 100);
  mjd += century * 36524;
  // MJD at end of previous 4-year cycle:
  year -= century * 100;
  var cycle4 = Math.floor((year - 1) / 4);
  mjd += cycle4 * 1461;
  // MJD at end of previous year:
  year -= cycle4 * 4;
  mjd += (year - 1) * 365;
  // MJD at given date:
  mjd += dtlGetDayOfYear(ds);
  return mjd;
}

function dtlMJDToDate(mjd) {
  // * returns a DateStr given an MJD
  // * returns false for invalid input
  // convert to a float:
  var mjd = dtlToInt(mjd);
  // find the date:
  mjd -= 51909;
  var year = 0;
  var cycle400 = Math.floor((mjd - 1) / 146097) + 5;
  year += cycle400 * 400; // takes us to the end of the previous 400-year cycle
  mjd -= (cycle400 - 5) * 146097;
  var century = Math.floor((mjd - 1) / 36524);
  if (century == 4) {
    century--;
  }
  year += century * 100; // takes us to the end of the previous century
  mjd -= century * 36524;
  var cycle4 = Math.floor((mjd - 1) / 1461);
  year += cycle4 * 4; // takes us to the end of the previous 4-year cycle
  mjd -= cycle4 * 1461;
  var yr = Math.floor((mjd - 1) / 365);
  if (yr == 4) {
    yr--;
  }
  year += yr + 1; // takes us to the desired year
  mjd -= yr * 365;  // mjd is now the mjd of year
  ds = dtlDateFromDayOfYear(year, mjd);
  return ds;
}

function dtlDateTimeToMJD(dts) {
  // * returns a Modified Julian Date given a valid DateStr
  // * returns false for invalid input
  if (!dtlIsValidDateTime(dts)) {
    return false;
  }
  var dta = dtlDateTimeStrToArray(dts);
  // get the whole MJD:
  var mjd = dtlDateToMJD(dta['date']);
  // calculate fractional part:
  var frac = (dta['hours'] / 24) + (dta['minutes'] / 1440) + (dta['seconds'] / 86400);
  mjd += frac;
  return mjd;
}

function dtlMJDToDateTime(mjd) {
  // * returns a DateStr given an MJD
  // * returns false for invalid input
  // convert to a float:
  var mjd = parseFloat(mjd);
  // break into whole number of days and fraction of a day:
  var day = Math.floor(mjd);
  var frac = mjd - day;
  // find the date:
  var ds = dtlMJDToDate(day);
  // find the time:
  frac *= 24;
  var hours = Math.floor(frac);
  frac = (frac - hours) * 60;
  var minutes = Math.floor(frac);
  frac = (frac - minutes) * 60;
  var seconds = Math.round(frac);
  ts = dtlTimeStr(hours, minutes, seconds);
  // assemble the datestring and return:
  return ds + ' ' + ts;
}

///////////////////////////////////////////////////////////////////////////
// configuration constants and functions for weeks

/**
 * ISO8601
 * The DTL conforms to ISO8601 spec for handling weeks and days of the week.
 * - Days numbered from 1-7, starting with Monday.
 * - The first week of the year contains 4 or more days.
 */

// * these constants match the array indices in $dtlLanguages[]['dayNames']
// * therefore you can get a day name with (e.g.) $dtlLanguages['EN']['dayNames'][DTL_THURSDAY]
// * Numbering days from 1-7 starting with Monday comes from ISO8601.
var DTL_MONDAY = 1;
var DTL_TUESDAY = 2;
var DTL_WEDNESDAY = 3;
var DTL_THURSDAY = 4;
var DTL_FRIDAY = 5;
var DTL_SATURDAY = 6;
var DTL_SUNDAY = 7;

///////////////////////////////////////////////////////////////////////////
// Get functions - part 1
// ======================
// This first set of functions do *not* require a valid DateStr, TimeStr, or DateTimeStr,
// just so long as they are in the correct format.

function dtlGetDate(dts) {
  // * given a DateStr or DateTimeStr, returns the date part
  // * date not checked for validity
  // * returns false for invalid input
  if (dtlIsDateStr(dts)) {
    return dts;
  } else if (dtlIsDateTimeStr(dts)) {
    return dts.substr(0, 10);
  } else {
    return false;
  }
}

function dtlGetTime(dts) {
  // * given a TimeStr or DateTimeStr, returns the time part
  // * time not checked for validity
  // * returns false for invalid input
  if (dtlIsTimeStr(dts)) {
    return dts;
  } else if (dtlIsDateTimeStr(dts)) {
    return dts.substr(11, 8);
  } else {
    return false;
  }
}

function dtlGetYear(dts) {
  // * returns the year as an integer given a DateStr or a DateTimeStr
  // * if no params, returns current year
  // * returns false if dts not a valid date or datetime
  if (typeof (dts) == 'undefined' || dts == '') {
    dts = dtlToday();
  } else if (!dtlIsDateStr(dts) && !dtlIsDateTimeStr(dts)) {
    return false;
  }
  return dtlToInt(dts.substr(0, 4));
}

function dtlGetMonth(dts) {
  // * returns the month as an integer given a DateStr or a DateTimeStr
  // * if no params, returns current month
  // * returns false if dts not a valid date or datetime
  if (typeof (dts) == 'undefined' || dts == '') {
    dts = dtlToday();
  } else if (!dtlIsDateStr(dts) && !dtlIsDateTimeStr(dts)) {
    return false;
  }
  return dtlToInt(dts.substr(5, 2));
}

function dtlGetDay(dts) {
  // * returns the day of the month as an integer (1..31) given a DateStr or a DateTimeStr
  // * if no params, returns current day of month
  // * returns false if dts not a DateStr or DateTimeStr (no validity checking)
  if (typeof (dts) == 'undefined' || dts == '') {
    dts = dtlToday();
  } else if (!dtlIsDateStr(dts) && !dtlIsDateTimeStr(dts)) {
    return false;
  }
  return dtlToInt(dts.substr(8, 2));
}

function dtlGetWeekOfYear(dts) {
  // * given a DateStr or a DateTimeStr, calculate which week of the year it is (1..53)
  // * uses the method specified in dtlFirstWeekOfYear
  // * if no params, returns current week of year
  // * returns false if dts not a valid date or datetime
  if (dts == undefined) {
    dts = dtlToday();
  } else if (!dtlIsValidDate(dts) && !dtlIsValidDateTime(dts)) {
    return false;
  }
  var ds = dtlGetDate(dts);
  var dayOfYear = dtlGetDayOfYear(ds);
  var dayOfWeek = dtlGetDayOfWeek(ds);
  // This formula gives the first whole week as week 1:
  var week = intdiv(dayOfYear - dayOfWeek + 7, 7);
  // Add 1 if the year started on Tuesday, Wednesday or Thursday:
  var year = dtlGetYear(ds);
  var firstDayOfYear = dtlFirstDayOfYear(year);
  var firstDayOfYear_dayOfWeek = dtlGetDayOfWeek(firstDayOfYear);
  if (firstDayOfYear_dayOfWeek >= DTL_TUESDAY && firstDayOfYear_dayOfWeek <= DTL_THURSDAY) {
    week++;
  }
  // Check for beginning of year:
  if (week == 0) {
    year--;
    var lastDayOfPreviousYear = dtlLastDayOfYear(year);
    return dtlGetWeekOfYear(lastDayOfPreviousYear);
  }
  // Check for end of year:
  var daysInYear = dtlDaysInYear(year);
  var lastDayOfYear = dtlLastDayOfYear(year);
  var lastDayOfYear_dayOfWeek = dtlGetDayOfWeek(lastDayOfYear);
  if (lastDayOfYear_dayOfWeek <= 3 && daysInYear - dayOfYear < lastDayOfYear_dayOfWeek) {
    // It's the first week of the following year:
    year++;
    week = 1;
  }
  return {year: year, week: week};
}

// @todo
// dtlWeeksInYear

function dtlGetDayOfYear(dts) {
  // * returns the day of the year as an integer (1..366) given a DateStr or a DateTimeStr
  // * if no params, returns current day of year
  // * returns false if $dts not a valid date or datetime
  if (!dtlIsValidDate(dts) && !dtlIsValidDateTime(dts)) {
    return false;
  }
  da = dtlDateStrToArray(dtlGetDate(dts));
  if (da['month'] == 1) {
    return da['day'];
  } else {
    return dtlDaysInMonths(da['year'], da['month'] - 1) + da['day'];
  }
}

function dtlGetDayOfWeek(dts) {
  // * returns the day of the week as an integer (1..7 with 1=Monday) given a DateStr or a DateTimeStr
  // * if no params, returns current day of week
  // * returns false if $dts not a valid date or datetime
  if (!dts) {
    dts = dtlToday();
  } else if (!dtlIsValidDate(dts) && !dtlIsValidDateTime(dts)) {
    return null;
  }
  // convert date to MJD:
  var mjd = dtlDateToMJD(dtlGetDate(dts));
  // make sure mjd is a positive number so the modulus will work:
  if (mjd < 7) {
    mjd += (Math.ceil(Math.abs(mjd - 7) / 7) + 1) * 7;
  }
  // MJD=0 is a Wednesday, have to adjust by the difference between Monday and Wednesday:
  dow = (mjd + DTL_WEDNESDAY - DTL_MONDAY) % 7 + 1;
  return dow;
}

function dtlGetDayName(dts, languageCode) {
  // * returns the name of the day of the week in the current language,
  //   given a DateStr or a DateTimeStr
  // * if no params, returns current day name
  // * returns false if $dts not a valid date or datetime
  if (!dts) {
    dts = dtlToday();
  } else if (!dtlIsValidDate(dts) && !dtlIsValidDateTime(dts)) {
    return false;
  }
  if (!languageCode) {
    languageCode = 'EN';
  }
  return dtlDayName(dtlGetDayOfWeek(dts), languageCode);
}

function dtlAddDays(dts, nDays) {
  // * returns dts with nDays added
  // * returns false if dts is not a valid date or datetime
  //   or if result is not a valid date/datetime
  // * returns true if result is a valid date/datetime
  if (!dtlIsInt(nDays) || (!dtlIsValidDate(dts) && !dtlIsValidDateTime(dts))) {
    return false;
  }
  var isDateTime = dtlIsDateTimeStr(dts);
  var ds = isDateTime ? dtlGetDate(dts) : dts;
  var mjd = dtlDateToMJD(ds);
  mjd += nDays;
  ds = dtlMJDToDate(mjd);
  return isDateTime ? dtlSetDate(dts, ds) : ds;
}

function dtlAddWeeks(dts, nWeeks) {
  // * returns dts with nWeeks weeks added
  // * returns false if dts is not a valid date or datetime
  // check params:
  if (!dtlIsInt(nWeeks) || (!dtlIsValidDate(dts) && !dtlIsValidDateTime(dts))) {
    return false;
  }
  // is it a date or a datetime?
  var isDateTime = dtlIsDateTimeStr(dts);
  var ds = dtlGetDate(dts);
  if (isDateTime) {
    var ts = dtlGetTime(dts);
  }
  // convert to MJD:
  var mjd = dtlDateToMJD(ds);
  // add the number of days:
  mjd += nWeeks * 7;
  // convert back to Gregorian date:
  ds = dtlMJDToDate(mjd);
  // return the result:
  return isDateTime ? ds + ' ' + ts : ds;
}

function dtlSetDate(dts, ds) {
  // * if dts is a DateStr then it is simply set to ds (same effect as dts = ds)
  // * if dts is a TimeStr then it is changed to a DateTimeStr with ds as the date part
  // * if dts is a DateTimeStr then the date part is set to ds
  // * returns false if parameters not in proper formats
  // * parameters not checked for validity
  if (!dtlIsDateStr(ds)) {
    return false;
  }
  if (dtlIsDateStr(dts)) {
    dts = ds;
    return true;
  } else if (dtlIsTimeStr(dts)) {
    dts = ds + ' ' + dts;
    return true;
  } else if (dtlIsDateTimeStr(dts)) {
    dts = ds + ' ' + dtlGetTime(dts);
    return true;
  } else {
    return false;
  }
}

function dtlSetDay(dts, day) {
  // * returns the given DateStr or DateTimeStr with the day of month set to day
  // * returns false if dts is not a DateStr or DateTimeStr, or if day < 0 or day > 99
  // * does not require that input or output be a valid Gregorian date
  // check for valid input:
  if (!dtlIsInRange(day, 0, 99) || (!dtlIsDateStr(dts) && !dtlIsDateTimeStr(dts))) {
    return false;
  }
  dta = dtlDateStrToArray(dtlGetDate(dts));
  // if we don't have to change the day then return the original string:
  if (day == dta['day']) {
    return dts;
  }
  // apply new date:
  return dtlSetDate(dts, dtlDateStr(dta['year'], dta['month'], day));
}

function dtlDaysInMonths(year, month) {
  // * returns the number of days in year up to the end of month
  if (!dtlIsInt(year) || !dtlIsInRange(month, 1, 12)) {
    return false;
  }
  // get days in months:
  var daysInMonths = [0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334, 365];
  var result = daysInMonths[month];
  // add a leap day?
  if (month >= 2 && dtlIsLeapYear(year)) {
    result++;
  }
  return result;
}

function dtlDaysInYear(year) {
  // * returns the number of days in year
  // * returns false if year not valid Gregorian
  if (!dtlIsInt(year)) {
    return false;
  }
  return dtlIsLeapYear(year) ? 366 : 365;
}

function dtlDateFromDayOfYear(year, doy) {
  // * given a year and the day of year, returns a DateStr
  // * returns false for invalid year or if the resulting date is invalid
  // check params:
  if (!dtlIsInt(year) || !dtlIsInRange(doy, 1, 366)) {
    return false;
  }
  month = 12;
  monthFound = false;
  var daysInMonths;
  while (!monthFound) {
    daysInMonths = dtlDaysInMonths(year, month - 1);
    if (doy <= daysInMonths) {
      month--;
    } else {
      monthFound = true;
      break;
    }
  }
  day = doy - daysInMonths;
  return dtlDateStr(year, month, day);
}

////////////////////////////////////////////////////////////////////////////////
// Functions for use with date, time, and datetime selectors.
// ==========================================================
////////////////////////////////////////////////////////////////////////////////

function dtlUpdateDaySelector(name, year, month, day) {
  // check and update the day-of-month selector if necessary:
  var daySelector = el(name + '_day');
  if (!daySelector.options)  // it's a hidden field
  {
    return day;
  }
  var maxDay = dtlToInt(daySelector.options[daySelector.options.length - 1].value);
  var daysInMonth = month > 0 ? dtlDaysInMonth(year, month) : 31;
  if (maxDay > daysInMonth) {
    // remove days from the day selector:
    daySelector.options.length = daysInMonth + 1;
    // if the selected day was more than max number of days in this month,
    // select the last day of the month:
    if (day > daysInMonth) {
      daySelector.value = daysInMonth;
      day = daysInMonth;
    }
  } else if (maxDay < daysInMonth) {
    // add more days to the day selector:
    // check to see if format is Dth:
    var Dth = daySelector.options[1].text == '1st';
    var dayOption;
    for (var d = maxDay + 1; d <= daysInMonth; d++) {
      dayOption = document.createElement('OPTION');
      dayOption.value = d;
      if (Dth) {
        dayOption.text = dtlOrdinalSuffix(d);
      } else {
        dayOption.text = d;
      }
      daySelector.options.add(dayOption);
    }
  }
  return day;
}

function dtlUpdateTimeSelectors(name, hours, minutes, seconds) {
  // calculate the increment in seconds:
  var selMinutes = el(name + '_minutes');
  var selSeconds = el(name + '_seconds');
  var increment;
  if (selSeconds && selSeconds.options) {
    increment = dtlToInt(selSeconds.options[1].value) - dtlToInt(selSeconds.options[0].value);
  } else if (selMinutes && selMinutes.options) {
    increment =
      (dtlToInt(selMinutes.options[1].value) - dtlToInt(selMinutes.options[0].value)) * 60;
  } else {
    increment = 1;
  }

  // get the current time in seconds:
  var seconds = (hours * 3600) + (minutes * 60) + seconds;

  // round off:
  seconds = Math.round(seconds / increment) * increment;

  // NOTE this algorithm does not precisely account for situations close to midnight when the time might technically round off to 00:00:00 the next day.  The solution, not yet implemented, is to write a dtlRound function which rounds off the datetime including the date part.  However, it is unlikely that this will be required.  The temp solution is satisfactory, which is to select the maximum value within the day:
  if (seconds >= 86400) {
    seconds = 86400 - increment;
  }

  // get new values for hours, minutes, and seconds:
  minutes = Math.floor(seconds / 60);
  seconds = seconds - (minutes * 60);
  hours = Math.floor(minutes / 60);
  minutes = minutes - (hours * 60);

  // update form fields:
  // is this 12-hour time?
  sbHours = el(name + '_hours');
  if (sbHours) {
    if (sbHours.options.length == 12) {
      // 12-hour time:
      var xm;
      if (hours > 12) {
        hours -= 12;
        xm = 'pm';
      } else {
        xm = 'am';
      }
      if (sbMeridiem = el(name + '_meridiem')) {
        sbMeridiem.value = xm;
      }
    }
    sbHours.value = hours;
  }
  if (sbMinutes = el(name + '_minutes')) {
    sbMinutes.value = minutes;
  }
  if (sbSeconds = el(name + '_seconds')) {
    sbSeconds.value = seconds;
  }
}

////////////////////////////////////////////////////////////////////////////////
// date selector functions:

function dtlUpdateDateSelector(name) {
  // get the field values:
  var year = dtlToInt(getValue(name + '_year'));
  var month = dtlToInt(getValue(name + '_month'));
  var day = dtlToInt(getValue(name + '_day'));
  day = dtlUpdateDaySelector(name, year, month, day);
  // update the hidden field:
  setValue(name, dtlDateStr(year, month, day));
  // call the onchange event of the control:
  var hiddenField = el(name);
  if (hiddenField.onchange) {
    hiddenField.onchange();
  }
}

function dtlSetDateSelector(name, multi, month, day) {
  // * updates a date selector
  // * supports 2 syntaxes:
  //		dtlSetDateSelector(name, dateStr)
  //		dtlSetDateSelector(name, year, month, day)
  var year;
  if (dtlIsDateStr(multi)) {
    var da = dtlDateStrToArray(multi);
    year = da['year'];
    month = da['month'];
    day = da['day'];
  } else {
    // multi is probably year:
    year = multi;
  }
  setValue(name + '_year', year);
  setValue(name + '_month', month);
  day = dtlUpdateDaySelector(name, year, month, day);
  setValue(name + '_day', day);
  // update the hidden field:
  setValue(name, dtlDateStr(year, month, day));
  // call the onchange event of the control:
  var hiddenField = el(name);
  if (hiddenField.onchange) {
    hiddenField.onchange();
  }
}

function dtlEnableDateSelector(name, enabled) {
  // enable or disable all fields in the selector:
  enable(name, enabled);
  enable(name + '_year', enabled);
  enable(name + '_month', enabled);
  enable(name + '_day', enabled);
}

////////////////////////////////////////////////////////////////////////////////
// time selector functions:

function dtlUpdateTimeSelector(name) {
  // get the field values:
  var hours = dtlToInt(getValue(name + '_hours'));
  var minutes = dtlToInt(getValue(name + '_minutes'));
  var seconds = dtlToInt(getValue(name + '_seconds'));
  var meridiem = getValue(name + '_meridiem');
  if (meridiem == 'pm') {
    hours += 12;
  }
  // update the hidden field:
  setValue(name, dtlTimeStr(hours, minutes, seconds));
  // call the onchange event of the control:
  var hiddenField = el(name);
  if (hiddenField.onchange) {
    hiddenField.onchange();
  }
}

function dtlSetTimeSelector(name, multi, minutes, seconds) {
  // * updates a time selector
  // * supports 2 syntaxes:
  //		dtlSetTimeSelector(name, timeStr)
  //		dtlSetTimeSelector(name, hours, minutes, seconds)
  if (dtlIsTimeStr(multi)) {
    var ta = dtlTimeStrToArray(multi);
    hours = ta['hours'];
    minutes = ta['minutes'];
    seconds = ta['seconds'];
  } else {
    // multi is probably hours:
    hours = multi;
  }
  // update form fields:
  dtlUpdateTimeSelectors(name, hours, minutes, seconds);
  dtlUpdateTimeSelector(name);
}

function dtlEnableTimeSelector(name, enabled) {
  // enable or disable all fields in the selector:
  enable(name);
  enable(name + '_hours');
  enable(name + '_minutes');
  enable(name + '_seconds');
}

////////////////////////////////////////////////////////////////////////////////
// datetime selector functions:

function dtlUpdateDateTimeSelector(name) {
  // get the field values:
  var year = dtlToInt(getValue(name + '_year'));
  var month = dtlToInt(getValue(name + '_month'));
  var day = dtlToInt(getValue(name + '_day'));
  var hours = dtlToInt(getValue(name + '_hours'));
  var minutes = dtlToInt(getValue(name + '_minutes'));
  var seconds = dtlToInt(getValue(name + '_seconds'));
  var meridiem = getValue(name + '_meridiem');
  if (meridiem == 'pm') {
    hours += 12;
  }
//	alert('' + year + month + day + minutes + hours + seconds);
  // update the day selector if necessary:
  day = dtlUpdateDaySelector(name, year, month, day);
  // update the hidden field:
  setValue(name, dtlDateTimeStr(year, month, day, hours, minutes, seconds));
  // call the onchange event of the control:
  var hiddenField = el(name);
  if (hiddenField.onchange) {
    hiddenField.onchange();
  }
}

function dtlSetDateTimeSelector(name, multi, month, day, hours, minutes, seconds) {
  // * updates a datetime selector
  // * supports 2 syntaxes:
  //		dtlSetDateTimeSelector(name, datetimeStr)
  //		dtlSetDateTimeSelector(name, year, month, day, hours, minutes, seconds)
  var updateTime = true;
  if (dtlIsDateTimeStr(multi)) {
    var dta = dtlDateTimeStrToArray(multi);
    year = dta['year'];
    month = dta['month'];
    day = dta['day'];
    hours = dta['hours'];
    minutes = dta['minutes'];
    seconds = dta['seconds'];
  } else if (dtlIsDateStr(multi)) {
    var dta = dtlDateStrToArray(multi);
    year = dta['year'];
    month = dta['month'];
    day = dta['day'];
    updateTime = false;
  } else {
    // multi is probably year:
    year = multi;
  }
//	alert(name + '=' + dtlDateTimeStr(year, month, day, hours, minutes, seconds));

  // update form fields:
  setValue(name + '_year', year);
  setValue(name + '_month', month);
  setValue(name + '_day', day);
  if (updateTime) {
    dtlUpdateTimeSelectors(name, hours, minutes, seconds);
  }
  dtlUpdateDateTimeSelector(name);
}

function dtlEnableDateTimeSelector(name, enabled) {
  // enable or disable all fields in the selector:
  enable(name);
  enable(name + '_year');
  enable(name + '_month');
  enable(name + '_day');
  enable(name + '_hours');
  enable(name + '_minutes');
  enable(name + '_seconds');
}

function dtlFirstDayOfYear(dts) {
  // * finds the date of the first day of the year containing the date or datetime dts
  // * returns false if invalid input
  // * if parameter not provided then assumes current date
  if (!dts) {
    dts = dtlToday();
  } else if (!dtlIsValidDate(dts) && !dtlIsValidDateTime(dts)) {
    return false;
  }
  return dtlDateStr(dtlGetYear(dts), 1, 1);
}

function dtlLastDayOfYear(mixed) {
  // * finds the date of the last day of the year containing the date or datetime dts
  // * returns false if invalid input
  // * if parameter not provided then assumes current date
  var year;
  if (mixed == undefined) {
    year = dtlGetYear();
  } else if (dtlIsInt(mixed)) {
    year = mixed;
  } else if (dtlIsValidDate(dts) || dtlIsValidDateTime(dts)) {
    year = dtlGetYear(dts);
  } else {
    return false;
  }
  return dtlDateStr(year, 12, 31);
}
