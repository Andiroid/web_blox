<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

	// get the q parameter from URL
	$cat = $_REQUEST["cat"];

	$sql="SELECT * FROM struc_cat WHERE cat_link='$cat' ORDER BY cat_id DESC";
	$result=mysqli_query($conn,$sql);
	$num_rows = mysqli_num_rows($result);
	$x = 1;

		echo '<label for="p_cat">Please choose a CATEGORY</label><br>';

		echo '<select id="p_cat" onchange="getSubCat()" name="p_cat">';

	if ($num_rows == 0){

				echo'
					<option value=""></option>		
					<option value="default">Default</option>
				';

	} else {

				//not needed when add project
				//echo '<option value="'.$p_cat.'">'.$p_cat.'</option>';
			echo '
				<option value=""></option>
				<option value="default">Default</option>
			';
			while ($row = mysqli_fetch_array($result, 1)) {
				echo'				
					<option value="'.$row['cat_slug'].'">'.$row['cat_title'].'</option>
				';
				$x++;
			}
			mysqli_free_result($result);

	}


	echo '</select><br><br>';

?> 