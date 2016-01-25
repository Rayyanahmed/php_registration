<?php 

$con = mysqli_connect('localhost', 'root', '', 'login_db');

// Add functions that have to do with database


function escape($string) {
	global $con;

	return mysqli_real_escape_string($con, $string)
}

function query($query) {
	global $con;
	return mysqli_query($con, $query);
}

function fetch_array($result) {
	global $con;

	mysqli_fetch_array($result);
}

?>