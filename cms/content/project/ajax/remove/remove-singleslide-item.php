<?php

/* ============================================================
	SETUP START VARIABLES START
============================================================ */

	require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

	$item_id = $_REQUEST["itemid"];
	$p_id = $_REQUEST["coreid"];

	$sqlIMAGE="SELECT * FROM item_slide WHERE slide_id = $item_id LIMIT 1";
	$resultIMAGE=mysqli_query($conn,$sqlIMAGE);
	$num_rowsIMAGE = mysqli_num_rows($resultIMAGE);
	$rowIMAGE = mysqli_fetch_array($resultIMAGE, 1);

	$item_file = $rowIMAGE['slide_file'];

	mysqli_free_result($resultIMAGE);

/* ============================================================
	SETUP START VARIABLES END
============================================================ */


/* ============================================================
	REMOVE ITEM START
============================================================ */

	$filename = $item_file;

	
	$folders = array("100", "200", "300", "400", "500", "origin");
	$thumb_path = $_SERVER['DOCUMENT_ROOT'] .'/img/project/slide';

	foreach ($folders as $folder) {

		if ( @unlink ( $thumb_path.'/'.$folder.'/'.$filename ) ) {

			//echo 'The file <strong><span style="color:green;">' . $thumb_path.'/'.$folder.'/'.$filename . '</span></strong> was deleted!<br />';

		} else {

			//echo 'Couldn\'t delete the file <strong><span style="color:red;">' . $thumb_path.'/'.$folder.'/'.$filename . '</span></strong>!<br />';

		}
	}


	$sql = "DELETE FROM item_slide WHERE slide_id='$item_id'";


	if ($conn->query($sql) === TRUE) {

		//echo "Record deleted successfully";
		echo 'OK';

	} else {

		echo "Error deleting record: " . $conn->error;

	}




/* ============================================================
  REMOVE ITEM END
============================================================ */

?>