<!-- ===========================================================
FOOTER START
============================================================ -->

<div style="clear:both;"></div>

<div id="footerwrap" style="background-color:#333;">

	<div id="footer" class="navx themeBG" style="padding:2% 0px;">

		<div class="container">

			<div style="width:100%;text-align:center;">
				
				<br style="clear:both;">

				<div class="copyright">
					<a href="/">www.examvple.com/a>
					<p>&copy; 2016  Your Name or Company</p>
				</div>

				<style>
					#gp-btn{width:20%;height:auto;}
					@media screen and (max-width: 800px) {
						#gp-btn{width:50%;}
					}

				</style>

				<?php

					if($AndroidApp == true){	
						#echo 'Wilkommen auf der Kunstcafe App';
					} else{

						echo '
								<a href="https://play.google.com/store/apps/details?id=info.andreasleitzmueller.andreasleitzmueller" target="_blank">
								<img id="gp-btn" src="/img/core/googleplay.png" alt="">
								</a>
							';

					}

				?>
				
			</div>

		</div>

	</div>

</div>


<!-- ===========================================================
FOOTER END
============================================================ -->



