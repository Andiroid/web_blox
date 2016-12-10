<div class="bit-15">

	<div class="break"><br></div>
	
	<div id="alphaSquareWrap" class="alphaSquareWrap" style="position:relative;margin-top:80px;display:inline-block;">

		<?php
if($trashmode == true){
	$queryArr = "WHERE p_trash='1'";
}
			$alphas = range('A', 'Z');

			for ($alphaCount = 0; $alphaCount < count($alphas); $alphaCount++) {

				$thisALPHA = $alphas[$alphaCount];

				$sql2 = "SELECT p_title FROM p_core $queryArr AND p_slug LIKE '$thisALPHA%' LIMIT 1";

				$result2 = $conn->query($sql2);
				
				if ($result2->num_rows > 0) {

					$row2 = $result2->fetch_assoc();

					echo '

						<div onclick="loadAlphpaResults(this)" id="'.$alphas[$alphaCount].'" class="alphaSquareOuter">
							<aside class="alphaSquareInner validAlpha">
								<span class="verticalAlignElement">'.$alphas[$alphaCount].'</span>
							</aside>
							<div></div>
						</div>

					';

				} else {

					echo '

						<div class="alphaSquareOuter">
							<aside class="alphaSquareInner invalidAlpha">
								<span class="verticalAlignElement">'.$alphas[$alphaCount].'</span>
							</aside>
							<div></div>
						</div>

					';

				}

			}

			echo '

				<div onclick="loadAlphpaResults(this)" id="ALL" class="alphaSquareOuter alphaSquareOuterDouble">
					<aside class="alphaSquareInner validAlpha activeAlpha">
						<span class="verticalAlignElement">'.$json['strings_archive'][0][$sys_data['lang']].'</span>
					</aside>
					<div></div>
				</div>

			';

		?>

	</div>

</div>

<div class="break40"><br></div>