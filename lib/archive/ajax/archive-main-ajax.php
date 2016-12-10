<?php

	if(isset($_POST['rm'])){

		$requestCat = $_POST['rm'];

	}

	if(isset($_POST['rc'])){

		$requestSubCat = $_POST['rc'];

	} 

/* ============================================================
  SETUP AJAX POST VARABLES START
============================================================ */

	$currentINDEX = preg_replace('#[^0-9]#', '', $_POST['ci']);
	$alpha = $_POST['ap'];
	$searchPhrase = $_POST['sp'];
	$searchMETHOD = $_POST['sm'];

/* ============================================================
  SETUP AJAX POST VARABLES END
============================================================ */

/* ============================================================
  SETUP MAIN VARABLES START
============================================================ */

	// Specify the Master Categories to search
	$archiveTarget = $_POST['at'];

	// Specify the Master Categories to search
	$searchType = $_POST['st'];
	if($searchType == 'trashmode'){
		$trashmode = true;
	}
	// Specify the fill mode vertical or horizontal
	$fillMode = $_POST['fm'];

	// Specify the display mode visual or archive
	$displayMode = $_POST['dm'];

	// Specify how many columns per page
	$containerCols = $_POST['cc'];

	// Specify how many rows per page
	$containerRows = $_POST['cr'];

	// Calculate results per page
	$containerPAYLOAD = $_POST['cp'];

	// Calculate Payload Limit for SQL query
	$containerLimit = 'LIMIT ' .($currentINDEX - 1) * $containerPAYLOAD .',' .$containerPAYLOAD;			

/* ============================================================
  SETUP MAIN VARABLES END
============================================================ */

/* ============================================================
  CONNECT TO SQL DB START
============================================================ */

	require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

/* ============================================================
  CONNECT TO SQL DB END
============================================================ */

if($trashmode == true){

	$queryArr = array();

	if($searchMETHOD == 'alpha'){

		if($alpha != 'ALL'){

			array_push($queryArr,"WHERE p_check='1'","AND p_slug LIKE '$alpha%'");

		} else {

			array_push($queryArr,"WHERE p_check='1'");	

		}

	} elseif ($searchMETHOD == 'string') {

		array_push($queryArr,"WHERE p_check='1'","AND p_slug LIKE '%$searchPhrase%'");

	} else {

		array_push($queryArr,"WHERE p_check='1'");

	}

	$queryArr = implode(" ",$queryArr);

	/* ============================================================
		QUERY TOTAL COUNT START
	============================================================ */

		$setupSQL = "SELECT COUNT(p_id) FROM p_core $queryArr AND (p_trash='1')";

		$setupQUERY = mysqli_query($conn, $setupSQL);
		
		$setupROW = mysqli_fetch_row($setupQUERY);

		$setupCOUNT = $setupROW[0];

	/* ============================================================
		QUERY TOTAL COUNT END
	============================================================ */

	/* ============================================================
	  QUERY LIMITED RESULTS START
	============================================================ */

		$resultsSQL = "SELECT * FROM p_core $queryArr AND p_trash='1' ORDER BY p_slug ASC $containerLimit";

		$resultsQUERY = mysqli_query($conn, $resultsSQL);

		$resultsCOUNT = mysqli_num_rows($resultsQUERY);

	/* ============================================================
	  QUERY LIMITED RESULTS END
	============================================================ */

} else {

	$queryArr = array("WHERE p_draft='0'","AND p_trash='0'");

	if($searchMETHOD == 'alpha'){

		if($alpha != 'ALL'){

			array_push($queryArr,"AND p_slug LIKE '$alpha%'");

		} else {

			//array_push($queryArr,"WHERE p_draft='0'");
				
		}

	} elseif ($searchMETHOD == 'string') {

		array_push($queryArr,"AND p_slug LIKE '%$searchPhrase%'");

	} else {

		//array_push($queryArr,"WHERE p_draft='0'");

	}

	if (isset($requestCat)) {

		array_push($queryArr,"AND (p_cat='$requestCat')");

	}

	if (isset($requestSubCat)) {

		array_push($queryArr,"AND (p_sub_cat='$requestSubCat')");

	}

	if(empty($requestCat) && empty($requestSubCat)){

		if($searchType == 'MASTER' && empty($_GET['cat']) && empty($_GET['sub_cat'])){

			array_push($queryArr,"AND (p_arch='$archiveTarget')");

		}

		if($searchType != 'MASTER' && empty($_GET['cat']) && empty($_GET['sub_cat'])){

			array_push($queryArr,"AND (p_cat='$searchType')");

		}
	}

	$queryArr = implode(" ",$queryArr);

	/* ============================================================
		QUERY TOTAL COUNT START
	============================================================ */

		$setupSQL = "SELECT COUNT(p_id) FROM p_core $queryArr AND (p_pub='1')";
		$setupQUERY = mysqli_query($conn, $setupSQL);
		$setupROW = mysqli_fetch_row($setupQUERY);
		$setupCOUNT = $setupROW[0];

	/* ============================================================
		QUERY TOTAL COUNT END
	============================================================ */

	/* ============================================================
	  QUERY LIMITED RESULTS START
	============================================================ */

		$resultsSQL = "SELECT * FROM p_core $queryArr AND (p_pub='1') ORDER BY p_slug ASC $containerLimit";
		$resultsQUERY = mysqli_query($conn, $resultsSQL);
		$resultsCOUNT = mysqli_num_rows($resultsQUERY);

	/* ============================================================
	  QUERY LIMITED RESULTS END
	============================================================ */

}

/* ============================================================
  PAGINATION ALGORITHM START
============================================================ */

	// rounds the $finalINDEX average UP to the nearest integer, if necessary

	$finalINDEX = ceil($setupCOUNT/$containerPAYLOAD);

	// $finalINDEX cannot be less than 1

	if($finalINDEX < 1){

		$finalINDEX = 1;

	}

	// $currentINDEX can't be below 1, or higher than $finalINDEX

	if ($currentINDEX < 1) {

		$currentINDEX = 1; 

	} else if ($currentINDEX > $finalINDEX) { 

		$currentINDEX = $finalINDEX; 

	}

/* ============================================================
  PAGINATION ALGORITHM END
============================================================ */

if($searchMETHOD == 'alpha'){

	if ($alpha == 'ALL'){

		$orderedMode =  'mode';
		$orderedTarget = 'ALL';

	} else{

		$orderedMode = 'letter';
		$orderedTarget = $alpha;

	}

} elseif ($searchMETHOD == 'string'){

	if($searchPhrase == ''){

		$orderedMode =  'mode';
		$orderedTarget = 'ALL';

	} else {

		$orderedMode = 'word';
		$orderedTarget = $searchPhrase;

	}

} else {

	$orderedMode =  'mode';
	$orderedTarget = 'ALL';

}

$orderedBY = '

	<span style="font-family:Helvetica;color:#3f3f3f;font-size:15px;padding-left:10px;">
		ordered by '.$orderedMode.'
	</span>

	<span style="color:red;">
		'.$orderedTarget.'
	</span>

';

include_once($root . "/lib/archive/bits/payload_process.php");

/* ============================================================
  RELEASE START
============================================================ */

	$dataString .= $output.'|'.$finalINDEX.'|'.$projectTITLE.'|'.$orderedBY.'||';

	// Close your database connection
	mysqli_close($conn);

	// Echo the results back to Ajax
	echo $dataString;

	exit();

/* ============================================================
  RELEASE END
============================================================ */

?>