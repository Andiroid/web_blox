<?php

/* ============================================================
	ADD UNIQUE RULES START
============================================================ */

	function newUniqueRules($newRule) {
		
		$item_string = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/.htaccess");

		$lines = explode(PHP_EOL, $item_string);

		$length = count($lines);

		$arr = array();

		for ($i = 0; $i < $length+1; $i++) {	

			if (strpos($lines[$i], '||') !== false) {

				$arr[] = ' '. PHP_EOL;

				$arr[] = 'RewriteRule ^'.$newRule.'$ /pages/'.$newRule.'.php [NC,L]'. PHP_EOL;

				$arr[] = '#||'. PHP_EOL;

			} else {

				$arr[] = $lines[$i]. PHP_EOL;

			}
			
		}

		$item_string = implode("",$arr);

		//chmod($_SERVER['DOCUMENT_ROOT'] . "/.htaccess",0777);

		$myfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/.htaccess", "w") or die("Unable to open file!");

		fwrite($myfile, $item_string);

		fclose($myfile);
	}

	//newUniqueRules('test');

/* ============================================================
	ADD UNIQUE RULES END
============================================================ */




/* ============================================================
	EDIT UNIQUE PAGE RULES START
============================================================ */

	function editUniqueRules($newRule, $oldRule) {
		
		$item_string = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/.htaccess");

		$lines = explode(PHP_EOL, $item_string);

		$length = count($lines);

		$arr = array();
		$hitCount = 0;
		for ($i = 0; $i < $length+1; $i++) {	

			if (strpos($lines[$i], $oldRule) !== false) {

				if($hitCount == 0){
					array_pop($arr);
					$hitCount = 1;					
				}

			} else {

				if (strpos($lines[$i], '||') !== false) {

						$arr[] = ' '. PHP_EOL;

						$arr[] = 'RewriteRule ^'.$newRule.'$ /pages/'.$newRule.'.php [NC,L]'. PHP_EOL;

						$arr[] = '#||'. PHP_EOL;
					

				} else {

					$arr[] = $lines[$i]. PHP_EOL;

				}
			
			}
		}
		
		$item_string = implode("",$arr);

		//chmod($_SERVER['DOCUMENT_ROOT'] . "/.htaccess",0777);

		$myfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/.htaccess", "w") or die("Unable to open file!");

		fwrite($myfile, $item_string);

		fclose($myfile);
	}

	//editUniqueRules('test');

/* ============================================================
	EDIT UNIQUE PAGE RULES END
============================================================ */



/* ============================================================
	EDIT STARTPAGE RULES START
============================================================ */

	function newStartPageRules($newRule, $oldRule) {
		
		$item_string = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/.htaccess");

		$lines = explode(PHP_EOL, $item_string);

		$length = count($lines);

		$arr = array();
		$hitCount = 0;
		for ($i = 0; $i < $length+1; $i++) {	

			if (strpos($lines[$i], $oldRule) !== false) {

				if($hitCount == 0){
					array_pop($arr);
					$hitCount = 1;					
				}

			} else {

				if (strpos($lines[$i], '||') !== false) {

						$arr[] = ' '. PHP_EOL;

						$arr[] = 'RewriteRule ^'.$newRule.'$ /pages/startpage.php [NC,L]'. PHP_EOL;

						$arr[] = '#||'. PHP_EOL;
					

				} else {

					$arr[] = $lines[$i]. PHP_EOL;

				}
			
			}
		}
		
		$item_string = implode("",$arr);

		//chmod($_SERVER['DOCUMENT_ROOT'] . "/.htaccess",0777);

		$myfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/.htaccess", "w") or die("Unable to open file!");

		fwrite($myfile, $item_string);

		fclose($myfile);
	}

	//newStartPageRules('test');

/* ============================================================
	EDIT STARTPAGE RULES END
============================================================ */







