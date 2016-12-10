 <?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

$thisID = $_POST['p_id'];
//echo $thisID;




	/* ============================================================
		SETUP CORE PROJECT VARIABLES START
	============================================================ */

		$sql="SELECT * FROM p_core WHERE p_id='$thisID'";
		$result=mysqli_query($conn,$sql);
		$num_rows = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result, 1);
		$thisID = $row['p_id'];
		$p_title = $row['p_title'];
		$p_file = $row['p_file'];
		$p_cat = $row['p_cat'];
		$p_sub_cat = $row['p_sub_cat'];
		$p_pub = $row['p_pub'];
		$p_created = $row['p_created'];
		$p_check = $row['p_check'];
		$p_draft = $row['p_draft'];

	/* ============================================================
		SETUP CORE PROJECT VARIABLES END
	============================================================ */


$dataString = $thisID.'|'.$p_title.'|'.$p_file.'|'.$p_cat.'|'.$p_sub_cat.'|'.$p_pub.'|'.$p_created.'|'.$p_check.'|'.$p_draft.'||';


echo $dataString;



?>