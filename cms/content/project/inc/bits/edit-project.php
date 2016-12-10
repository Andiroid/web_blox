<div class="masterAccordion">Project Settings</div>

<div class="masterPanel">	

	<div id="coreUploadLoading"><br></div>

	<div id="coreFormWrap" style="text-align:center;">

		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 1 START
		———————————————————————————————————————————————————————————————————————————————————-->

		<?php

			if($p_key == 'archive'){
				include($_SERVER['DOCUMENT_ROOT'] . '/cms/content/project/inc/bits/cat-select.php');
			}

		?> 

		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 1 END
		———————————————————————————————————————————————————————————————————————————————————-->

		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 2 START
		———————————————————————————————————————————————————————————————————————————————————-->

		<div class="accordion">Title</div>

		<div class="panel">

			<!--—————————————————————————————————————————————————————————————————————————————————
				PROJECT TITLE START
			———————————————————————————————————————————————————————————————————————————————————-->	

			<input id="p_title" onchange="updateCOLLECTOR('title')" maxlength="60" value="<?php echo $p_title; ?>" name="p_title" style="text-align:left;width:80%;height:40px;font-size:15px;line-height:14px;font-family:Courier New;">

			<div style="text-align:center;color:#1f1f1f;font-family:Helvetica;font-size:12px;">
				<span style="color:red;" id="char_left"></span> Buchstaben zur Verfügung
			</div>

			<script>

				var element = document.getElementById('p_title');
				var label = document.getElementById('char_left');

				var start_length = element.value.length;
				var text_max = 60 - start_length;

				label.innerHTML = text_max;

				element.onkeyup=function(){

					var text_length = element.value.length;
					var text_remaining = 60 - text_length;
					label.innerHTML = text_remaining;

				};

			</script>

			<!--—————————————————————————————————————————————————————————————————————————————————
				PROJECT TITLE END
			———————————————————————————————————————————————————————————————————————————————————-->	

		</div>

		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 2 END
		———————————————————————————————————————————————————————————————————————————————————-->

		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 3 START
		———————————————————————————————————————————————————————————————————————————————————-->

			<?php

				if($p_key != 'startpage'){
					include($_SERVER['DOCUMENT_ROOT'] . '/cms/content/project/inc/bits/image-input.php');
				}

			?>

		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 3 END
		———————————————————————————————————————————————————————————————————————————————————-->

		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 4 START
		———————————————————————————————————————————————————————————————————————————————————-->

			<?php

				if($p_key != 'startpage'){
					include($_SERVER['DOCUMENT_ROOT'] . '/cms/content/project/inc/bits/privacy-check.php');
				}

			?>

		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 4 END
		———————————————————————————————————————————————————————————————————————————————————-->

		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 5 START
		———————————————————————————————————————————————————————————————————————————————————-->

			<?php

				if($p_key != 'startpage'){
					include($_SERVER['DOCUMENT_ROOT'] . '/cms/content/project/inc/bits/date-select.php');
				}

			?>	

		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 5 END
		———————————————————————————————————————————————————————————————————————————————————-->



		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 8 START
		———————————————————————————————————————————————————————————————————————————————————-->

			<div class="accordion activeit">Update Settings</div>

			<div class="panel show">

				<!--—————————————————————————————————————————————————————————————————————————————————
					MAIN BUTTON START
				———————————————————————————————————————————————————————————————————————————————————-->	

					<div id="setting_btn" onclick="updateProjectCore()" style="background-color:blue !important; margin:0 auto;" class="button_tmp_00"><span>SAVE </span></div>

				<!--—————————————————————————————————————————————————————————————————————————————————
					MAIN BUTTON END
				———————————————————————————————————————————————————————————————————————————————————-->

			</div>

		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 8 END
		———————————————————————————————————————————————————————————————————————————————————-->
		
	</div>

</div>

<?php

	if($p_key != 'startpage'){
		include($_SERVER['DOCUMENT_ROOT'] . '/cms/content/project/inc/bits/project-tags.php');
	}

?>	

<script>

	var acc = document.getElementsByClassName("accordion");
	var it;

	for (it = 0; it < acc.length; it++) {
		acc[it].onclick = function(){
			this.classList.toggle("activeit");
			this.nextElementSibling.classList.toggle("show");
		}
	}

</script>


<script>

	var masterACC = document.getElementsByClassName("masterAccordion");
	var masterPANEL = document.getElementsByClassName("masterPanel");
	var started;

	for (var masterIT = 0; masterIT < masterACC.length; masterIT++) {
		
		//alert( masterACC[masterIT].classList);	
		var y = masterIT;
		masterACC[masterIT].onclick = function(){

		//alert(masterIT);
		for (var x = 0; x < masterACC.length; x++) {

			var activeMasterPanel = masterACC[x].className;
			var n = activeMasterPanel.includes("activeit");

			if(n == true){

				//alert('hallo');
				masterACC[x].classList.toggle("activeit");
				masterACC[x].nextElementSibling.classList.toggle("show");
				this.classList.toggle("activeit");
				this.nextElementSibling.classList.toggle("show");						
								
			}

			//alert(n);			
		}

		this.classList.toggle("activeit");
		this.nextElementSibling.classList.toggle("show");
		started = true;

		}
	}

</script>