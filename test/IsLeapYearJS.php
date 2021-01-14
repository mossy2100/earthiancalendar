<?php
require "../include/init.php";
includeJavaScript("../lib/common.js");
includeJavaScript("../class/EarthianDate.js");
?>

<div id='hey'>
</div>

<script>
var isLeapYear;
var color;
var text = '';
for (y = -33; y <= 70; y++) {
  isLeapYear = EarthianDate.isLeapYear(y);
  text += y + ' a leap year? ' + (isLeapYear ? 'TRUE' : 'f') + '\n';
}
alert(text);

//setInnerHTML('hey', text);
</script>
