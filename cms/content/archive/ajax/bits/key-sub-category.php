<?php

	$createCatSQL = "INSERT INTO struc_sub_cat (sub_cat_check) VALUES ('0')";

	if ($conn->query($createCatSQL) === TRUE) {

		$req_id = $conn->insert_id;

	} else {

		echo "Error: " . $sql . "<br>" . $conn->error;

	}

	include($_SERVER['DOCUMENT_ROOT'] . '/cms/content/archive/ajax/bits/image_upload.php');

	//createArchivePage($req_slug);
	//newCatRules($req_slug);

	$sql = " UPDATE struc_sub_cat 

			 SET sub_cat_file='$req_file',
			  	 sub_cat_link='$req_link', 
			 	 sub_cat_title='$req_title', 
			 	 sub_cat_slug='$req_slug',
			 	 sub_cat_align='$req_align',
			 	 sub_cat_mode='$req_mode',
			 	 sub_cat_cols='$req_cols',
			 	 sub_cat_rows='$req_rows',
			 	 sub_cat_check='1' 

			 WHERE sub_cat_id='$req_id' 

			";

	if ($conn->query($sql) === TRUE) {

		echo'OK';

	}

?>