<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/lib/core_functions.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/lib/file_functions.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/lib/rewrite_functions.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/lib/gfx_functions.php');

if($user['group'] != 2) {
	header('Location: ' . '/');
}


if(isset($_GET['key'])){
	$p_key = $_GET['key'];
}

/* ============================================================
  SETUP VARIABLES START
============================================================ */

	$target_dir = $_SERVER['DOCUMENT_ROOT'] ."/img/project/core/origin/";
	$target_file = basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	$date = date("_Y_m_d_h_i_s");
	$target_file = preg_replace('/\\.[^.\\s]{3,4}$/', '', $target_file) . ($date) . "." .pathinfo($target_file,PATHINFO_EXTENSION);
	//echo "<br>".$target_file ;
	$out = $target_file ;
	$target_file_name = $target_file;
	$target_file = $target_dir.$target_file;

/* ============================================================
  SETUP VARIABLES END
============================================================ */



	  

?>

<!DOCTYPE html>
<html>
<head>

	<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/inc/parts/head.php');?>

</head>
<body>
	
<div id="main_frame">
		
	<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/inc/parts/nav.php');?>

	<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/inc/parts/nav.php');?>

			<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/inc/bits/back-btn.php');?>


			
				<!--—————————————————————————————————————————————————————————————————————————————————
					LEFT BIT START
				———————————————————————————————————————————————————————————————————————————————————-->

					<div class="bit-20">
						<br>
						<input type="hidden" value="" name="p_draft">
					</div>

				<!--—————————————————————————————————————————————————————————————————————————————————
					LEFT BIT END
				———————————————————————————————————————————————————————————————————————————————————-->


				<!--—————————————————————————————————————————————————————————————————————————————————
					MAIN BIT START
				———————————————————————————————————————————————————————————————————————————————————-->

					<div class="bit-60">

						<div id="coreUploadLoading"></div>
						
						<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/content/project/inc/bits/add-project.php');?>
						

				</div>
				<!--—————————————————————————————————————————————————————————————————————————————————
					MAIN BIT END
				———————————————————————————————————————————————————————————————————————————————————-->



				<!--—————————————————————————————————————————————————————————————————————————————————
					RIGHT BIT START
				———————————————————————————————————————————————————————————————————————————————————-->

					<div class="bit-20">

						<br>
						
					</div>

				<!--—————————————————————————————————————————————————————————————————————————————————
					RIGHT BIT END
				———————————————————————————————————————————————————————————————————————————————————-->


			<div class="break40"><br></div>





<script type='text/javascript'>


function validateDATA() {

	var p_image = document.getElementById("addCoreImgFileSelect").value;
	var p_title = document.getElementById("p_title").value;
	var p_pub = document.getElementById("corePublicValue").value;
	var projectType = document.getElementById("projectType").value;

	var p_cat = document.getElementById("p_cat").value;

	if(projectType != 'unique'){
		var x = p_cat;
		if (x == null || x == "") {
			alert("Category must be filled out");
			return false;
		}
	}



	var x = p_title;
	if (x == null || x == "") {
		alert("Title must be filled out");
		return false;
	}
	var x = p_image;
	if (x == null || x == "") {
		alert("Project Image must be added");
		return false;
	}
	var x = p_pub;
	if (x == null || x == "") {
		alert("Publification must be filled out");
		return false;
	}


	updateProjectCore();

}


	function getCoreImgTHUMB(input) {
		var addCoreImageThumb = document.getElementById('addCoreImageThumb');
		if (input.files && input.files[0]) {
			var coreImgREADER = new FileReader();
			coreImgREADER.onload = function (e) {			
				addCoreImageThumb.src = e.target.result;
				addCoreImageThumb.width = "auto";
				addCoreImageThumb.height = "200px";
			};
			coreImgREADER.readAsDataURL(input.files[0]);
		}
	}

	function coreImageThumbTRIGGER(){
		document.getElementById("addCoreImgFileSelect").click();		
	}



/* ============================================================
	UPDATE PROJECT CORE START
============================================================ */

	function updateProjectCore() {

		document.getElementById("coreFormWrap").style.display = 'none';
		document.getElementById("coreUploadLoading").innerHTML = '<div style="font-family:bebas;font-size:40px;height:400px;width:100%;text-align:center;padding:180px 0px;color:purple;">uploading..</div>';
		
		var p_title = document.getElementById("p_title").value;
		var p_pub = document.getElementById("corePublicValue").value;
		var p_priv = document.getElementById("corePrivateValue").value;
		var projectType = document.getElementById("projectType").value;

		if(projectType != 'unique'){
			var p_cat = document.getElementById("p_cat").value;
			var p_sub_cat = document.getElementById("p_sub_cat").value;
		}
		

		var projectCoreFormData = new FormData();

		var fileSelect = document.getElementById('addCoreImgFileSelect');

		var files = fileSelect.files;

		for (var i = 0; i < files.length; i++) {
			
			var file = files[0];

			if (!file.type.match('image.*')) {
				continue;
			}

			projectCoreFormData.append('fileUPLOAD[]', file, file.name);
		}
		projectCoreFormData.append('p_key', projectType);
		projectCoreFormData.append('p_title', p_title);
		projectCoreFormData.append('p_pub', p_pub);

		if(projectType != 'unique'){
			projectCoreFormData.append('p_cat', p_cat);
			projectCoreFormData.append('p_sub_cat', p_sub_cat);
		}

		var updateProjectCoreXHTTP = new XMLHttpRequest();

		updateProjectCoreXHTTP.open('POST', '/cms/content/project/ajax/insert/add-update-project-core.php', true);

		updateProjectCoreXHTTP.onload = function () {

			if (updateProjectCoreXHTTP.status === 200) {

				document.getElementById("coreUploadLoading").innerHTML = '<div style="font-family:bebas;font-size:40px;height:400px;width:100%;text-align:center;padding:160px 0px;color:#02E88C;">Finished<br><br><span style="color:black;"><a href="/cms/content/project/edit?id='+updateProjectCoreXHTTP.responseText+'">next step -></a></span></div>';

			} else {

			alert('An error occurred!');

			}
		};

		updateProjectCoreXHTTP.send(projectCoreFormData);
	}

/* ============================================================
	UPDATE PROJECT CORE START
============================================================ */

</script>






	<?php include ($_SERVER['DOCUMENT_ROOT'] . '/inc/parts/footer.php'); ?>

</div>

<?php include ($root.'/inc/parts/static-bottom.php'); ?>
