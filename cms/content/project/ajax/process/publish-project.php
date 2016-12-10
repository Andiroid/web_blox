<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

$p_id = $_POST['p_id'];
$p_draft = $_POST['p_draft'];

//echo $p_id;
//echo $p_draft;




$sql = "UPDATE p_core SET p_draft='$p_draft' WHERE p_id='$p_id'";

if ($conn->query($sql) === TRUE) {
	//echo "Record updated successfully";
	echo 'OK';
} else {
	//echo "Error updating record: " . $conn->error;
}




?>