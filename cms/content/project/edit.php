<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

if($user['group'] != 2) {
	header('Location: ' . '/');
}

	/* ============================================================
		GET ID FROM URL START
	============================================================ */

		if(isset($_GET['id'])){
			$p_id = $_GET['id'];
		}

		if(isset($_GET['key'])){
			$p_key = $_GET['key'];
		}

		//echo $p_key;

	/* ============================================================
		GET ID FROM URL START
	============================================================ */


	/* ============================================================
		SETUP CORE PROJECT VARIABLES START
	============================================================ */

		$sql="SELECT * FROM p_core WHERE p_id='$p_id'";
		$result=mysqli_query($conn,$sql);
		$num_rows = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result, 1);
		$p_id = $row['p_id'];
		$p_key = $row['p_key'];
		$p_title = $row['p_title'];
		$p_file = $row['p_file'];
		$p_cat = $row['p_cat'];
		$p_sub_cat = $row['p_sub_cat'];
		$p_pub = $row['p_pub'];
		$p_created = $row['p_created'];
		$p_check = $row['p_check'];
		$p_draft = $row['p_draft'];
		$imgtodelete = $row['p_file'];

		$coreDate = new DateTime($p_created);


	/* ============================================================
		SETUP CORE PROJECT VARIABLES END
	============================================================ */
?>

<!DOCTYPE html>

<html>
	<head>
		<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/inc/parts/head.php');?>
	</head>
