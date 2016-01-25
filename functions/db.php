<?php 

$con = mysqli_connect('localhost', 'root', '', 'login_db');

// Add functions that have to do with database

function query($query) {
	global $con;
	return mysqli_query($con, $query);
}

?>