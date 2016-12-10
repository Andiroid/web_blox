<script type="text/javascript">

/* ============================================================
	ARCHIVE MAIN PAGINATION PROCESS START
============================================================ */

	var rc = <?=json_encode($requestSubCat)?>;
	var rm = <?=json_encode($requestCat)?>;
	var at = <?=json_encode($archiveTarget)?>;
	var st = <?=json_encode($searchType)?>;
	var fm = <?=json_encode($fillMode)?>;
	var dm = <?=json_encode($displayMode)?>;
	var ci = parseInt(<?=json_encode($currentINDEX)?>);
	var fi = parseInt(<?=json_encode($finalINDEX)?>);
	var cc = parseInt(<?=json_encode($containerCols)?>);
	var cr = parseInt(<?=json_encode($containerRows)?>);
	var cp = parseInt(<?=json_encode($containerPAYLOAD)?>);

	var sm = '';
	var ap = '';
	var sp = '';

	function loadPagCtrls(ci, fi) {

		var label = document.getElementsByClassName("pag_label");
		for (var x = 0; x < label.length; x++) {
			label[0].innerHTML = 'Page ' + ci + ' of ' + fi;
			label[1].innerHTML = 'Page ' + ci + ' of ' + fi;
		}

	}

	function loadAlphpaResults(e){
		var searchINPUT = document.getElementById("searchINPUT");
		searchINPUT.value='';
		sm = 'alpha';
		ap = e.id;
		request_items(1);

	}

	function searchPAYLOAD(str) {

		sm = 'string';
		sp = str;
		request_items(1);

	}


	function nextPage() {

		if (ci != fi) {
			request_items(ci + 1);
			ci = ci + 1;
		} else {
			request_items(1);
			ci = 1;
		}

	}

	function prevPage() {

		if (ci > 1) {
			request_items(ci - 1);
			ci = ci - 1;
		} else {
			request_items(fi);
			ci = fi;
		}

	}

	function request_items(ci) {

		var pag_load = document.getElementById("pag_load");
		var pag_results = document.getElementById("pag_results");

		var projectTITLE = document.getElementsByClassName("projectTITLE");
		var archivetitle = document.getElementById("archivetitle");
		var searchTITLE = document.getElementsByClassName("searchTITLE");

		pag_load.style.display="block";

		var paginationXHTTP = new XMLHttpRequest();

		paginationXHTTP.open("POST", "/lib/archive/ajax/archive-main-ajax.php", true);
		paginationXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		paginationXHTTP.onreadystatechange = function() {

			if (paginationXHTTP.readyState == 4 && paginationXHTTP.status == 200) {

				var dataArray = paginationXHTTP.responseText.split("||");

				for (var i = 0; i < dataArray.length - 1; i++) {
					
					var itemArray = dataArray[i].split("|");

					pag_results.innerHTML = itemArray[0];

					fi = itemArray[1];

					loadPagCtrls(ci, fi);

				}

				for (var i = 0; i < projectTITLE.length; i++) {
					projectTITLE[i].innerHTML = itemArray[2];
				}

				for (var i = 0; i < searchTITLE.length; i++) {
					searchTITLE[i].innerHTML = itemArray[3];
				}

				pag_load.style.display="none";
				pag_results.style.display="block";

			}
		}

		var markUp = [];
		markUp.push("ci=" + ci + "&fm=" + fm + "&st=" + st + "&dm=" + dm + "&cc=" + cc + "&cr=" + cr + "&cp=" + cp + "&sm=" + sm + "&ap=" + ap + "&sp=" + sp + "&at=" + at);


		if (rc !== null){
			markUp.push("&rc=" + rc);
		}

		if (rm !== null){
			markUp.push("&rm=" + rm);
		}
		
		paginationXHTTP.send(markUp.join(""));

	}

	document.onkeydown = controls;

	function controls(e) {
		e = e || window.event;
		if (e.keyCode == '37') {
			prevPage();
		} else if (e.keyCode == '39') {
			nextPage();
		}
	}

/* ============================================================
	ARCHIVE MAIN PAGINATION PROCESS END
============================================================ */

/* ============================================================
	GET STRUCTURE START
============================================================ */

	var strucType = document.getElementById("struc_type");
	strucType.value = '';

	function getStrucOps(){
		if(strucType.value == 'unique'){
			document.getElementById("submit-trash-process").style.display = 'block';
		}
		if(strucType.value == 'archive'){
			document.getElementById("submit-trash-process").style.display = 'none';
		}
		if(strucType.value == ''){
			document.getElementById("submit-trash-process").style.display = 'none';
		}		
		document.getElementById("strucResults").innerHTML = "";
		document.getElementById("cat-results").innerHTML = "";
		document.getElementById("sub-cat-results").innerHTML = "";

		var coreType = document.getElementById("struc_type");
		var str = coreType.value;
		var xhttp;

		xhttp = new XMLHttpRequest();

		xhttp.onreadystatechange = function() {

			if (xhttp.readyState == 4 && xhttp.status == 200) {
				if(strucType.value == 'archive'){
					document.getElementById("strucResults").innerHTML = xhttp.responseText;
				}			
			}

		};

		xhttp.open("GET", "/cms/content/project/ajax/process/get-struc.php?cat="+str, true);
		xhttp.send(); 

	}

