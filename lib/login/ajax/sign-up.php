<?php

	include ($_SERVER['DOCUMENT_ROOT'] . '/lib/login/database_connection.php');

	if (empty($_POST['name'])) {

		$nameOK = 0;

	} else {

		$usr_name = $_POST['name'];
		$nameOK = 1;
	}

	if (empty($_POST['email'])) {

		$emailOK = 0;

	} else {

		if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email'])) {

			$usr_email = $_POST['email'];
			$emailOK = 1;

		} else {

			$emailOK = 0;

		}

	}


	if (empty($_POST['password'])) {

		$pwdOK = 0;

	} else {

		$usr_pwd = $_POST['password'];
		$pwdOK = 1;

	}

	$newsletter = $_POST['newsletter'];

	if ($newsletter === 'true'){

		$newsletter = 1;

	} else {

		$newsletter = 0;

	}

	date_default_timezone_set("Europe/Vienna");
	$last_online = date( "Y-m-d H:i:s");
	date_default_timezone_set('UTC');
if ($nameOK === 1 && $emailOK === 1 && $pwdOK === 1){

	$query_verify_email = "SELECT * FROM core_usr  WHERE usr_email ='$usr_email'";
	$result_verify_email = mysqli_query($dbc, $query_verify_email);

	if (!$result_verify_email) {

		$error = 'Database Error Occured';

	}

	if (mysqli_num_rows($result_verify_email) === 0) {
		
		$emailCheck = 1;

	} else { 
	
		$emailCheck = 0;

	}

	$query_verify_name = "SELECT * FROM core_usr  WHERE usr_name ='$usr_name'";
	$result_verify_name = mysqli_query($dbc, $query_verify_name);

	if (!$result_verify_name) {

		$error = 'Database Error Occured';

	}

	if (mysqli_num_rows($result_verify_name) === 0) {

		$blackListCHECK = strtoupper($usr_name);

		if (strpos($blackListCHECK , 'ADMIN') !== false) {

			$usrCheck = 0;
			
		} else {
			
			$usrCheck = 1;
		}
		
	} else { 

		$usrCheck = 0;
	
	}

	if($usrCheck == 0 || $emailCheck == 0){

		$insertOK = 0;

	} else {

		$insertOK = 1;

	}

	if($insertOK === 1){

		// Create a unique  activation code
		$usr_activ = md5(uniqid(rand(), true));

		// password_hash encrypt password
		$usr_pwd = password_hash($usr_pwd, PASSWORD_DEFAULT);

		$query_insert_user = "INSERT INTO core_usr ( usr_name, usr_email, usr_pwd, usr_activ, usr_subs, usr_online) VALUES ( '$usr_name', '$usr_email', '$usr_pwd', '$usr_activ', '$newsletter', '$last_online')";

		$result_insert_user = mysqli_query($dbc, $query_insert_user);

		if (!$result_insert_user) {

			$error = 'Error Occured Query Failed';

		}

		if (mysqli_affected_rows($dbc) === 1) { 

			// Send the email
			$message = " To activate your account, please click on this link:\n\n";
			$message .= WEBSITE_URL . '/activate.php?email=' . urlencode($usr_email) . "&key=$usr_activ";
			mail($usr_email, 'Registration Confirmation', $message, 'From: Andi <andreasleitzmueller@gmail.com>');

			$success = '<div class="c_g" style="width:100%; text-align:center; padding:25% 0px;">Thank you for signing up!<br><br><span style="color:#3f3f3f;">A confirmation email has been sent to <span style="color:#000;">'.$usr_email.'</span><br><br>Please click on the Activation Link in this email to Activate your account</span></div>';

		} else {

			$error = 'You could not be registered due to a system error. We apologize for any inconvenience.';
		
		}
	}
}

if ($nameOK === 0 || $emailOK === 0 || $pwdOK === 0 || $usrCheck === 0 || $emailCheck === 0){

	$dataError = 1;

} else {

	$dataError = 0;
}

if(!empty($error)){

	$dataString = 'ERROR||'.$error.'|||';

} else {

	if($dataError === 0){

		$dataString = 'OK||'.$success.'|||';

	} else {

		$dataString .= 'DATA';

			if ($nameOK === 0){

				$dataString .= '||NAME';

			}

			if ($emailOK === 0){

				$dataString .= '||EMAIL';

			}

			if ($pwdOK === 0){

				$dataString .= '||PWD';

			}

			if ($usrCheck === 0){

				$dataString .= '||USRCHECK';

			}

			if ($emailCheck === 0){

				$dataString .= '||EMAILCHECK';

			}

		$dataString .= '|||';

	}

}

mysqli_close($dbc);

echo $dataString;

?>