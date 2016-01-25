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

function validation_errors($error) {
$alerts = <<<DELIMETER
<div class="alert alert-warning alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<strong>Warning!</strong>{$error}
</div>

DELIMETER;
return $alerts;
}

function email_exists($email) {
	$sql = "SELECT id FROM users WHERE email = '$email'";
	$result = query($sql);
	if(row_count($result) == 1) {
		return true;
	} else {
		return false;
	}
}

function username_exists($username) {
	$sql = "SELECT id FROM users WHERE username = '$username'";
	$result = query($sql);
	if(row_count($result) == 1) {
		return true;
	} else {
		return false;
	}
}

function validate_user_registration() {
	$errors = [];

	$min = 3;
	$max = 20;
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$first_name       =        clean($_POST['first_name']);
		$last_name        =        clean($_POST['last_name']);
		$username         =        clean($_POST['username']);
		$email            =        clean($_POST['email']);
		$password         =        clean($_POST['password']);
		$confirm_password =        clean($_POST['confirm_password']);

		if(strlen($first_name) < $min) {
			$errors[] = "Your first name cannot be less than {$min} characters";
		}

		if(strlen($first_name) > $max) {
			$errors[] = "Your first name cannot be more than {$max} characters";
		}

		if(strlen($last_name) < $min) {
			$errors[] = "Your last name cannot be less than {$min} characters";
		}

		if(strlen($last_name) > $max) {
			$errors[] = "Your last name cannot be more than {$max} characters";
		}

		if(strlen($username) < $min) {
			$errors[] = "Your username cannot be less than {$min} characters";
		}

		if(strlen($username) > $max) {
			$errors[] = "Your username cannot be more than {$max} characters";
		}

		if(username_exists($username)) {
			$errors[] = "Sorry that username is already registered";
		}

		if(strlen($email) > $max) {
			$errors[] = "Your email cannot be more than {$max} characters";
		}

		if(email_exists($email)) {
			$errors[] = "Sorry that email is already registered";
		}

		if($password != $confirm_password) {
			$errors[] = "Your password fields do not match";
		}

		if(!empty($errors)) {
			foreach($errors as $error) {
				echo validation_errors($error);
			}
		} else {
			if(register_user($first_name, $last_name, $username, $email, $password)) {
				set_message("<p class='bg-success text-center'>Please check your email for activation link </p>");
				redirect("index.php");
			}
		}
	}
}


function send_email($email, $subject, $msg, $headers) {
	return mail($email, $subject, $msg, $headers)
}

// Functions for REGISTRATION
// Wouldnt it be better to register only if errors array is empty?
function register_user($first_name, $last_name, $username, $email, $password) {
	$first_name = escape($first_name);
	$last_name = escape($last_name);
	$username = escape($username);
	$email = escape($email);
	$password = escape($password);

	if(email_exists($email)) {
		return false;
	} elseif(username_exists($username)) {
		return false;
	} else {
		$password = md5($password);
		$validation_code = md5($username + microtime());
		$sql = "INSERT INTO users(first_name, last_name, username, email, password, validation_code, active)";
		$sql .= " VALUES('$first_name', '$last_name', '$username', '$email', '$password', '$validation_code', '0')";
		$result = query($sql);
		confirm($result);

		return true;
	}
}



?>