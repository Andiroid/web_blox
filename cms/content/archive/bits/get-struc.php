<?php

	if($req_key == 'archive'){

		echo '

			<br><br>

			New Archive Title:<br><br>
			
			<input id="title" placeholder="New Archive Title" type="text" maxlength="60" name="cat_title"/>

			';
	}

	if($req_key == 'category'){

		echo 'Choose Parent Archive:<br><br><select name="" id="link">';

		$archSQL="SELECT * FROM struc_core WHERE struc_key='archive' ORDER BY struc_slug ASC";
		$archRESULT=mysqli_query($conn,$archSQL);
		$archCOUNT = mysqli_num_rows($archRESULT);
		$archiveData = array();

		while ($archROW = mysqli_fetch_array($archRESULT, 1)) {

			$archiveId = $archROW['struc_id'];
			$archiveTitle = $archROW['struc_title'];
			$archiveSlug = $archROW['struc_slug'];
		
			echo '<option value="'.$archiveSlug.'">'.$archiveTitle.'</option>';

		}

		echo '</select><br><br>';

		echo '

			<br><br>

			New Category Title:<br><br>

			<input id="title" placeholder="your new title" type="text" maxlength="60" name="cat_title"/>

			';
	}

	if($req_key == 'sub-category'){

		echo 'Choose Parent Category:<br><br><select name="" id="link">';

		$archSQL="SELECT * FROM struc_cat ORDER BY cat_slug ASC";
		$archRESULT=mysqli_query($conn,$archSQL);
		$archCOUNT = mysqli_num_rows($archRESULT);
		$archiveData = array();

		while ($archROW = mysqli_fetch_array($archRESULT, 1)) {

			$archiveId = $archROW['cat_id'];
			$archiveTitle = $archROW['cat_title'];
			$archiveSlug = $archROW['cat_slug'];
		
			echo '<option value="'.$archiveSlug.'">'.$archiveTitle.'</option>';

		}

		echo '</select><br><br>';

		echo '

			<br><br>

			New Sub Category Title:<br><br>

			<input id="title" placeholder="your new title" type="text" maxlength="60" name="cat_title"/>

			';
	}

?>





				