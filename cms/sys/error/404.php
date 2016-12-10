<!DOCTYPE html>
<html>
<head>

	

<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");
include ($root.'/inc/parts/static-head.php'); 

?>
	<style type="text/css">
/*XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX   ERROR PAGE START        XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX*/
.errorPageWrap{
	font-family:anita;font-size:35px;
	background-size: 100% 100%;
    background-repeat: no-repeat;
	position:fixed;top:0px;left:0px;padding:0px;margin:0px;width:100%;height:100%;background-image: url("/img/core/noisybg.gif");}
.errorPageContent{font-size:35px;font-family:anita;overflow: hidden;width:100%;text-align:center;color:white;}
.errorPageContentLink{font-size:35px;font-family:anita;color:red; text-decoration:none;}
.errorPageContentLink:hover{color:#C42333;}
/*XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX   ERROR PAGE END          XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX*/
#mainContent{padding-top:;padding-bottom:;}
@media all and (max-width: 960px) {
#mainContent{padding-top:;padding-bottom:;}

	}
	</style>



</head>
<body>
	<div class="errorPageWrap">
		<div class="errorPageContent verticalAlignElement">
			<span style="color:red;">ERROR 404</span>
			<br>
			I think you are wrong here..<br>
			Shit happens..<br>
			<br>
			But cou can still<br>
			<a class="errorPageContentLink" href="/">back to root</a>
		</div>	
	</div>
</body>
</html>

