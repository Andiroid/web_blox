<?php

	$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$urlBit = explode('/', str_ireplace(array('http://', 'https://'), '', $url));
	$archiveTarget = basename($urlBit[1], ".php");
	$currentFileName = $urlBit[1];

	if(isset($_GET['sub_cat'])){

		$requestSubCat = $_GET['sub_cat'];
		$searchForSQL = "SELECT COUNT(sub_cat_id) FROM struc_sub_cat WHERE sub_cat_slug='$requestSubCat'";
		$searchForQUERY = mysqli_query($conn, $searchForSQL);
		$searchForROW = mysqli_fetch_row($searchForQUERY);
		$searchForCOUNT = $searchForROW[0];

		if ($searchForCOUNT == 0) {
			if(count($urlBit) > 2){
				$p_slug = $requestSubCat;
			}
		}

	}

	if(isset($_GET['cat'])){

		$requestCat = $_GET['cat'];
		$searchForSQL = "SELECT COUNT(cat_id) FROM struc_cat WHERE cat_slug='$requestCat'";
		$searchForQUERY = mysqli_query($conn, $searchForSQL);
		$searchForROW = mysqli_fetch_row($searchForQUERY);
		$searchForCOUNT = $searchForROW[0];

		if($searchForCOUNT == 0){

			$searchForSQL = "SELECT COUNT(sub_cat_id) FROM struc_sub_cat WHERE sub_cat_slug='$requestCat'";
			$searchForQUERY = mysqli_query($conn, $searchForSQL);
			$searchForROW = mysqli_fetch_row($searchForQUERY);
			$searchForCOUNT = $searchForROW[0];

			if($searchForCOUNT == 0){

				$searchForSQL = "SELECT COUNT(p_id) FROM p_core WHERE p_slug='$requestCat'";
				$searchForQUERY = mysqli_query($conn, $searchForSQL);
				$searchForROW = mysqli_fetch_row($searchForQUERY);
				$searchForCOUNT = $searchForROW[0];
				$p_slug = $requestCat;

			} else {

				$requestCat = null;
				$requestSubCat = $_GET['cat'];

			}
		}
	}

	if(empty($p_slug)){

		if(isset($requestCat)){

			$sql = "SELECT * FROM struc_cat WHERE (cat_slug='$requestCat')";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {

				while($row = $result->fetch_assoc()) {

					$fillMode = $row["cat_align"];
					$searchType = $row["cat_slug"];
					$displayMode = $row["cat_mode"];
					$containerCols = $row["cat_cols"];
					$containerRows = $row["cat_rows"];

				}
			}
		}

		if(isset($requestSubCat)){

			$sql = "SELECT * FROM struc_sub_cat WHERE (sub_cat_slug='$requestSubCat')";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {

				while($row = $result->fetch_assoc()) {

					$fillMode = $row["sub_cat_align"];
					$searchType = $row["sub_cat_slug"];
					$displayMode = $row["sub_cat_mode"];
					$containerCols = $row["sub_cat_cols"];
					$containerRows = $row["sub_cat_rows"];

				}
			}
		}

		if(empty($_GET['cat']) && empty($_GET['sub_cat'])){

			$sql = "SELECT * FROM struc_core WHERE (struc_slug='$archiveTarget')";

			$result = $conn->query($sql);

			if ($result->num_rows > 0) {

				while($row = $result->fetch_assoc()) {

					$searchType = 'MASTER';
					$fillMode = $row["struc_align"];
					$displayMode = $row["struc_mode"];
					$containerCols = $row["struc_cols"];
					$containerRows = $row["struc_rows"];

				}

			} else {
				
				$sql = "SELECT * FROM struc_cat WHERE (cat_slug='$archiveTarget')";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {

					while($row = $result->fetch_assoc()) {
					
						$fillMode = $row["cat_align"];
						$searchType = $row["cat_slug"];
						$displayMode = $row["cat_mode"];
						$containerCols = $row["cat_cols"];
						$containerRows = $row["cat_rows"];

					}
				}
			}
		}

		// Specify the Current Index
		$currentINDEX = 1;

		// Calculate results per page
		$containerPAYLOAD = $containerCols * $containerRows;

		// Calculate Payload Limit for SQL query
		$containerLimit = 'LIMIT ' .($currentINDEX - 1) * $containerPAYLOAD .',' .$containerPAYLOAD;

		$queryArr = array("WHERE p_draft='0'","AND p_trash='0'");

		if (isset($requestCat)) {
			
			array_push($queryArr,"AND (p_cat='$requestCat')");

		}

		if (isset($requestSubCat)) {

			array_push($queryArr,"AND (p_sub_cat='$requestSubCat')");

		}

		if(empty($_GET['cat']) && empty($_GET['sub_cat'])){

			if($searchType == 'MASTER' && empty($_GET['cat']) && empty($_GET['sub_cat'])){

				 array_push($queryArr,"AND (p_arch='$archiveTarget')");

			}

			if($searchType != 'MASTER' && empty($_GET['cat']) && empty($_GET['sub_cat'])){

				 array_push($queryArr,"AND (p_cat='$searchType')");

			}
		}

		if ($urlBit[1] == 'cms' && $urlBit[2] == 'trash'){

			$trashmode = true;
			$fillMode = 'vertical';
			$searchType = 'trashmode';
			$displayMode = 'trashmode';
			$containerCols = 3;
			$containerRows = 100;

			// Specify the Current Index
			$currentINDEX = 1;

			// Calculate results per page
			$containerPAYLOAD = $containerCols * $containerRows;

			// Calculate Payload Limit for SQL query
			$containerLimit = 'LIMIT ' .($currentINDEX - 1) * $containerPAYLOAD .',' .$containerPAYLOAD;	

			//$queryArr = implode(" ",$queryArr);

			$setupSQL = "SELECT COUNT(p_id) FROM p_core WHERE p_trash='1'";

			$setupQUERY = mysqli_query($conn, $setupSQL);

			$setupROW = mysqli_fetch_row($setupQUERY);

			$setupCOUNT = $setupROW[0];

			/* ============================================================
				MASTER QUERY SEARCH RESULTS START
			============================================================ */

				$resultsSQL = "SELECT * FROM p_core WHERE p_trash='1' ORDER BY p_title ASC $containerLimit";
				
				$resultsQUERY = mysqli_query($conn, $resultsSQL);

				$resultsCOUNT = mysqli_num_rows($resultsQUERY);

			/* ============================================================
				MASTER QUERY SEARCH RESULTS END
			============================================================ */	

		} else {

			/* ============================================================
				MASTER QUERY TOTAL COUNT START
			============================================================ */

			$queryArr = implode(" ",$queryArr);

			$setupSQL = "SELECT COUNT(p_id) FROM p_core $queryArr AND (p_pub='1')";

			$setupQUERY = mysqli_query($conn, $setupSQL);

			$setupROW = mysqli_fetch_row($setupQUERY);

			$setupCOUNT = $setupROW[0];

			/* ============================================================
				MASTER QUERY TOTAL COUNT END
			============================================================ */

			/* ============================================================
				MASTER QUERY SEARCH RESULTS START
			============================================================ */

				$resultsSQL = "SELECT * FROM p_core $queryArr AND (p_pub='1') ORDER BY p_title ASC $containerLimit";
				
				$resultsQUERY = mysqli_query($conn, $resultsSQL);

				$resultsCOUNT = mysqli_num_rows($resultsQUERY);

			/* ============================================================
				MASTER QUERY SEARCH RESULTS END
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

		include_once($root . "/lib/archive/bits/payload_process.php");

	}

?>