/* ============================================================
	GET STRUCTURE END
============================================================ */

/* ============================================================
	GET CAT START
============================================================ */

	function getCat(){

		var coreStruc = document.getElementById("struc_core");
		var str = coreStruc.value;
		var xhttp;
		if(coreStruc.value == ''){
			document.getElementById("submit-trash-process").style.display = 'none';
		}
		document.getElementById("cat-results").innerHTML = "";
		document.getElementById("sub-cat-results").innerHTML = "";

		xhttp = new XMLHttpRequest();

		xhttp.onreadystatechange = function() {

			if (xhttp.readyState == 4 && xhttp.status == 200) {
				if(coreStruc.value != ''){
				document.getElementById("cat-results").innerHTML = xhttp.responseText;
				}
				document.getElementById("submit-trash-process").style.display = 'none';
			}

		};

		xhttp.open("GET", "/cms/content/project/ajax/process/get-cat.php?cat="+str, true);
		xhttp.send(); 

	}; 

/* ============================================================
	GET CAT END
============================================================ */

/* ============================================================
	GET SUB CAT START
============================================================ */

	function getSubCat(){

		var p_cat = document.getElementById("p_cat");
		var str = p_cat.value;
		var xhttp;
		if(p_cat.value == ''){
			document.getElementById("submit-trash-process").style.display = 'none';
		}
		document.getElementById("sub-cat-results").innerHTML = "";
		xhttp = new XMLHttpRequest();

		xhttp.onreadystatechange = function() {

			if (xhttp.readyState == 4 && xhttp.status == 200) {
				if(p_cat.value != ''){
				document.getElementById("sub-cat-results").innerHTML = xhttp.responseText;
				}
				document.getElementById("submit-trash-process").style.display = 'none';
			}

		};

		xhttp.open("GET", "/cms/content/project/ajax/process/get-sub-cat.php?cat="+str, true);
		xhttp.send(); 
	}

/* ============================================================
	GET SUB CAT END
============================================================ */

/* ============================================================
	SUB CAT ON CHANGE START
============================================================ */

	function subCatOnChange(){

		if(document.getElementById("p_sub_cat").value != ''){
			document.getElementById("submit-trash-process").style.display = 'block';
		} else {
			document.getElementById("submit-trash-process").style.display = 'none';
		}
		
	}

/* ============================================================
	SUB CAT ON CHANGE END
============================================================ */
	
/* ============================================================
	LEFT BIT ACCORDION START
============================================================ */

	var masterACC = document.getElementsByClassName("accordion");
	var masterPANEL = document.getElementsByClassName("panel");

	for (var masterIT = 0; masterIT < masterACC.length; masterIT++) {

		var y = masterIT;
		masterACC[masterIT].onclick = function(){

			for (var x = 0; x < masterACC.length; x++) {

				var activeMasterACC = masterACC[x].className;
				var n = activeMasterACC.search("activeit");

				if(n > -1){

					masterACC[x].classList.toggle("activeit");
					masterACC[x].nextElementSibling.classList.toggle("show");
					this.classList.toggle("activeit");
					this.nextElementSibling.classList.toggle("show");						
									
				} 

			}

			this.classList.toggle("activeit");
			this.nextElementSibling.classList.toggle("show");

		}
	}

/* ============================================================
	LEFT BIT ACCORDION END
============================================================ */

/* ============================================================
	CHECK & UNCHECK ALL CHECKBOXES START
============================================================ */

	function checkAll(){

		//var inputs = document.getElementsByTagName("input");
		var inputs = document.querySelectorAll("input[name='trashCB']");
	
		for(var i = 0; i < inputs.length; i++) {
			inputs[i].checked = true;   
		}
		checkAllState = true;

	}

	function unCheckAll(){

		var inputs = document.querySelectorAll("input[name='trashCB']");
		for(var i = 0; i < inputs.length; i++) {
			inputs[i].checked = false;   
		}

	}

/* ============================================================
	CHECK & UNCHECK ALL CHECKBOXES END
============================================================ */

