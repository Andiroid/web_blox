<div class="accordion">Image</div>

<div class="panel">

	<!--—————————————————————————————————————————————————————————————————————————————————
		PROJECT IMAGE START
	———————————————————————————————————————————————————————————————————————————————————-->						

		<input id="addCoreImgFileSelect" style="width:0px;height:0px;" type="file" onchange="getCoreImgTHUMB(this)" name="fileUPLOAD[]" class="inputfile" multiple/>

		<img id="addCoreImageThumb" onclick="coreImageThumbTRIGGER()" style="width:80%;height:auto;" src="/img/project/core/300/<?php echo $p_file; ?>" alt="your image" />

		<br><br>

		<label for="file">Bild hinzufügen</label>


	<!--—————————————————————————————————————————————————————————————————————————————————
		PROJECT IMAGE END
	———————————————————————————————————————————————————————————————————————————————————-->

</div>

<script type="text/javascript">
	function getCoreImgTHUMB(input) {

		updateCOLLECTOR("image");
		
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
</script>