


var updateLIST = [];

if(coreKEY == 'archive'){
	var coreCat = document.getElementById("p_cat");
	function getValidSubCats(){
		updateCOLLECTOR('category');
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

	function subCatOnChange(){
		updateCOLLECTOR('subcategory');
	}
}






/* ============================================================
	PUBLISH PROJECT START
============================================================ */
	
	function publishProject(transfer) {

		var newDraftState = transfer.id.split('-')[1];

		//alert(draftState);

		var publishProjectXHTTP;

		publishProjectXHTTP = new XMLHttpRequest();

		publishProjectXHTTP.onreadystatechange = function() {

			if (publishProjectXHTTP.readyState == 4 && publishProjectXHTTP.status == 200) {
				
				//document.getElementById("publishRESULTS").innerHTML = publishProjectXHTTP.responseText;
				
				if (publishProjectXHTTP.responseText == 'OK'){

					if(newDraftState == 0){

						document.getElementById("publishRESULTS").innerHTML = '<button id="publish-1" onclick="publishProject(this)" style="background-color:#4f4f4f !important;font-size:15px;" class="button_tmp_00"><span>draft </span></button>';

					} else {

						document.getElementById("publishRESULTS").innerHTML = '<button id="publish-0" onclick="publishProject(this)" style="background-color:#4f4f4f !important;font-size:15px;" class="button_tmp_00"><span>publish </span></button>';
					
					}
					getDraftCount();
					refreshCoreMetaData();
				}

			}

		};

		publishProjectXHTTP.open("POST", "/cms/content/project/ajax/process/publish-project.php", true);
		publishProjectXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		publishProjectXHTTP.send("p_id="+coreID+"&p_draft="+newDraftState);
	}

/* ============================================================
	PUBLISH PROJECT END
============================================================ */


/* ============================================================
	UPDATE PROJECT CORE START
============================================================ */

	function updateCOLLECTOR(e) {

		var indexCHECK = updateLIST.indexOf(e) > -1;
		
		if (indexCHECK != true){
			updateLIST.push(e);
		}
		/*
		alert(e.id);
			e.focus();
		*/
	}


	function updateCHECK(e) {

		return e = updateLIST.indexOf(e) > -1;
		
	}

	function updateProjectCore() {

		//	on change add to list
		//document.getElementById("coreFormWrap").style.display = 'none';
		//document.getElementById("coreUploadLoading").innerHTML = '<div style="font-family:bebas;font-size:40px;height:400px;width:100%;text-align:center;padding:180px 0px;color:purple;">uploading..</div>';	
		// p_id is located in the head.php file as [ var p_id = <?=json_encode($p_id)?>; ]
		
		var p_title = document.getElementById("p_title").value;

		if(coreKEY != 'startpage'){

			var p_pub = document.getElementById("corePublicValue").value;
			var p_priv = document.getElementById("corePrivateValue").value;
			var y = document.getElementById("coreYear").value;
			var m = document.getElementById("coreMonth").value;
			var d = document.getElementById("coreDay").value;
			var h = document.getElementById("coreHour").value;
			var min = document.getElementById("coreMinute").value;
			var s = document.getElementById("coreSecond").value;

			var p_date = d+'-'+m+'-'+y+' '+h+':'+min+':'+s;
		}

		if(coreKEY == 'archive'){

			var p_cat = document.getElementById("p_cat").value;
			var p_sub_cat = document.getElementById("p_sub_cat").value;

		}

		var projectCoreFormData = new FormData();

		//alert(updateCHECK('title'));

		projectCoreFormData.append('p_id', p_id);

		if (updateCHECK('title') == true){

			projectCoreFormData.append('p_title', p_title);
			
		}

		if(coreKEY != 'startpage'){

			if (updateCHECK('date') == true){

				projectCoreFormData.append('p_date', p_date);

			}

			if (updateCHECK('public') == true){

				projectCoreFormData.append('p_pub', p_pub);

			}

			if (updateCHECK('image') == true){

				var fileSelect = document.getElementById('addCoreImgFileSelect');

				var files = fileSelect.files;

				for (var i = 0; i < files.length; i++) {
					
					var file = files[0];

					if (!file.type.match('image.*')) {
						continue;
					}

					projectCoreFormData.append('fileUPLOAD[]', file, file.name);
				}

			}

		}

		if(coreKEY == 'archive'){

			if (updateCHECK('category') == true){

				projectCoreFormData.append('p_cat', p_cat);

			}

			if (updateCHECK('subcategory') == true){

				projectCoreFormData.append('p_sub_cat', p_sub_cat);

			}

		}

		var updateProjectCoreXHTTP = new XMLHttpRequest();

		updateProjectCoreXHTTP.open('POST', '/cms/content/project/ajax/update/update-project-core.php', true);

		updateProjectCoreXHTTP.onload = function () {

			if (updateProjectCoreXHTTP.status === 200) {
				document.getElementById("coreUploadLoading").innerHTML = '<span class="fadeInOut">'+updateProjectCoreXHTTP.responseText+'</span>';
				setTimeout(function(){ document.getElementById("coreUploadLoading").innerHTML ='<br>'; }, 1000);
				updateLIST = [];
				refreshCoreMetaData();
			} else {

			alert('An error occurred!');

			}
		};

		updateProjectCoreXHTTP.send(projectCoreFormData);

	}

/* ============================================================
	UPDATE PROJECT CORE START
============================================================ */



/* ============================================================
	ADD ITEM CORE START
============================================================ */

	function addItemCore(transfer) {

		var editorType = transfer.id.split('-')[0];
		//alert(editorType);

		var itemPOS = document.getElementById("item_pos").value;

		document.getElementById("itemEditor").style.display = "block";

		var addItemCoreXHTTP;

		addItemCoreXHTTP = new XMLHttpRequest();

		addItemCoreXHTTP.onreadystatechange = function() {

			if (addItemCoreXHTTP.readyState == 4 && addItemCoreXHTTP.status == 200) {

					//document.getElementById("testRESULTS").innerHTML = addItemCoreXHTTP.responseText;
					if(addItemCoreXHTTP.responseText != ''){
						newItemID = addItemCoreXHTTP.responseText;
						//alert(newItemID);
					}
 
					if(editorType == 'string'){

						addStringItem();

					}
					
					if(editorType == 'image'){

						refreshITEMS();

						document.getElementById("itemEditor").style.display = "none";

						addImageItem();
					}

					if(editorType == 'slideshow'){

						refreshITEMS();

						document.getElementById("itemEditor").style.display = "none";

						addSlideItem();

					}
					
					//document.getElementById("itemEditor").style.display = "none";

			}
		};

		addItemCoreXHTTP.open("POST", "/cms/content/project/ajax/insert/add-item-core.php", true);
		addItemCoreXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		addItemCoreXHTTP.send("coreID=" + coreID + "&itemPOS=" + itemPOS + "&editorType=" + editorType);
	}

/* ============================================================
	ADD ITEM CORE END
============================================================ */


/* ============================================================
	ADD STRING ITEM START
============================================================ */


	function addStringItem() {
		//alert(newItemID);

		var itemPOS = document.getElementById("item_pos").value;
		var stringTYPE = document.getElementById("string_type").value;
		var stringITEM = document.getElementById("item_string").value;
		//alert(stringTYPE);
		if(stringTYPE == 'code'){
		stringITEM = stringITEM.replace("&&", "pure_string_000");
		stringITEM = stringITEM.replace("&", "pure_string_001");
		stringITEM = stringITEM.replace("+", "pure_string_002");
		stringITEM = stringITEM.replace("++", "pure_string_003");
		}
		if(stringTYPE == 'float'){
		stringITEM = stringITEM.replace("&&", "pure_string_000");
		stringITEM = stringITEM.replace("&", "pure_string_001");
		stringITEM = stringITEM.replace("+", "pure_string_002");
		stringITEM = stringITEM.replace("++", "pure_string_003");
		}

		//stringITEM = stringITEM.replace(/\s+/, "");

		//stringITEM = stringITEM.replace("&nbsp", "test12345");

		//(stringITEM);

		document.getElementById("itemEditor").style.display = "block";

		var addStringXHTTP;

		addStringXHTTP = new XMLHttpRequest();

		addStringXHTTP.onreadystatechange = function() {

			if (addStringXHTTP.readyState == 4 && addStringXHTTP.status == 200) {

				if (addStringXHTTP.responseText == 'OK'){

					//document.getElementById("testRESULTS").innerHTML = addStringXHTTP.responseText;
					//alert('hallo');
					refreshITEMS();
					
					//includeJS('/js/slideshow.js', 'off');

					//includeJS('/js/slideshow.js', 'on');

					document.getElementById("itemEditor").style.display = "none";

				}
				
			}
		};

		addStringXHTTP.open("POST", "/cms/content/project/ajax/insert/add-string.php", true);
		addStringXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		addStringXHTTP.send("coreID=" + coreID + "&itemPOS=" + itemPOS + "&stringTYPE=" + stringTYPE + "&stringITEM=" + stringITEM + "&newItemID=" + newItemID);
	}

/* ============================================================
	ADD STRING ITEM END
============================================================ */


/* ============================================================
	ADD IMAGE ITEM START
============================================================ */

	function getImgItemTHUMB(input) {
		var addImageItemThumb = document.getElementById('addImageItemThumb');
		if (input.files && input.files[0]) {
			var imgItemREADER = new FileReader();
			imgItemREADER.onload = function (e) {			
				addImageItemThumb.src = e.target.result;
				addImageItemThumb.width = "auto";
				addImageItemThumb.height = "200px";
			};
			imgItemREADER.readAsDataURL(input.files[0]);
		}
	}

	function imgItemThumbTRIGGER(){
		document.getElementById("addImgItemFileSelect").click();		
	}

	function addImageItem() {

		var fileSelect = document.getElementById('addImgItemFileSelect');
		//var uploadButton = document.getElementById('upload-button');
	
		//uploadButton.innerHTML = 'Uploading...';

		var files = fileSelect.files;

		var formData = new FormData();

		for (var i = 0; i < files.length; i++) {
			
			var file = files[0];

			if (!file.type.match('image.*')) {
				continue;
			}

			formData.append('fileUPLOAD[]', file, file.name);
			formData.append('id', newItemID);
		}

		var addImageXHTTP = new XMLHttpRequest();

		addImageXHTTP.open('POST', '/cms/content/project/ajax/insert/add-image.php', true);

		addImageXHTTP.onload = function () {
			if (addImageXHTTP.status === 200) {
			//uploadButton.innerHTML = 'Upload';
			//document.getElementById("test").innerHTML = addImageXHTTP.responseText;
			//document.getElementById("test").innerHTML += '<img src="/img/project/core/'+file.name+'">';

					refreshITEMS();

					//document.getElementById("itemEditor").style.display = "none";

			} else {
			alert('An error occurred!');
			}
		};

		addImageXHTTP.send(formData);
		
	}

/* ============================================================
	ADD IMAGE ITEM END
============================================================ */


/* ============================================================
	ADD SLIDESHOW ITEM START
============================================================ */

	function getSlideItemTHUMB(input) {

		var addSlideItemThumb = document.getElementById('addSlideItemThumb');

		if (input.files && input.files[0]) {

			var slideItemREADER = new FileReader();

			slideItemREADER.onload = function (e) {

				addSlideItemThumb.src = e.target.result;
				addSlideItemThumb.width = "auto";
				addSlideItemThumb.height = "200px";

			};

			slideItemREADER.readAsDataURL(input.files[0]);

		}
	}

	function slideItemThumbTRIGGER(){

		document.getElementById("addSlideItemFileSelect").click();

	}

	function addSlideItem() {

		var fileSelect = document.getElementById('addSlideItemFileSelect');
		//var uploadButton = document.getElementById('upload-button');
	
		//uploadButton.innerHTML = 'Uploading...';

		var files = fileSelect.files;

		var formData = new FormData();

		for (var i = 0; i < files.length; i++) {
			
			var file = files[0];

			if (!file.type.match('image.*')) {
				continue;
			}

			formData.append('fileUPLOAD[]', file, file.name);
			formData.append('id', newItemID);
			formData.append('p_id', coreID);
		}

		document.getElementById("itemEditor").style.display = "none";
		
		var addImageXHTTP = new XMLHttpRequest();

		addImageXHTTP.open('POST', '/cms/content/project/ajax/insert/add-slide.php', true);

		addImageXHTTP.onload = function () {
			if (addImageXHTTP.status === 200) {
			//uploadButton.innerHTML = 'Upload';
			//document.getElementById("test").innerHTML = addImageXHTTP.responseText;
			//document.getElementById("test").innerHTML += '<img src="/img/project/core/'+file.name+'">';

					refreshITEMS();


			} else {
			alert('An error occurred!');
			}
		};

		addImageXHTTP.send(formData);

	}

/* ============================================================
	ADD SLIDESHOW ITEM END
============================================================ */


/* ============================================================
	GET ADD EDITOR START
============================================================ */
	
	function openAddEditor(e) {

		var editorType = e.id.substr(0, e.id.indexOf('-')); 
		//alert( editorType);

		document.getElementById("itemEditor").style.display = "block";

		var getEditorXHTTP;

		if (editorType.length == 0) { 

			alert(document.getElementById("editorRESULTS"));
			return;

		}

		getEditorXHTTP = new XMLHttpRequest();

		getEditorXHTTP.onreadystatechange = function() {

			if (getEditorXHTTP.readyState == 4 && getEditorXHTTP.status == 200) {

				document.getElementById("editorRESULTS").innerHTML = getEditorXHTTP.responseText;

			}

		};

		getEditorXHTTP.open("GET", "/cms/content/project/ajax/process/get-editor.php?editorTYPE="+editorType + "&coreID=" + coreID, true);
		getEditorXHTTP.send();
	}

	function closeEditor() {

		document.getElementById("itemEditor").style.display = "none";

	}

/* ============================================================
	GET ADD EDITOR END
============================================================ */


/* ============================================================
  HANDLE SLIDESHOW JS FOR AJAX START
============================================================ */

	function includeJS(filename, status){

		if (status == "on") {

			var head = document.getElementsByTagName('head')[0];
			var script = document.createElement('script');
			script.src = filename;
			script.type = "text/javascript";
			script.id = "slideshowSCRIPT";
			head.appendChild(script);

		} else {

			var elem;
			(elem=document.getElementById("slideshowSCRIPT")).parentNode.removeChild(elem)

		}
	}

	includeJS('/js/slideshow.js', 'on');

/* ============================================================
  HANDLE SLIDESHOW JS FOR AJAX START
============================================================ */


/* ============================================================
  REMOVE SINGLE ITEM START
============================================================ */

	function removeItem(transfer) {

		var delItemButtons = document.getElementsByClassName("removeItemBtn");
		var delItemForm = document.getElementById('item-form');

		var itemType = transfer.id.split('-')[0];

		var itemId = transfer.id.split('-')[1];

		//alert(itemType)

		var removeItemXHTTP;

		if (coreID.length == 0) {

			alert(document.getElementById("itemRESULTS"));
			return;

		}

		removeItemXHTTP = new XMLHttpRequest();

		removeItemXHTTP.onreadystatechange = function() {

			if (removeItemXHTTP.readyState == 4 && removeItemXHTTP.status == 200) {

				//document.getElementById("itemRESULTS").innerHTML = removeItemXHTTP.responseText;
				if (removeItemXHTTP.responseText == 'OK'){

					refreshITEMS();

				}

			}

		};

		removeItemXHTTP.open("GET", "/cms/content/project/ajax/remove/remove-"+itemType+"-item.php?itemid=" + itemId + "&coreid=" + coreID, true);
		removeItemXHTTP.send();
		
	}

/* ============================================================
  REMOVE SINGLE ITEM END
============================================================ */


/* ============================================================
  REFRESH ITEM RESULTS START
============================================================ */

	function refreshITEMS(){

		includeJS('/js/slideshow.js', 'off');

		var refreshItemsXHTTP;

		if (coreID.length == 0) { 
			alert(document.getElementById("itemRESULTS"));
		document.getElementById("itemRESULTS").innerHTML = "";
		//alert(document.getElementById("refresh-results").innerHTML);
		return;
		}

		refreshItemsXHTTP = new XMLHttpRequest();

		refreshItemsXHTTP.onreadystatechange = function() {
			if (refreshItemsXHTTP.readyState == 4 && refreshItemsXHTTP.status == 200) {
				document.getElementById("itemRESULTS").innerHTML = refreshItemsXHTTP.responseText;

					//includeJS('/js/slideshow.js', 'off');

					includeJS('/js/slideshow.js', 'on');
//constantInterval();

			}
		};

		refreshItemsXHTTP.open("GET", "/cms/content/project/ajax/process/refresh-item-results.php?coreID="+coreID, true);
		refreshItemsXHTTP.send(); 

	};

	//refreshITEMS();

/* ============================================================
  REFRESH ITEM RESULTS END
============================================================ */




/* ============================================================
	REFRESH PROJECT META DATA START
============================================================ */

	function refreshCoreMetaData() {

		var refreshCoreMetaDataXHTTP;

		refreshCoreMetaDataXHTTP = new XMLHttpRequest();

		refreshCoreMetaDataXHTTP.onreadystatechange = function() {

			if (refreshCoreMetaDataXHTTP.readyState == 4 && refreshCoreMetaDataXHTTP.status == 200) {
				
				//document.getElementById("coreMetaDataRESULTS").innerHTML = refreshCoreMetaDataXHTTP.responseText;
				//refreshCoreMetaDataXHTTP.responseText

					var metaDataArray = refreshCoreMetaDataXHTTP.responseText.split("||");


					for (var i = 0; i < metaDataArray.length -1; i++) {

						var metaItemArray = metaDataArray[i].split("|");
						//alert(metaItemArray[7]);
						document.getElementById("metaDataId").innerHTML = metaItemArray[0];
						document.getElementById("metaDataTitle").innerHTML = metaItemArray[1];
						document.getElementById("metaDataCat").innerHTML = metaItemArray[3];
						document.getElementById("metaDataSubCat").innerHTML = metaItemArray[4];
						if (metaItemArray[5] == 0){
							document.getElementById("metaDataPub").innerHTML = 'private';
						} else {
							document.getElementById("metaDataPub").innerHTML = 'public';
						}

						document.getElementById("metaDataDate").innerHTML = metaItemArray[6];

						if (metaItemArray[8] == 1){
							document.getElementById("metaDataDraft").innerHTML = '<span class="c_r">drafted</span>';
						} else {
							document.getElementById("metaDataDraft").innerHTML = '<span class="c_g">published</span>';
						}						

						return false;
						
					}

			}

		};

		refreshCoreMetaDataXHTTP.open("POST", "/cms/content/project/ajax/process/refresh-project-metadata.php", true);
		refreshCoreMetaDataXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		refreshCoreMetaDataXHTTP.send("p_id="+coreID);
	}
	refreshCoreMetaData();
/* ============================================================
	REFRESH PROJECT META DATA END
============================================================ */



/* ============================================================
	KEY CONTROLS START
============================================================ */



	document.getElementById("p_title").onkeypress = function(e){

		if (!e) e = window.event;

		var keyCode = e.keyCode || e.which;
//alert(keyCode);
		if (keyCode == '13'){

			document.getElementById("p_title").blur();

			if (updateCHECK('title') == true){
				document.getElementById("setting_btn").click();
			}

		}

	}






	if(coreKEY != 'startpage'){

		document.getElementById("add-tag").onkeypress = function(e){

			if (!e) e = window.event;

			var keyCode = e.keyCode || e.which;

			if (keyCode == '13'){
				addCoreKeyword();
			}
		}


		document.getElementById("checkboxG1").onkeypress = function(e){
			if (!e) e = window.event;
			var keyCode = e.keyCode || e.which;
			if (keyCode == '13'){
				if (updateCHECK('public') == true){
					document.getElementById("setting_btn").click();
				}
			}
		}

		document.getElementById("checkboxG2").onkeypress = function(e){
			if (!e) e = window.event;
			var keyCode = e.keyCode || e.which;
			if (keyCode == '13'){
				if (updateCHECK('public') == true){
					document.getElementById("setting_btn").click();
				}
			}
		}


		document.getElementById("coreYear").onkeypress = function(e){
			if (!e) e = window.event;
			var keyCode = e.keyCode || e.which;
			if (keyCode == '13'){
				if (updateCHECK('date') == true){
					document.getElementById("setting_btn").click();
				}
			}
		}

		document.getElementById("coreMonth").onkeypress = function(e){
			if (!e) e = window.event;
			var keyCode = e.keyCode || e.which;
			if (keyCode == '13'){
				if (updateCHECK('date') == true){
					document.getElementById("setting_btn").click();
				}
			}
		}

		document.getElementById("coreDay").onkeypress = function(e){
			if (!e) e = window.event;
			var keyCode = e.keyCode || e.which;
			if (keyCode == '13'){
				if (updateCHECK('date') == true){
					document.getElementById("setting_btn").click();
				}
			}
		}

		document.getElementById("coreHour").onkeypress = function(e){
			if (!e) e = window.event;
			var keyCode = e.keyCode || e.which;
			if (keyCode == '13'){
				if (updateCHECK('date') == true){
					document.getElementById("setting_btn").click();
				}
			}
		}

		document.getElementById("coreMinute").onkeypress = function(e){
			if (!e) e = window.event;
			var keyCode = e.keyCode || e.which;
			if (keyCode == '13'){
				if (updateCHECK('date') == true){
					document.getElementById("setting_btn").click();
				}
			}
		}

		document.getElementById("coreSecond").onkeypress = function(e){
			if (!e) e = window.event;
			var keyCode = e.keyCode || e.which;
			if (keyCode == '13'){
				if (updateCHECK('date') == true){
					document.getElementById("setting_btn").click();
				}
			}
		}

	}

	if(coreKEY == 'archive'){
		document.getElementById("p_cat").onkeypress = function(e){
			if (!e) e = window.event;
			var keyCode = e.keyCode || e.which;
			if (keyCode == '13'){
				document.getElementById("p_cat").blur();

				if (updateCHECK('category') == true){
					document.getElementById("setting_btn").click();
				}
			}
		}

		document.onkeypress = function(e){
			if (!e) e = window.event;
			var keyCode = e.keyCode || e.which;
			if (keyCode == '13'){
				document.getElementById("p_sub_cat").blur();

				if (updateCHECK('subcategory') == true){
					document.getElementById("setting_btn").click();
				}

				//alert('hallo');
				//document.getElementById("addCoreImgFileSelect").blur();
				if (updateCHECK('image') == true){
					document.getElementById("setting_btn").click();
				}

			}
		}
	}


	document.onkeypress = function(e){
		if (!e) e = window.event;
		var keyCode = e.keyCode || e.which;
		var start;
		var end;
		if (keyCode == '9'){

			var ctl = document.getElementById("item_string");
			//ctl.innerHTML = '<span>test</span>';
			//ctl.value = ctl.innerHTML;
			start = ctl.selectionStart;
			end = ctl.selectionEnd;
			ctl.value = ctl.value.substring(0, start) + "\t" + ctl.value.substring(end);
			ctl.selectionStart = ctl.selectionEnd = start + 1;
			return false;

		}
	}


	function textEditorControls (){
		//e.preventDefault()
		//alert('hallo');
		var ctl = document.getElementById("item_string");
		var divE = document.getElementById("divTextEDITOR");
		//ctl.innerHTML = ctl.value;
		divE.innerHTML = '<span class="c_r">'+ctl.value+'</span>';
	}
	function textEditorDivControls (){
		//e.preventDefault()
		//alert('hallo');
		var ctl = document.getElementById("item_string");
		var divE = document.getElementById("divTextEDITOR");
		//ctl.innerHTML = ctl.innerHTML;
		ctl.value = divE.innerHTML;
	}
/* ============================================================
	KEY CONTROLS END
============================================================ */






















