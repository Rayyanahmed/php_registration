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


function display_message() {
	if(isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
}

function token_generator() {
	$token = $_SESSION['token'] = md5(uniqid(mt_rand(), true));
	return $token;
}


/******************** VALIDATION FUNCTIONS  *********************/

function validate_user_registration() {
	if(isset($_POST['register-submit'])) {
		// execute validations. this is one way but its less compatible
		// IE may give us problems so we will use SERVER superglobal instead
	}
}

?>