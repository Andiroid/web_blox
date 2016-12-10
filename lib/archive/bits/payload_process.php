<?php

/* ============================================================
  COLLECT RESULT OUTPUT START
============================================================ */

	$itemCount = 0;

	$fullSlots = array();

	while($resultROW = mysqli_fetch_array($resultsQUERY, 1)){

		/* ============================================================
			SETUP METATATA START
		============================================================ */

			$project_created = $resultROW["p_created"];
			$project_sub_cat = $resultROW["p_sub_cat"];
			$project_cat = $resultROW["p_cat"];
			$phpdate = strtotime( $project_created );
			$project_created = date( 'd-m-Y H:i:s', $phpdate );
			$project_title = $resultROW["p_title"];
			$project_id = $resultROW["p_id"];
			$project_slug = $resultROW["p_slug"];
			$link_title = urlencode($resultROW["p_title"]);

		/* ============================================================
			SETUP METATATA END
		============================================================ */

		/* ============================================================
		  GET CORE TAGS START
		============================================================ */
		
			$p_id = $resultROW["p_id"];

			$sql="SELECT * FROM p_tag WHERE tag_nr='$p_id'";
			$result=mysqli_query($conn,$sql);
			$num_rows = mysqli_num_rows($result);
			$tagCount = 1;

			if ($num_rows == 0){

				$coreTags = 'no tags';

			} else {

				while ($tagROW = mysqli_fetch_array($result, 1)) {

					if ($tagCount == 1){

						$coreTags .= $tagROW['tag_value'];

					} else {

						$coreTags .= '<span style="color:black;">, </span>'.$tagROW['tag_value'];

					}

					$tagCount++;
				}

			}

			mysqli_free_result($result);

		/* ============================================================
		  GET CORE TAGS END
		============================================================ */


		/* ============================================================
		  COLLECT FULL ITEMS START
		============================================================ */
			
			if($project_cat == 'default'){
				$project_cat = '';
			} else {
				$project_cat = $project_cat.'/';
			}

			if($project_sub_cat == 'default'){
				$project_sub_cat = '';
			} else {
				$project_sub_cat = $project_sub_cat.'/';
			}

			if($searchType == 'MASTER'){

				$href = '/'.$archiveTarget.'/'.$project_cat.$project_sub_cat.$project_slug;
			
			} else {

				$href = '/'.$archiveTarget.'/'.$project_cat.$project_sub_cat.$project_slug;
			
			}

			if(($containerCols == 1)&&($containerRows == 1)){

				$imgsize = '400';

			} else {

				$imgsize = '300';

			}


			if($displayMode == 'archive'){

				$fullSlot = '

						<a class="archiv-link a_disp" href="'.$href.'">

							<div class="snippet-archive-bit" style="padding:10px;">

							<div class="snippet-archive-bit-inner">

								<span class="coretitle">
									'.$project_title.'
								</span>

								<div class="coretags txtcrop">
									<span style="color:red;">'.$coreTags.'</span><br><span class="corecreated">'.$project_created.'</span>
								</div>

							</div>

						</div>

					</a>

				';

			}

			if($displayMode == 'visual'){
				$quote = "'";
				$fullSlot = '
					
					<a class="archiv-link a_disp" href="'.$href.'">

						<div style="width:100%;padding:10px;">

							<div class="archiveBitTitle">
								'.$project_title.'
							</div>

							<div class="archive-image-wrap desaturate" style="background-image: url('.$quote.'/img/project/core/'.$imgsize.'/'.$resultROW["p_file"].$quote.');"></div>

							<div class="txtcrop">

								<div class="c_g3" style="height:30px;">
									text here
								</div>

							</div>

						</div>

					</a>

				';

			}

			if($trashmode == true){

				$fullSlot = '
					
					
							<div class="snippet-archive-bit" style="padding:10px;">

							<div class="snippet-archive-bit-inner">

								<span class="coretitle">
									'.$project_title.'
								</span>
								<div style="position:absolute;right:15px;top:15px;">

<input type="checkbox" name="trashCB" id="checkboxG-'.$project_id.'" class="css-checkbox" />
				<label for="checkboxG-'.$project_id.'" class="css-label" style="color:#fff;"></label><br>
								</div>

								<div class="coretags txtcrop">
									<span style="color:red;">'.$coreTags.'</span><br><span class="corecreated">'.$project_created.'</span>
								</div>

							</div>

						</div>

				';

			}

			$fullSlots[] = $fullSlot;

			$itemCount++;

			$coreTags = '';

		/* ============================================================
		  COLLECT FULL ITEMS END
		============================================================ */
		
	}

	/* ============================================================
	  DEFINE EMPTY ITEMS START
	============================================================ */

		if($displayMode == 'archive'){

			$emptySlot = '

				<p class="archiv-link mobile-hide">
					<div class="snippet-archive-bit mobile-hide" style="padding:10px;">
						<div class="snippet-archive-bit-inner issetArchiveBit">
							<span>
								
							</span>
							<div class="txtcrop">
								<br>
							</div>
						</div>
					</div>
				</p>

			';

		}

		if($displayMode == 'visual'){

			$emptySlot = '

				<a class="a_disp">

					<div style="width:100%;padding:10px;" class="mobile-hide">

						<div>
							<br>
						</div>

						
							<div class="archive-image-wrap desaturate" style="background-image: url(/img/core/leer.png);">     
							</div>

						<div class="txtcrop">

							<div class="c_g3" style="height:30px;">
								<br>
							</div>

						</div>

					</div>

				</a>

			';

		}
			if($trashmode == true){

				$emptySlot = '
					
				<p class="archiv-link mobile-hide">
					<div class="snippet-archive-bit mobile-hide" style="padding:10px;">
						<div class="snippet-archive-bit-inner issetArchiveBit">
							<span>
								
							</span>
							<div class="txtcrop">
								<br>
							</div>
						</div>
					</div>
				</p>
				';

			}
	/* ============================================================
	  DEFINE EMPTY ITEMS END
	============================================================ */


	/* ============================================================
	  FILL BY MODE START
	============================================================ */

		if($fillMode == 0){

			$outputCount = 0;
			$rowCount = 0;

			$output .= '<div class="archive-bit-'.$containerCols.'">';

			while($outputCount < $containerPAYLOAD){

				if($rowCount == $containerRows){
					$output .= '<div class="darkFrame"><br></div></div><div class="archive-bit-'.$containerCols.'">';
					$rowCount = 0;
				}

				if(isset($fullSlots[$outputCount])){

					$output .= $fullSlots[$outputCount];

				} else {

					$output .= $emptySlot;

				}
				
				$outputCount ++;
				$rowCount ++;
			}

			$output .= '<div class="darkFrame"><br></div></div>';

		}

		if($fillMode == 1){

			$outputCount = 0;
			$rowCount = 0;

			while($outputCount < $containerPAYLOAD){

				if($rowCount == $containerCols){
					$output .= '<div class="break"><br></div>';
					$rowCount = 0;
				}

				if(isset($fullSlots[$outputCount])){

					$output .= '<div class="archive-bit-'.$containerCols.'">'.$fullSlots[$outputCount].'</div>';

				} else {

					$output .= '<div class="archive-bit-'.$containerCols.'">'.$emptySlot.'</div>';

				}
				
				$outputCount ++;
				$rowCount ++;
			}


		} 

	/* ============================================================
	  FILL BY MODE END
	============================================================ */


	/* ============================================================
	  SETUP TITLE & COUNT
	============================================================ */

		$projectTITLE = '<div style="color:red;width:30px;float:left;">'.$setupCOUNT.'</div> '.$requestSubCat.' '.$requestCat;

	/* ============================================================
	  SETUP TITLE & COUNT
	============================================================ */


/* ============================================================
  COLLECT RESULT OUTPUT END
============================================================ */

?>