<style type="text/css">
	



/* ============================================================
	DROPDOWN FRAMEWORK START
============================================================ */

	.nav-wrap{
		position:relative;
		top:0px;
		left:0px;
		background-color:#333;
		width:100%;

	}
.navInner{
	display:block;
}

	.dropdown {
		position: relative;
		display: inline-block;
		margin:0px -5px;
	}

	.dropcontent {
		
		position: absolute;
		z-index:999999999;
		background-color: #f9f9f9;
		min-width: 320px;
		box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	}

.mobile-nav-trigger{
	display: none;
}

	/*
	.dropdown:hover .dropcontent {
		display: block;
	}
	*/
/* ============================================================
	DROPDOWN FRAMEWORK END
============================================================ */


/* ============================================================
	DESKTOP NAV CATEGORIES START
============================================================ */

	.deskNavAcc {
		background-color: #1f1f1f;
		color: #fff;
		cursor: pointer;
		padding: 18px;
		width: 320px;
		border: none;
		text-align: left;
		outline: none;
		font-size: 15px;
		transition: 0.4s;
	}

	.deskNavAcc.deskNavActive, .deskNavAcc:hover {
		background-color: #2f2f2f;
		box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.3);
	}

	.deskNavAcc:after {
		content: '▶';
		font-size: 13px;
		color: #777;
		float: right;

	}

	.deskNavAcc:hover:after {
		content: '▶';
		color: #fff;

	}

	.accAll:after{content:'' !important;}

	.deskNavAcc.deskNavActive:after {
		color: #fff;
		content: '▼';
	}

	.deskNavPanel {
		width: 320px;
		padding: 0 18px;
		background-color: rgba(255, 255, 255, 1);

		max-height: 0;
		overflow: hidden;
		transition: 0.6s ease-in-out;
		opacity: 0;
		filter: alpha(opacity=0);
	}

	.deskNavPanel.deskNavShow {
		filter: alpha(opacity=100);
		opacity: 1;
		max-height: 500px;
		overflow-y:scroll;  
	}

	.deskNavSubCatItem{
		background-color:#2f2f2f;
		box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.3);
		font-size:14px;
		font-family:Helvetica;
		letter-spacing:1px;
		color:white;
		padding:7px;
		cursor:pointer;
		line-height: 42px;
	}
	.deskNavSubCatItem:hover{
		box-shadow: 5px 5px 3px rgba(0, 0, 0, 0.3);
	}

/* ============================================================
	DESKTOP NAV CATEGORIES START
============================================================ */


/* ============================================================
	DROPDOWN BUTTON START
============================================================ */

	.dropbtn {
		color: #fff;
		cursor: pointer;
		padding: 16px;
		height:50px;
		border: none;
		text-align: left;
		outline: none;
		font-size: 15px;
		transition: 0.4s;
	}

	.dropbtn.deskNavActive, .dropbtn:hover {
		background-color: #1f1f1f;
	}

	.dropbtn:after {
		content: '\00a0\00a0\00a0▶\00a0';
		width:20px;
		font-size: 12px;
		color: #777;
		float: right;

	}

	.dropbtn:hover:after {
		content: '\00a0\00a0\00a0▼\00a0';
		width:20px;
		color: #fff;
	}
	.dropbtn.deskNavActive:after {
		color: #fff;
		content: '\00a0\00a0\00a0▼\00a0';
	}
/* ============================================================
	DROPDOWN BUTTON END
============================================================ */


/* ============================================================
	DEFAULT NAV BUTTONS START
============================================================ */

	.deskNavSubLink {
		color: #fff;
		background-color: #1f1f1f;
		cursor: pointer;
		padding: 16px;
		height:50px;
		border: none;
		text-align: left;
		outline: none;
		font-size: 15px;
		transition: 0.4s;
	}

	.deskNavSubLink a{
		color: #fff;
	}

	.deskNavActive, .deskNavSubLink:hover {
		background-color: #2f2f2f;
		box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.3);
	}

	.nodropbtn {
		color: #fff;
		cursor: pointer;
		padding: 16px;
		height:50px;
		border: none;
		text-align: left;
		outline: none;
		font-size: 15px;
		transition: 0.4s;
	}

	.nodropbtn a {
		color: #fff;
	}

	.deskNavActive, .nodropbtn:hover {
		background-color: #1f1f1f;
	}

	.homeBtn{

		position: relative;
		display: inline-block;
	}

	.homeBtn:hover{
		background-color: #1f1f1f;
	}

	.homeBtn div{
		cursor:pointer;
		height:35px;
		padding-right:15px;
		color:white;
		display:inline-block;
	}

	.homeBtn img{
		margin-bottom:-20px;
		width:50px;
		height:50px;
		padding:10px;
	}

