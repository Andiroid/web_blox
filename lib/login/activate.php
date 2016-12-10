<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");


	
?>

<!DOCTYPE html>
<html>
<head>
	<?php include ($root.'/inc/parts/static-head.php'); ?>
</head>
<body>
	<script>

	</script>   
<div id="main_frame">

	<?php include ($root.'/inc/parts/nav.php'); ?>

	<div class="bit-20">    
		<div id="sideContentBOX" class="sideContentBOX">
			<div class="bit-1 welcomeFrame">
				<div style="width:100%;border-radius:250px;background-color:white;border:2px solid #333;background-image: url(/img/core/);  background-size: 100% auto;">
					<div style="padding-top:100%;"></div>
				</div>
				<div style="clear:both;"></div>
				<div style="width:100%;padding:10px 0px;text-align:center;color:#2f2f2f;font-family:anita;font-size:30px;">Hallo!</div>
			</div>

			<div class="welcomeTXT">
				<h4>Herzlich Willkommen auf <br class="mobile-show"> <?php if($AndroidApp == true){echo 'meiner Android APP..';}else{echo 'Your domain';}?></h4>
				<p>Diese <?php if($AndroidApp == true){echo 'APP';}else{echo 'Website';}?> dient als kleiner Einblick in laufende aber auch archivierte Projekte.</p>
				<h4>Viel Spass beim SURFEN</h4>
				<h5>Your Name</h5>
				<br><br>
			</div>
		</div>
	</div>

	<div class="bit-60">

	<div class="mobiletop"></div>


<?php
include ('database_connection.php');

if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $_GET['email']))
{
	$email = $_GET['email'];
}
if (isset($_GET['key']) && (strlen($_GET['key']) == 32))//The Activation key will always be 32 since it is MD5 Hash
{
	$key = $_GET['key'];
}
//echo urlencode($email);

//if (isset($email) && isset($key))
if (isset($key))
{

	// Update the database to set the "activation" field to null

	$query_activate_account = "UPDATE core_usr SET usr_activ=NULL WHERE(usr_activ='$key')LIMIT 1";

   
	$result_activate_account = mysqli_query($dbc, $query_activate_account) ;

	// Print a customized message:
	if (mysqli_affected_rows($dbc) == 1)//if update query was successfull
	{
	echo '<div class="success">Your account is now active. You may now <a href="login.php">Log in</a></div>';

	} else
	{
		echo '<div class="errormsgbox">Oops !Your account could not be activated. Please recheck the link or contact the system administrator.</div>';

	}

	mysqli_close($dbc);

} else {
		echo '<div class="errormsgbox">Error Occured . Please retry or contact the system administrator.</div>';
}


?>


<div class="break40"><br></div>
	</div>

	<div class="bit-20">
	   <br>
	</div>

	<div class="break40"><br></div>

	<?php include ($root.'/inc/parts/footer.php'); ?>

</div>      

<?php include ($root.'/inc/parts/static-bottom.php'); ?>
