<?php 

	include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/lib/file_functions.php');

	include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/lib/rewrite_functions.php');

	function permanentDeleteProject($id) {

		global $conn;

		/* ============================================================
			GET PROJECT DATA START
		============================================================ */

			$sql="SELECT p_key, p_slug, p_title, p_file FROM p_core WHERE p_id='$id'";
			$result=mysqli_query($conn,$sql);
			$num_rows = mysqli_num_rows($result);

			while($row = mysqli_fetch_assoc($result)) {
				$key = $row["p_key"];
				$title = $row["p_title"];
				$slug = $row["p_slug"];
				$file = $row["p_file"];
			}

		/* ============================================================
			GET PROJECT DATA END
		============================================================ */

		/* ============================================================
			DELETE PROCESS START
		============================================================ */

			if($key == 'unique'){

				removeCatRules($slug);
				delUniquePage($slug);

				$sql = "DELETE FROM struc_core WHERE struc_slug='$slug'";

				if ($conn->query($sql) === TRUE) {
					//echo "Record deleted successfully";
				} else {
					//echo "Error deleting record: " . $conn->error;
				}
			}

			//if($key == 'archive'){

			//}
		

			/* ============================================================
				REMOVE PROJECT IMAGE START
			============================================================ */

			function unlinkImgs($file, $target, $sub) {

				$filename = $file;

				$folders = array("100", "200", "300", "400", "500", "origin");
				$thumb_path = $_SERVER['DOCUMENT_ROOT'] .'/img/'.$target.'/'.$sub;

				foreach ($folders as $folder) {

					if ( @unlink ( $thumb_path.'/'.$folder.'/'.$filename ) ) {
						echo 'deleted '.$sub. 'images';
						//echo 'The file <strong><span style="color:green;">' . $thumb_path.'/'.$folder.'/'.$filename . '</span></strong> was deleted!<br />';

					} else {
						//echo 'not deleted ';
						//echo 'Couldn\'t delete the file <strong><span style="color:red;">' . $thumb_path.'/'.$folder.'/'.$filename . '</span></strong>!<br />';

					}
				}
			}
			unlinkImgs($file, 'project', 'core');
			/* ============================================================
				REMOVE PROJECT IMAGE END
			============================================================ */

			/* ============================================================
				DELETE ITEM PROCESS START
			============================================================ */

				/* ============================================================
					ITEM CORE DATA START
				============================================================ */

					$sql="SELECT item_id, item_type FROM p_item WHERE item_nr='$id'";
					$result=mysqli_query($conn,$sql);
					$num_rows = mysqli_num_rows($result);

					if($num_rows > 0){

						while($row = mysqli_fetch_assoc($result)) {
							
							$item_id = $row["item_id"];
							$type = $row["item_type"];

							if($type == 'string'){

								$sql = "DELETE FROM item_string WHERE string_nr='$item_id'";

								if ($conn->query($sql) === TRUE) {
									//echo "Record deleted successfully";
								} else {
									echo "Error deleting record: " . $conn->error;
								}

							}

							if($type == 'image'){
								
								$sql="SELECT img_file FROM item_img WHERE img_nr='$item_id'";
								$result=mysqli_query($conn,$sql);
								$num_rows = mysqli_num_rows($result);

								while($row = mysqli_fetch_assoc($result)) {
									$item_image_file = $row["img_file"];

								}

								$sql = "DELETE FROM item_img WHERE img_nr='$item_id'";

								if ($conn->query($sql) === TRUE) {
									//echo "Record deleted successfully";
								} else {
									echo "Error deleting record: " . $conn->error;
								}

								unlinkImgs($item_image_file, 'project', 'image');

							}

							if($type == 'slideshow'){

								$sql="SELECT slide_file FROM item_slide WHERE slide_nr='$id'";
								$result=mysqli_query($conn,$sql);
								$num_rows = mysqli_num_rows($result);

								while($row = mysqli_fetch_assoc($result)) {
									
									$item_slide_file = $row["slide_file"];

									$sql = "DELETE FROM item_slide WHERE slide_nr='$id'";

									if ($conn->query($sql) === TRUE) {
										//echo "Record deleted successfully";
									} else {
										echo "Error deleting record: " . $conn->error;
									}

									unlinkImgs($item_slide_file, 'project', 'slide');

								}

							}

						}

						$sql = "DELETE FROM p_item WHERE item_nr='$id'";

						if ($conn->query($sql) === TRUE) {
							//echo "Record deleted successfully";
						} else {
							echo "Error deleting record: " . $conn->error;
						}

					}

				/* ============================================================
					ITEM CORE DATA END
				============================================================ */

			/* ============================================================
				DELETE ITEM PROCESS END
			============================================================ */

			/* ============================================================
				DELETE PROJECT TAGS START
			============================================================ */



					$sql="SELECT tag_id FROM p_tag WHERE tag_nr='$id'";
					$result=mysqli_query($conn,$sql);
					$num_rows = mysqli_num_rows($result);

					if($num_rows > 0){

						while($row = mysqli_fetch_assoc($result)) {
							$tag_id = $row["tag_id"];
							$sql = "DELETE FROM p_tag WHERE tag_id='$tag_id'";

							if ($conn->query($sql) === TRUE) {
								echo "Record deleted successfully";
							} else {
								echo "Error deleting record: " . $conn->error;
							}						
						}


					}

					$sql="SELECT time_id FROM p_time WHERE time_nr='$id'";
					$result=mysqli_query($conn,$sql);
					$num_rows = mysqli_num_rows($result);

					if($num_rows > 0){

						while($row = mysqli_fetch_assoc($result)) {
							$time_id = $row["time_id"];
							$sql = "DELETE FROM p_time WHERE time_id='$time_id'";

							if ($conn->query($sql) === TRUE) {
								echo "Record deleted successfully";
							} else {
								echo "Error deleting record: " . $conn->error;
							}						
						}


					}


			/* ============================================================
				DELETE PROJECT TAGS END
			============================================================ */

			$sql = "DELETE FROM p_core WHERE p_id=$id";

			if ($conn->query($sql) === TRUE) {
				//echo "Record deleted successfully";
			} else {
				//echo "Error deleting record: " . $conn->error;
			}

		/* ============================================================
			DELETE PROCESS END
		============================================================ */
	}

	function reactivateArchiveProject($id, $archive, $category, $subcategory) {

		global $conn;

		$sql = "UPDATE p_core SET p_key='archive', p_arch='$archive', p_cat='$category', p_sub_cat='$subcategory', p_trash='0' WHERE p_id='$id'";

		if ($conn->query($sql) === TRUE) {
			echo "Project RECOVERED successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}

	}

	function reactivateUniqueProject($id) {

		global $conn;

		/* ============================================================
			GET CURRENT TITLE & SLUG START
		============================================================ */

			$sql="SELECT p_slug, p_title FROM p_core WHERE p_id='$id'";
			$result=mysqli_query($conn,$sql);
			$num_rows = mysqli_num_rows($result);

			while($row = mysqli_fetch_assoc($result)) {
				$newUniqueTitle = $row["p_title"];
				$newUniqueSlug = $row["p_slug"];
			}

		/* ============================================================
			GET CURRENT TITLE & SLUG END
		============================================================ */

		/* ============================================================
			INSERT STRUCTURE CORE START
		============================================================ */

			$sql="SELECT * FROM struc_core";
			$result=mysqli_query($conn,$sql);
			$num_rows = mysqli_num_rows($result);
			$struc_pos = $num_rows;

			$sql = "INSERT INTO struc_core (struc_title, struc_slug, struc_key, struc_pos)
			VALUES ('$newUniqueTitle', '$newUniqueSlug', 'unique', '$struc_pos')";

			if ($conn->query($sql) === TRUE) {

				createUniquePage($p_slug);
				newUniqueRules($p_slug);

			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

		/* ============================================================
			INSERT STRUCTURE CORE END
		============================================================ */

		/* ============================================================
			CREATE FILE & ADD REWRITE RULE START
		============================================================ */

			createUniquePage($newUniqueSlug);
			newUniqueRules($newUniqueSlug);
		/* ============================================================
			CREATE FILE & ADD REWRITE RULE END
		============================================================ */

		/* ============================================================
			UPDATE TARGET PROJECT CORE START
		============================================================ */

			$sql = "UPDATE p_core SET p_key='unique', p_arch='', p_cat='', p_sub_cat='', p_trash='0' WHERE p_id='$id'";

			if ($conn->query($sql) === TRUE) {
				echo "Project RECOVERED successfully";
			} else {
				//echo "Error updating record: " . $conn->error;
			}

		/* ============================================================
			UPDATE TARGET PROJECT CORE END
		============================================================ */

	}

	require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

	if(isset($_POST['r'])){
		$r = $_POST['r'];
	}
	
	if(isset($_POST['idARR'])){
		$idARR = $_POST['idARR'];
		$idARR = json_decode($idARR); 
	}

	if(isset($_POST['struc'])){
		$struc = $_POST['struc'];
	}

	if($struc == 'archive'){
		$arch = $_POST['arch'];
		$cat = $_POST['cat'];
		$subcat = $_POST['subcat'];
	}

	for ($x = 0; $x < count($idARR); $x++) {

		if($r == 'a'){

			//activate
			if($struc == 'archive'){
				reactivateArchiveProject($idARR[$x],$arch,$cat,$subcat);
			}

			if($struc == 'unique'){
				reactivateUniqueProject($idARR[$x]);
			}

		}

		if($r == 'd'){

			//delete
			permanentDeleteProject($idARR[$x]);

		}

	}

?>