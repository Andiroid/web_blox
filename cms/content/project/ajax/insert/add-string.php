<?php 

	require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

	$new_item_id = $_POST['newItemID'];
	$p_id = $_POST['coreID'];
	$item_nr = $p_id;
	$item_pos = $_POST['itemPOS'];
	$item_type = 'string';
	$string_type = $_POST['stringTYPE'];
	$item_string = $_POST['stringITEM'];

	//echo $item_pos.'<br>';
	//echo $string_type.'<br>';
	//echo $item_string;



		//echo $string_type;

		if($string_type == 'float'){
			$item_string = $item_string;
			$item_string = htmlentities($item_string, ENT_QUOTES);
			$item_string = str_replace("pure_string_000", "&&", $item_string);
			$item_string = str_replace("pure_string_001", "&", $item_string);
			$item_string = str_replace("pure_string_002", "+", $item_string);
			$item_string = str_replace("pure_string_003", "++", $item_string);
			$item_string = '<div class="float">'.$item_string.'</div>';
		}
		if($string_type == 'free'){
			$item_string = $item_string;
			$item_string = htmlentities($item_string, ENT_QUOTES);
		}
		if($string_type == 'head'){
			$item_string = $item_string;
			$item_string = htmlentities($item_string, ENT_QUOTES);
			$item_string = '<div class="headline">'.$item_string.'</div>';
		}
		if($string_type == 'code'){

			//$item_string = nl2br($item_string);
			//escapes sensitive html chars to avoid xss
			//$item_string = htmlentities($item_string, ENT_QUOTES);
			//$item_string = nl2br(str_replace("    ", "&nbsp", $item_string));
			//$item_string = nl2br(str_replace("&nbsp", "&nbsp;&nbsp;&nbsp;&nbsp;", $item_string));
			//echo htmlspecialchars_decode($str);
			//echo htmlspecialchars_decode($str, ENT_NOQUOTES);
			//escapes sensitive sql chars
			//$item_string = mysql_real_escape_string($item_string);

			// remove \n BUG
			
			//$item_string = $item_string;
			//$item_string = preg_replace('/&(?![A-Za-z0-9#]{1,7};)/','&amp;',$item_string);
			$item_string = addslashes($item_string);
			//$item_string = preg_replace('/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/', "test124", $item_string);
			//$item_string = htmlspecialchars($item_string);
			//$item_string = nl2br(str_replace("test12345", "&nbsp", $item_string));

			$item_string = str_replace("pure_string_000", "&&", $item_string);
			$item_string = str_replace("pure_string_001", "&", $item_string);
			$item_string = str_replace("pure_string_002", "+", $item_string);
			$item_string = str_replace("pure_string_003", "++", $item_string);
			//$item_string = str_replace("pure_string_002", '\n', $item_string);

			$item_string = htmlentities($item_string, ENT_QUOTES, 'UTF-8');
			//$item_string = str_replace('escape_string_0', '\n', $item_string);
			//$item_string = '<pre><code>'.$item_string.'</code></pre>';

			//$item_string = htmlspecialchars_decode($item_string);
			

			$lines = explode(PHP_EOL, $item_string);

			$length = count($lines);
			$arr = array();
			$arr[] = '<pre><span class="line-number">';

			for ($i = 1; $i < $length+1; $i++) {

				$arr[] = '<span>'.$i.'</span>';
				
			}
			$arr[] = '</span>';
			for ($i = 1; $i < $length+1; $i++) {
				//$thisLine = highlight_string($lines[$i-1], TRUE);
				
				$arr[] = '<code>'.$lines[$i-1].'</code>';
			}
			$arr[] = '<span class="cl"></span></pre>';
			$item_string = implode(" ",$arr);


/*
<style type="text/css">
.num {
float: left;
color: gray;
text-align: right;
margin-right: 6pt;
padding-right: 6pt;
border-right: 1px solid gray;}
</style> 

function highlight_num($file)
{
  $item_string = '<code class="num">', implode(range(1, count(file($file))), '<br />'), '</code>';
  highlight_file($file);
}

highlight_num(/test.php); 
*/ 

			/*
			echo'
<pre><span class="line-number"><span>1</span><span>2</span><span>3</span><span>4</span></span><code>test
test
test
test</code>
<span class="cl"></span>
</pre>			
';
*/
		}





		$sql = "INSERT INTO item_string (string_nr, string_payload, string_type)
		VALUES ('$new_item_id', '$item_string', '$string_type')";



		if ($conn->query($sql) === TRUE) {
			$last_item_id = $conn->insert_id;
			//echo "New record created successfully. Last inserted ID is: " . $last_item_id;
			//header('Location: '.$_SERVER['REQUEST_URI']);
			echo 'OK';
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}











?>