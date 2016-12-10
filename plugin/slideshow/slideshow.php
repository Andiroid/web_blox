

<div class="slideshow-container">
		<?php

		$sql2="SELECT slide_title,slide_file,slide_id FROM item_slide WHERE slide_nr='$p_id' ORDER BY slide_id DESC";
		$result2=mysqli_query($conn,$sql2);
		$num_rows = mysqli_num_rows($result2);
		$x = 1;
		while ($row2 = mysqli_fetch_array($result2, 1)) {

			echo'					
				<div>

					<input class="childNode" type="hidden" value="'.$row2['slide_id'].'"/>
						
					<input type="hidden" value="'.$row2['slide_file'].'"/>
						
				</div>


			';

			echo'

				<div class="indexSlides fade">
					<div class="admineditbutton addSlideshowBtn" onclick="openSlideEditor()">+</div>

					<div id="singleslide-'.$row2['slide_id'].'" class="admineditbutton" onclick="removeItem(this)">&#9746;</div>

					<div class="numbertext" style="width:100%;text-align:left;">

						<img onclick="toggleFullScreen()" class="zoomBtn fullscreenbtn" src="/img/core/fullscreen-w.svg" alt="">
						<p>'.$x.' / '.$num_rows.'</p>

					</div>

					<img onclick="toggleFullScreen()" class="slideimg zoomBtn" src="/img/project/slide/300/'.$row2['slide_file'].'">

				</div>
				
				<div class="slideTxtWrap">

					<div class="text">'.$row2['slide_title'].'</div>

				</div>

			';

			$x++;
		}
		mysqli_free_result($result2);
	?>
	<!--<p id="error-display"></p>-->

	<div class="pause">&#9611;&#9611;</div>

	<div class="play">&#9654;</div>

	<div class="label autoslidepart">0%</div>

	<div class="progress-bar-container autoslidepart">
		<div class="slideshow-progress-bar"><br></div>
	</div>

	<a class="prev">❮</a>
	<a class="next">❯</a>

</div>

<br>

<div class="dotwrap">

	<?php

		$result2=mysqli_query($conn,$sql2);
		$x = 1;

		while ($row2 = mysqli_fetch_array($result2, 1)) {

			echo'<span class="dot" id="'.$x.'"></span>';$x++;

		}

	?>

</div>

<div class="modal-header">

	<span onclick="toggleFullScreen()" class="close">×</span>

	<div class="modal-title">

		<?php

			$result2=mysqli_query($conn,$sql2);

			while ($row2 = mysqli_fetch_array($result2, 1)) {

				echo'<div class="slideTXT modal-title">'.$row2['slide_title'].'</div>';

			}

		?>

	</div>

</div>

<div class="modal">

	<div class="modal-content">	

		<a class="prev prevZOOM">❮</a>
		<a class="next nextZOOM">❯</a>

		<div class="modal-body" onclick="toggleFullScreen()">

			<?php

				$result2=mysqli_query($conn,$sql2);

				while ($row2 = mysqli_fetch_array($result2, 1)) {

					echo'<img onclick="toggleFullScreen()" class="zoomSlides fade" src="/img/project/slide/origin/'.$row2['slide_file'].'">';

				}
				
			?>

		</div>

		<div style="width:100%;clear:both;"></div>

		<div class="modal-footer"></div>

	</div>

</div>

