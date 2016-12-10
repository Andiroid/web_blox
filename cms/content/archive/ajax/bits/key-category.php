<?php

	$createCatSQL = "INSERT INTO struc_cat (cat_check) VALUES ('0')";

	if ($conn->query($createCatSQL) === TRUE) {

		$req_id = $conn->insert_id;

	} else {

		echo "Error: " . $sql . "<br>" . $conn->error;

	}

	include($_SERVER['DOCUMENT_ROOT'] . '/cms/content/archive/ajax/bits/image_upload.php');

	createArchivePage($req_slug);
	newCatRules($req_slug);

	$sql = " UPDATE struc_cat 

			 SET cat_file='$req_file',
			  	 cat_link='$req_link', 
			 	 cat_title='$req_title', 
			 	 cat_slug='$req_slug',
			 	 cat_align='$req_align',
			 	 cat_mode='$req_mode',
			 	 cat_cols='$req_cols',
			 	 cat_rows='$req_rows',
			 	 cat_check='1' 

			 WHERE cat_id='$req_id' 

			";

	if ($conn->query($sql) === TRUE) {

		echo'OK';
	}

?>