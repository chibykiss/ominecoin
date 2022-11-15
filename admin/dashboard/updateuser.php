<?php
ob_start();

require("../../script.php");
$classObj = new topspin;
$classObj->dbcon();
$classObj->updateuser();
ob_end_flush();

?>