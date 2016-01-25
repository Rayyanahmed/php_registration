<?php 

// clean html strings from forms

function clean($string) {
	return htmlentities($string);
}

function redirect($location) {
	return header("Location: {$location}");
}


function set_message($message) {
	if(!empty($message)) {
		$_SESSION['message'] = $message;
	} else {
		$message = "";
	}
}


?>