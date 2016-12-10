<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

	$remove_id = $_POST['remove_id'];
	

	$sql2 = "DELETE FROM p_time WHERE time_id='$remove_id'";

	if ($conn->query($sql2) === TRUE) {

		echo 'OK';

	} else {

		//echo "Error deleting record: " . $conn->error;
		
	}



?>