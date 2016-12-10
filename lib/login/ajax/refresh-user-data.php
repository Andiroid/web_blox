<?php

include ($_SERVER['DOCUMENT_ROOT'] . '/lib/login/database_connection.php');

echo $_SESSION['usr_group'];

	if($_SESSION['group'] == 2) {

		$userDISPLAY .= '<a class="usrAdmin"href="/cms/index">Admin</a>';
		$userDISPLAY .= '<span class="usrName">'.$user_name.'</span>';
		$userDISPLAY .= '<div class="usrNavWrap"><div class="usrNavPointer">&#9650;</div><div class="usrNavInner"><a href="/account-settings" class="usrNavBtn">Account Settings</a><div class="usrNavBtn" onclick="logOut()">Logout</div></div></div>';

	} else {

		$userDISPLAY .= '<a href="/user/account-settings.php"><span>'.$user_name.'</span></a>';
		$userDISPLAY .= '<div class="usrNavWrap"><div class="usrNavPointer">&#9650;</div><div class="usrNavInner"><a href="/account-settings" class="usrNavBtn">Account Settings</a><div class="usrNavBtn" onclick="logOut()">Logout</div></div></div>';

	}
	
	echo $userDISPLAY;
?>