/* ============================================================
	DEFAULT NAV BUTTONS END
============================================================ */

@media screen and (min-width: 1900px){

}

@media screen and (min-width: 1400px) and (max-width: 1900px) {

}

@media screen and (min-width: 1200px) and (max-width: 1400px) {

}

@media screen and (min-width: 1000px) and (max-width: 1200px) {

}

@media screen and (min-width: 800px) and (max-width: 1000px) {

}

@media screen and (min-width: 450px) and (max-width: 800px) {

}

@media screen and (max-width: 450px) {

}
@media screen and (min-width: 950px) {













	#userDisplayRESULTS{position:relative;background-color:#333;float:right;top:15px;right:20px;padding:15px;z-index:999999999999;}
	.loginBtn{color:#fff;font-family:bebas;font-size:20px;cursor:pointer;}
	.usrName{position:relative;z-index:999;color:#fff;font-family:bebas;font-size:20px;cursor:pointer;}
	.usrAdmin{padding-right:5px;position:relative;z-index:99;color:red;font-family:bebas;font-size:20px;cursor:pointer;}
}
@media screen and (max-width: 950px) {




		.homeBtn{
		
		width:100%;
	}	
	.mobile-nav-trigger{
		width:50px;
		
	}
	.mobile-nav-trigger div{
		position:relative;
		top:0px;
		left:0px;
height:50px;
line-height:25px;
		font-size:25px;
	}
	.nav-wrap{
		position:relative;
		top:0px;
		left:0px;
		background-color: #333;
		/*
		background-color: cyan;
		*/
		width:100%;
		overflow: hidden;
	}

	.dropdown {
		position: relative;
		display: block;
		margin:0px -5px;
	}

	.dropcontent {
		position: relative;
		z-index:999999999;
		/*
		background-color: magenta;
		*/
		min-width: 100%;
		box-shadow: 0;
	}

	.deskNavAcc {
		background-color:grey;
		color: #fff;
		cursor: pointer;
		padding: 18px;
		width: 100%;
		border: none;
		text-align: left;
		outline: none;
		font-size: 15px;
		transition: 0.4s;
	}

	.deskNavPanel {
		width: 100%;
		padding: 0 18px;
		background-color: rgba(255, 255, 255, 1);

		max-height: 0;
		overflow: hidden;
		transition: 0.6s ease-in-out;
		opacity: 0;
		filter: alpha(opacity=0);
	}

	.navInner{
		display:none;
		background-color:#1f1f1f;
	}

	.homeBtn{
		/*
		background-color: grey;
		*/
	}

	.dropdown.mobile-nav-trigger{
		background-color: #333;
		
	}

	.deskNavSubLink {
		background-color: grey;
	}

	.deskNavAcc.deskNavActive, .deskNavAcc:hover {
		background-color: #333;
	}

	.dropbtn.deskNavActive, .dropbtn:hover {
		background-color: #333;
	}

	.deskNavActive, .deskNavSubLink:hover {
		background-color: #333;
	}

	.deskNavActive, .nodropbtn:hover {
		background-color: #1f1f1f;
	}

	.homeBtn:hover{
		background-color: #333;
	}






	#userDisplayRESULTS{position:absolute;background-color:rgba(255, 0, 0, 0);float:right;top:0px;right:0px;padding:15px;z-index:999999999999;}
	.loginBtn{color:#fff;font-family:bebas;font-size:20px;cursor:pointer;}
	.usrName{position:relative;z-index:999;color:#fff;font-family:bebas;font-size:20px;cursor:pointer;}
	.usrAdmin{padding-right:5px;position:relative;z-index:99;color:red;font-family:bebas;font-size:20px;cursor:pointer;}





}

</style>










<div class="nav-wrap">
	<div class="dropdown mobile-nav-trigger">
		<div class="nodropbtn" onclick="mobileNavTrigger()">☰</div>
	</div>
	<div class="navInner">
		<?php

			//$archSQL="SELECT * FROM p_arch WHERE arch_type='0' ORDER BY arch_pos ASC";
			$strucSQL="SELECT * FROM struc_core WHERE struc_pub='0' AND struc_trash='0' ORDER BY struc_pos ASC";
			$strucRESULT=mysqli_query($conn,$strucSQL);
			$strucCOUNT = mysqli_num_rows($strucRESULT);
			$strucData = array();

			while ($strucROW = mysqli_fetch_array($strucRESULT, 1)) {

				$strucId = $strucROW['struc_id'];
				$strucKey = $strucROW['struc_key'];
				$strucTitle = $strucROW['struc_title'];
				$strucSlug = $strucROW['struc_slug'];


				if($strucKey == 'startpage'){

					echo '
						<a href="/'.$strucSlug.'" class="homeBtn n-part">			
							<img src="https://andiroid.info/img/core/andiroid-robo1-op.svg"/>
							<div>'.$strucTitle.'</div>
						</a>
					';

				}


				if($strucKey == 'unique'){

					echo '
						<div class="dropdown n-part">
							<a href="/'.$strucSlug.'">
								<div class="nodropbtn n-part">
									'.$strucTitle.'
								</div>
							</a>
						</div>
					';

				}

				if($strucKey == 'archive'){

					echo '

						<div class="dropdown n-part">
							<div class="dropbtn n-part" onclick="dropDown(this)">'.$strucTitle.'</div>
							<div class="dropcontent n-part" style="display:none;">		

					';

					$sql="SELECT cat_title,cat_slug,cat_link FROM struc_cat WHERE cat_link='$strucSlug' ORDER BY cat_slug ASC";
					$result=mysqli_query($conn,$sql);
					$num_rows = mysqli_num_rows($result);
					$x = 1;
					if($num_rows != 0){

					}

					echo '<a href="/'.$strucSlug.'"><div class="deskNavSubLink n-part">All '.strtoupper($strucSlug).'</div></a>';
					
					while ($row = mysqli_fetch_array($result, 1)) {

						$newcat = $row['cat_slug'];
						$newarch = $row['cat_link'];


						$subCatSQL="SELECT sub_cat_title,sub_cat_slug FROM struc_sub_cat WHERE sub_cat_link='$newcat' ORDER BY sub_cat_slug ASC";
						$subCatRESULT=mysqli_query($conn,$subCatSQL);
						$subCatCOUNT = mysqli_num_rows($subCatRESULT);

						if($subCatCOUNT == 0){

							echo '<a href="/'.$strucSlug.'/'.$row['cat_slug'].'"><div class="deskNavSubLink n-part">'.$row['cat_title'].'</div></a>';

						} else {

							echo '
								<div class="deskNavAcc n-part" onclick="triggerAcc(this)">'.$row['cat_title'].'</div>
									<div class="deskNavPanel"><br>
							';

							echo '
								<div>
									<a href="/'.$newarch.'/'.$newcat.'">
										<div style="margin:0px 0px;padding-right:10px;">
											<span class="deskNavSubCatItem n-part">ALL</span>
										</div>
									</a>
								</div>

							';

							while ($subCatROW = mysqli_fetch_array($subCatRESULT, 1)) {

								if(strlen($subCatROW['sub_cat_title'])>25){

									$shortSubCatName = substr($subCatROW['sub_cat_title'],0,25);
									$shortSubCatName = $shortSubCatName.'..';

								} else {

									$shortSubCatName = $subCatROW['sub_cat_title'];

								}

								echo '

									<div>  
										<a href="/'.$newarch.'/'.$newcat.'/'.$subCatROW['sub_cat_slug'].'">
											<div style="margin:0px 0px;padding-right:10px;">
												<span class="deskNavSubCatItem n-part">'.$shortSubCatName.'</span>
											</div>
										</a>
									</div>
										
								';  

							}

							echo '<br></div>';

						


						}

						$x++;

					}

					mysqli_free_result($result);

					echo '

							</div>
						</div>

					';

				}
			}
		?>
	</div>
</div>



<div id="userDisplayRESULTS">

	<?php

		if(isset($user['id'])) {
			
			$user_name = $user['name'];

			if($user['group'] == 2) {

				$userDISPLAY .= '<a class="usrAdmin" href="/cms/index">Admin</a>';
				$userDISPLAY .= '<span class="usrName">'.$user_name.'</span>';
				$userDISPLAY .= '<div class="usrNavWrap"><div class="usrNavPointer">&#9650;</div><div class="usrNavInner"><a href="/account-settings" class="usrNavBtn">Account Settings</a><div class="usrNavBtn" onclick="logOut()">Logout</div></div></div>';

			} else {

				$userDISPLAY .= '<a href="/user/account-settings.php"><span>'.$user_name.'</span></a>';
				$userDISPLAY .= '<div class="usrNavWrap"><div class="usrNavPointer">&#9650;</div><div class="usrNavInner"><a href="/account-settings" class="usrNavBtn">Account Settings</a><div class="usrNavBtn" onclick="logOut()">Logout</div></div></div>';

			}

			echo $userDISPLAY;

		} else {

			$userDISPLAY .= '<div class="loginBtn" onclick="openLogin()">login</div>';
			echo $userDISPLAY;

		}

	?>

</div>

	<?php 
		/*
		if($user['group'] == 2) {

			$getDraftCountSQL = "SELECT count(*) as total from p_core WHERE p_draft='1'";
			$getDraftCountQUERY = mysqli_query($conn, $getDraftCountSQL);
			$getDraftCountROW = mysqli_fetch_row($getDraftCountQUERY);
			$draftCOUNT = $getDraftCountROW[0];

			echo '
				<div style="position:absolute;top:70px;left:10px;">draft [<span id="draftCountRESULTS" style="color:red;">'.$draftCOUNT.'</span>]</div>

			'; 
		}
		*/
	?>

<div id="loginContainer">

	<div id="loginFormWrap">

		<div id="closeLoginBtn" onclick="closeLogin()">&times;</div>

		<div class="break"></div>

		<form id="loginForm" action="/login.php" method="post" class="registration_form" style="text-align:center;">	

			<div id="loginUsrDataLabel" class="c_r"><br></div>

			<input placeholder="user | e-mail" onfocus="this.placeholder = ''" onblur="this.placeholder = 'user | e-mail'" type="text" id="userLoginMail" name="e-mail" size="25" />

			<div id="loginPwdDataLabel" class="c_r"><br></div>

			<input placeholder="password"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'password'" type="password" id="userLoginPassword" name="Password" size="25" />

			<br><br>

			<div>
				<input type="checkbox" name="staylogged" id="checkboxG3" class="css-checkbox" />
				<label for="checkboxG3" class="css-label" style="color:#fff;"> Wanna stay logged in ?!</label><br>
			</div>

			<br>

			<a href="/login/sign-up" style="color:white;">No account yet ?</a>

			<br><br>

			<a href="/login/forgot-password" style="color:white;">Forgot Password ?</a>

			<br><br>

			<input type="hidden" name="formsubmitted" value="TRUE" />

			<div id="loginSubmitBtn" onclick="submitLogin()">Login</div>
			
			<br><br>

		</form>

	</div>

</div>

<script>

	function mobileNavTrigger() {
		var t = document.getElementsByClassName("navInner")[0];
		if(t.style.display == 'block'){
			t.style.display = 'none';
		} else {
			t.style.display = 'block';
		}
	}

	var loginContainer = document.getElementById('loginContainer');

	function openLogin (){
		loginContainer.style.display = "block";
	}

	function closeLogin(){
		loginContainer.style.display = "none";
	}

	document.getElementById("userLoginMail").onkeypress = function(e){

		if (!e) e = window.event;
		var keyCode = e.keyCode || e.which;

		if (keyCode == '13'){
			submitLogin();
		}

	}

	document.getElementById("userLoginPassword").onkeypress = function(e){

		if (!e) e = window.event;
		var keyCode = e.keyCode || e.which;

		if (keyCode == '13'){
			submitLogin();
		}

		if (keyCode == '9'){
			e.preventDefault();
			document.getElementById("userLoginMail").focus();
		}
	}

/* ============================================================
	LOGIN START
============================================================ */
	
	function submitLogin() {

		document.getElementById("loginUsrDataLabel").innerHTML = '<br>';
		document.getElementById("loginPwdDataLabel").innerHTML = '<br>';

		var email = document.getElementById('userLoginMail').value;
		var password = document.getElementById('userLoginPassword').value;
		var cookieRequest = document.getElementById('checkboxG3').checked;

		var submitLoginXHTTP;

		submitLoginXHTTP = new XMLHttpRequest();

		submitLoginXHTTP.onreadystatechange = function() {

			if (submitLoginXHTTP.readyState == 4 && submitLoginXHTTP.status == 200) {

				var dataArray = submitLoginXHTTP.responseText.split("|||");

				for (var i = 0; i < dataArray.length - 1; i++) {

					var itemArray = dataArray[i].split("||");

					var dataKEY = itemArray[0];

					if(dataKEY == 'OK'){
						//if (itemArray[2] === undefined || itemArray[2] === null) {
							//if (typeof itemArray[2] != 'undefined'){
								//document.getElementById('userNavRESULTS').innerHTML = itemArray[2];
							//}
						//} else {
							//document.getElementById('userNavRESULTS').innerHTML = itemArray[2];
						//}
						document.getElementById('userDisplayRESULTS').innerHTML = itemArray[1];

						document.getElementById('userLoginMail').value = '';
						document.getElementById('userLoginPassword').value = '';
						closeLogin();

					} else {

						var loginUsrLabel = document.getElementById("loginUsrDataLabel");
						var loginPwdLabel = document.getElementById("loginPwdDataLabel");

						if(dataKEY == 'CHECK'){

							loginUsrLabel.innerHTML = itemArray[1];

							//if (typeof itemArray[2] != 'undefined'){
								//loginPwdLabel.innerHTML = itemArray[2];
							//}

						}                       

						if(dataKEY == 'PWD'){

							loginPwdLabel.innerHTML = itemArray[1];

						}

						if(dataKEY == 'USR'){

							loginUsrLabel.innerHTML = itemArray[1];

						}

						if(dataKEY == 'DATA'){

							loginUsrLabel.innerHTML = itemArray[1];

						}	
					}
				}
					
			}

		};

		submitLoginXHTTP.open("POST", "/lib/login/ajax/login.php", true);
		submitLoginXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		submitLoginXHTTP.send("email="+email+"&password="+password+"&cookie="+cookieRequest);
	}

/* ============================================================
	LOGIN END
============================================================ */


/* ============================================================
	LOGOUT START
============================================================ */
	
	function logOut() {

		var logOutXHTTP;

		logOutXHTTP = new XMLHttpRequest();

		logOutXHTTP.onreadystatechange = function() {

			if (logOutXHTTP.readyState == 4 && logOutXHTTP.status == 200) {
				
				if(logOutXHTTP.responseText == 'redirect'){
					window.location.replace("/");
				} else {
				document.getElementById('userNavRESULTS').innerHTML = "";
				document.getElementById('userDisplayRESULTS').innerHTML = '<div class="loginBtn" onclick="openLogin()">login</div>';
				}		

			}

		};

		logOutXHTTP.open("POST", "/lib/login/ajax/logout.php", true);
		logOutXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		logOutXHTTP.send();
	}

/* ============================================================
	LOGOUT END
============================================================ */

/* ============================================================
	LOGIN START
============================================================ */
	
	function refreshUserData() {

		var refreshUserDataXHTTP;

		refreshUserDataXHTTP = new XMLHttpRequest();

		refreshUserDataXHTTP.onreadystatechange = function() {

			if (refreshUserDataXHTTP.readyState == 4 && refreshUserDataXHTTP.status == 200) {
				
				document.getElementById("userDataRESULTS").innerHTML = refreshUserDataXHTTP.responseText;			
				

			}

		};

		refreshUserDataXHTTP.open("POST", "/lib/login/ajax/process/refresh-user-data.php", true);
		refreshUserDataXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		refreshUserDataXHTTP.send();
	}

/* ============================================================
	LOGIN END
============================================================ */

</script>

<script>

	function triggerAcc(e){

		var acc = document.getElementsByClassName("deskNavAcc");
if(e.className.search("deskNavActive") > -1){
	//alert(e.classList);
		//e.classList.remove("deskNavActive");
		
}
if(e.nextElementSibling.className.search("deskNavActive") > -1){
	//e.nextElementSibling.classList.remove("deskNavShow");
}
		for (var x = 0; x < acc.length; x++) {

			var cACC = acc[x];
			var n = cACC.className.search("deskNavActive");

			if(n > -1){
				//alert('hallo');
				acc[x].classList.remove("deskNavActive");
				acc[x].nextElementSibling.classList.remove("deskNavShow");
											
			} 

		}
		e.classList.toggle("deskNavActive");
		e.nextElementSibling.classList.toggle("deskNavShow");

	}

	function toggleDrop(){
		var dropBtns = document.getElementsByClassName("dropbtn");
		
		for (var i = 0; i < dropBtns.length; i++) {
			var activeDropBtn = dropBtns[i].className;
			var n = activeDropBtn.search("deskNavActive");

			if(n > -1){
				dropBtns[i].classList.toggle("deskNavActive");									
			}
		}

		var drops = document.getElementsByClassName("dropcontent");
		if (drops != undefined) {
			for (var i = 0; i < drops.length; i++) {
				drops[i].style.display = "none";

			}
		}
	}

	function dropDown(e){

		if(e.nextElementSibling.style.display == 'none'){
			var thisElement = false;
		}		
		toggleDrop();

		if(thisElement == false){
			e.classList.toggle("deskNavActive");
			e.nextElementSibling.style.display = "block";
		}else{
			e.nextElementSibling.style.display = "none";
		}
	}

	window.onclick = function(ev){

		var needle = ev.target.className.search("n-part");

		if(needle == -1){
			toggleDrop();	
		}

	};

</script>



