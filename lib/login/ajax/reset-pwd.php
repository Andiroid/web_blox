<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/lib/login/database_connection.php');

$q = $_POST['q'];
$email = $_POST['email'];
$password = $_POST['pwd'];

// Create a unique salt. This will never leave PHP unencrypted.
$salt = "498#2DadJdfFvn98BD!801600D*7E3CC13";

// Create the unique user password reset key
$KEY = hash('sha512', $salt.$email);
//echo $KEY.'<br>';

if($q === $KEY){

	$urlEmailCHECK = 1;

} else {

	$urlEmailCHECK = 0;

}


// Your 16 bytes binary pseudo-random salt
$salt = '00001111 11111001 11011110 10011001 00000001 10000110 00101100 11111111 
10100011 11011001 00001011 10110111 01000001 11101111 11110011 00000101';

// Your 16 bytes binary pseudo-random initialization vector
$iv = '10011111 10111110 00011010 10100011 00111001 01100010 10011111 00000010 
10011001 11101101 00101011 10000111 00101001 00001011 00101000 10111011';


$sql = "SELECT usr_reset, usr_name FROM core_usr WHERE usr_email='$email'";
$result = $dbc->query($sql);

if ($result->num_rows > 0) {

	// output data of each row

	while($row = $result->fetch_assoc()) {

		//echo "id: " . $row["usr_reset"]. " - Name: " . $row["usr_name"]. "<br>";

		if(empty($row["usr_reset"])){

			$tokenOK = 0;

		} else {

			$token = $row["usr_reset"];
			
			// decrypted data
			$decrypted  = openssl_decrypt($token, 'AES-128-CBC', $salt, 1, $iv);

			// if 24 hours subtracted from the present time is older than the requested time token
			if((time()-(60*60*24)) < strtotime($decrypted)){
				
				// output
				$tokenOK = 1;

			} else {

				// token expired
				$tokenOK = 0;

			}        	
		}

	}

} else {

	echo "0 results";

}

if($urlEmailCHECK === 1 && $tokenOK === 1){

	$usr_pwd = password_hash($password, PASSWORD_DEFAULT);

	$sql = "UPDATE core_usr SET usr_pwd='$usr_pwd', usr_reset=NULL WHERE usr_email='$email'";

	if ($dbc->query($sql) === TRUE) {

		echo "OK";

	} else {

		echo "ERROR_2";
	
	}

}

?>