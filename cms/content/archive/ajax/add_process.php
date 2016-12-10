<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/lib/core_functions.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/lib/file_functions.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/lib/rewrite_functions.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/lib/gfx_functions.php');



/* ============================================================
	SETUP MASTER CAT DB ENTRY END
============================================================ */

	$req_key = $_POST["key"];
	$req_link = $_POST["link"];
	$req_title = $_POST["title"];
	$req_mode = $_POST["mode"];
	$req_align = $_POST["align"];
	$req_cols = $_POST["cols"];
	$req_rows = $_POST["rows"];

	$req_slug = create_slug($req_title);
	
/* ============================================================
	IMAGE PROCESS START
============================================================ */	

if($req_key == 'archive'){

	include($_SERVER['DOCUMENT_ROOT'] . '/cms/content/archive/ajax/bits/key-archive.php');

}

if($req_key == 'category'){

	include($_SERVER['DOCUMENT_ROOT'] . '/cms/content/archive/ajax/bits/key-category.php');

}

if($req_key == 'sub-category'){

	include($_SERVER['DOCUMENT_ROOT'] . '/cms/content/archive/ajax/bits/key-sub-category.php');
	
}



?>