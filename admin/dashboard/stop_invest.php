<?php
ob_start();
session_start();
require("../../script.php");
$classObj = new topspin;
$classObj->dbcon();
//$classObj->blockk();
$classObj->stop_invest();
ob_end_flush();
?>