/* ============================================================
	ADD MASTER ARCHIVE RULES START
============================================================ */

	function newMasterArchiveRules($newRule) {
		
		$item_string = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/.htaccess");

		$lines = explode(PHP_EOL, $item_string);

		$length = count($lines);

		$arr = array();

		for ($i = 0; $i < $length+1; $i++) {	

			if (strpos($lines[$i], '||') !== false) {

				$arr[] = ' '. PHP_EOL;

				$arr[] = 'RewriteRule ^'.$newRule.'/([0-9a-zA-Z_-]+)$ /pages/'.$newRule.'.php?cat=$1 [NC,L]'. PHP_EOL;

				$arr[] = 'RewriteRule ^'.$newRule.'/([0-9a-zA-Z_-]+)/$ /pages/'.$newRule.'.php?cat=$1 [NC,L]'. PHP_EOL;

				$arr[] = 'RewriteRule ^'.$newRule.'/([0-9a-zA-Z_-]+)/([\:\+0-9a-zA-Z_-]+)$ /pages/'.$newRule.'.php?cat=$1&sub_cat=$2 [NC,L]'. PHP_EOL;

				$arr[] = 'RewriteRule ^'.$newRule.'/([0-9a-zA-Z_-]+)/([\:\+0-9a-zA-Z_-]+)/$ /pages/'.$newRule.'.php?cat=$1&sub_cat=$2 [NC,L]'. PHP_EOL;

				$arr[] = 'RewriteRule ^'.$newRule.'/([0-9a-zA-Z_-]+)/([\:\+0-9a-zA-Z_-]+)/([\:\+0-9a-zA-Z_-]+)$ /pages/'.$newRule.'.php?cat=$1&sub_cat=$2&p_slug=$3 [NC,L]'. PHP_EOL;

				$arr[] = 'RewriteRule ^'.$newRule.'/$ /pages/'.$newRule.'.php [NC,L]'. PHP_EOL;

				$arr[] = 'RewriteRule ^'.$newRule.'$ /pages/'.$newRule.'.php [NC,L]'. PHP_EOL;

				$arr[] = '#||'. PHP_EOL;

			} else {

				$arr[] = $lines[$i]. PHP_EOL;

			}
			
		}

		$item_string = implode("",$arr);

		//chmod($_SERVER['DOCUMENT_ROOT'] . "/.htaccess",0777);

		$myfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/.htaccess", "w") or die("Unable to open file!");

		fwrite($myfile, $item_string);

		fclose($myfile);
	}

	//newCatRules('test');

/* ============================================================
	ADD MASTER ARCHIVE RULES END
============================================================ */



/* ============================================================
	ADD CAT RULES START
============================================================ */

	function newCatRules($newRule) {
		
		$item_string = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/.htaccess");

		$lines = explode(PHP_EOL, $item_string);

		$length = count($lines);

		$arr = array();

		for ($i = 0; $i < $length+1; $i++) {	

			if (strpos($lines[$i], '||') !== false) {

				$arr[] = ' '. PHP_EOL;

				$arr[] = 'RewriteRule ^'.$newRule.'/([0-9a-zA-Z_-]+)$ /pages/'.$newRule.'.php?sub_cat=$1 [NC,L]'. PHP_EOL;

				$arr[] = 'RewriteRule ^'.$newRule.'/([0-9a-zA-Z_-]+)/$ /pages/'.$newRule.'.php?sub_cat=$1 [NC,L]'. PHP_EOL;

				$arr[] = 'RewriteRule ^'.$newRule.'/([0-9a-zA-Z_-]+)/([\:\+0-9a-zA-Z_-]+)$ /pages/'.$newRule.'.php?sub_cat=$1&p_slug=$2 [NC,L]'. PHP_EOL;

				$arr[] = 'RewriteRule ^'.$newRule.'/$ /pages/'.$newRule.'.php [NC,L]'. PHP_EOL;

				$arr[] = 'RewriteRule ^'.$newRule.'$ /pages/'.$newRule.'.php [NC,L]'. PHP_EOL;

				$arr[] = '#||'. PHP_EOL;

			} else {

				$arr[] = $lines[$i]. PHP_EOL;

			}
			
		}

		$item_string = implode("",$arr);

		//chmod($_SERVER['DOCUMENT_ROOT'] . "/.htaccess",0777);

		$myfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/.htaccess", "w") or die("Unable to open file!");

		fwrite($myfile, $item_string);

		fclose($myfile);
	}

	//newCatRules('test');

/* ============================================================
	ADD CAT RULES END
============================================================ */

/* ============================================================
	REMOVE CAT RULES START
============================================================ */

	function removeCatRules($targetRule) {
		
		$item_string = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/.htaccess");

		$lines = explode(PHP_EOL, $item_string);

		$length = count($lines);

		$arr = array();
		$hitCount = 0;

		for ($i = 0; $i < $length+1; $i++) {	

			if (strpos($lines[$i], $targetRule) !== false) {

				if($hitCount == 0){
					array_pop($arr);
					$hitCount = 1;					
				}


			} else {

				$arr[] = $lines[$i]. PHP_EOL;

			}
			
		}

		$item_string = implode("",$arr);

		$myfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/.htaccess", "w") or die("Unable to open file!");

		fwrite($myfile, $item_string);
		
		fclose($myfile);
	}

	//removeCatRules('test');

/* ============================================================
	REMOVE CAT RULES END
============================================================ */

?>