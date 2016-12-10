<?php
session_start();


	foreach ($_SESSION as $key=>$val){

		if($key == 'usr_group'){
			//echo $key." ".$val."<br/>";
			$usr_group = $val;
			//echo $usr_group;
		}
	}


	setcookie('auth_00', $cookie_email, time() - (42000), "/");
	setcookie('auth_01', $cookie_pwd, time() - (42000), "/");


	if($usr_group == 2){
		$url = $_SERVER["HTTP_REFERER"];
		$path = parse_url($url, PHP_URL_PATH);

		$cmsCHECK = explode('/', $path)[1];
		if($cmsCHECK == 'cms'){
			echo 'redirect';
		}
	}


//echo $_SESSION['usr_group'];

// Initialize the session.
// If you are using session_name("something"), don't forget it now!
// session_start();

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
	$params = session_get_cookie_params();
	setcookie(session_name(), '', time() - (42000),
		$params["path"], $params["domain"],
		$params["secure"], $params["httponly"]
	);
}



// Finally, destroy the session.
session_destroy();

?>