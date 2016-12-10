<div class="accordion">Upload Date</div>

<div class="panel">

	<style>
		.dateInput4digit{width:70px;}
		.dateInput2digit{width:60px;}
	</style>

	<!--—————————————————————————————————————————————————————————————————————————————————
		CREATED DATE START
	———————————————————————————————————————————————————————————————————————————————————-->

		<div class="bit-1" style="padding:0px 0%">

			<br><br>

			<fieldset>

				<legend><h2 style="padding:0px 5px;"> Date </h2></legend>

				<div class="bit-3">
					Day<br>
					<div id="getValidDaysRESULT">
						<input id="coreDay" onchange="updateCOLLECTOR('date')" class="dateInput2digit" type="number" name="year" min="1" max="<?php $number = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y")); echo $number; ?>" value="<?php echo $coreDate->format('d'); ?>">
					</div>
				</div>

				<div class="bit-3">							
					Month<br>
					<input id="coreMonth" class="dateInput2digit" onchange="getValidDays()" type="number" name="year" min="1" max="12" value="<?php echo $coreDate->format('m'); ?>">
				</div>

				<div class="bit-3">
					Year<br>
					<input id="coreYear" class="dateInput4digit" onchange="getValidDays()" type="number" name="year" min="<?php echo date('Y', strtotime('-50 year')); ?>" max="<?php echo date('Y', strtotime('+50 year')); ?>" value="<?php echo $coreDate->format('Y'); ?>">
				</div>


			</fieldset>

			<br><br>

			<fieldset>

				<legend><h2 style="padding:0px 5px"> Time </h2></legend>
				
			<div class="bit-3">
				Hour<br>
				<input id="coreHour" onchange="updateCOLLECTOR('date')" class="dateInput2digit" type="number" name="year" min="0" max="23" value="<?php echo $coreDate->format('H'); ?>">
			</div>
				
			<div class="bit-3">
				Minute<br>
				<input id="coreMinute" onchange="updateCOLLECTOR('date')" class="dateInput2digit" type="number" name="year" min="0" max="59" value="<?php echo $coreDate->format('i'); ?>">
			</div>
				
			<div class="bit-3">
				Second<br>
				<input id="coreSecond" onchange="updateCOLLECTOR('date')" class="dateInput2digit" type="number" name="year" min="0" max="59" value="<?php echo $coreDate->format('s'); ?>">
			</div>
		
			</fieldset>

			<br><br>

		</div>


		<script>

			function getValidDays(){
				
				updateCOLLECTOR('date');

				var coreDayValue = document.getElementById("coreDay").value;

				var year = document.getElementById("coreYear").value;

				var month = document.getElementById("coreMonth").value;

				var getValidDaysXHTTP;

				if (year.length == 0) { 

					document.getElementById("getValidDaysRESULT").innerHTML = "";
					return;

				}

				getValidDaysXHTTP = new XMLHttpRequest();

				getValidDaysXHTTP.onreadystatechange = function() {

					if (getValidDaysXHTTP.readyState == 4 && getValidDaysXHTTP.status == 200) {

						if(coreDayValue > getValidDaysXHTTP.responseText){
							coreDayValue = getValidDaysXHTTP.responseText;
						}

						document.getElementById("getValidDaysRESULT").innerHTML = '<input id="coreDay" class="dateInput2digit" type="number" name="year" min="1" max="'+getValidDaysXHTTP.responseText+'" value="'+coreDayValue+'">';

					}

				};

				getValidDaysXHTTP.open("POST", "/cms/content/project/ajax/process/get-valid-days.php", true);
				getValidDaysXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				getValidDaysXHTTP.send("year=" + year + "&month=" + month); 

			}; 

		</script>

	<!--—————————————————————————————————————————————————————————————————————————————————
		CREATED DATE END
	———————————————————————————————————————————————————————————————————————————————————-->

</div>