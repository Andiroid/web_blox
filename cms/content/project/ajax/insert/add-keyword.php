<?php 

	require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

	$p_id = $_POST['p_id'];
	$tag_value = $_POST['tag_value'];

	//echo $p_id;
	//echo $tag_value;



		$sql = "INSERT INTO p_tag (tag_nr, tag_value)
		VALUES ('$p_id', '$tag_value')";



		if ($conn->query($sql) === TRUE) {

			echo 'OK';

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}




?>