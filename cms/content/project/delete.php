<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

/*
if (!$auth->isLoggedIn()) {
header('Location: ' . '/');
}
*/
if(isset($_POST["pictureid"])) {

$delitem = $_POST["pictureid"];

	$sql="SELECT img FROM slideshow WHERE nr='$delitem' ORDER BY id DESC";
	$result=mysqli_query($conn,$sql);
	$num_rows = mysqli_num_rows($result);
	$x = 1;
	$files = array();
	while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
		
		$files[] = $row['img'];

		$x++;
	}
	mysqli_free_result($result);

	foreach ($files as $file) {
		if ( @unlink ( $_SERVER[DOCUMENT_ROOT]."/img/slideshow/".$file ) ) {
		echo 'The file <strong><span style="color:green;">' . $file . '</span></strong> was deleted!<br />';
		} else {
		echo 'Couldn\'t delete the file <strong><span style="color:red;">' . $file . '</span></strong>!<br />';
		}
	}
/*
if(isset($_POST["pictureid"])) {

$delitem = $_POST["pictureid"];
*/
//$filename = $_SERVER['DOCUMENT_ROOT'] .'/img/project/'.$_POST["picturename"];
//echo $filename;
// sql to delete a record
$sql = "DELETE FROM content WHERE id='$delitem'";
if ($conn->query($sql) === TRUE) {
    //echo "Record deleted successfully";
} else {
    //echo "Error deleting record: " . $conn->error;
}
$sql = "DELETE FROM slideshow WHERE nr='$delitem'";
if ($conn->query($sql) === TRUE) {
    //echo "Record deleted successfully";
} else {
    //echo "Error deleting record: " . $conn->error;
}
$filename = $_SERVER['DOCUMENT_ROOT'] .'/img/project/'.$_POST["picturename"];
if (is_file($filename)) {

   chmod($filename, 0777);

   if (unlink($filename)) {
      echo 'File deleted';
   } else {
      //echo 'Cannot remove that file';
   }

} else {
  //echo 'File does not exist';
}
/*
if ($conn->query($sql) === TRUE) {
    //echo "Record deleted successfully";
} else {
    //echo "Error deleting record: " . $conn->error;
}
*/
/*
$sql="SELECT img FROM slideshow WHERE nr=$delitem ORDER BY id DESC";
$result=mysqli_query($conn,$sql);
$num_rows = mysqli_num_rows($result);
$x = 1;
$files = array();
while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
	
	$files[] = $row['img'];

	$x++;
}
mysqli_free_result($result);

echo $files[0];



foreach ($files as $file) {
if ( @unlink ( $_SERVER[DOCUMENT_ROOT]."/img/slideshow/".$file ) ) {
echo 'The file <strong><span style="color:green;">' . $file . '</span></strong> was deleted!<br />';
} else {
echo 'Couldn\'t delete the file <strong><span style="color:red;">' . $file . '</span></strong>!<br />';
}
*/
//$conn->close();
//header('Location: ' . $_SERVER['PHP_SELF']);






}


?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/inc/head.php');?>
	</head>
	<body>
		<div id="main_frame">
			<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/inc/parts/nav.php');?>
			<div class="bit-1">
						<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'){include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/inc/history-go-2-btn.php');}else{include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/inc/back-btn.php');}?>

				<div class="bit-20">
					<br>
				</div>
				<div class="bit-60">
					<h1 style="padding-top:30px;text-align:center;">Slideshow-Objekte löschen</h1>

					<form id="cms-delete-form" method="post" action="" enctype="multipart/form-data">
						<input type="hidden" name="deleteslideshowpic" value="1">
						<input type="hidden" name="pictureid">
						<input type="hidden" name="picturename">
						<ul id="deletelist">
							<?php

							$piccounter = 0;
							$sql="SELECT title,img,id FROM content ORDER BY id DESC";
							$result=mysqli_query($conn,$sql);
							$num_rows = mysqli_num_rows($result);
							$x = 1;
							while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
							$piccounter += 1;
							echo '
							<li class="bit-3 deleteWrap"><p class="numberCircle">№' . $piccounter . '</p><input name="hidden" type="hidden" value="' . $row['id'] . '"><button class="delbutton">&#9746;</button><br><img class="deleteimg" alt="' . $row['img'] . '" src="/img/project/200/' . $row['img'] . '"><div class="deletetitle">' . $row['title'] . '</div></li>
							';
							}
							?>
						</ul>
						<br><br>
					</form>
				</div>
				<div class="bit-20">
					<br>
				</div>
				<div class="break40"><br></div>
			</div>
			<script type="text/javascript">
			var delButtons = document.getElementsByClassName("delbutton");
			for(var i = 0; i < delButtons.length; i++) {
				var btnX = delButtons[i];
				btnX.addEventListener('click', function(e) {
					e.preventDefault();
					var parentDOM = this.parentNode;
					var hiddenId = parentDOM.childNodes[1].value;
					var delForm = document.getElementById('cms-delete-form');
					delForm.elements['pictureid'].value = hiddenId;
					var hiddenName = parentDOM.childNodes[4].alt;
					delForm.elements['picturename'].value = hiddenName;
					delForm.submit();
				});
			}
			</script>
			<?php include ($_SERVER['DOCUMENT_ROOT'] . '/inc/parts/footer.php'); ?>
		</div>
<?php include ($root.'/inc/parts/static-bottom.php'); ?>
