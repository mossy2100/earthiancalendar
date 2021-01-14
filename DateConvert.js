// initialise:
var dToday = dtlToday();
var thisYear = dtlGetYear(thisYear);
var minGregDate = '1900-01-01';
var maxGregDate = '2100-12-31';
var minEarthDate = EarthianDate.fromGregorian(minGregDate);
var maxEarthDate = EarthianDate.fromGregorian(maxGregDate);
var minMjd = minEarthDate.toMjd();
var maxMjd = maxEarthDate.toMjd();

function checkDaySelector() {
  var year = getValue('earthDate_year');
  var month = getValue('earthDate_month');
  EarthianDate.adjustDaySelector('earthDate_day', year, month);
}

function updateGregorian(gregDate) {
  if (gregDate < minGregDate || gregDate > maxGregDate) {
    showRangeMessage();
  } else {
    // set the Gregorian date:
    dtlSetDateSelector('gregDate', gregDate);
  }
}

function updateGregorianInfo(gregDate) {
  setInnerHTML('gregDayOfWeekName', dtlGetDayName(gregDate));
  setInnerHTML('gregDayOfYear', dtlGetDayOfYear(gregDate));
  setInnerHTML('gregYear', dtlFormatYear(dtlGetYear(gregDate)));
  setInnerHTML('gregDayOfWeek', dtlGetDayOfWeek(gregDate));
  var weekOfYear = dtlGetWeekOfYear(gregDate);
  setInnerHTML('gregWeekOfYear_week', weekOfYear['week']);
  setInnerHTML('gregWeekOfYear_year', dtlFormatYear(weekOfYear['year']));
}

function updateEarthian(earthDate) {
  if (earthDate.isEarlierThan(minEarthDate) || earthDate.isLaterThan(maxEarthDate)) {
    showRangeMessage();
  } else {
    // set the Earthian date:
    EarthianDate.setDateSelector('earthDate', earthDate);
  }
}

function updateEarthianInfo(earthDate) {
  //alert('updateEarthianInfo');
  setInnerHTML('earthDayOfWeekName', earthDate.dayOfWeekName());
  setInnerHTML('earthDayOfYear', earthDate.dayOfYear());
  setInnerHTML('earthYear', EarthianDate.formatYear(earthDate.year));
  setInnerHTML('earthDayOfWeek', earthDate.dayOfWeek());
  var weekOfYear = earthDate.weekOfYear();
  setInnerHTML('earthWeekOfYear_week', weekOfYear.week);
  setInnerHTML('earthWeekOfYear_year', EarthianDate.formatYear(weekOfYear.year));
}

function updateMjd(mjd) {
  // set the MJD:
  setValue('mjd', mjd);
}

function getEarthDate() {
  var year = getValue('earthDate_year');
  var month = getValue('earthDate_month');
  var day = getValue('earthDate_day');
  return new EarthianDate(year, month, day);
}

function convertEarthian() {
  var earthDate = getEarthDate();
  if (earthDate.isValid()) {
    if (earthDate.isEarlierThan(minEarthDate)) {
      updateEarthian(minEarthDate);
      convertEarthian();
    } else {
      if (earthDate.isLaterThan(maxEarthDate)) {
        updateEarthian(maxEarthDate);
        convertEarthian();
      } else {
        updateEarthianInfo(earthDate);
        // update Gregorian date:
        var gregDate = earthDate.toGregorian();
        updateGregorian(gregDate);
        updateGregorianInfo(gregDate);
        // update MJD:
        var mjd = earthDate.toMjd();
        updateMjd(mjd);
      }
    }
  } else {
    dtlSetDateSelector('gregDate', '0000-00-00');
  }
}

function convertGregorian() {
  //alert('convertGregorian');
  var gregDate = getValue('gregDate');
  if (dtlIsValidDate(gregDate)) {
    if (gregDate < minGregDate) {
      updateGregorian(minGregDate);
      convertGregorian();
    } else {
      if (gregDate > maxGregDate) {
        updateGregorian(maxGregDate);
        convertGregorian();
      } else {
        updateGregorianInfo(gregDate);
        // update Earthian date:
        var earthDate = EarthianDate.fromGregorian(gregDate);
        updateEarthian(earthDate);
        updateEarthianInfo(earthDate);
        // update MJD:
        var mjd = earthDate.toMjd();
        updateMjd(mjd);
      }
    }
  } else {
    setValue('earthDate_year', 0);
    setValue('earthDate_month', 0);
    setValue('earthDate_day', 0);
  }
}

function convertMjd() {
  // get the MJD:
  var mjd = getValue('mjd');
  if (mjd < minMjd) {
    mjd = minMjd;
    updateMjd(mjd);
  } else {
    if (mjd > maxMjd) {
      mjd = maxMjd;
      updateMjd(mjd);
    }
  }
  // update Earthian date:
  var earthDate = EarthianDate.fromMjd(mjd);
  updateEarthian(earthDate);
  // update Gregorian date:
  var gregDate = earthDate.toGregorian();
  updateGregorian(gregDate);
}

function setGregYearBegin() {
  var year = strtoint(getValue('gregDate_year'));
  if (year < 1900) {
    year = thisYear;
  }
  var gregDate = dtlDateStr(year, 1, 1);
  updateGregorian(gregDate);
  convertGregorian();
}

function setGregYearEnd() {
  var year = strtoint(getValue('gregDate_year'));
  if (year < 1900) {
    year = thisYear;
  }
  var gregDate = dtlDateStr(year, 12, 31);
  updateGregorian(gregDate);
  convertGregorian();
}

function setEarthYearBegin() {
  var year = getValue('earthDate_year');
  var earthDate = EarthianDate.firstDayOfYear(year);
  updateEarthian(earthDate);
  convertEarthian();
}

function setEarthYearEnd() {
  var year = getValue('earthDate_year');
  var earthDate = EarthianDate.lastDayOfYear(year);
  updateEarthian(earthDate);
  convertEarthian();
}

function showRangeMessage() {
  alert('Sorry, this date outside the range of the converter!');
}

function gregorianPreviousDay() {
  var gregDate = getValue('gregDate');
  gregDate = dtlAddDays(gregDate, -1);
  updateGregorian(gregDate);
  convertGregorian();
}

function gregorianNextDay() {
  var gregDate = getValue('gregDate');
  gregDate = dtlAddDays(gregDate, 1);
  updateGregorian(gregDate);
  convertGregorian();
}

function earthianPreviousDay() {
  var earthDate = getEarthDate();
  earthDate = earthDate.addDays(-1);
  updateEarthian(earthDate);
  convertEarthian();
}

function earthianNextDay() {
  var earthDate = getEarthDate();
  earthDate = earthDate.addDays(1);
  updateEarthian(earthDate);
  convertEarthian();
}

function setToday() {
  updateGregorian(dToday);
  convertGregorian();
}

function setEaster() {
  var dEaster = dtlEaster(thisYear);
  if (dEaster < dToday) {
    dEaster = dtlEaster(thisYear + 1);
  }
  updateGregorian(dEaster);
  convertGregorian();
}

function setChristmas() {
  var dChristmas = dtlChristmas(thisYear);
  if (dChristmas < dToday) {
    dChristmas = dtlChristmas(thisYear + 1);
  }
  updateGregorian(dChristmas);
  convertGregorian();
}

// initialise selectors to today's date:
updateGregorian(dToday);
convertGregorian();

var selEarthianMonth = el('earthDate_month');
selEarthianMonth.onchange = checkDaySelector;
var selEarthianYear = el('earthDate_year');
selEarthianYear.onchange = checkDaySelector;
