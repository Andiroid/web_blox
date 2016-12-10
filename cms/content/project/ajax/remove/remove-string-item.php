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

/* ============================================================
	SETUP START VARIABLES END
============================================================ */


	include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/content/project/inc/bits/remove-pos-shift.php');


/* ============================================================
	REMOVE ITEM START
============================================================ */

	$sql = "DELETE FROM p_item WHERE item_id='$item_id'";

	if ($conn->query($sql) === TRUE) {

		//echo "Record deleted successfully";
		//header('Location: '.$_SERVER['REQUEST_URI']);
		//echo 'OK';

	} else {

		//echo "Error deleting record: " . $conn->error;

	}

	$sql2 = "DELETE FROM item_string WHERE string_nr='$item_id'";

	if ($conn->query($sql2) === TRUE) {

		//echo "Record deleted successfully";
		//header('Location: '.$_SERVER['REQUEST_URI']);
		echo 'OK';

	} else {

		//echo "Error deleting record: " . $conn->error;
	}

/* ============================================================
	REMOVE ITEM END
============================================================ */

?>