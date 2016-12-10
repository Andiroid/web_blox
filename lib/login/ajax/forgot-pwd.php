<?php

	include ($_SERVER['DOCUMENT_ROOT'] . '/lib/login/database_connection.php');


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


	date_default_timezone_set("Austria/Vienna");
	$last_online = date( "Y-m-d H:i:s");

if ($emailOK === 1){

	$query_verify_email = "SELECT * FROM core_usr  WHERE usr_email ='$usr_email'";
	$result_verify_email = mysqli_query($dbc, $query_verify_email);

	if (!$result_verify_email) {

		$error = 'Database Error Occured';

	}

	if (mysqli_num_rows($result_verify_email) === 0) {

		$emailCheck = 1;

	} else { 
	
		$requestOK = 1;

	}





	if($requestOK === 1){

		// Your 16 bytes binary pseudo-random salt
		$salt = 'Ckdsc2D0dcvde3r4';

		// Your 16 bytes binary pseudo-random initialization vector
		$iv = 'vd3feefEfcSDsvVd';

		// data to encrypt
		$decrypted = date("Y-m-d h:i:s");

		// in aes 128 bit cipher block chaining method encrypted data
		$token = openssl_encrypt($decrypted, 'AES-128-CBC', $salt, 1, $iv);

        // create a unique salt
        $salt = "498#2DadJdfFvn98BD!801600D*7E3CC13";

        // create the unique user password reset key
        $key = hash('sha512', $salt.$usr_email);

        // create a url which we will direct them to reset their password
        $pwrurl = 'https://andiroid.info/login/reset-password.php?q='.$key.'&email='.urlencode($usr_email);


	$sql = "UPDATE core_usr SET usr_reset='$token' WHERE usr_email='$usr_email'";

	if ($dbc->query($sql) === TRUE) {

		// Send the email
		$message = "If this e-mail does not apply to you please ignore it. It appears that you have requested a password reset at our website https://example.com\n\nTo reset your password, please click the link below.\n\n";
		//$message .= WEBSITE_URL . '/login/reset-password.php?email=' . urlencode($usr_email) . "&key=$usr_activ";
		$message .= $pwrurl;
		mail($usr_email, 'Password Reset Requested', $message, 'From: example.com <example@hotmail.com>');

		$success = '<div class="c_g" style="width:100%; text-align:center; padding:25% 0px;">Confirmed !<br><br><span style="color:#3f3f3f;">Your password recovery key has been sent to <span style="color:#000;">'.$usr_email.'</span><br><br>';


       

	} else {

		echo "ERROR";

	}












	}


















}

if ($emailOK === 0 || $emailCheck === 0){

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

			if ($emailOK === 0){

				$dataString .= '||EMAIL';

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