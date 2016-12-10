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
#forgotPwdForm{text-align:center; padding:12% 0px;}	
</style>
	
		<div id="forgotPwdFormWrap">
			<form id="forgotPwdForm" action="" method="post" class="registration_form">

				<fieldset>

					<legend>Forgot Password </legend>
					
					<br><div id="forgotPwdError" class="c_r"><br></div><br>
				
					<br><br>

					<label for="forgotPwdEmail">E-mail</label><br>
					<input type="text" id="forgotPwdEmail" name="e-mail" size="25" onblur="validateEMAIL();" onkeyup="valideEMAIL()" /><span id="validateEMAIL"></span>
					<div id="forgotPwdEmailError" class="c_r"><br></div>
					<br>
					<script>

					function validateEMAIL() {
						var x = document.getElementById('forgotPwdEmail').value;
						var y = document.getElementById('forgotPwdEmailError');
						var atpos = x.indexOf("@");
						var dotpos = x.lastIndexOf(".");
						if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
							y.innerHTML = 'invalid email format';
							return false;
						} else {
							y.innerHTML = '<br>';
						}
					}
					function valideEMAIL() {
						var x = document.getElementById('forgotPwdEmail').value;
						var y = document.getElementById('forgotPwdEmailError');
						var atpos = x.indexOf("@");
						var dotpos = x.lastIndexOf(".");
						if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
							//y.innerHTML = 'invalid email format';
							//return false;
						} else {
							y.innerHTML = '<br>';
						}
					}
					</script>



					<input type="hidden" name="formsubmitted" value="TRUE" />
					
					<div id="forgotPwdSubmitBtn" onclick="submitforgotPwd()">Request New Password</div>
					<br><br>

				</fieldset>

			</form>
		</div>

<script>
	

	function submitforgotPwd() {

		var forgotPwdFormWrap =  document.getElementById('forgotPwdFormWrap');
		var forgotPwdError =  document.getElementById('forgotPwdError');

		var forgotPwdEmail = document.getElementById('forgotPwdEmail').value;
		var forgotPwdEmailError = document.getElementById('forgotPwdEmailError');

		forgotPwdError.innerHTML = '<br>';

		forgotPwdEmailError.innerHTML = '<br>';

		var submitforgotPwdXHTTP;

		submitforgotPwdXHTTP = new XMLHttpRequest();

		submitforgotPwdXHTTP.onreadystatechange = function() {

			if (submitforgotPwdXHTTP.readyState == 4 && submitforgotPwdXHTTP.status == 200) {

				var dataArray = submitforgotPwdXHTTP.responseText.split("|||");

				for (var i = 0; i < dataArray.length - 1; i++) {

					var itemArray = dataArray[i].split("||");
					var dataKEY = itemArray[0];

				}

				if(dataKEY == 'OK'){

					forgotPwdFormWrap.innerHTML = itemArray[1];

				}

				if(dataKEY == 'ERROR'){

					forgotPwdError.innerHTML = itemArray[1];

				}

				if(dataKEY == 'DATA'){
				
					for (var i = 0; i < itemArray.length; i++) {

						if(itemArray[i] == 'EMAIL'){

							forgotPwdEmailError.innerHTML = 'invalid email';

						}

						if(itemArray[i] == 'EMAILCHECK'){

							forgotPwdEmailError.innerHTML = 'email is already in use';

						}
						
					}
				}

			}

		};

		submitforgotPwdXHTTP.open("POST", "/lib/login/ajax/forgot-pwd.php", true);
		submitforgotPwdXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		submitforgotPwdXHTTP.send("email="+forgotPwdEmail);

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