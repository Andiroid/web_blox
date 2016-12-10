


<div class="masterAccordion">Project Tags</div>

<div class="masterPanel">	



		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 6 START
		———————————————————————————————————————————————————————————————————————————————————-->

		<div class="accordion">Keywords</div>

		<div class="panel">

			<!--—————————————————————————————————————————————————————————————————————————————————
				PROJECT KEYWORDS START
			———————————————————————————————————————————————————————————————————————————————————-->

				<div id="tagRESULTS">
					
					<?php


						$sql="SELECT * FROM p_tag WHERE tag_nr='$p_id'";
						$result=mysqli_query($conn,$sql);
						$num_rows = mysqli_num_rows($result);
						$x = 1;

						if ($num_rows == 0){

							echo '<div style="padding:3px;style="font-size:25px;line-height:25px;">no <span class="c_r">keywords</span> yet</div>';

						} else {

							echo '<br>';
							echo '<hr style="margin:5px;">';

							while ($row = mysqli_fetch_array($result, 1)) {

								echo'
									
									<div style="cursor:default;padding:3px;style="font-size:25px;line-height:25px;">
										'.$row['tag_value'].'
										<span class="c_r" id="tag-'.$row['tag_id'].'" onclick="removeCoreTag(this)" style="cursor:pointer;float:right;padding-left:-20px;padding-right:10px;font-size:25px;line-height:15px;font-weight:900;">
											&times
										</span>
									</div>
								
								';

								//if ($x < $num_rows){

									echo '<hr style="margin:5px;">';

								//}

								$x++;
							}

						}

						mysqli_free_result($result);

					?>

				</div>
				<br>
				
				<style>

					#addTagWrap input{
						width:80%;
						float:left;
						height:30px;
						margin-left:5%;
					}

					#addTagWrap label{
						color:green;
						cursor:pointer;
						font-family:bebas;
						font-weight:1200;
						width:5%;
						padding-left:5px;
						float:left;
						line-height:32px;
						font-size:50px;
					}

					#addTagWrap .charCountWrap{
						text-align:center;
						color:#1f1f1f;
						font-family:Helvetica;
						font-size:12px;
					}

				</style>

				<div id="addTagWrap">
					<input maxlength="20" id="add-tag" type="text" placeholder="keyword">
					<label for="add-tag" onclick="validateKEYWORD()">
					 + 
					 </label>

					<div class="break"><br></div>

					<div class="charCountWrap">
						<span class="c_r" id="char_left2"></span> Buchstaben zur Verfügung
					</div>



				</div>

				<script>

					var addTagInput = document.getElementById('add-tag');
					var addTagLabel = document.getElementById('char_left2');

					var start_length = addTagInput.value.length;
					var text_max = 20 - start_length;

					addTagLabel.innerHTML = text_max;

					addTagInput.onkeyup=function(){

						var text_length = addTagInput.value.length;
						var text_remaining = 20 - text_length;
						addTagLabel.innerHTML = text_remaining;

					};

				</script>
			<!--—————————————————————————————————————————————————————————————————————————————————
				PROJECT KEYWORDS END
			———————————————————————————————————————————————————————————————————————————————————-->

		</div>

		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 6 END
		———————————————————————————————————————————————————————————————————————————————————-->
<script>
	
/* ============================================================
	ADD CORE TAG START
============================================================ */
	var coreID = <?=json_encode($p_id)?>;



function validateKEYWORD() {

	var tag_value = document.getElementById("add-tag").value;

	var x = tag_value;
	if (x == null || x == "") {
		alert("You have to fill the KEYWORD before submit");
		return false;
	}



	addCoreKeyword();

}




	function addCoreKeyword() {
		var tag_value = document.getElementById("add-tag").value;

		//alert(draftState);

		var addCoreKeywordXHTTP;

		addCoreKeywordXHTTP = new XMLHttpRequest();

		addCoreKeywordXHTTP.onreadystatechange = function() {

			if (addCoreKeywordXHTTP.readyState == 4 && addCoreKeywordXHTTP.status == 200) {
				
				//document.getElementById('tagRESULTS').innerHTML = addCoreKeywordXHTTP.responseText;

				if(addCoreKeywordXHTTP.responseText == 'OK'){
					document.getElementById("add-tag").value = '';
					document.getElementById('char_left2').innerHTML = '20';
					refreshKeywordResults();
				}

			}

		};

		addCoreKeywordXHTTP.open("POST", "/cms/content/project/ajax/insert/add-keyword.php", true);
		addCoreKeywordXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		addCoreKeywordXHTTP.send("p_id="+coreID+"&tag_value="+tag_value);
	}

/* ============================================================
	ADD CORE TAG END
============================================================ */

/* ============================================================
	REFRESH KEYWORD RESULTS START
============================================================ */
	
	function refreshKeywordResults() {

		//alert(draftState);

		var getCoreTagsXHTTP;

		getCoreTagsXHTTP = new XMLHttpRequest();

		getCoreTagsXHTTP.onreadystatechange = function() {

			if (getCoreTagsXHTTP.readyState == 4 && getCoreTagsXHTTP.status == 200) {
				
				document.getElementById("tagRESULTS").innerHTML = getCoreTagsXHTTP.responseText;


			}

		};

		getCoreTagsXHTTP.open("POST", "/cms/content/project/ajax/process/get-core-tags.php", true);
		getCoreTagsXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		getCoreTagsXHTTP.send("p_id="+coreID);
	}

