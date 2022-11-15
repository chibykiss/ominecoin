<?php
ob_start();
require("../script.php");
$classObj = new topspin;
$classObj->dbcon();
$classObj->resendverify();
ob_end_flush();

?>