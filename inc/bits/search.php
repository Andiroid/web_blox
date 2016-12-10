
<div id="archiveTitle" class="bit-3">
	
	<div class="projectTITLE" style="text-align:left;"><?php echo $projectTITLE; ?></div>

	<div class="searchTITLE" style="">
		<span style="font-family:Helvetica;color:#3f3f3f;font-size:15px;padding-left:10px;">
			ordered by mode
		</span>
		<span style="color:red;">
			<?php echo $json['core_strings'][0]['cs_000_'.$sys_data['lang']]; ?>
		</span>
	</div>

</div>

<div class="bit-3 pag_ctrl_t" style="text-align:center;">
	<button class="pag_prev" onclick="prevPage();">&lt;</button>
		&nbsp; &nbsp; <b class="pag_label">Page 1 of <?php echo $finalINDEX ?></b> &nbsp; &nbsp; 
	<button class="pag_next" onclick="nextPage();">&gt;</button>
</div>

<div class="bit-3" style="">



		<div class="searchBarWRAP">

			<div id="searchInputAfter" onclick="animateSearch()"><img src="/img/core/magnify.svg" alt=""></div>
				<input id="searchINPUT" autocomplete="off" onkeyup="searchPAYLOAD(this.value)" maxlength="10" type="text" name="search" placeholder="Search..">	
			
			<div id="alphaSquareWrap" class="alphaSquareWrap">

				<?php

					//$searchType = 'cat';
					//$searchType = 'snippets';

					$alphas = range('A', 'Z');

					for ($x = 0; $x < count($alphas); $x++) {

						// check first result from projects by all cats to see if they are empty
						$newcat = $row['sub_cat_slug'];
						//echo $newcat;
						$thisALPHA = $alphas[$x];
						if($searchType == 'cat'){
							$sql2=("SELECT * FROM p_core WHERE p_title LIKE '$thisALPHA%' AND p_draft='0' AND p_cat='$cat' AND p_pub='1' LIMIT 1");
						}else{
							$sql2=("SELECT * FROM p_core WHERE p_title LIKE '$thisALPHA%' AND p_draft='0' AND p_sub_cat='$cat' AND p_pub='1' LIMIT 1");
						}

						$result2 = $conn->query($sql2);

						if ($result2->num_rows > 0) {

							$row2 = $result2->fetch_assoc();
							//echo "id: " . $row2["p_id"]. "<br>";
							echo '
								<div onclick="loadAlphpaResults(this)" id="'.$alphas[$x].'" class="alphaSquareOuter">
									<aside class="alphaSquareInner validAlpha">
										<span class="verticalAlignElement">'.$alphas[$x].'</span>
									</aside>
									<div></div>
								</div>
							';

						} else {

							echo '
								<div class="alphaSquareOuter">
									<aside class="alphaSquareInner invalidAlpha">
										<span class="verticalAlignElement">'.$alphas[$x].'</span>
									</aside>
									<div></div>
								</div>
							';

						}

					}

					echo '
								<div onclick="loadAlphpaResults(this)" id="ALL" class="alphaSquareOuter alphaSquareOuterDouble">
									<aside class="alphaSquareInner validAlpha activeAlpha">
										<span class="verticalAlignElement">'.$json['core_strings'][0]['cs_000_'.$sys_data['lang']].'</span>
									</aside>
									<div></div>
								</div>
					';

				?>

			</div>

		</div>



</div>
<!--
<style>
	.searchTITLE span{}
</style>
<div class="searchTITLE mobile-show-portrait" style="font-size:15px;">
	<span class="projectTITLE" style="text-align:left;font-size:15px;float:left;"><?php echo $projectTITLE; ?></span>

	<span style="font-family:Helvetica;color:#3f3f3f;font-size:15px;padding-left:10px;">
		ordered by mode
	</span>
	<span style="color:red;">
		$json['core_strings'][0]['cs_000_'.$sys_data['lang']]
	</span>
</div>

<div class="bit-3 pag_ctrl_t mobile-show-portrait" style="text-align:center;">
	<button class="pag_prev" onclick="prevPage();">&lt;</button>
		&nbsp; &nbsp; <b class="pag_label">Page 1 of <?php echo $finalINDEX ?></b> &nbsp; &nbsp; 
	<button class="pag_next" onclick="nextPage();">&gt;</button>
</div>
-->