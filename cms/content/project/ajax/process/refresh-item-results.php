 <?php

 	if(isset($_REQUEST["coreID"])){

 		$p_id = $_REQUEST["coreID"];
 		require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");
 	}

	

	$sql="SELECT * FROM p_item WHERE item_nr='$p_id' ORDER BY item_pos ASC";
	$result=mysqli_query($conn,$sql);
	$num_rows = mysqli_num_rows($result);
	$x = 1;

	if($num_rows == 0){

		echo '<h2 style="color:red;padding:20% 0px;font-size:50px;">EMPTY</h2>';

	} else {

		while ($row = mysqli_fetch_array($result, 1)) {
			
			echo'
				<div class="project-item-wrap">
					<div class="project-item">

						<div class="project-item-header">
							№ 
							<span style="color:red;">
								' . $row['item_pos'] .'
							</span>
							Type: 
							<span style="color:red;">
								'. $row['item_type'] .'
							</span>
							';

							if ($row['item_type'] == 'string'){

									$this_String_type_item_id = $row['item_id'];
									$sqlStringTYPE="SELECT * FROM item_string WHERE string_nr = '$this_String_type_item_id' LIMIT 1";
									$resultStringTYPE=mysqli_query($conn,$sqlStringTYPE);
									$num_rowsStringTYPE = mysqli_num_rows($resultStringTYPE);
									$rowStringTYPE = mysqli_fetch_array($resultStringTYPE, 1);

									$item_string_type = $rowStringTYPE['string_type'];

									mysqli_free_result($resultStringTYPE);

								echo '
									<span style="color:#000;">
										(<span style="color:#3f3f3f;">'. $item_string_type .'</span>)
									</span>
								';

							}

							echo'
								<span onclick="removeItem(this)" id="'. $row['item_type'] . '-' . $row['item_id'] . '" class="removeItemBtn">
									&times
								</span>
						
						</div>

						<div class="project-item-body" style="overflow:hidden;">

					';

					/* ============================================================
					  ITEM BODY CONTENT START
					============================================================ */				
					
						if ($row['item_type']=='string'){

							$thisItemID = $row['item_id'];

							$sql3="SELECT * FROM item_string WHERE string_nr='$thisItemID' ORDER BY string_id DESC";
							$result3=mysqli_query($conn,$sql3);
							$num_rows3 = mysqli_num_rows($result3);
							$x3 = 1;

							while ($row3 = mysqli_fetch_array($result3, 1)) {

								echo'

									<div class="item string">'.$row3['string_payload'].'</div>

								';

								$x3++;
							}

							mysqli_free_result($result3);

						}

						if($row['item_type']=='slideshow'){

							$thisItemID = $row['item_id'];

							echo'<div class="item slideshow">';

							include_once($_SERVER['DOCUMENT_ROOT'] . '/plugin/slideshow/slideshow.php');
						
							echo'</div>';

						}

						if($row['item_type']=='image'){


							echo '<div class="item image">';

							$thisItemID = $row['item_id'];

							$sql4="SELECT * FROM item_img WHERE img_nr='$thisItemID' ORDER BY img_id DESC";
							$result4=mysqli_query($conn,$sql4);
							$num_rows4 = mysqli_num_rows($result4);
							$x4 = 1;

							if ($num_rows4 == 0){

								echo '<div class="loading"><img class="fade" src="/img/core/loading_04.gif"/></div>';

							} else {

								while ($row4 = mysqli_fetch_array($result4, 1)) {

										echo '<img class="fade" src="/img/project/image/400/'.$row4['img_file'].'"/>';

									$x4++;
								}

							}

							echo '</div>';
						}

					/* ============================================================
					  ITEM BODY CONTENT END
					============================================================ */

					echo'
						</div>

						<div class="project-item-footer"><br></div>

					</div>
				</div>

			';
			$x++;
		}
	}
?> 