/* ============================================================
	GET ALL PROJECT IDS FROM CHECKED CHECKBOXES START
============================================================ */

	var jsonTargetIDs;
	var r;
	var count;

	function getCB(e){

		r = e.id.split("-");
		r = r[0];

		var targetIDs = [];
		var inputs = document.querySelectorAll("input[name='trashCB']");

		for(var i = 0; i < inputs.length; i++) {
			if(inputs[i].checked == true){
				var targetID = inputs[i].id.split("-"); 
				targetIDs.push(targetID[1]);
			}	
		}

		count = targetIDs.length;
		jsonTargetIDs = JSON.stringify(targetIDs);

		if(r == 'd'){
			var check = confirm(count+" Projects will be permanent deleted!");
			if (check == true) {
				requestTrashDelProcess();
			}
		}

		if(r == 'a'){
			var popupCount = document.getElementById("popUpCount");
			var popup = document.getElementById("popUpWrap");
			popupCount.innerHTML = count;
			popup.style.display = 'block';
		}

	}

/* ============================================================
	GET ALL PROJECT IDS FROM CHECKED CHECKBOXES END
============================================================ */

/* ============================================================
	CLOSE TRASH PROCESS POPUP START
============================================================ */

	function closePopUp(){
		var popup = document.getElementById("popUpWrap");
		popup.style.display = 'none';	
	}

/* ============================================================
	CLOSE TRASH PROCESS POPUP END
============================================================ */

/* ============================================================
	REQUEST TRASH RECOVER PROCESS START
============================================================ */

	function requestTrashRecoverProcess() {

		var struc = document.getElementById("struc_type").value;

		var formData = new FormData();

		if(struc == 'archive'){

			var arch = document.getElementById("struc_core").value;
			var cat = document.getElementById("p_cat").value;
			var subcat = document.getElementById("p_sub_cat").value;

			formData.append('arch', arch);
			formData.append('cat', cat);
			formData.append('subcat', subcat);

		}

		formData.append('idARR', jsonTargetIDs);
		formData.append('r', r);
		formData.append('struc', struc);


		var requestTrashProcessXHTTP = new XMLHttpRequest();

		requestTrashProcessXHTTP.open('POST', '/lib/archive/ajax/trash.php', true);
		//requestTrashProcessXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		requestTrashProcessXHTTP.onload = function () {
			if (requestTrashProcessXHTTP.status === 200) {
				request_items(1);
			alert(requestTrashProcessXHTTP.responseText);
			} else {
			alert('An error occurred!');
			}
		};

		requestTrashProcessXHTTP.send(formData);
		
	}

/* ============================================================
	REQUEST TRASH RECOVER PROCESS END
============================================================ */

/* ============================================================
	REQUEST TRASH DELETE PROCESS START
============================================================ */

	function requestTrashDelProcess() {

		var formData = new FormData();

		formData.append('idARR', jsonTargetIDs);
		formData.append('r', r);

		var requestTrashProcessXHTTP = new XMLHttpRequest();

		requestTrashProcessXHTTP.open('POST', '/lib/archive/ajax/trash.php', true);

		requestTrashProcessXHTTP.onload = function () {

			if (requestTrashProcessXHTTP.status === 200) {
				alert(requestTrashProcessXHTTP.responseText);
				request_items(1);
			} else {
				alert('An error occurred!');
			}

		};

		requestTrashProcessXHTTP.send(formData);
		
	}

/* ============================================================
	REQUEST TRASH DELETE PROCESS END
============================================================ */

/* ============================================================
	SEARCH BAT ANIMATION START
============================================================ */

	function animateSearch() {

		var alphaSquareWrap = document.getElementById("alphaSquareWrap");
		var searchInputAfter = document.getElementById("searchInputAfter");
		var searchINPUT = document.getElementById("searchINPUT");

		var className = searchINPUT.getAttribute("class");

		if (className=="defaultSearch") {

			searchINPUT.className = "activeSearch";
			
			searchINPUT.style.width = "0px";
			setTimeout(function(){ searchINPUT.style.visibility = 'hidden';searchINPUT.style.paddingLeft = "0px";}, 400);
			//alphaSquareWrap.style.display = "none";
			searchInputAfter.innerHTML = '<img src="/img/core/magnify.svg" alt="">';

		} else {

			searchINPUT.className = "defaultSearch";

			searchINPUT.style.paddingLeft = "10px";
			searchINPUT.style.visibility = 'visible';
			//alert(screen.innerWidth);
			if (window.innerWidth < 1100){
				searchINPUT.style.width = "70%";
			} else {
				searchINPUT.style.width = "14%";
			}
			
			//setTimeout(function(){ alphaSquareWrap.style.display = "block"; }, 400);
			searchInputAfter.innerHTML = "&times;";

		}
		
	}
	//animateSearch();

/* ============================================================
	SEARCH BAT ANIMATION END
============================================================ */

</script>