<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

	// get the q parameter from URL
	$cat = $_REQUEST["cat"];

	$sql="SELECT * FROM struc_sub_cat WHERE sub_cat_link='$cat' ORDER BY sub_cat_id DESC";
	$result=mysqli_query($conn,$sql);
	$num_rows = mysqli_num_rows($result);
	$x = 1;

		echo '<label for="p_sub_cat">Please choose a SUB-CATEGORY</label><br>';

		echo '<select id="p_sub_cat" onchange="subCatOnChange()" name="p_sub_cat">';

	if ($num_rows == 0){

			echo '
				<option value=""></option>
				<option value="default">Default</option>
			';

	} else {
			echo '
				<option value=""></option>
				<option value="default">Default</option>
			';
				//not needed when add project
				//echo '<option value="'.$p_sub_cat.'">'.$p_sub_cat.'</option>';


			while ($row = mysqli_fetch_array($result, 1)) {
				echo'				
					<option value="'.$row['sub_cat_slug'].'">'.$row['sub_cat_title'].'</option>
				';
				$x++;
			}
			mysqli_free_result($result);

	}


	echo '</select><br><br>';

?> 