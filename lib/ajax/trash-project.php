<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

	$id = $_POST['id'];

	function trashProject($id) {

		global $conn;

		/* ============================================================
			GET PROJECT DATA START
		============================================================ */

			$sql="SELECT p_key, p_slug, p_title FROM p_core WHERE p_id='$id'";
			$result=mysqli_query($conn,$sql);
			$num_rows = mysqli_num_rows($result);

			while($row = mysqli_fetch_assoc($result)) {
				$key = $row["p_key"];
				$title = $row["p_title"];
				$slug = $row["p_slug"];
			}

		/* ============================================================
			GET PROJECT DATA END
		============================================================ */

		if($key == 'unique'){

			$sql = "UPDATE struc_core SET struc_trash='1' WHERE struc_slug='$slug'";

			if ($conn->query($sql) === TRUE) {
				echo "Project RECOVERED successfully";
			} else {
				echo "Error updating record: " . $conn->error;
			}

		}

		$sql = "UPDATE p_core SET p_trash='1' WHERE p_id='$id'";

		if ($conn->query($sql) === TRUE) {
			echo "Project RECOVERED successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}

	}

trashProject($id);

?>