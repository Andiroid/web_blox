<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

if($user['group'] != 2) {
	header('Location: ' . '/');
}

?>

<!DOCTYPE html>
<html style="height:100%;">

<head>
	<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/inc/parts/head.php');?>
</head>

	<body style="height:100%;">

		<div id="main_frame">

			<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/inc/parts/nav.php');?>

			<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/inc/parts/dashboard.php');?>

			<?php include ($root.'/inc/parts/footer.php'); ?>

		</div>		

<?php include ($root.'/inc/parts/static-bottom.php'); ?>