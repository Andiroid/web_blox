	
	



	<div id="coreFormWrap" style="text-align:center;">
<br><br>
			<h3 style="text-align:left;letter-spacing:1px;">Add New Project</h3>	
<br><br>
	


		<div class="accordion activeit">Type</div>

		<div class="panel show">
			<select name="" onchange="getCat()" id="projectType">
				<option value="archive">Archived Page</option>
				<option value="unique">Unique Page</option>
			</select>
		</div>


		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 2 START
		———————————————————————————————————————————————————————————————————————————————————-->

		<div class="accordion activeit">Title</div>

		<div class="panel show">

			<!--—————————————————————————————————————————————————————————————————————————————————
				PROJECT TITLE START
			———————————————————————————————————————————————————————————————————————————————————-->	

			<input id="p_title" maxlength="60" name="p_title" style="text-align:left;width:300px;height:40px;font-size:12px;line-height:14px;font-family:Courier New;"/>

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

		<div class="accordion activeit">Image</div>

		<div class="panel show">

			<!--—————————————————————————————————————————————————————————————————————————————————
				PROJECT IMAGE START
			———————————————————————————————————————————————————————————————————————————————————-->						

				<input id="addCoreImgFileSelect" style="width:0px;height:0px;" type="file" onchange="getCoreImgTHUMB(this);" name="fileUPLOAD[]" class="inputfile" multiple/>

				<img id="addCoreImageThumb" onclick="coreImageThumbTRIGGER()" style="border:2px #6f6f6f dashed; width:auto;height:200px;" src="/img/core/leer.png" alt="your image" />

				<br><br>

				<label for="file">Bild hinzufügen</label>


			<!--—————————————————————————————————————————————————————————————————————————————————
				PROJECT IMAGE END
			———————————————————————————————————————————————————————————————————————————————————-->

		</div>

		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 3 END
		———————————————————————————————————————————————————————————————————————————————————-->





		<?php



		echo '



		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 1 START
		———————————————————————————————————————————————————————————————————————————————————-->

		<div id="catacc" class="accordion activeit">Category</div>

		<div id="catpan" class="panel show">
						
		';

			/*
			echo '
					<br><br><select name="" id="p_arch">
			';

					$archSQL="SELECT * FROM struc_core ORDER BY struc_slug ASC";
					$archRESULT=mysqli_query($conn,$archSQL);
					$archCOUNT = mysqli_num_rows($archRESULT);
					$archiveData = array();

					while ($archROW = mysqli_fetch_array($archRESULT, 1)) {

						$archiveId = $archROW['struc_id'];
						$archiveTitle = $archROW['struc_title'];
						$archiveSlug = $archROW['struc_slug'];
					
						echo '<option value="'.$archiveId.'">'.$archiveTitle.'</option>';

					}
			
			echo '
				</select>
			';
			*/


			echo '		
			
			<!--—————————————————————————————————————————————————————————————————————————————————
				SELECT CATEGORY START
			———————————————————————————————————————————————————————————————————————————————————-->	 
				<label for="p_cat">Category</label>
				<select id="p_cat" name="p_cat">
				<option value=""></option>
				';
				//echo $cat;
					$sql="SELECT * FROM struc_cat WHERE cat_slug='$p_cat'";
					$result=mysqli_query($conn,$sql);
					$num_rows = mysqli_num_rows($result);
					$x = 1;
					while ($row = mysqli_fetch_array($result, 1)) {
						echo'				
							<option value="'.$row['cat_slug'].'">'.$row['cat_title'].'</option>
						';
						$x++;
					}
					mysqli_free_result($result);
				echo '
					<option value="default">Default</option>
					<option value="private">Private</option>
					';
						$sql="SELECT * FROM struc_cat ORDER BY cat_id DESC";
						$result=mysqli_query($conn,$sql);
						$num_rows = mysqli_num_rows($result);
						$x = 1;
						while ($row = mysqli_fetch_array($result, 1)) {
							echo'				
								<option value="'.$row['cat_slug'].'">'.$row['cat_title'].'</option>
							';
							$x++;
						}
						mysqli_free_result($result);
				echo '	
				</select><br><br>

			<!--—————————————————————————————————————————————————————————————————————————————————
				SELECT CATEGORY END
			———————————————————————————————————————————————————————————————————————————————————-->



			<!--—————————————————————————————————————————————————————————————————————————————————
				SELECT SUB-CATEGORY END
			———————————————————————————————————————————————————————————————————————————————————-->

				<div id="sub-cat-results">
					
				</div>
			<!--—————————————————————————————————————————————————————————————————————————————————
				SELECT SUB-CATEGORY END
			———————————————————————————————————————————————————————————————————————————————————-->

			</div>

		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 1 END
		———————————————————————————————————————————————————————————————————————————————————-->

						
			';
			
			 ?>





