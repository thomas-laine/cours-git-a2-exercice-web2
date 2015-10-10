<?php session_start();
require('config/config.php');
require('model/functions.fn.php');

/********************************
			PROCESS
********************************/

if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {

	 /*isEmailAvailable
		return :
			true if available
			false if not available
		$db -> 				database object
		$email -> 			field value : email
	*/
	$email=$_POST['email'];
	$email_ok = isEmailAvailable($db, $email);

	/* isUsernameAvailable
		return :
			true if available
			false if not available
		$db -> 				database object
		$username -> 			field value : username
	*/
	$username=$_POST['username'];
	$username_ok = isUsernameAvailable($db, $username);

	$password=$_POST['password'];

	if ($email_ok && $username_ok) {
		/* userRegistration
			return :
				true for registration OK
				false for fail
			$db -> 				database object
			$username -> 		field value : username
			$email -> 			field value : email
			$password -> 		field value : password
		*/
		userRegistration($db, $email, $username, $password);
		header('Location: login.php');
	}


	if (!$email_ok) {
		 $error = "email faux!";
	}

	if (!$username_ok) {
		 $error = "username faux!";
	}

}

/******************************** 
			VIEW 
********************************/

include 'view/_header.php';
include 'view/register.php';
include 'view/_footer.php';