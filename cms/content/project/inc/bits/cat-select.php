
<!--—————————————————————————————————————————————————————————————————————————————————
	PANEL 1 START
———————————————————————————————————————————————————————————————————————————————————-->

	<!--—————————————————————————————————————————————————————————————————————————————————
		SELECT CATEGORY START
	———————————————————————————————————————————————————————————————————————————————————-->	 					
		<div class="accordion">Category</div>
		<div class="panel">

			<label for="p_cat">Category</label>
			<select id="p_cat" onchange="getValidSubCats()" name="p_cat">
			
	<?php

		$sql="SELECT * FROM struc_cat WHERE cat_slug='$p_cat'";
		$result=mysqli_query($conn,$sql);
		$num_rows = mysqli_num_rows($result);
		$x = 1;
		while ($row = mysqli_fetch_array($result, 1)) {
			echo'				
				<option value="'.$row['cat_slug'].'">'.$row['cat_title'].'</option>
			';
			$x++;
		}
		mysqli_free_result($result);

		echo '<option value="default">Default</option>';

		$sql="SELECT * FROM struc_cat ORDER BY cat_id DESC";
		$result=mysqli_query($conn,$sql);
		$num_rows = mysqli_num_rows($result);
		$x = 1;

		while ($row = mysqli_fetch_array($result, 1)) {
			echo'				
				<option value="'.$row['cat_slug'].'">'.$row['cat_title'].'</option>
			';
			$x++;
		}

		mysqli_free_result($result);
	?>
						

</select>

<!--—————————————————————————————————————————————————————————————————————————————————
	SELECT CATEGORY END
———————————————————————————————————————————————————————————————————————————————————-->

	<br><br>

<!--—————————————————————————————————————————————————————————————————————————————————
	SELECT SUB-CATEGORY END
———————————————————————————————————————————————————————————————————————————————————-->

<div id="sub-cat-results">


	<?php					

		$sql="SELECT * FROM struc_sub_cat WHERE sub_cat_link='$p_cat' ORDER BY sub_cat_id DESC";
		$result=mysqli_query($conn,$sql);
		$num_rows = mysqli_num_rows($result);
		$x = 1;


			echo '<label for="p_sub_cat">Sub-Category</label>';

			echo '<select id="p_sub_cat" onchange="subCatOnChange()" name="p_sub_cat">';

		if ($num_rows == 0){

					echo'				
						<option value="default">Default</option>
					';

		} else {

			echo '<option value="'.$p_sub_cat.'">'.$p_sub_cat.'</option>';

				while ($row = mysqli_fetch_array($result, 1)) {
					echo'				
						<option value="'.$row['sub_cat_slug'].'">'.$row['sub_cat_title'].'</option>
					';
					$x++;
				}
				mysqli_free_result($result);

		}

	?>				

	</select>
	</div>
	<!--—————————————————————————————————————————————————————————————————————————————————
		SELECT SUB-CATEGORY END
	———————————————————————————————————————————————————————————————————————————————————-->

</div>						
						

