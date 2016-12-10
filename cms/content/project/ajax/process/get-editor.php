<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

// get the q parameter from URL
$p_id = $_REQUEST["coreID"];
$editor_type = $_REQUEST["editorTYPE"];



/* ============================================================
	GET LAST ITEM POSITION START
============================================================ */

	$getLastPosSQL="SELECT item_pos FROM p_item WHERE item_nr='$p_id' ORDER BY item_pos ASC";
	$getLastPosRESULT=mysqli_query($conn,$getLastPosSQL);
	$getLastPosCOUNT = mysqli_num_rows($getLastPosRESULT);
	$last_item_pos = $getLastPosCOUNT;

/* ============================================================
	GET LAST ITEM POSITION END
============================================================ */


$new_last_item_pos = $last_item_pos + 1;

if ($editor_type == 'string'){

	//echo $editor_type;

	echo '

		<select name="string_type" id="string_type">
			<option value="float">FLOAT</option>
			<option value="free">FREESTYLE</option>
			<option value="head">HEADLINE</option>
			<option value="code">CODE</option>
		</select>

		<select id="item_pos" name="item_pos" id="">
			<option value="'. $new_last_item_pos .'">'. $new_last_item_pos .'</option>

	';

	$y = 1;

	while($y <= $last_item_pos) {

		echo '<option value="'.$y.'">'.$y.'</option>';
		$y++;

	}

	echo '

		</select>

		<input name="item_type" type="hidden" value="string">
		<div class="editor-header">
		<span class="editorClose" onclick="closeEditor()">&times</span>
		<h2>Text Editor</h2>
		</div>

		<div class="editor-body">
		<!--<div id="divTextEDITOR" contenteditable="true" onkeyup="textEditorDivControls()"><br></div>-->
		<textarea id="item_string" onkeyup="textEditorControls()" name="item_string" class="editor-textarea"></textarea>
		</div>

		<div class="editor-footer">
			<div id="string-btn" style="margin:0 auto;" onclick="addItemCore(this)" class="button_tmp_02"><span>OK </span></div>		
		</div>

	';

}

if ($editor_type == 'image'){

	echo '

		<select id="item_pos" name="item_pos" id="">

			<option value="'. $new_last_item_pos .'">'. $new_last_item_pos .'</option>

	';

	$y = 1;
	while($y <= $last_item_pos) {
		echo '<option value="'.$y.'">'.$y.'</option>';
		$y++;
	}

	echo '

		</select>
								
		<div class="editor-header">
				<span class="editorClose" onclick="closeEditor()">&times</span>
				<h2>Image Editor</h2>
		</div>

		<div class="editor-body">

			<input id="addImgItemFileSelect" style="width:0px;height:0px;" type="file" onchange="getImgItemTHUMB(this);" name="fileUPLOAD[]" class="inputfile" multiple/>

			<img id="addImageItemThumb" onclick="imgItemThumbTRIGGER()" style="width:auto;height:200px;" src="/img/core/leer.png" alt="your image" />

			<br><br>

			<label for="file">Bild hinzufügen</label>

		</div>

		<div class="editor-footer">
			<div id="image-btn" style="margin:0 auto;" onclick="addItemCore(this)" class="button_tmp_02"><span>OK </span></div>	
		</div>

	';

}

if ($editor_type == 'slideshow'){

	$sqlSlideCHECK="SELECT * from p_item WHERE item_type='slideshow' AND item_nr='$p_id' LIMIT 1";
	$resultSlideCHECK=mysqli_query($conn,$sqlSlideCHECK);
	$num_rowsSlideCHECK = mysqli_num_rows($resultSlideCHECK);
	$rowSlideCHECK = mysqli_fetch_array($resultSlideCHECK, 1);

	if ($num_rowsSlideCHECK != 0) {

		$projectSlideshow = 'TRUE';

	} else {

		$projectSlideshow = 'FALSE';

	}




	if ($projectSlideshow == 'TRUE'){

	echo '
								
		<div class="editor-header">
				<span class="editorClose" onclick="closeEditor()">&times</span>
				<h2>ADD Single-Slide</h2>
		</div>

		<div class="editor-body">

			<input id="addSlideItemFileSelect" style="width:0px;height:0px;" type="file" onchange="getSlideItemTHUMB(this);" name="fileUPLOAD[]" class="inputfile" multiple/>

			<img id="addSlideItemThumb" onclick="slideItemThumbTRIGGER()" style="width:auto;height:200px;" src="/img/core/leer.png" alt="your image" />

			<br><br>

			<label for="file">Bild hinzufügen</label>

		</div>


		<div class="editor-footer">
			<div id="slideshow-btn" style="margin:0 auto;" onclick="addSlideItem()" class="button_tmp_02"><span>ITEM </span></div>	
		</div>

		';

	} else {

		echo '

			<select id="item_pos" name="item_pos" id="">

				<option value="'. $new_last_item_pos .'">'. $new_last_item_pos .'</option>

		';

		$y = 1;

		while($y <= $last_item_pos) {

			echo '<option value="'.$y.'">'.$y.'</option>';
			$y++;

		}
	echo '

		</select>
								
		<div class="editor-header">
				<span class="editorClose" onclick="closeEditor()">&times</span>
				<h2>ADD Slideshow</h2>
		</div>

		<div class="editor-body">

			<input id="addSlideItemFileSelect" style="width:0px;height:0px;" type="file" onchange="getSlideItemTHUMB(this);" name="fileUPLOAD[]" class="inputfile" multiple/>

			<img id="addSlideItemThumb" onclick="slideItemThumbTRIGGER()" style="width:auto;height:200px;" src="/img/core/leer.png" alt="your image" />

			<br><br>

			<label for="file">Bild hinzufügen</label>

		</div>


		<div class="editor-footer">
			<div id="slideshow-btn" style="margin:0 auto;" onclick="addItemCore(this)" class="button_tmp_02"><span>SHOW </span></div>	
		</div>

		';

	}

}















?>