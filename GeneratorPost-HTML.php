<?php
require "include/init.php";
require "tpl/TemplateTop.php";
require "$libDir/dtl.php";
require "$libDir/arrays.php";
require "$libDir/colors.php";
require "$classDir/EarthianDate.php";

// Get post values:
//debug($_POST);

// cell colors:
for ($i = 1; $i <= 7; $i++) {
  $hexDayColours[$i] = $_POST["dayColors"][$i];
  $rgbDayColors[$i] = hex2rgb($_POST["dayColors"][$i]);
}
$borderColor = $_POST['borderColor'];
?>

<style>
.control {
  color: Black;
  background-color: White;
  border: solid 1px DarkGray;
}

.calendarPage {
  width: 100%;
  border-collapse: collapse;
  margin: auto;
}

.calendarPage th {
  border: solid 1px <?php echo $borderColor; ?>;
  text-align: center;
  font-size: 13px;
  color: Black;
  padding: 5px 0;
}

.calendarPage td {
  width: 10%;
  height: 60px;
  border: solid 1px <?php echo $borderColor; ?>;
}

.calendarPage td.empty {
  border-width: 0;
}

.dayNum {
  width: 100%;
  text-align: left;
  font-weight: bold;
  vertical-align: top;
  color: Black;
}

.note {
  width: 100%;
  height: 60px;
  padding: 0;
  margin: 0;
  font-size: 10px;
}

.greg {
  width: 100%;
  color: Black;
  font-weight: normal;
  font-size: 9px;
  float: right;
  text-align: center;
}

.otherMonth {
  background-color: #f7f7f7;
  color: #BBBBBB;
}

.month {
  width: 95%;
  margin: 0 auto 20px;
  padding: 3px;
}

.month h2 {
  padding: 0;
  margin: 10px;
  color: Black;
  font-size: 20px;
}

.odd {
  background-color: White;
}

#tblForm {
  background-color: #EEE;
  padding: 10px;
  border: solid 1px Silver;
}

#tblForm th {
  text-align: left;
  background-color: transparent;
  color: Black;
  font-weight: normal;
}
</style>

<?php
require_once "include/CalculatePages.php";
require_once "include/GetSeasonalMarkers.php";
require_once "include/GetLunarPhases.php";

$formattedYear = str_pad($year, 4, '0', STR_PAD_LEFT);

foreach ($pages as $month => $page) {
  println("<div class='month" . ($month % 2 == 0 ? "" : " odd") . "'>");
  println("<h2 align='center'>$formattedYear " . EarthianDate::$monthNames[$month] . "</h2>");
  println("<table align='center' class='calendarPage' cellspacing='1' cellpadding='3'>");
  // day names:
  println("<tr>");
  foreach (EarthianDate::$dayNames as $dow => $dayName) {
    println("<th style='background-color: " . $hexDayColours[$dow] . "'>$dayName</th>");
  }
  println("</tr>");
  // Print the weeks:
  foreach ($page as $week) {
    for ($dayOfWeek = 1; $dayOfWeek <= 7; $dayOfWeek++) {
      if ($dayOfWeek == 1) {
        println("<tr>");
      }
      $earthDate = $week[$dayOfWeek];
      $gregDate = $earthDate->toGregorian();

      // Make the note:
      $note = getSeasonNote($gregDate);
      if ($note != "") {
        $note .= "<br />";
      }
      $note .= getLunarNote($gregDate);

      $isOtherMonth = $earthDate->month != $month;
      if ($isOtherMonth) {
        println("<td class='otherMonth'>");
        println("<div class='dayNum otherMonth' >" .
          (EarthianDate::$abbrevMonthNames[$earthDate->month] . ' ' . $earthDate->day) . "</div>");
        println("<div class='note otherMonth'>$note</div>");
        println("<div class='greg otherMonth'>" . dtlFormat($gregDate, "Day D Mon YYYY") .
          "</div>");
      }
      else {
        $id = str_replace(EarthianDate::sep, '_', $earthDate->__toString());
        println("<td style='background-color: " . $hexDayColours[$dayOfWeek] . "'>");
        println("<div id='$id' class='dayNum'>" . $earthDate->day . "</div>");
        println("<div class='note'>$note</div>");
        println("<div class='greg'>" . dtlFormat($gregDate, "Day D Mon YYYY") . "</div>");
      }
      println("</td>");
      if ($dayOfWeek == 7) {
        println("</tr>");
      }
    }
  }
  println("</table>");
  println("</div>");
}

includeJavaScript("$libUrl/dtl.js");
includeJavaScript("$classUrl/EarthianDate.js");
?>

<script type='text/javascript'>
function highlightToday() {
  var gregToday = dtlToday();
  var earthToday = EarthianDate.fromGregorian(gregToday);
  var id = str_replace(EarthianDate.sep, '_', earthToday.toString());
  var dayNum = el(id);
  if (dayNum) {
    dayNum.style.color = '#ff0000';
  }
}

highlightToday();
</script>

<?php
require "tpl/TemplateBottom.php";
