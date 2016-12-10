<?php 

/* ============================================================
	VALIDATE DATA START
============================================================ */

	// remove special chars from string & replace whitespace with empty

	function clean($string) {
		$string = str_replace(' ', '', $string);
		$string = str_replace('&lt;', '', $string);
		$string = str_replace('&gt;', '', $string);
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
	}

/* ============================================================
	VALIDATE DATA START
============================================================ */


/* ============================================================
	RETURN SLUG START
============================================================ */

	function create_slug($string){
		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		$slug = strtolower($slug);
		
		if ($slug[0] === "-") {
			$slug = substr($slug, 1);
		}

		if(substr($slug, -1) === "-"){
			$slug = substr($slug, 0, -1);
		}

		return $slug;
		
	}
	//create_slug($string);
/* ============================================================
	RETURN SLUG END
============================================================ */


/* ============================================================
	VALIDATE DATA START
============================================================ */

	// validate strings before upload to sql db

	function validate_str($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

/* ============================================================
	VALIDATE DATA END
============================================================ */



?>