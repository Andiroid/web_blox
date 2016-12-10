<?php 

// there are 2 create page methods, unique & archive
// rewrite

/* ============================================================
	CREATE UNIQUE PAGE START
============================================================ */

	function createUniquePage($uniqueName) {

		$newUniqueFile = fopen($_SERVER['DOCUMENT_ROOT'] .'/pages/'. $uniqueName . '.php', 'w');
		$content = '<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/lib/unique/pages/unique.php"); ?>';
		fwrite($newUniqueFile, $content);
		fclose($newUniqueFile);

	}

	//createUniquePage('testarchiv');

/* ============================================================
	CREATE UNIQUE PAGE END
============================================================ */

/* ============================================================
	DELETE UNIQUE PAGE START
============================================================ */

	function delUniquePage($uniqueName) {

		$file = $_SERVER['DOCUMENT_ROOT'] .'/pages/'. $uniqueName . '.php';

		if (!unlink($file)){
		//echo ("Error deleting $file");
		}else{
		//echo ("Deleted $file");
		}

	}

	//delUniquePage('testarchiv');

/* ============================================================
	DELETE UNIQUE PAGE END
============================================================ */

/* ============================================================
	CREATE ARCHIVE PAGE START
============================================================ */

	function createArchivePage($archiveName) {

		$newArchiveFile = fopen($_SERVER['DOCUMENT_ROOT'] .'/pages/'. $archiveName . '.php', 'w');
		$content = '<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/lib/archive/pages/archive.php"); ?>';
		fwrite($newArchiveFile, $content);
		fclose($newArchiveFile);

	}

	//createArchivePage('testarchiv');

/* ============================================================
	CREATE ARCHIVE PAGE END
============================================================ */


/* ============================================================
	CREATE SINGLE EXTERNAL PAGE START
============================================================ */

	function createSinglePageExt($singlePageName, $singlePageLink) {

		$newSinglePageFile = fopen($_SERVER['DOCUMENT_ROOT'] .'/pages/'. $singlePageName . '.php', 'w');
		$content = '<?php include_once("https://'.$singlePageLink.'"); ?>';
		fwrite($newSinglePageFile, $content);
		fclose($newSinglePageFile);

	}


/* ============================================================
	CREATE SINGLE EXTERNAL PAGE START
============================================================ */


/* ============================================================
	CREATE SINGLE LOCAL PAGE START
============================================================ */

	function createSinglePageLocal($singlePageName, $singlePageLink) {

		$newSinglePageFile = fopen($_SERVER['DOCUMENT_ROOT'] .'/pages/'. $singlePageName . '.php', 'w');
		$content = '<?php include_once("https://'.$singlePageLink.'"); ?>';
		fwrite($newSinglePageFile, $content);
		fclose($newSinglePageFile);

	}


/* ============================================================
	CREATE SINGLE LOCAL PAGE START
============================================================ */







?>