<script type="text/javascript">
		if(projectType.value == 'unique'){
			catacc.style.display = 'none';
			catpan.style.display = 'none';
		}
		if(projectType.value == 'archive'){
			catacc.style.display = 'block';
			catpan.style.display = 'block';
		}
	function getCat(){
		var coreCat = document.getElementById("p_cat");
		var projectType = document.getElementById("projectType");
		var catacc = document.getElementById("catacc");
		var catpan = document.getElementById("catpan");
		//alert(projectType.value);
		if(projectType.value == 'unique'){
			catacc.style.display = 'none';
			catpan.style.display = 'none';
		}
		if(projectType.value == 'archive'){
			catacc.style.display = 'block';
			catpan.style.display = 'block';
		}
	}

</script>





				<script>
				/*
				var subCat = document.getElementById("sub_cat");
				var hiddenSubCat = document.getElementById("hidden_sub_cat");
				subCat.onchange=function(){
					hiddenSubCat.value=subCat.value;
					//alert(subCat.value);
				}
				*/

				
				function subCatOnChange() {

				}
					var coreCat = document.getElementById("p_cat");
		
					coreCat.onchange=function(){
						//alert(coreCat.value);

						var str = coreCat.value;
						//alert(str);
						var xhttp;

						if (str.length == 0) { 

							document.getElementById("sub-cat-results").innerHTML = "";
							return;

						}

						xhttp = new XMLHttpRequest();

						xhttp.onreadystatechange = function() {

							if (xhttp.readyState == 4 && xhttp.status == 200) {

								document.getElementById("sub-cat-results").innerHTML = xhttp.responseText;

							}

						};

						xhttp.open("GET", "/cms/content/project/ajax/process/get-sub-cat.php?cat="+str, true);
						xhttp.send(); 

					}; 
				
				</script>











		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 4 START
		———————————————————————————————————————————————————————————————————————————————————-->

		<div class="accordion activeit">Privacy</div>

		<div class="panel show">

			<!--—————————————————————————————————————————————————————————————————————————————————
				CHECK IF PROJECT IS PRIVATE OR PUBLIC START
			———————————————————————————————————————————————————————————————————————————————————-->

				<div>

					<input type="checkbox" name="publicCB" id="checkboxG1" class="css-checkbox" onclick='handlePUBLIC(this);' />

					<label for="checkboxG1" class="css-label">Public</label><span style="color:red;"> OR </span>

					<input type="hidden" name="p_pub" id="corePublicValue" value="" />			

					<input type="checkbox" name="privateCB" id="checkboxG2" class="css-checkbox" onclick='handlePRIVATE(this);' />

					<label for="checkboxG2" class="css-label">Private</label>

					<input type="hidden" name="p_priv" id="corePrivateValue" value="" />

					<script>

						var publicstate = document.getElementById('corePublicValue');
						var privatestate = document.getElementById('corePrivateValue');
						var publicCHECKBOX = document.getElementById('checkboxG1');
						var privateCHECKBOX = document.getElementById('checkboxG2');

						function handlePUBLIC(cb) {
							
								publicstate.value=1;
								publicCHECKBOX .checked = true;
								privateCHECKBOX.checked = false;
								privatestate.value=0;
						
						}

						function handlePRIVATE(cb) {

								publicstate.value=0;
								publicCHECKBOX .checked = false;
								privateCHECKBOX.checked = true;
								privatestate.value=1;
						}

					</script>						

				</div>

			<!--—————————————————————————————————————————————————————————————————————————————————
				CHECK IF PROJECT IS PRIVATE OR PUBLIC END
			———————————————————————————————————————————————————————————————————————————————————-->

		</div>

		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 4 END
		———————————————————————————————————————————————————————————————————————————————————-->



		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 6 START
		———————————————————————————————————————————————————————————————————————————————————-->

		<div class="accordion activeit">Save Project</div>

		<div class="panel show">

			<!--—————————————————————————————————————————————————————————————————————————————————
				MAIN BUTTON START
			———————————————————————————————————————————————————————————————————————————————————-->	

				<div id="setting_btn" onclick="validateDATA()" style="background-color:blue !important; margin:0 auto;" class="button_tmp_00"><span>SAVE </span></div>

			<!--—————————————————————————————————————————————————————————————————————————————————
				MAIN BUTTON END
			———————————————————————————————————————————————————————————————————————————————————-->

		</div>

		<!--—————————————————————————————————————————————————————————————————————————————————
			PANEL 6 END
		———————————————————————————————————————————————————————————————————————————————————-->


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





		
</div>