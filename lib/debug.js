function debug(obj) {
  alert((typeof obj) + ' ' + serialize(obj));
}

function debug_r(arr) {
  var str = '';
  for (el in arr) {
    str += el + ' => (' + typeof (arr[el]) + ') ' + arr[el] + '     ';
  }
  alert(str);
}

// @todo add addslashes() to case 'string'
function serialize(obj) {
  switch (typeof obj) {
    case 'string':
      return '\'' + obj + '\'';
    case 'number':
    case 'boolean':
      return String(obj);
    case 'object':
      if (obj === null) {
        return 'null';
      }
      var result = '{';
      for (var key in obj) {
        if (typeof obj[key] != 'function') {
          if (result != '{') {
            result += ', ';
          }
          result += key + ': ' + serialize(obj[key]);
        }
      }
      result += '}';
      return result;
    default:
      return typeof obj;
  }
}
