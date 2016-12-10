<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

	include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/lib/core_functions.php');

	include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/lib/file_functions.php');

	include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/lib/gfx_functions.php');

	include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/lib/rewrite_functions.php');

	if(isset($_POST["p_id"])) {

		$p_id = $_POST["p_id"];

	}

	/* ============================================================
		SETUP CORE PROJECT VARIABLES START
	============================================================ */

		$sql="SELECT * FROM p_core WHERE p_id='$p_id'";
		$result=mysqli_query($conn,$sql);
		$num_rows = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result, 1);
		$p_id = $row['p_id'];
		$p_key = $row['p_key'];
		$p_title = $row['p_title'];
		$p_slug = $row['p_slug'];
		$p_file = $row['p_file'];
		$p_cat = $row['p_cat'];
		$p_sub_cat = $row['p_sub_cat'];
		$p_pub = $row['p_pub'];
		$p_created = $row['p_created'];
		$p_check = $row['p_check'];
		$p_draft = $row['p_draft'];
		$imgtodelete = $row['p_file'];

	/* ============================================================
		SETUP CORE PROJECT VARIABLES END
	============================================================ */

	$updateSUCCESS = 0;

	if(isset($_POST["p_title"])) {

		$p_title = $_POST["p_title"];
		$new_p_slug = create_slug($p_title);

		if($p_key == 'startpage'){

			$sql = "UPDATE struc_core SET struc_title='$p_title', struc_slug='$new_p_slug' WHERE struc_key='startpage'";

			if ($conn->query($sql) === TRUE) {
				$updateSUCCESS = 1;
			} else {
				$updateSUCCESS = 0;
				//echo "Error updating record: " . $conn->error;
			}

			// important edit old startpage rule in htaccess file
			newStartPageRules($new_p_slug, $p_slug);
			
		}
		if($p_key == 'unique'){

			$sql = "UPDATE struc_core SET struc_title='$p_title', struc_slug='$new_p_slug' WHERE struc_key='unique'";

			if ($conn->query($sql) === TRUE) {
				$updateSUCCESS = 1;
			} else {
				$updateSUCCESS = 0;
				//echo "Error updating record: " . $conn->error;
			}

			// important edit old startpage rule in htaccess file
			//newUniqueRules($new_p_slug, $p_slug);
			editUniqueRules($new_p_slug, $p_slug);
			delUniquePage($p_slug);
			createUniquePage($new_p_slug);
		}		
		$sql = "UPDATE p_core SET p_title='$p_title', p_slug='$new_p_slug' WHERE p_id='$p_id'";
		
		if ($conn->query($sql) === TRUE) {
			//echo "Record updated successfully";
			$updateSUCCESS = 1;
		} else {
			$updateSUCCESS = 0;
			//echo "Error updating record: " . $conn->error;
		}

	}

	if(isset($_POST["p_pub"])) {

		$p_pub = $_POST["p_pub"];

		$sql = "UPDATE p_core SET p_pub='$p_pub' WHERE p_id='$p_id'";

		if ($conn->query($sql) === TRUE) {
			//echo "Record updated successfully";
			$updateSUCCESS = 1;
		} else {
			$updateSUCCESS = 0;
			//echo "Error updating record: " . $conn->error;
		}

	}

	if(isset($_POST["p_date"])) {

		$p_created = $_POST['p_date'];
		$phpdate = strtotime( $p_created );
		$p_created = date( "Y-m-d H:i:s", $phpdate );

		$sql = "UPDATE p_core SET p_created='$p_created' WHERE p_id='$p_id'";

		if ($conn->query($sql) === TRUE) {
			//echo "Record updated successfully";
			$updateSUCCESS = 1;
		} else {
			$updateSUCCESS = 0;
			//echo "Error updating record: " . $conn->error;
		}

	}

	if(isset($_POST["p_cat"])) {

		$p_cat = $_POST["p_cat"];

		$sql = "UPDATE p_core SET p_cat='$p_cat' WHERE p_id='$p_id'";

		if ($conn->query($sql) === TRUE) {
			//echo "Record updated successfully";
			$updateSUCCESS = 1;
		} else {
			$updateSUCCESS = 0;
			//echo "Error updating record: " . $conn->error;
		}

	}

	if(isset($_POST["p_sub_cat"])) {

		$p_sub_cat = $_POST["p_sub_cat"];

		$sql = "UPDATE p_core SET p_sub_cat='$p_sub_cat' WHERE p_id='$p_id'";

		if ($conn->query($sql) === TRUE) {
			//echo "Record updated successfully";
			$updateSUCCESS = 1;
		} else {
			$updateSUCCESS = 0;
			//echo "Error updating record: " . $conn->error;
		}

	}

	if(isset($_FILES['fileUPLOAD']['name'][0])) {

		/* ============================================================
			REMOVE OLD IMAGE START
		============================================================ */

			$filename = $p_file;

			$folders = array("100", "200", "300", "400", "500", "origin");
			$thumb_path = $_SERVER['DOCUMENT_ROOT'] .'/img/project/core';

			foreach ($folders as $folder) {

				if ( @unlink ( $thumb_path.'/'.$folder.'/'.$filename ) ) {

					//echo 'The file <strong><span style="color:green;">' . $thumb_path.'/'.$folder.'/'.$filename . '</span></strong> was deleted!<br />';

				} else {

					//echo 'Couldn\'t delete the file <strong><span style="color:red;">' . $thumb_path.'/'.$folder.'/'.$filename . '</span></strong>!<br />';

				}
			}

		/* ============================================================
			REMOVE OLD IMAGE END
		============================================================ */

		/* ============================================================
			ADD NEW IMAGE END
		============================================================ */

			$target_dir = $_SERVER['DOCUMENT_ROOT'] ."/img/project/core/origin/";
			$target_file = basename($_FILES["fileUPLOAD"]["name"][0]);

			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			$date = date("_Y_m_d_h_i_s");
			$target_file = preg_replace('/\\.[^.\\s]{3,4}$/', '', $target_file) . ($date) . "." .pathinfo($target_file,PATHINFO_EXTENSION);
			$out = $target_file ;
			$target_file_name = $target_file;
			$target_file = $target_dir.$target_file;

			if (move_uploaded_file($_FILES["fileUPLOAD"]["tmp_name"][0], $target_file)) {

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

		/* ============================================================
			ADD NEW IMAGE END
		============================================================ */

		/* ============================================================
			UPDATE DB START
		============================================================ */


			$sql = "UPDATE p_core SET p_file='$out' WHERE p_id='$p_id'";

			if ($conn->query($sql) === TRUE) {
				//echo "Record updated successfully";
				$updateSUCCESS = 1;
			} else {
				$updateSUCCESS = 0;
				//echo "Error updating record: " . $conn->error;
			}

		/* ============================================================
			UPDATE DB END
		============================================================ */

	}

	if ($updateSUCCESS == 1){
		echo '<span class="c_g">SAVED</span>';
	} else {
		echo '<span class="c_r">NOTHING CHANGED</span>';
	}

?>