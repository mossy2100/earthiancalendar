<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
  <title>The Earthian Calendar</title>
  <?php
  includeCss("tpl/general.css");
  includeCss("tpl/layout.css");
  includeCss("tpl/links.css");
  includeCss("tpl/menu.css");
  includeCss("tpl/tables.css");
  includeJavaScript("$libUrl/common.js");
  includeJavaScript("$libUrl/debug.js");
  includeJavaScript("$libUrl/strings.js");
  includeJavaScript("$libUrl/php-strings.js");
  includeJavaScript("$libUrl/numbers.js");
  includeJavaScript("$libUrl/arrays.js");
  includeJavaScript("$libUrl/jquery-1.2.6.min.js");
  ?>
</head>
<body>

<pre>
  <?php
  //var_dump($_SERVER); ?>
</pre>

<?php
require_once "$baseDir/include/menu.php"; ?>

<div id='main'>

  <div id='header'>
    <img src="<?php
    echo $imagesUrl; ?>/TheEarthianCalendar-banner.jpg"
      alt="The Earthian Calendar" width="413" height="175">
    <h3><em>A simple, accurate, solar calender for Earth</em></h3>
  </div>
