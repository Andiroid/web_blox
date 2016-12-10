<?php

	$createCatSQL = "INSERT INTO struc_core (struc_check) VALUES ('0')";

	if ($conn->query($createCatSQL) === TRUE) {

		$req_id = $conn->insert_id;

	} else {

		echo "Error: " . $sql . "<br>" . $conn->error;

	}

	include($_SERVER['DOCUMENT_ROOT'] . '/cms/content/archive/ajax/bits/image_upload.php');

	createArchivePage($req_slug);
	newMasterArchiveRules($req_slug);
		
	$sql = " UPDATE struc_core 

			 SET struc_file='$req_file',
			 	 struc_key='archive',
			 	 struc_title='$req_title', 
			 	 struc_slug='$req_slug',
			 	 struc_align='$req_align',
			 	 struc_mode='$req_mode',
			 	 struc_cols='$req_cols',
			 	 struc_rows='$req_rows',
			 	 struc_check='1' 

			 WHERE struc_id='$req_id' 

			";

	if ($conn->query($sql) === TRUE) {

		echo'OK';
	}

?>