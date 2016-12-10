<div class="bit-70 artist-archiv-main-bit" style="margin:4% 0%;padding:0% 1%;">

	<div id="archiveTitle" class="bit-2" style="padding-top:60px;">
		
		<div class="projectTITLE" style="float:left;font-size:23px;"><?php echo $projectTITLE; ?></div>

		<?php
		
			$orderedMode =  $json['strings_archive'][3][$sys_data['lang']];

			$orderedTarget = $json['strings_archive'][0][$sys_data['lang']];

			echo '

				<div class="searchTITLE" style="float:left;padding-top:8px;">

					<span style="font-family:Helvetica;color:#3f3f3f;font-size:15px;padding-left:10px;">
						'.$json['strings_archive'][4][$sys_data['lang']].$orderedMode.'
					</span>

					<span style="color:red;">
						'.$orderedTarget.'
					</span>

				</div>

			';

		?>

	</div>

	<div class="bit-2" style="position:relative;z-index:99;">

		<div class="pag_ctrl_t" style="padding-top:60px;text-align:right;">
			<button class="pag_prev" onclick="prevPage();">&lt;</button>
				&nbsp; &nbsp; <b class="pag_label"><?php echo $json['strings_archive'][1][$sys_data['lang']]; ?> 1 <?php echo $json['strings_archive'][2][$sys_data['lang']]; ?> <?php echo $finalINDEX ?></b> &nbsp; &nbsp; 
			<button class="pag_next" onclick="nextPage();">&gt;</button>
		</div>

	</div>

	<div class="break"><br></div>

	<div style="height:100%;">

		<div id="pag_results">

			<?php echo $output; ?>

		</div>

	</div>

	<div class="break"><br></div>

	<div id="pag_ctrl_b" style="text-align:right;">
		<button class="pag_prev" onclick="prevPage();">&lt;</button>
			&nbsp; &nbsp; <b class="pag_label">Page 1 of <?php echo $finalINDEX ?></b> &nbsp; &nbsp; 
		<button class="pag_next" onclick="nextPage();">&gt;</button>
	</div>

	<div class="break40"><br></div>

</div>