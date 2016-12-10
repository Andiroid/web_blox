<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");


$req_key = $_GET['key'];

?>
<!DOCTYPE html>
<html>
<head>

	<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/inc/parts/head.php');?>

</head>
<body>
	
<div id="main_frame">
		
	<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/inc/parts/nav.php');?>

	<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/inc//parts/nav.php');?>


	<!--—————————————————————————————————————————————————————————————————————————————————
		LEFT BIT START
	———————————————————————————————————————————————————————————————————————————————————-->

		<div class="bit-20">
			<br>
		</div>

	<!--—————————————————————————————————————————————————————————————————————————————————
		LEFT BIT END
	———————————————————————————————————————————————————————————————————————————————————-->

	<!--—————————————————————————————————————————————————————————————————————————————————
		MAIN BIT START
	———————————————————————————————————————————————————————————————————————————————————-->

	<div class="bit-60">

		<!--—————————————————————————————————————————————————————————————————————————————————
			FORM START
		———————————————————————————————————————————————————————————————————————————————————-->
			
			<br>
				
			<h2>Add New <span style="color:red;"> <?php echo $req_key; ?> </span></h2>

			<br><br>

			<ul class="catTab">
			  <li><div class="catTabLinks Credentials active" onclick="openTab(event, 'Credentials')">Credentials</div></li>
			  <li><div class="catTabLinks Thumbnail" onclick="openTab(event, 'Thumbnail')">Thumbnail</div></li>
			  <li><div class="catTabLinks Archive" onclick="openTab(event, 'Archive')">Archive</div></li>
			</ul>

			<div id="Credentials" class="catTabContent" style="text-align:center; display:block;">

				<br><br>
				
				<?php include($_SERVER['DOCUMENT_ROOT'] . '/cms/content/archive/bits/get-struc.php') ;?>

				<br><br>
				
				<div id="char_left"></div>
				
				<script>
					var element = document.getElementById('title');
					var label = document.getElementById('char_left');		
					var text_max = 60;
					label.innerHTML = text_max + ' Buchstaben zur Verfügung';
					element.onreq_keyup=function(){
						var text_length = element.value.length;
						var text_remaining = text_max - text_length;
						label.innerHTML = text_remaining + ' Buchstaben zur Verfügung';
					};	
				</script>

				<br><br>

			</div>

			<div id="Thumbnail" class="catTabContent">

				<br><br>

				<input id="catImage" style="width:0px;height:0px;" type="file" onchange="getCoreImgTHUMB(this);" name="fileUPLOAD[]" class="inputfile" multiple/>

				<div id="addCoreImageThumb" onclick="coreImageThumbTRIGGER()" style="margin:0 auto; border:dashed 1px #333; width:200px;height:200px;background-size: 400px auto; background-repeat: no-repeat;background-image: url('/img/core/leer.png'); background-position: center;"><br></div>

				<br><br>

				<label for="file">Bild hinzufügen</label>

				<script>

					function getCoreImgTHUMB(input) {

						var addCoreImageThumb = document.getElementById('addCoreImageThumb');

						if (input.files && input.files[0]) {

							var coreImgREADER = new FileReader();

							coreImgREADER.onload = function (e) {

								addCoreImageThumb.style.backgroundImage = 'url("'+e.target.result+'")';

								var domIMG = new Image(); 

								domIMG.onload = function(){

									if(domIMG.width > domIMG.height){

										//landscape
										addCoreImageThumb.style.backgroundSize = "auto 200px";

									} else if (domIMG.width < domIMG.height){

										//portrait
										addCoreImageThumb.style.backgroundSize = "200px auto";

									} else {

										addCoreImageThumb.style.backgroundSize = "200px 200px";

									}

								};

								domIMG.src = e.target.result;							

							};

							coreImgREADER.readAsDataURL(input.files[0]);
						}
					}

					function coreImageThumbTRIGGER(){

						document.getElementById("catImage").click();

					}

				</script>

			</div>



			<div id="Archive" class="catTabContent">

				<br><br>

				<div class="bit-1 tabItemWrap" style="border-bottom:dashed 2px #333;">
					<div class="bit-2">
						<div class="tabItemTitle">Item Display Mode</div>		
					</div>
					<div class="bit-2 tabItemOptions">
						<select name="" id="mode">
							<option value="visual">visual</option>
							<option value="archive">archive</option>
							<option value="list">list</option>
						</select>		
					</div>
				</div>
					
				<div class="bit-1 tabItemWrap" style="border-bottom:dashed 2px #333;">
					<div class="bit-2">
						<div class="tabItemTitle">Item Alignment</div>		
					</div>
					<div class="bit-2 tabItemOptions">
						<select name="" id="align">
							<option value="vertical">vertical</option>
							<option value="horizontal">horizontal</option>
						</select>
					</div>
				</div>

				<br><br>

				<div class="bit-1 tabItemWrap" style="border-bottom:dashed 2px #333;">
					<div class="bit-2">
						<div class="tabItemTitle">Columns</div>		
					</div>
					<div class="bit-2 tabItemOptions">
						<input id="cols" style="width:60px;" type="number" name="" min="0" max="5" value="3">
					</div>
				</div>

				<div class="bit-1 tabItemWrap">
					<div class="bit-2">
						<div class="tabItemTitle">Rows</div>		
					</div>
					<div class="bit-2 tabItemOptions">
						<input id="rows" style="width:60px;" type="number" name="" min="0" max="5" value="3">
					</div>
				</div>

				<br><br>

			</div>

			<script>

				function openTab(evt, headName) {

					var i, catTabContent, catTabLinks;
					catTabContent = document.getElementsByClassName("catTabContent");

					for (i = 0; i < catTabContent.length; i++) {

						catTabContent[i].style.display = "none";

					}

					catTabLinks = document.getElementsByClassName("catTabLinks");

					for (var i = 0; i < catTabLinks.length; i++) {

						catTabLinks[i].className = catTabLinks[i].className.replace(" active", "");
					}

					document.getElementById(headName).style.display = "block";
					evt.currentTarget.className += " active";
				}

			</script>

	</div>

	<!--—————————————————————————————————————————————————————————————————————————————————
		MAIN BIT END
	———————————————————————————————————————————————————————————————————————————————————-->

	<script type='text/javascript'>

		function validateForm() {

			var x = document.forms["add-cat-form"]["cat_title"].value;
			if (x == null || x == "") {
				alert("The field MAIN-CATEGORY must be filled out");
				return false;
			}

		}

	</script>

	<!--—————————————————————————————————————————————————————————————————————————————————
		RIGHT BIT START
	———————————————————————————————————————————————————————————————————————————————————-->
		<div class="bit-20">
		<br><br><br><br>
			<div style="padding:0px 4%;">
				<button class="button_tmp_00" onclick="addArchiveItem()"><span>OK </span></button>
			</div>
		</div>
	<!--—————————————————————————————————————————————————————————————————————————————————
		RIGHT BIT END
	———————————————————————————————————————————————————————————————————————————————————-->

	<div class="break40"><br></div>


	<?php include ($_SERVER['DOCUMENT_ROOT'] . '/inc/parts/footer.php'); ?>

