<div id="popUpWrap">
	
	<div id="closePopUp" onclick="closePopUp()">&times;</div>
	
	<div id="popUp" class="verticalAlignElement">

		<div id="popUpInner">

			<br>

			<span><span id="popUpCount"></span> Projects selected</span>

			<br><br>

			<span>How do you want to recover them?</span>

			<br>

			<select id="struc_type" onchange="getStrucOps()">
				<option value=""></option>
				<option value="archive">Archived Page</option>
				<option value="unique">Unique Page</option>
			</select>

			<br><br>

			<div id="strucResults"></div>
			<div id="cat-results"></div>
			<div id="sub-cat-results"></div>
			<div id="submit-trash-process" class="btn_tmp_04" onclick="requestTrashRecoverProcess()"><span>OK </span></div>
			
			
		</div>

	</div>	

</div>

<div class="bit-15" style="padding:40px 10px;">

	<div style="height:30px;width:100%;text-align:left;">
		<br>
		<div id="pag_load" style="display:none;">ich lade gerade...</div>
	</div>

	<br><br>
		
	<?php

	if($searchType == 'MASTER'){

		echo '
			<a href="/'.$archiveTarget.'">
				<button class="accordion accAll">ALL '.strtoupper($archiveTarget).'</button><br><br>
			</a>	
		';

		$sql="SELECT cat_title,cat_slug,cat_link FROM struc_cat WHERE cat_link='$archiveTarget' ORDER BY cat_slug ASC";
		$result=mysqli_query($conn,$sql);
		$num_rows = mysqli_num_rows($result);
		$x = 1;

		while ($row = mysqli_fetch_array($result, 1)) {

			$newcat = $row['cat_slug'];
			$newarch = $row['cat_link'];

			echo'
				<button class="accordion">'.$row['cat_title'].'</button>
				<div class="panel">
			';

			echo '
				<div style="padding:10px 0px;">
				<a href="/'.$archiveTarget.'/'.$newcat.'">
					<div style="margin:0px 0px;padding-right:10px;">
						<span style="background-color:#333;font-size:14px;font-family:Helvetica;letter-spacing:1px;color:white;padding:7px;cursor:pointer;">ALL</span>
					</div>
				</a>
				</div>

			';

			$subCatSQL="SELECT sub_cat_title,sub_cat_slug FROM struc_sub_cat WHERE sub_cat_link='$newcat' ORDER BY sub_cat_slug ASC";
			$subCatRESULT=mysqli_query($conn,$subCatSQL);
			$subCatCOUNT = mysqli_num_rows($subCatRESULT);
			
			while ($subCatROW = mysqli_fetch_array($subCatRESULT, 1)) {

				if(strlen($subCatROW['sub_cat_title'])>10){

					$shortSubCatName = substr($subCatROW['sub_cat_title'],0,10);
					$shortSubCatName = $shortSubCatName.'..';

				} else {

					$shortSubCatName = $subCatROW['sub_cat_title'];

				}

				echo'
					<div style="">	
						<a href="/'.$archiveTarget.'/'.$newcat.'/'.$subCatROW['sub_cat_slug'].'">
							<div style="margin:0px 0px;padding-right:10px;">
								<span class="catNavItem">'.$shortSubCatName.'</span>
							</div>
						</a>
					</div>	
				';	

			}

			echo'</div>';

			$x++;
		}

		mysqli_free_result($result);

	} else {

		$sql="SELECT sub_cat_title,sub_cat_slug FROM struc_sub_cat WHERE sub_cat_link='$searchType' ORDER BY sub_cat_slug ASC";
		$result=mysqli_query($conn,$sql);
		$num_rows = mysqli_num_rows($result);
		$x = 1;

		if($num_rows != 0){

			echo '

				<a href="/'.$archiveTarget.'">
				<button class="accordion accAll">ALL '.$searchType.'</button>
				<br><br>
				</a>
				
				<button class="accordion activeit">Categories</button>
			';

			echo '<div class="panel show">';

			while ($row = mysqli_fetch_array($result, 1)) {

				$newcat = $row['sub_cat_slug'];

				$sql2=("SELECT * from p_core WHERE p_sub_cat='$newcat' AND (p_draft='0') AND (p_pub='1') LIMIT 1");
				$result2 = $conn->query($sql2);

				if ($result2->num_rows > 0) {

					$row2 = $result2->fetch_assoc();

					if(strlen($row['sub_cat_title'])>10){

						$shortSubCatName = substr($row['sub_cat_title'],0,10);
						$shortSubCatName = $shortSubCatName.'..';

					} else {

						$shortSubCatName = $row['sub_cat_title'];

					}

					echo'				
						<div style="">
							<a href="/'.$archiveTarget.'/'.$row['sub_cat_slug'].'" style="">
								<div style="margin:0px 0px;padding-right:10px;">
									<span class="catNavItem">'.$shortSubCatName.'</span>
								</div>
							</a>
						</div>
							
					';
							
				} else {
					//echo "0 results";
				}
				$x++;
			}
			echo '</div>';
			mysqli_free_result($result);
		}

	}

	if($trashmode == true){
		echo '<div style="cursor:pointer;" onclick="checkAll()">check all</div>';
		echo '<br>';
		echo '<div style="cursor:pointer;" onclick="unCheckAll()">uncheck all</div>';
		echo '<br>';
		echo '<div id="a-trash" style="cursor:pointer;" onclick="getCB(this)">recover all checked</div>';
		echo '<br>';
		echo '<div id="d-trash" style="cursor:pointer;" onclick="getCB(this)">permanent delete all checked</div>';
	}
	
	?>

</div>

