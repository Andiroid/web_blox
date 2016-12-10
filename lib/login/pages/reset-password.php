<?php
if (isset($_GET["q"])) {
    $q = $_GET["q"];
}
if (isset($_GET["email"])) {
    $email = urldecode($_GET["email"]);
}


?>
<?php


require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");



?>
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
<div class="success"><?php echo $_SESSION['fk_group']	; ?></div>
	<div class="bit-20">    
		<br>
	</div>

	<div class="bit-60">
<style>
#resetPwdForm{text-align:center; padding:12% 0px;}	
</style>
	
		<div id="resetPwdFormWrap">
			<form id="resetPwdForm" action="" method="post" class="registration_form">

				<fieldset>

					<legend>Reset Password </legend>
					
					<br><div id="resetPwdError" class="c_r"><br></div><br>
			
					<br><br>

					<label for="resetPwdPassword">New Password</label><br>
					<input type="password" id="resetPwdPassword" name="Password" size="25" />
					<div id="resetPwdPwdError" class="c_r"><br></div>
					<br>

					<label for="resetPwdRepeatPassword">Repeat New Password</label><br>
					<input type="password" id="resetPwdRepeatPassword" name="repeat-password" size="25" />
					<div id="resetPwdRepeatPwdError" class="c_r"><br></div>
					<br>

					<input type="hidden" name="formsubmitted" value="TRUE" />
					
					<div id="resetPwdSubmitBtn" onclick="submitresetPwd()">Save New Password</div>
					
					<br><br>

				</fieldset>

			</form>
		</div>

<script>
var q = <?=json_encode($q)?>;	
var email = <?=json_encode($email)?>;
	function submitresetPwd() {

		var resetPwdFormWrap =  document.getElementById('resetPwdFormWrap');
		var resetPwdError =  document.getElementById('resetPwdError');


		var resetPwdPassword = document.getElementById('resetPwdPassword').value;
		var resetPwdPwdError = document.getElementById('resetPwdPwdError');
		var resetPwdRepeatPassword = document.getElementById('resetPwdRepeatPassword').value;


		var resetPwdRepeatPwdError = document.getElementById('resetPwdRepeatPwdError');
		
		resetPwdError.innerHTML = '<br>';

		resetPwdPwdError.innerHTML = '<br>';
		resetPwdRepeatPwdError.innerHTML = '<br>';

		var submitresetPwdXHTTP;

		submitresetPwdXHTTP = new XMLHttpRequest();

		submitresetPwdXHTTP.onreadystatechange = function() {

			if (submitresetPwdXHTTP.readyState == 4 && submitresetPwdXHTTP.status == 200) {

				if(submitresetPwdXHTTP.responseText == 'OK'){
					
					document.getElementById('resetPwdFormWrap').innerHTML = '<div class="c_g" style="width:100%; text-align:center; padding:25% 0px;">Confirmed !<br><br><span style="color:#3f3f3f;">Your password has been changed to the new one.</span><br><br>';

				}
			}
		};

		submitresetPwdXHTTP.open("POST", "/lib/login/ajax/reset-pwd.php", true);
		submitresetPwdXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		
		if ((!!resetPwdPassword && !!resetPwdRepeatPassword) && (resetPwdPassword == resetPwdRepeatPassword)){
			submitresetPwdXHTTP.send("pwd="+resetPwdPassword+"&q="+q+"&email="+email);
		} else {
	
			document.getElementById('resetPwdPwdError').innerHTML = 'password repeat failed';
			document.getElementById('resetPwdRepeatPwdError').innerHTML = 'password repeat failed';
			
		}
	}

</script>

<div class="break40"><br></div>
	</div>

	<div class="bit-20">
	   <br>
	</div>

	<div class="break40"><br></div>

	<?php include ($root.'/inc/parts/footer.php'); ?>

</div>      

<?php include ($root.'/inc/parts/static-bottom.php'); ?>