/* ============================================================
	REFRESH KEYWORD RESULTS END
============================================================ */



/* ============================================================
	REMOVE CORE TAG START
============================================================ */
	
	function removeCoreTag(transfer) {

		var removeTagID = transfer.id.split('-')[1];

		var removeCoreTagXHTTP;

		removeCoreTagXHTTP = new XMLHttpRequest();

		removeCoreTagXHTTP.onreadystatechange = function() {

			if (removeCoreTagXHTTP.readyState == 4 && removeCoreTagXHTTP.status == 200) {
				

				if(removeCoreTagXHTTP.responseText == 'OK'){

					refreshKeywordResults();
				
				}

			}

		};

		removeCoreTagXHTTP.open("POST", "/cms/content/project/ajax/remove/remove-core-tag.php", true);
		removeCoreTagXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		removeCoreTagXHTTP.send("remove_id="+removeTagID);
	}

/* ============================================================
	REMOVE CORE TAG END
============================================================ */









</script>
		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 7 START
		———————————————————————————————————————————————————————————————————————————————————-->
<style>
	#addTimeTagBtn{
		width:100%;
		text-align:center;	
		color:green;
		cursor:pointer;
		font-family:bebas;
		font-weight:1200;

		padding-left:5px;
		float:left;
		line-height:32px;
		font-size:50px;
	}
</style>
		<div class="accordion">Time-Tags</div>

		<div class="panel">

			<!--—————————————————————————————————————————————————————————————————————————————————
				PROJECT TIME TAG START
			———————————————————————————————————————————————————————————————————————————————————-->						

				<div class="bit-1" style="padding:0px 0%">
				<div id="timeTagRESULTS">
					
					<?php


						$sql="SELECT * FROM p_time WHERE time_nr='$p_id'";
						$result=mysqli_query($conn,$sql);
						$num_rows = mysqli_num_rows($result);
						$x = 1;

						if ($num_rows == 0){

							echo '<div style="padding:3px;style="font-size:25px;line-height:25px;">no <span class="c_r">timetags</span> yet</div>';

						} else {

							echo '<br>';
							echo '<hr style="margin:5px;">';

							while ($row = mysqli_fetch_array($result, 1)) {

								echo'
									
									<div style="cursor:default;padding:3px;style="font-size:25px;line-height:25px;">
										'.$row['time_value'].'
										<span class="c_r" id="time-'.$row['time_id'].'" onclick="removeTimeTag(this)" style="cursor:pointer;float:right;padding-left:-20px;padding-right:10px;font-size:25px;line-height:15px;font-weight:900;">
											&times
										</span>
									</div>
								
								';

								//if ($x < $num_rows){

									echo '<hr style="margin:5px;">';

								//}

								$x++;
							}

						}

						mysqli_free_result($result);

					?>

				</div>
					<br><br>

					<fieldset>

						<legend><h2 style="padding:0px 5px;"> Date </h2></legend>

						<div class="bit-3">
							Day<br>
							<div id="getValidDaysTimeTagRESULT">
								<input id="timeTagDay" onchange="updateCOLLECTOR('date')" class="dateInput2digit" type="number" name="year" min="1" max="<?php $number = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y")); echo $number; ?>" value="<?php echo date("d"); ?>">
							</div>
						</div>

						<div class="bit-3">							
							Month<br>
							<input id="timeTagMonth" class="dateInput2digit" onchange="getValidDaysTimeTag()" type="number" name="year" min="1" max="12" value="<?php echo date("m"); ?>">
						</div>

						<div class="bit-3">
							Year<br>
							<input id="timeTagYear" class="dateInput4digit" onchange="getValidDaysTimeTag()" type="number" name="year" min="<?php echo date('Y', strtotime('-50 year')); ?>" max="<?php echo date('Y', strtotime('+50 year')); ?>" value="<?php echo date("Y"); ?>">
						</div>


					</fieldset>

					<br>

					<fieldset>

						<legend><h2 style="padding:0px 5px"> Time </h2></legend>
						
					<div class="bit-3">
						Hour<br>
						<input id="timeTagHour" onchange="updateCOLLECTOR('date')" class="dateInput2digit" type="number" name="year" min="0" max="23" value="<?php echo date("H"); ?>">
					</div>
						
					<div class="bit-3">
						Minute<br>
						<input id="timeTagMinute" onchange="updateCOLLECTOR('date')" class="dateInput2digit" type="number" name="year" min="0" max="59" value="<?php echo date("i"); ?>">
					</div>
						
					<div class="bit-3">
						Second<br>
						<input id="timeTagSecond" onchange="updateCOLLECTOR('date')" class="dateInput2digit" type="number" name="year" min="0" max="59" value="<?php echo date("s"); ?>">
					</div>
				
					</fieldset>

					<br>
					<div id="addTimeTagBtn" onclick="addTimeTag()">+</div>
					<br>

				</div>


				<script>

					function getValidDaysTimeTag(){

						var timeTagDayValue = document.getElementById("timeTagDay").value;

						var year = document.getElementById("timeTagYear").value;

						var month = document.getElementById("timeTagMonth").value;

						var getValidDaysXHTTP;

						if (year.length == 0) { 

							document.getElementById("getValidDaysRESULT").innerHTML = "";
							return;

						}

						getValidDaysTimeTagXHTTP = new XMLHttpRequest();

						getValidDaysTimeTagXHTTP.onreadystatechange = function() {

							if (getValidDaysTimeTagXHTTP.readyState == 4 && getValidDaysTimeTagXHTTP.status == 200) {

								if(timeTagDayValue > getValidDaysTimeTagXHTTP.responseText){
									timeTagDayValue = getValidDaysTimeTagXHTTP.responseText;
								}

								document.getElementById("getValidDaysTimeTagRESULT").innerHTML = '<input id="timeTagDay" class="dateInput2digit" type="number" name="year" min="1" max="'+getValidDaysTimeTagXHTTP.responseText+'" value="'+timeTagDayValue+'">';

							}

						};

						getValidDaysTimeTagXHTTP.open("POST", "/cms/content/project/ajax/process/get-valid-days.php", true);
						getValidDaysTimeTagXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						getValidDaysTimeTagXHTTP.send("year=" + year + "&month=" + month); 

					}; 

				</script>

			<!--—————————————————————————————————————————————————————————————————————————————————
				PROJECT TIME TAG END
			———————————————————————————————————————————————————————————————————————————————————-->