<body>
  
	<div id="main_frame">
	
		<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/inc/parts/nav.php');?>

		<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/inc/parts/nav.php');?>

		<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'){include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/inc/bits/history-go-2-btn.php');}else{include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/inc/bits/back-btn.php');}?>

		<!--—————————————————————————————————————————————————————————————————————————————————
			LEFT BIT START
		———————————————————————————————————————————————————————————————————————————————————-->

			<div class="bit-20" style="text-align:center;padding:0px 5px;">
				

					<br>
					
					<div style="padding:10px;">

						<?php include ($root.'/cms/content/project/inc/bits/edit-project.php'); ?>

					</div>
					
				
	
			</div>

		<!--—————————————————————————————————————————————————————————————————————————————————
			LEFT BIT END
		———————————————————————————————————————————————————————————————————————————————————-->

		<!--—————————————————————————————————————————————————————————————————————————————————
			MAIN BIT START
		———————————————————————————————————————————————————————————————————————————————————-->

			<div class="bit-60" style="text-align:center;">

				<!--—————————————————————————————————————————————————————————————————————————————————
					ITEM RESULTS HEAD START
				———————————————————————————————————————————————————————————————————————————————————-->

					<h2 id="metaDataTitle"></h2>
					<h4 id="metaDataDate"></h4>

				<!--—————————————————————————————————————————————————————————————————————————————————
					ITEM RESULTS HEAD END
				———————————————————————————————————————————————————————————————————————————————————-->

				<!--—————————————————————————————————————————————————————————————————————————————————
					ITEM RESULTS START
				———————————————————————————————————————————————————————————————————————————————————-->

					<div id="itemRESULTS">
						<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/content/project/ajax/process/refresh-item-results.php'); ?>
					</div>

				<!--—————————————————————————————————————————————————————————————————————————————————
					ITEM RESULTS END
				———————————————————————————————————————————————————————————————————————————————————-->

			</div>

		<!--—————————————————————————————————————————————————————————————————————————————————
			MAIN BIT END
		———————————————————————————————————————————————————————————————————————————————————-->
		
		<!--—————————————————————————————————————————————————————————————————————————————————
			RIGHT BIT START
		———————————————————————————————————————————————————————————————————————————————————-->

			<style>
				#metaDataWrap{padding:0px 20px;}
				#metaDataInner{text-align:left;}
				#metaDataInner div{color:#4f4f4f;font-size:15px;line-height:23px;}
				#metaDataInner div span{color:black;}
			</style>

			<div class="bit-20" style="text-align:center;">

				<div id="metaDataWrap">
					<div id="metaDataInner">
					<div>Type: 
						<span>
							<?php
							if($p_key == 'unique'){
								$p_key_out = 'Unique Project';
							}
							if($p_key == 'archive'){
								$p_key_out = 'Archived Project';
							}
							if($p_key == 'startpage'){
								$p_key_out = 'Startpage Project';
							}
							echo $p_key_out;
							?>
						</span>
					</div>
					<div>ID: <span id="metaDataId"></span></div>
					<div>Privacy: <span id="metaDataPub"></span></div>
					<div>Category: <span id="metaDataCat"></span></div>
					<div>Sub-Cat: <span id="metaDataSubCat"></span></div>
					<div>Draft-State: <span id="metaDataDraft"></span></div>
					<br>
					</div>
				</div>

				<!--—————————————————————————————————————————————————————————————————————————————————
					EDITOR START
				———————————————————————————————————————————————————————————————————————————————————-->

					<div id="itemEditor" class="itemEditor">

						<div class="editor-content">

							<div id="editorRESULTS">
								
							</div>

						</div>

					</div>			

				<!--—————————————————————————————————————————————————————————————————————————————————
					EDITOR END
				———————————————————————————————————————————————————————————————————————————————————-->

				<!--—————————————————————————————————————————————————————————————————————————————————
					GET ADD EDITOR BUTTONS START
				———————————————————————————————————————————————————————————————————————————————————-->

					<button id="string-editor_btn"  onclick="openAddEditor(this)" class="button_tmp_03">
						<span>add text </span>
					</button>

					<button id="image-editor_btn"  onclick="openAddEditor(this)" class="button_tmp_03">
						<span>add image </span>
					</button>

					<button id="slideshow-editor_btn"  onclick="openAddEditor(this)" class="button_tmp_03">
						<span>add slide </span>
					</button>

				<!--—————————————————————————————————————————————————————————————————————————————————
					GET ADD EDITOR BUTTONS END
				———————————————————————————————————————————————————————————————————————————————————-->


				<!--—————————————————————————————————————————————————————————————————————————————————
					PREVIEW BUTTON START
				———————————————————————————————————————————————————————————————————————————————————-->

					<br><br>

					<a href="/cms/content/project/preview?id=<?php echo $p_id;?>" target="_blank">preview</a>

					<br><br>

				<!--—————————————————————————————————————————————————————————————————————————————————
					PREVIEW BUTTON END
				———————————————————————————————————————————————————————————————————————————————————-->


				<!--—————————————————————————————————————————————————————————————————————————————————
					PUBLISH FORM START
				———————————————————————————————————————————————————————————————————————————————————-->

					
					<div id="publishRESULTS">
					
						<?php 

							if($p_draft == 1){
								echo '
									
									<button id="publish-0" onclick="publishProject(this)" style="background-color:#4f4f4f !important;font-size:15px;" class="button_tmp_00"><span>publish </span></button>

								';

							} else {
								echo '
									<button id="publish-1" onclick="publishProject(this)" style="background-color:#4f4f4f !important;font-size:15px;" class="button_tmp_00"><span>draft </span></button>

								';
																						
							}
						?>
						
					</div>

				<!--—————————————————————————————————————————————————————————————————————————————————
					PUBLISH FORM END
				———————————————————————————————————————————————————————————————————————————————————-->

			</div>

		<!--—————————————————————————————————————————————————————————————————————————————————
			RIGHT BIT END
		———————————————————————————————————————————————————————————————————————————————————-->

		<div class="break40"><br></div>

	  <?php include ($_SERVER['DOCUMENT_ROOT'] . '/inc/parts/footer.php'); ?>

	</div>

	<script type="text/javascript">

	var coreID = <?=json_encode($p_id)?>;
	var coreKEY = <?=json_encode($p_key)?>;
	//var lastItemPos = <?=json_encode($last_item_pos)?>;
	var newItemID;






	</script>

	<script src="/cms/content/project/js/project-edit.js"></script>


<?php include ($root.'/inc/parts/static-bottom.php'); ?>





