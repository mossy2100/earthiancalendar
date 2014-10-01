<?php
require "include/init.php";
require "tpl/TemplateTop.php";
require "$libDir/dtl.php";
?>

<style>
#unitsTable { margin: auto; }
#unitsTable td { text-align: right; }
</style>

<h1>Units</h1>
<p>The balanced structure of the Earthian Calendar makes it easy to divide the year into pieces that are equal within &plusmn;1 day.</p>
<table id='unitsTable' border="1" cellspacing="0" cellpadding="5">
  <tr>
    <th>millennia</th>
    <th>centuries</th>
    <th>generations</th>
    <th>decades</th>
    <th>years</th>
    <th>seasons</th>
    <th>months</th>
    <th>days</th>
  </tr>
  <tr>
    <td>1</td>
    <td>10</td>
    <td>~30</td>
    <td>100</td>
    <td>1000</td>
    <td>4000</td>
    <td>12000</td>
    <td>365242 or 365243</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>1</td>
    <td> ~3</td>
    <td>10</td>
    <td>100</td>
    <td>400</td>
    <td>1200</td>
    <td>36524 or 36525</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>1</td>
    <td>3.3</td>
    <td>33</td>
    <td>132</td>
    <td>396</td>
    <td>12053</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>1</td>
    <td>10</td>
    <td>40</td>
    <td>120</td>
    <td>3652 or 3653</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>1</td>
    <td>4</td>
    <td>12</td>
    <td> 365 or 366</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><sup>1</sup>/<sub>2</sub></td>
    <td>2</td>
    <td>6</td>
    <td>183 or 184</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><sup>1</sup>/<sub>3</sub></td>
    <td>&nbsp;</td>
    <td>4</td>
    <td>121 or 122</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><sup>1</sup>/<sub>4</sub></td>
    <td>1</td>
    <td>3</td>
    <td> 91 or 92</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><sup>1</sup>/<sub>6</sub></td>
    <td>&nbsp;</td>
    <td>2</td>
    <td>60 or 61</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>1</td>
    <td> 30 or 31</td>
  </tr>
</table>
<p>&nbsp;</p>
<?php
require "tpl/TemplateBottom.php";
?>