<script>
	

/* ============================================================
	ADD TOME TAG START
============================================================ */

	function addTimeTag() {



		var y = document.getElementById("timeTagYear").value;
		var m = document.getElementById("timeTagMonth").value;
		var d = document.getElementById("timeTagDay").value;
		var h = document.getElementById("timeTagHour").value;
		var min = document.getElementById("timeTagMinute").value;
		var s = document.getElementById("timeTagSecond").value;

		var time_value = d+'-'+m+'-'+y+' '+h+':'+min+':'+s;
//alert(time_value);
		//alert(draftState);

		var addCoreKeywordXHTTP;

		addCoreKeywordXHTTP = new XMLHttpRequest();

		addCoreKeywordXHTTP.onreadystatechange = function() {

			if (addCoreKeywordXHTTP.readyState == 4 && addCoreKeywordXHTTP.status == 200) {
				
				//document.getElementById('tagRESULTS').innerHTML = addCoreKeywordXHTTP.responseText;
				document.getElementById('timeTagRESULTS').innerHTML = addCoreKeywordXHTTP.responseText;
				if(addCoreKeywordXHTTP.responseText == 'OK'){

					refreshTimeTagResults();
				}

			}

		};

		addCoreKeywordXHTTP.open("POST", "/cms/content/project/ajax/insert/add-timetag.php", true);
		addCoreKeywordXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		addCoreKeywordXHTTP.send("p_id="+coreID+"&time_value="+time_value);
	}

/* ============================================================
	ADD TOME TAG END
============================================================ */


/* ============================================================
	REFRESH KEYWORD RESULTS START
============================================================ */
	
	function refreshTimeTagResults() {

		//alert(draftState);

		var getTimeTagXHTTP;

		getTimeTagXHTTP = new XMLHttpRequest();

		getTimeTagXHTTP.onreadystatechange = function() {

			if (getTimeTagXHTTP.readyState == 4 && getTimeTagXHTTP.status == 200) {
				
				document.getElementById("timeTagRESULTS").innerHTML = getTimeTagXHTTP.responseText;


			}

		};

		getTimeTagXHTTP.open("POST", "/cms/content/project/ajax/process/refresh-timetags.php", true);
		getTimeTagXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		getTimeTagXHTTP.send("p_id="+coreID);
	}

/* ============================================================
	REFRESH KEYWORD RESULTS END
============================================================ */


/* ============================================================
	REMOVE TIME TAG START
============================================================ */
	
	function removeTimeTag(transfer) {

		var removeTimeTagID = transfer.id.split('-')[1];

		var removeTimeTagXHTTP;

		removeTimeTagXHTTP = new XMLHttpRequest();

		removeTimeTagXHTTP.onreadystatechange = function() {

			if (removeTimeTagXHTTP.readyState == 4 && removeTimeTagXHTTP.status == 200) {
				

				if(removeTimeTagXHTTP.responseText == 'OK'){

					refreshTimeTagResults();
				
				}

			}

		};

		removeTimeTagXHTTP.open("POST", "/cms/content/project/ajax/remove/remove-timetag.php", true);
		removeTimeTagXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		removeTimeTagXHTTP.send("remove_id="+removeTimeTagID);
	}

/* ============================================================
	REMOVE TIME TAG END
============================================================ */



</script>

		</div>

		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 7 END
		———————————————————————————————————————————————————————————————————————————————————-->




</div>