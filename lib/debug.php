<?php
// debugging & logging functions:
// * requires strings.php

$debugMode = false;
$debugQueries = false;
$logFile = 0;
$logPath = "";

function debug($var, $funcName = '') {
  global $debugMode;
  if ($debugMode) {
    if ($funcName != '') {
      print "<b style='color:Red'>$funcName:</b> ";
    }
    if (is_array($var)) {
      debug_r($var);
    }
    elseif (is_bool($var)) {
      printbr(bool2str($var));
    }
    elseif (is_object($var)) {
      debug_obj($var);
    }
    else {
      printbr(htmlspecialchars($var));
    }
  }
}

function debug_r($ar) {
  global $debugMode;
  if ($debugMode) {
    println("<pre style='color:Red'>");
    print_r($ar);
    println("</pre>");
  }
}

function debug_obj($obj) {
  global $debugMode;
  if ($debugMode) {
    println("<pre style='color:Red'>");
    var_dump($obj);
    println("</pre>");
  }
}

function debugOn() {
  global $debugMode;
  $debugMode = true;
}

function debugOff() {
  global $debugMode;
  $debugMode = false;
}

function getDebugMode() {
  global $debugMode;
  return $debugMode;
}

function debug_exit($str = '') {
  global $debugMode;
  if ($debugMode) {
    exit($str);
  }
}

function logOpen($path, $wipe = false) {
  global $logFile, $logPath;
  $logFile = @fopen($path, $wipe ? 'wb' : 'ab');
  if (!$logFile) {
    exit("Could not open log file $path");
  }
  else {
    $logPath = $path;
  }
}

function logClose() {
  global $logFile;
  fclose($logFile);
  $logFile = 0;
}

function logWrite($line) {
  global $logFile;
  if ($logFile) {
    if (is_array($line)) {
      foreach ($line as $key => $value) {
        logWrite("$key => $value");
      }
    }
    else {
      fwrite($logFile, $line . "\r\n");
    }
  }
}

function logReadAll() {
  global $logPath;
  if ($logPath) {
    return file_get_contents($logPath);
  }
}

function log2html() {
  return str_replace(["\r\n", "\r", "\n"], "<br>", logReadAll());
}

function dumpAll() {
  println("<pre style='color:Red'>");
  var_dump(get_defined_vars());
  println("</pre>");
}

function printError($msg) {
  printbr("<b style='color:Red'>ERROR:</b> $msg");
}
