<?php

/* ============================================================
	SETUP START VARIABLES START
============================================================ */

	require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

	$item_id = $_REQUEST["itemid"];
	$p_id = $_REQUEST["coreid"];

	$sqlPARA="SELECT * FROM p_item WHERE item_id = $item_id LIMIT 1";
	$resultPARA=mysqli_query($conn,$sqlPARA);
	$num_rowsPARA = mysqli_num_rows($resultPARA);
	$rowPARA = mysqli_fetch_array($resultPARA, 1);
	
	$item_pos = $rowPARA['item_pos'];
	$item_type = $rowPARA['item_type'];

	mysqli_free_result($resultPARA);

	$sqlIMAGE="SELECT * FROM item_slide WHERE slide_nr='$p_id'";
	$resultIMAGE=mysqli_query($conn,$sqlIMAGE);
	$num_rowsIMAGE = mysqli_num_rows($resultIMAGE);
	$y = 1;

	$filename_Array = array();

	while ($rowIMAGE = mysqli_fetch_array($resultIMAGE, 1)) {
		$filename_Array[] = $rowIMAGE['slide_file'];
		//$item_file = $rowIMAGE['slide_file'];
		$y++;
	}
	mysqli_free_result($resultIMAGE);

/* ============================================================
	SETUP START VARIABLES END
============================================================ */


	include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/content/project/inc/bits/remove-pos-shift.php');


/* ============================================================
	REMOVE ITEM START
============================================================ */

	//$filename = $filename_Array[0];

	

	for ($q = 0; $q <= count($filename_Array); $q++) {

		$folders = array("100", "200", "300", "400", "500", "origin");
		$thumb_path = $_SERVER['DOCUMENT_ROOT'] .'/img/project/slide';

		foreach ($folders as $folder) {

			if ( @unlink ( $thumb_path.'/'.$folder.'/'.$filename_Array[$q] ) ) {

				//echo 'The file <strong><span style="color:green;">' . $thumb_path.'/'.$folder.'/'.$filename_Array[$q] . '</span></strong> was deleted!<br />';

			} else {

				//echo 'Couldn\'t delete the file <strong><span style="color:red;">' . $thumb_path.'/'.$folder.'/'.$filename_Array[$q] . '</span></strong>!<br />';

			}
		}

	}



	$sql = "DELETE FROM p_item WHERE item_type='slideshow'";

	if ($conn->query($sql) === TRUE) {

		//echo "Record deleted successfully";

	} else {

		echo "Error deleting record: " . $conn->error;

	}

	$sql2 = "DELETE FROM item_slide WHERE slide_nr='$p_id'";

	if ($conn->query($sql2) === TRUE) {

		//echo "Record deleted successfully";
		echo 'OK';

	} else {

		//echo "Error deleting record: " . $conn->error;

	}


/* ============================================================
  REMOVE ITEM END
============================================================ */

?>