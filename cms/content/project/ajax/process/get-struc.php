<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

echo '
	<label for="struc_core">Please choose an ARCHIVE</label>
	<select id="struc_core" onchange="getCat()" name="struc_core">		

				<option value=""></option>
			';

			$sql="SELECT * FROM struc_core WHERE struc_key='archive' ORDER BY struc_slug ASC";
			$result=mysqli_query($conn,$sql);
			$num_rows = mysqli_num_rows($result);
			$x = 1;

			while ($row = mysqli_fetch_array($result, 1)) {
				echo'				
					<option value="'.$row['struc_slug'].'">'.$row['struc_title'].'</option>
				';
				$x++;
			}

			mysqli_free_result($result);
echo'
							

	</select><br><br>
';
?> 