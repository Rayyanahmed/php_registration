<?php 

$con = mysqli_connect('localhost', 'root', '', 'login_db');

// Add functions that have to do with database

function row_count($result) {
	// Just a note, good reason to use helper functions:
	// Lets say we want to change databases, instead of changing the code everywhere
	// We just will have to change the code here once.
	return mysqli_num_rows($result);
}


function escape($string) {
	global $con;

	return mysqli_real_escape_string($con, $string);
}

function query($query) {
	global $con;
	return mysqli_query($con, $query);
}

function confirm($result) {
	global $con;

	if(!$result) {
		die("QUERY FAILED" . mysqli_error($con));
	}
}

function fetch_array($result) {
	global $con;

	mysqli_fetch_array($result);
}

?>