<?php 
$sql="SELECT cat_title,cat_slug FROM struc_cat ORDER BY cat_slug ASC";
$result=mysqli_query($conn,$sql);
$num_rows = mysqli_num_rows($result);
$x = 1;

while ($row = mysqli_fetch_array($result, 1)) {

	$newcat = $row['cat_slug'];

	//$sql2=("SELECT * from p_core WHERE p_cat='$newcat' AND (p_draft='0') AND (p_pub='1') LIMIT 1");
	//$result2 = $conn->query($sql2);

	//if ($result2->num_rows > 0) {

		//$row2 = $result2->fetch_assoc();

			echo'
				<div class="navACC" onclick="triggerAcc(this)">'.$row['cat_title'].'</div>
				<div class="navpanel">
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

		
			
			echo'
				</div>

			';

	//} else {
		//echo "0 results";
	//}
	
	$x++;
}

mysqli_free_result($result);
?>