<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

$createCoreSQL = "INSERT INTO p_core (p_check) VALUES ('0')";

if ($conn->query($createCoreSQL) === TRUE) {

	$p_id = $conn->insert_id;
	echo $p_id;
	//echo "New record created successfully. Last inserted ID is: " . $p_id;

} else {

	//echo "Error: " . $sql . "<br>" . $conn->error;

}





?>