<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

	$p_id = $_POST['p_id'];
	//echo $p_id;
	$sql="SELECT * FROM p_tag WHERE tag_nr='$p_id'";
	$result=mysqli_query($conn,$sql);
	$num_rows = mysqli_num_rows($result);
	$x = 1;

	if ($num_rows == 0){

		echo '<div style="padding:3px;style="font-size:25px;line-height:25px;">no <span class="c_r">keywords</span> yet</div>';

	} else {

		echo '<br>';
		echo '<hr style="margin:5px;">';

		while ($row = mysqli_fetch_array($result, 1)) {

			echo'
				
				<div style="cursor:default;padding:3px;style="font-size:25px;line-height:25px;">
					'.$row['tag_value'].'
					<span class="c_r" id="tag-'.$row['tag_id'].'" onclick="removeCoreTag(this)" style="cursor:pointer;float:right;font-size:25px;line-height:15px;padding-left:-20px;padding-right:10px;font-weight:900;">
						&times
					</span>
				</div>
			
			';

			//if ($x < $num_rows){

				echo '<hr style="margin:5px;">';

			//}

			$x++;
		}

	}

	mysqli_free_result($result);

?>