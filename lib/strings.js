///////////////////////////////////////////////////////////////////////////////
// strings.js:
// A variety of handy functions for working with strings.

function write(str) {
  document.write(str);
}

function writeln(str) {
  write(str + '\n');
}

function writebr(str) {
  writeln(str + '<br>');
}

// trims spaces from the start and end of a string:
function trim(str) {
  // check we have a value:
  if (str == null || str == '') {
    return '';
  }

  // make a new String for the result:
  var result = String(str);

  // trim spaces from the start of result:
  while (result.charAt(0) == ' ') {
    result = result.substr(1, result.length - 1);
  }

  // trim spaces from the end of result:
  while (result.charAt(result.length - 1) == ' ') {
    result = result.substr(0, result.length - 1);
  }

  return result;
}

// functions to add characters to start of a string until desired length reached:
function padLeft(value, width, chPad) {
  // convert to a string:
  var result = value + '';
  // add pad characters until desired width is reached:
  while (result.length < width) {
    result = chPad + result;
  }
  return result;
}

// functions to add characters to end of a string until desired length reached:
function padRight(value, width, chPad) {
  // convert to a string:
  var result = value + '';
  // add pad characters until desired width is reached:
  while (result.length < width) {
    result = result + chPad;
  }
  return result;
}

// function to make a string of substr repeated n times:
function stringOf(substr, n) {
  var result = '';
  for (var i = 0; i < n; i++) {
    result += substr;
  }
  return result;
}

// returns n left-most characters from str:
function left(str, n) {
  return str.substr(0, n);
}

// returns n right-most characters from str:
function right(str, n) {
  return str.substr(str.length - n, n);
}

/////////////////////////////////////////////////////////////////////////////////////////
// Basic string and character functions:

// returns true if str is a string with length > 0
function isValidString(str) {
  return (typeof (str) == 'string' && str.length > 0);
}

// returns true if character ch is in string str:
function isIn(ch, str) {
  return (str.indexOf(ch) >= 0);
}

/////////////////////////////////////////////////////////////////////////////////////////
// check ASCII codes:

var ASCII_A = 65;
var ASCII_Z = 90;
var ASCII_a = 97;
var ASCII_z = 122;
var ASCII_0 = 48;
var ASCII_9 = 57;

function isUpperCaseLetterCode(code) {
  return (code >= ASCII_A) && (code <= ASCII_Z);
}

function isLowerCaseLetterCode(code) {
  return (code >= ASCII_a) && (code <= ASCII_z);
}

function isLetterCode(code) {
  return isUpperCaseLetterCode(code) || isLowerCaseLetterCode(code);
}

function isDigitCode(code) {
  return (code >= ASCII_0) && (code <= ASCII_9);
}

function isAlphanumericCode(code) {
  return isDigitCode(code) || isLetterCode(code);
}

/////////////////////////////////////////////////////////////////////////////////////////
// check ASCII characters:
function isUpperCaseLetter(ch) {
  return isUpperCaseLetterCode(ch.charCodeAt(0));
}

function isLowerCaseLetter(ch) {
  return isLowerCaseLetterCode(ch.charCodeAt(0));
}

function isLetter(ch) {
  return isLetterCode(ch.charCodeAt(0));
}

function isDigit(ch) {
  return isDigitCode(ch.charCodeAt(0));
}

function isAlphanumeric(ch) {
  return isAlphanumericCode(ch.charCodeAt(0));
}

function isQuoteChar(ch) {
  return ch == '"' || ch == '\'' || ch == '`' || ch == '�' || ch == '�' || ch == '�';
}

function isWhitespace(ch) {
  return ch == ' ' || ch == '\n' || ch == '\t' || ch == '\r';
}

/////////////////////////////////////////////////////////////////////////////////////////
// check strings of digits or letters:

function isAllDigits(str) {
  // check str:
  if (!isValidString(str)) {
    return false;
  }

  // check that each character is a digit:
  for (var j = 0; j < str.length; j++) {
    if (!isDigitCode(str.charCodeAt(j))) {
      return false;
    }
  }

  // all ok:
  return true;
}

