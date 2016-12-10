<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");


if(isset($_GET['p_slug'])){

	$p_slug = $_GET['p_slug'];

} else {

	include_once($root . "/lib/archive/process/archive-main-class.php");

}

?>

<!DOCTYPE html>

<html>

<head>

	<?php include ($root.'/inc/parts/static-head.php'); ?>

</head>

<body>

<div id="main_frame">

	<?php include ($root.'/inc/parts/nav.php'); ?>

	<?php 

		if(isset($p_slug)){

			include_once($root . "/lib/archive/bits/project-main-bit.php");

		} else {

			include_once($root . "/lib/archive/bits/archive-nav-bit.php");

			include_once($root . "/lib/archive/bits/archive-left-bit.php");

			include_once($root . "/lib/archive/bits/archive-main-bit.php");

			include_once($root . "/lib/archive/bits/archive-right-bit.php");

		}

	?>

	<?php include ($root.'/inc/parts/footer.php'); ?>

</div>

<?php

	if(empty($_GET['p_slug'])){

		include_once($root . "/lib/archive/bits/archive-static-bottom.php");

	}

?>
<script type="text/javascript">

	function trashProject(e){

		var eID = e.id.split('-');

		var xhttp;

		xhttp = new XMLHttpRequest();

		xhttp.onreadystatechange = function() {

			if (xhttp.readyState == 4 && xhttp.status == 200) {
				
				//alert(xhttp.responseText);
				window.location.replace("http://andiroid.info/cms/trash");
			}

		};

		xhttp.open("POST", "/lib/ajax/trash-project.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("id="+eID[0]);

	}

</script>
<?php include ($root.'/inc/parts/static-bottom.php'); ?>
