

/* ============================================================
	GET DRAFT COUNT START
============================================================ */


	
	function getDraftCount() {

		var draftCountXHTTP;

		draftCountXHTTP = new XMLHttpRequest();

		draftCountXHTTP.onreadystatechange = function() {

			if (draftCountXHTTP.readyState == 4 && draftCountXHTTP.status == 200) {
				
				document.getElementById("draftCountRESULTS").innerHTML = draftCountXHTTP.responseText;

			}

		};

		draftCountXHTTP.open("POST", "/cms/content/project/ajax/process/get-draft-count.php", true);
		draftCountXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		draftCountXHTTP.send();
	}

	//getDraftCount();


/* ============================================================
	GET DRAFT COUNT END
============================================================ */