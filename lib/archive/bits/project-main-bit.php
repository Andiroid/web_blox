<div class="bit-20">	
	<br>
</div>

<div class="bit-60">


	
	<div class="mobiletop"></div>


	<div style="padding:0px 0px;">
						
		<?php

			$projectCoreSQL="SELECT * FROM p_core WHERE p_slug='$p_slug' LIMIT 1";
			$projectCoreRESULT=mysqli_query($conn,$projectCoreSQL);
			$projectCoreCOUNT = mysqli_num_rows($projectCoreRESULT);
			$projectCoreROW = mysqli_fetch_array($projectCoreRESULT, 1);
			$p_id = $projectCoreROW['p_id'];
			$p_key = $projectCoreROW['p_key'];
			$p_title = $projectCoreROW['p_title'];
			$p_img = $projectCoreROW['p_file'];
			$p_txt = $projectCoreROW['p_txt'];
			$p_pub = $projectCoreROW['p_pub'];
			$p_draft = $projectCoreROW['p_draft'];
			$p_created = $projectCoreROW['p_created'];
			mysqli_free_result($projectCoreRESULT);

			if($user['group'] == 2) {
				echo '<a class="admineditbutton" href="/cms/content/project/edit?id='.$p_id.'&amp;key='.$p_key.'"><span style="">&#9998;</span></a>

				<div id="'.$p_id.'-trash" onclick="trashProject(this)"><img style="height:25px;width:25px;" src="/img/core/trash.svg" alt=""></div>
				';
			}

			/*
			if($p_pub == '0'){
				if (!$auth->isLoggedIn()) {
					header('Location: ' . '/');
				}
			}

			if($p_draft == '1'){
				if (!$auth->isLoggedIn()) {
					header('Location: ' . '/');
				}
			}
			*/
			//echo $p_id;
			$sql="SELECT * FROM p_item WHERE item_nr='$p_id' ORDER BY item_pos ASC";
			$result=mysqli_query($conn,$sql);
			$num_rows = mysqli_num_rows($result);
			$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$end = end(explode('/', $url));
			//$end = urldecode($end);
			$x = 1;
			if($num_rows == 0){

				if (isset($p_id)){
				
					echo '<div class="empty">EMTPY</div>';
				
				} else {
				
					echo "<div class='verticalAlignElement' style='text-align:center;margin:15% 0px;'><h2 class='c_r'>OOPS !!</h2>
					<h4>I couldn't find a Snippet called:<h4>
					<span class='c_g3'>".$end."</span><br><br><br>
					<a href='/snippets'><- back to the archives</a></div>";
				
				}


			} else {

				$phpdate = strtotime( $p_created );
				$p_created = date( 'd-m-Y H:i:s', $phpdate );

				echo '
				<h2 style="width:100%;text-align:center;padding-bottom:10px">'.$p_title.'</h2>
				<h5 style="width:100%;text-align:center;padding-bottom:30px">uploaded - 


				'.$p_created.' 

				</h5>
				';

				while ($row = mysqli_fetch_array($result, 1)) {

					echo'
						<div class="project-item-wrap">

							<div class="bit-1 project-item">

								<div class="project-item-header"></div>

								<div class="project-item-body">
							';

				if ($row['item_type']=='string'){

					$thisItemID = $row['item_id'];

					$sql3="SELECT * FROM item_string WHERE string_nr='$thisItemID' ORDER BY string_id DESC";
					$result3=mysqli_query($conn,$sql3);
					$num_rows3 = mysqli_num_rows($result3);
					$x3 = 1;

					while ($row3 = mysqli_fetch_array($result3, 1)) {

						echo'

							<div class="string">'.$row3['string_payload'].'</div>

						';

						$x3++;
					}

					mysqli_free_result($result3);

				}

				if($row['item_type']=='slideshow'){

					$thisItemID = $row['item_id'];
					$p_id = $p_id;
					//$p_id = $row['item_id'];
					include_once($_SERVER['DOCUMENT_ROOT'] . '/inc/bits/project-slideshow.php');
				
				}

				if($row['item_type']=='image'){

					$thisItemID = $row['item_id'];


					$sql4="SELECT * FROM item_img WHERE img_nr='$thisItemID' ORDER BY img_id DESC";
					$result4=mysqli_query($conn,$sql4);
					$num_rows4 = mysqli_num_rows($result4);
					$x4 = 1;

					while ($row4 = mysqli_fetch_array($result4, 1)) {

						echo '
							<div class="image">
								<img src="/img/project/image/400/'.$row4['img_file'].'"/>
							</div>
						';

						$x4++;
					}

					mysqli_free_result($result4);

				}

							echo'
								</div>

								<div class="project-item-footer"><br></div>

							</div>
						</div>

					';
					$x++;
				}
			}

			//mysqli_free_result($result);

		?>

	</div>

</div>

<div class="bit-20">
	<br>
</div>