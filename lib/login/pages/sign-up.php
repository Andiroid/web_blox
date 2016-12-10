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
#signUpForm{text-align:center; padding:12% 0px;}	
</style>
	
		<div id="signUpFormWrap">
			<form id="signUpForm" action="" method="post" class="registration_form">

				<fieldset>

					<legend>Registration Form </legend>
					
					<br><div id="signUpError" class="c_r"><br></div><br>

					<label for="name">Username</label><br>
					<input id="signUpUsername" onkeyup="checkUsername(this)" type="text" maxlength="20" name="name" size="25" />
					<div id="signUpUsrError" class="c_r"><br></div>

				<div style="text-align:center;color:#1f1f1f;font-family:Helvetica;font-size:12px;">
					<span style="color:red;" id="char_left"></span> Buchstaben zur Verfügung
				</div>

				<script>

					var username = document.getElementById('signUpUsername');
					var usernameLabel = document.getElementById('char_left');

					var start_length = username.value.length;
					var text_max = 20 - start_length;

					usernameLabel.innerHTML = text_max;

					function checkUsername(e){

						var res = username.value.replace(" ", "_");
						res = res.replace(/[^-\w\s]/gi, '');
						//alert(res);
						var text_length = res.length;
						username.value = res;
						var text_remaining = 20 - text_length;
						usernameLabel.innerHTML = text_remaining;

					};

				</script>				
					<br><br>

					<label for="signUpEmail">E-mail</label><br>
					<input type="text" id="signUpEmail" name="e-mail" size="25" onblur="validateEMAIL();" onkeyup="valideEMAIL()" /><span id="validateEMAIL"></span>
					<div id="signUpEmailError" class="c_r"><br></div>
					<br>
					<script>

					function validateEMAIL() {
						var x = document.getElementById('signUpEmail').value;
						var y = document.getElementById('signUpEmailError');
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
						var x = document.getElementById('signUpEmail').value;
						var y = document.getElementById('signUpEmailError');
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

					<label for="signUpPassword">Password</label><br>
					<input type="password" id="signUpPassword" name="Password" size="25" />
					<div id="signUpPwdError" class="c_r"><br></div>
					<br>

					<label for="signUpRepeatPassword">Repeat Password</label><br>
					<input type="password" id="signUpRepeatPassword" name="repeat-password" size="25" />
					<div id="signUpRepeatPwdError" class="c_r"><br></div>
					<br>
					
					<input checked type="checkbox" name="staylogged" id="signUpNewsletter" class="css-checkbox" />
					<label for="signUpNewsletter" class="css-label">I totally need a Newsletter !?</label>

					<br><br>

					<input type="hidden" name="formsubmitted" value="TRUE" />
					
					<div id="signUpSubmitBtn" onclick="submitSignUp()">Sign Up</div>
					
					<br><br>

				</fieldset>

			</form>
		</div>

<script>
	

	function submitSignUp() {

		var signUpFormWrap =  document.getElementById('signUpFormWrap');
		var signUpError =  document.getElementById('signUpError');
		var signUpUsername =  document.getElementById('signUpUsername').value;
		var signUpUsrError =  document.getElementById('signUpUsrError');
		var signUpPassword = document.getElementById('signUpPassword').value;
		var signUpPwdError = document.getElementById('signUpPwdError');
		var signUpRepeatPassword = document.getElementById('signUpRepeatPassword').value;
		var signUpEmail = document.getElementById('signUpEmail').value;
		var signUpEmailError = document.getElementById('signUpEmailError');
		var signUpNewsletter = document.getElementById('signUpNewsletter').checked;
		var signUpRepeatPwdError = document.getElementById('signUpRepeatPwdError');
		
		signUpError.innerHTML = '<br>';
		signUpUsrError.innerHTML = '<br>';
		signUpEmailError.innerHTML = '<br>';
		signUpPwdError.innerHTML = '<br>';
		signUpRepeatPwdError.innerHTML = '<br>';

		var submitSignUpXHTTP;

		submitSignUpXHTTP = new XMLHttpRequest();

		submitSignUpXHTTP.onreadystatechange = function() {

			if (submitSignUpXHTTP.readyState == 4 && submitSignUpXHTTP.status == 200) {

				var dataArray = submitSignUpXHTTP.responseText.split("|||");

				for (var i = 0; i < dataArray.length - 1; i++) {

					var itemArray = dataArray[i].split("||");
					var dataKEY = itemArray[0];

				}

				if(dataKEY == 'OK'){

					signUpFormWrap.innerHTML = itemArray[1];

				}

				if(dataKEY == 'ERROR'){

					signUpError.innerHTML = itemArray[1];

				}

				if(dataKEY == 'DATA'){
				
					for (var i = 0; i < itemArray.length; i++) {

						if(itemArray[i] == 'EMAIL'){

							signUpEmailError.innerHTML = 'invalid email';

						}

						if(itemArray[i] == 'NAME'){

							signUpUsrError.innerHTML = 'invalid name';

						}

						if(itemArray[i] == 'PWD'){

							signUpPwdError.innerHTML = 'empty password';

						}	

						if(itemArray[i] == 'USRCHECK'){

							signUpUsrError.innerHTML = 'username exists already';

						}

						if(itemArray[i] == 'EMAILCHECK'){

							signUpEmailError.innerHTML = 'email is already in use';

						}
						
						if ((!!signUpPassword && !!signUpRepeatPassword) && (signUpPassword == signUpRepeatPassword)){

						} else {
					
							document.getElementById('signUpPwdError').innerHTML = 'password repeat failed';
							document.getElementById('signUpRepeatPwdError').innerHTML = 'password repeat failed';
							
						}
					}
				}

			}

		};

		submitSignUpXHTTP.open("POST", "/lib/login/ajax/sign-up.php", true);
		submitSignUpXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		submitSignUpXHTTP.send("name="+signUpUsername+"&email="+signUpEmail+"&password="+signUpPassword+"&newsletter="+signUpNewsletter);

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