<?php

	include ($_SERVER['DOCUMENT_ROOT'] . '/lib/login/database_connection.php');

	//session_start();
	//$error = array();

	if (empty($_POST['email'])) {

		$usrDataOK = 0;

	} else {

		$Email = $_POST['email'];
		$usrDataOK = 1;

	}

	if (empty($_POST['password'])) {

		$pwdDataOK = 0;

	} else {

		$usr_pwd_decrypted = $_POST['password'];
		$pwdDataOK = 1;

	}

	if ($_POST['cookie'] === 'true') {

		$cookieLogin = 1;

	} else {

		$cookieLogin = 0;

	}

/*
if($cookieLogin === 1){

	// To set a Cookie
	// You could use the array to store several user info in one cookie

	$user = array(
		'id' => $id,
		'name' => $name,
		'login' => $login,
	)

	setcookie("loginCredentials", $user, time() * 7200); // Expiring after 2 hours

	// Now to log off, just set the cookie to blank and as already expired
	setcookie("loginCredentials", "", time() - 3600); // "Expires" 1 hour ago


}

*/










	if ($pwdDataOK == 1 && $usrDataOK == 1){

		$query_check_credentials = "SELECT * FROM core_usr WHERE (usr_email='$Email' OR usr_name='$Email') AND usr_activ IS NULL";

		$result_check_credentials = mysqli_query($dbc, $query_check_credentials);

		if(!$result_check_credentials){

			echo 'The Check Credentials Query Failed ';

		} else {

			$dataCheck = 1;

		}

		if (@mysqli_num_rows($result_check_credentials) == 1){


			if($cookieLogin === 0){

				session_start();
				$_SESSION = mysqli_fetch_array($result_check_credentials, MYSQLI_ASSOC);

				
				$usr_id = $_SESSION['usr_id'];
				$usr_pwd_encrypted = $_SESSION['usr_pwd'];
				$usr_group = $_SESSION['usr_group'];
				$usr_name = $_SESSION['usr_name'];
				$usr_email = $_SESSION['usr_email'];
				/*
				$userDATA = array(
					'id' => $usr_id,
					'pwd' => $usr_pwd_encrypted,
					'name' => $usr_name
				);
				var_dump($userDATA);
				echo $userDATA['id'];
				*/
			} else {

				$cookieROW = mysqli_fetch_array($result_check_credentials, MYSQLI_ASSOC);

				$usr_id = $cookieROW['usr_id'];
				$usr_pwd_encrypted = $cookieROW['usr_pwd'];
				$usr_group = $cookieROW['usr_group'];
				$usr_name = $cookieROW['usr_name'];
				$usr_email = $cookieROW['usr_email'];

				$triggerCookie = 1;

			}

			//password hash decryption
			if (password_verify($usr_pwd_decrypted, $usr_pwd_encrypted)) {

				$requestOK = 1;

				if($triggerCookie === 1){

					// Your 16 bytes binary pseudo-random salt
					$salt = 'Ckdsc2D0dcvde3r4';

					// Your 16 bytes binary pseudo-random initialization vector
					$iv = 'vd3feefEfcSDsvVd';

					// data to encrypt
					$decrypted = $usr_email;

					// in aes 128 bit cipher block chaining method encrypted data
					$cookie_email = openssl_encrypt($decrypted, 'AES-128-CBC', $salt, 1, $iv);

					$decrypted = $usr_pwd_decrypted;

					// in aes 128 bit cipher block chaining method encrypted data
					$cookie_pwd = openssl_encrypt($decrypted, 'AES-128-CBC', $salt, 1, $iv);

					setcookie('auth_00', $cookie_email, time() + (365*24*60*60), "/");
					setcookie('auth_01', $cookie_pwd, time() + (365*24*60*60), "/");

				}

			} else {

				$requestOK = 0;

			}


		} else { 
				
			$requestOK = 0;
		}

	}

	if ($dataCheck == 1 && $requestOK == 0){

		$dataString .= 'DATA';
		
		$data_error= 'E-mail or Password is Incorrect';

		$dataString .= '||'.$data_error;

	}

	if($usrDataOK == 0 && $pwdDataOK == 0){

		$dataString .= 'CHECK';

		$usr_error = 'Please Enter your Username or E-mail';

		$dataString .= '||'.$usr_error;

		$pwd_error = 'Please Enter Your Password ';

		$dataString .= '||'.$pwd_error;

	} else {

		if ($usrDataOK == 0){

			$dataString .= 'USR';

			$usr_error = 'Please Enter your Username or E-mail';

			$dataString .= '||'.$usr_error;

		}

		if ($pwdDataOK == 0){

			$dataString .= 'PWD';

			$pwd_error = 'Please Enter Your Password ';

			$dataString .= '||'.$pwd_error;

		}

	}

	if($requestOK == 1) {

		//if(!empty($_SESSION['usr_reset'])){
			date_default_timezone_set("Europe/Vienna");
			$usr_online = date( "Y-m-d H:i:s");
			$cleanUsrDataSQL = "UPDATE core_usr SET usr_online='$usr_online', usr_reset=NULL WHERE usr_email='$usr_email'";

			if ($dbc->query($cleanUsrDataSQL) === TRUE) {

				//echo "OK";

			} else {

				//echo "ERROR_2";
			
			}
		//}
		
		if ($usr_group == 2){

			$sql = "SELECT count(*) as total from p_core WHERE p_draft='1'";
			$query = mysqli_query($dbc, $sql);
			$row = mysqli_fetch_row($query);
			$total_rows = $row[0];

			//$adminEssentials = '<li><a id="private-archiv" class="navLink hovercell" href="/cms/content/project/archives/private">privates | archiv</a></li><li><a id="draft" class="navLink hovercell" href="/cms/content/project/archives/draft-archiv">draft [<span id="draftCountRESULTS" style="color:red;">'.$total_rows.'</span>]</a></li>';

		$userDISPLAY .= '<a class="usrAdmin"href="/cms/index">Admin</a>';
		$userDISPLAY .= '<span class="usrName">'.$usr_name.'</span>';
		$userDISPLAY .= '<div class="usrNavWrap"><div class="usrNavPointer">&#9650;</div><div class="usrNavInner"><a href="/account-settings" class="usrNavBtn">Account Settings</a><div class="usrNavBtn" onclick="logOut()">Logout</div></div></div>';


			$dataString .= 'OK||'.$userDISPLAY.'||'.$adminEssentials;

		} else {

		$userDISPLAY .= '<a href="/user/account-settings.php"><span>'.$usr_name.'</span></a>';
		$userDISPLAY .= '<div class="usrNavWrap"><div class="usrNavPointer">&#9650;</div><div class="usrNavInner"><a href="/account-settings" class="usrNavBtn">Account Settings</a><div class="usrNavBtn" onclick="logOut()">Logout</div></div></div>';
		
			$dataString .= 'OK||'.$userDISPLAY;
		}
		

	}

	mysqli_close($dbc);

	$dataString .='|||';
	
	echo $dataString;

?>