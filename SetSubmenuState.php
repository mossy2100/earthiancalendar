<?php
require "include/init.php";
if (!is_array($_SESSION["SubmenuVisible"])) {
  $_SESSION["SubmenuVisible"] = [];
}
$_SESSION["SubmenuVisible"][$_GET['menuName']] = str2bool($_GET['visible']);
//debug($_SESSION["SubmenuVisible"]);