function isAllLetters(str) {
  // check str:
  if (!isValidString(str)) {
    return false;
  }

  // check that each character is a letter:
  for (var j = 0; j < str.length; j++) {
    if (!isLetterCode(str.charCodeAt(j))) {
      return false;
    }
  }

  // all ok:
  return true;
}

function isAllAlphanumeric(str) {
  // check str:
  if (!isValidString(str)) {
    return false;
  }

  // check that each character is a letter:
  var ch;
  for (var j = 0; j < str.length; j++) {
    ch = str.charCodeAt(j);
    if (!isDigitCode(ch) && !isLetterCode(ch)) {
      return false;
    }
  }

  // all ok:
  return true;
}

function quote_replace(str) {
  return str_replace('\'', '\'\'', str);
}

function uniformBreakTags(str) {
  // replaces all versions of break tags with <br>
  str = str_replace('<BR', '<br', str);
  str = str_replace('<br >', '<br>', str);
  str = str_replace('<br />', '<br>', str);
  return str;
}

function stripHtmlTags(str) {
  // removes html tags from a string:

  // check str:
  if (!isValidString(str)) {
    return false;
  }

  var intag = false;
  var ch;
  var result = '';
  for (var j = 0; j < str.length; j++) {
    ch = str.charAt(j);
    if (!intag && ch == '<') {
      intag = true;
    } else {
      if (intag && ch == '>') {
        intag = false;
      } else {
        if (!intag) {
          result += ch;
        }
      }
    }
  }
  return result;
}

function capitalizeField(form, field) {
  form[field].value = (form[field].value).toUpperCase();
}

function buildPhoneNumberString(phHome, phWork, phMobile) {
  // make a string for the phone numbers:
  phoneNumbers = '';
  if (phHome != '') {
    if (phoneNumbers != '') {
      phoneNumbers += ', ';
    }
    phoneNumbers += 'H: ' + phHome;
  }
  if (phWork != '') {
    if (phoneNumbers != '') {
      phoneNumbers += ', ';
    }
    phoneNumbers += 'W: ' + phWork;
  }
  if (phMobile != '') {
    if (phoneNumbers != '') {
      phoneNumbers += ', ';
    }
    phoneNumbers += 'M: ' + phMobile;
  }
  return phoneNumbers;
}

function ucfirst(str) {
  // matches PHP function
  // makes the first letter of str upper case
  if (str.length == 0) {
    return '';
  }
  if (str.length == 1) {
    return str.toUpperCase();
  }
  return (left(str, 1)).toUpperCase() + right(str, str.length - 1);
}

function ucwords(text) {
  // Makes the first letter of each word uppercase.
  // A word is any string of characters after a whitespace character.
  var ch,
    prev_ch;
  var result = '';
  for (var i = 0; i < text.length; i++) {
    ch = text.charAt(i);
    if (i == 0 || isWhitespace(prev_ch)) {
      result += ch.toUpperCase();
    } else {
      result += ch;
    }
    prev_ch = ch;
  }
  return result;
}

function getExtension(filename) {
  var dotpos = filename.lastIndexOf('.');
  if (dotpos == -1) {
    return '';
  }
  return filename.substr(dotpos + 1);
}

function writeEmailLink(user, domain, link, className) {
  document.write('<a href=\'mailto:' + user + '@' + domain + '\'');
  if (className != null) {
    document.write(' class=\'' + className + '\'');
  }
  document.write('>' + link + '</a>');
}

function attributeString(attribs) {
  var result = '';
  if (typeof attribs == 'object') {
    for (var attrib in attribs) {
      if (attribs.hasOwnProperty(attrib)) {
        var value = attribs[attrib];
        result += ' ' + attrib + '=\'' + htmlspecialchars(value, ENT_QUOTES) + '\'';
      }
    }
  }
  return result;
}
