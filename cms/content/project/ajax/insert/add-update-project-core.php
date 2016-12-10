<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

	include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/lib/core_functions.php');

	include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/lib/file_functions.php');

	include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/lib/gfx_functions.php');

	include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/lib/rewrite_functions.php');

	$createCoreSQL = "INSERT INTO p_core (p_check) VALUES ('0')";

	if ($conn->query($createCoreSQL) === TRUE) {

		$p_id = $conn->insert_id;

	} else {
		//echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$p_created = date( "Y-m-d H:i:s");
	$p_key = $_POST['p_key'];
	$p_title = $_POST['p_title'];
	$p_pub = $_POST['p_pub'];
	$p_cat = $_POST['p_cat'];
	$p_sub_cat = $_POST['p_sub_cat'];

	$target_dir = $_SERVER['DOCUMENT_ROOT'] ."/img/project/core/origin/";
	$target_file = basename($_FILES["fileUPLOAD"]["name"][0]);

	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	$date = date("_Y_m_d_h_i_s");
	$target_file = preg_replace('/\\.[^.\\s]{3,4}$/', '', $target_file) . ($date) . "." .pathinfo($target_file,PATHINFO_EXTENSION);
	$out = $target_file ;
	$target_file_name = $target_file;
	$target_file = $target_dir.$target_file;

	if (move_uploaded_file($_FILES["fileUPLOAD"]["tmp_name"][0], $target_file)) {

		//echo "The file ". basename( $_FILES["fileUPLOAD"]["name"]). " has been uploaded.";

		$target_filename = preg_replace('/\\.[^.\\s]{3,4}$/', '', basename($_FILES["fileUPLOAD"]["name"][0])) . ($date) . "." .pathinfo($target_file,PATHINFO_EXTENSION);

		$thumbFolders = array("100", "200", "300", "400", "500");
		$thumbSizes = array(100, 300, 600, 900, 1200);
		$input_path = $_SERVER['DOCUMENT_ROOT'] .'/img/project/core/origin/';
		$output_path = $_SERVER['DOCUMENT_ROOT'] .'/img/project/core';
		$input_name = $out;
		$output_name = $out;
		$x = 0;

		if (strtoupper($imageFileType) == 'SVG'){

			$file = $_SERVER['DOCUMENT_ROOT'] .'/img/project/core/origin/'.$out;
			//$newfile = $_SERVER['DOCUMENT_ROOT'] .'/img/project/image/test.svg';

			foreach ($thumbFolders as $thumbFolderName) {
				$x++;
				if (!copy($file, $output_path.'/'.$thumbFolderName.'/'.$output_name)) {
					//echo 'failed to copy '.$file.'..';
				}
			}

		} else {
		
			foreach ($thumbFolders as $thumbFolderName) {
				$x++;
				createThumb($input_path.$input_name , $output_path.'/'.$thumbFolderName.'/'.$output_name, $thumbSizes[$x-1], $quality=100);
			}					
		}
	}

	$sql="SELECT * FROM struc_cat WHERE cat_slug='$p_cat'";
	$result=mysqli_query($conn,$sql);
	$num_rows = mysqli_num_rows($result);
	$row = mysqli_fetch_array($result, 1);
	$cat_arch = $row['cat_link'];

	$p_slug = create_slug($p_title);

	$updateCoreSQL = ("

		UPDATE p_core

		SET p_file='$out'
			,p_cat='$p_cat'
			,p_arch='$cat_arch'
			,p_key='$p_key'
			,p_sub_cat='$p_sub_cat'
			,p_title='$p_title'
			,p_slug='$p_slug'
			,p_pub='$p_pub'
			,p_created='$p_created'
			,p_draft='1'
			,p_check='1'

		WHERE p_id='$p_id'

	");

	if ($conn->query($updateCoreSQL) === TRUE) {

		if($p_key == 'unique'){
			$sql="SELECT * FROM struc_core";
			$result=mysqli_query($conn,$sql);
			$num_rows = mysqli_num_rows($result);
			$struc_pos = $num_rows;

			$sql = "INSERT INTO struc_core (struc_title, struc_slug, struc_key, struc_pos)
			VALUES ('$p_title', '$p_slug', '$p_key', '$struc_pos')";

			if ($conn->query($sql) === TRUE) {

				createUniquePage($p_slug);
				newUniqueRules($p_slug);

				// signals OK
				echo $p_id;

			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}

		if($p_key == 'archive'){
			// signals OK
			echo $p_id;
		}

	} else {
		//echo "Error: " . $sql . "<br>" . $conn->error;
	}

?>