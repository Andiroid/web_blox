<?php

/*
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
*/

		
$root = $_SERVER['DOCUMENT_ROOT'] . '/';

$generalpath = $root . 'inc/general.php';

include_once($_SERVER['DOCUMENT_ROOT'] . '/inc/php/get-agent.php');

$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

/*
if($_SERVER['HTTP_X_REQUESTED_WITH'] == "info.andreasleitzmueller.andreasleitzmueller"){
	$AndroidApp = true;
}else{
	$AndroidApp = false;
}
*/
$AndroidApp = false;





$sysSettingsSQL = "SELECT * FROM core_sys";

$sysSettingsResults = mysqli_query($conn, $sysSettingsSQL);

$sysDataRow = mysqli_fetch_array($sysSettingsResults, MYSQLI_ASSOC);



$sys_data = array(
	'lang' => $sysDataRow['sys_lang']
);

//echo $sys_data['lang'];


$json_data = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/json/string.json');

$json = json_decode($json_data, true);

//echo '<pre>' . print_r($json, true) . '</pre>'; 


/* ============================================================
	LOGIN START
============================================================ */

	$passwordOK = 0;

	if(isset($_COOKIE['auth_00']) && $_COOKIE['auth_01']) {
		// Your 16 bytes binary pseudo-random salt
		$salt = 'Ckdsc2D0dcvde3r4';
		// Your 16 bytes binary pseudo-random initialization vector
		$iv = 'vd3feefEfcSDsvVd';

		$encrypted = $_COOKIE['auth_00'];

		$email = openssl_decrypt($encrypted, 'AES-128-CBC', $salt, 1, $iv);

		$encrypted = $_COOKIE['auth_01'];

		$pwd = openssl_decrypt($encrypted, 'AES-128-CBC', $salt, 1, $iv);


		$query_check_credentials = "SELECT * FROM core_usr WHERE (usr_email='$email') AND usr_activ IS NULL";

		$result_check_credentials = mysqli_query($conn, $query_check_credentials);

		$cookieROW = mysqli_fetch_array($result_check_credentials, MYSQLI_ASSOC);
			
		if (password_verify($pwd, $cookieROW['usr_pwd'])){ $passwordOK = 1; }

		if($passwordOK === 1){

			$user = array(
				'id' => $cookieROW['usr_id'],
				'group' => $cookieROW['usr_group'],
				'name' => $cookieROW['usr_name']
			);

		}


	} else {
		
		session_start();
		$user = array(
			'id' => $_SESSION['usr_id'],
			'group' => $_SESSION['usr_group'],
			'name' => $_SESSION['usr_name']
		);
	}

	//print_r($_SESSION);

/* ============================================================
	LOGIN END
============================================================ */

?>