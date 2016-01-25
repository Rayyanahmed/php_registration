<?php
// pre-defined functions
ob_start();
session_start();

include("db.php");
include("functions.php");

if($con) {
	echo "Available";
}

?>