</div>

<?php include ($root.'/inc/parts/static-bottom.php'); ?>

<script>
	
	function addArchiveItem() {

		var req_key = <?=json_encode($req_key)?>;

		var title = document.getElementById("title").value;
		var mode = document.getElementById("mode").value;
		var align = document.getElementById("align").value;
		var cols = document.getElementById("cols").value;
		var rows = document.getElementById("rows").value;

		if (document.getElementById("link") != null){
			var link = document.getElementById("link").value;
		}

		var fileSelect = document.getElementById('catImage');

		if(align == 'vertical'){
			align = '0';
		} else {
			align = '1';
		}

		var catFormData = new FormData();

		catFormData.append('key', req_key);
		catFormData.append('title', title);
		catFormData.append('mode', mode);
		catFormData.append('align', align);
		catFormData.append('cols', cols);
		catFormData.append('rows', rows);

		if (document.getElementById("link") != null){
			catFormData.append('link', link);
		}

		var files = fileSelect.files;

		for (var i = 0; i < files.length; i++) {
			
			var file = files[0];

			if (!file.type.match('image.*')) {
				continue;
			}

			catFormData.append('fileUPLOAD[]', file, file.name);
		}

		var addArchiveXHTTP;

		addArchiveXHTTP = new XMLHttpRequest();

		addArchiveXHTTP.onreadystatechange = function() {

			if (addArchiveXHTTP.readyState == 4 && addArchiveXHTTP.status == 200) {

				//alert(addArchiveXHTTP.responseText);

				if (addArchiveXHTTP.responseText == 'OK'){

					//alert('hallo');

				}
				
			}

		};

		addArchiveXHTTP.open("POST", "/cms/content/archive/ajax/add_process.php", true);
		//addArchiveXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		addArchiveXHTTP.send(catFormData);
	}

</script>