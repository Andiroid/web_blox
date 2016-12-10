<?php 

	require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

	$p_id = $_POST['p_id'];
	$time_value = $_POST["time_value"];

	$phpdate = strtotime( $time_value );
	$time_value = date( "Y-m-d H:i:s", $phpdate );

	$sql = "INSERT INTO p_time (time_nr, time_value) VALUES ('$p_id', '$time_value')";

	if ($conn->query($sql) === TRUE) {
		//echo "Record updated successfully";
		echo 'OK';
	} else {
		//echo "Error updating record: " . $conn->error;
	}




?>