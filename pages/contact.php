<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

?>
<!DOCTYPE html>
<html>
	<head>
		<?php include ($_SERVER['DOCUMENT_ROOT'] . '/inc/parts/static-head.php'); ?>
		<style>

		</style>
	</head>
	<body>
	<div id="main_frame">
<?php include ($_SERVER['DOCUMENT_ROOT'] . '/inc/parts/nav.php'); ?>
		<div class="bit-20">

			<br>
		</div>
		<div class="bit-60">
			<div class="mobiletop"></div>
			<h2 style="text-align:center;">Kontakt</h2>


<p style="text-align:center;padding-top:30px;font-size:15px;font-family:Helvetica;color:#2f2f2f;">Sie können mir gerne eine Nachricht schicken..</p>
			<form id="contactForm" class="contactForm" name="contact_form" enctype="multipart/form-data" action="/inc/php/kontakt-erfolgreich.php" method="post">

				<input class="" placeholder="Name" name="name" type="text" value="<?php echo $name;?>"/>
				<span class="error"><?php echo '<br>'.$nameErr;?></span>
				<br>
				<input class="" placeholder="E-Mail" name="email" type="" value="<?php echo $email;?>" />
				<span class="error"><?php echo '<br>'.$emailErr;?></span>
				<br>
				<textarea class="" type="textarea" placeholder="Nachricht" name="comment"><?php echo $comment;?></textarea>
				<span class="error"><?php echo '<br>'.$commentErr;?></span>
				<span class="error"><?php echo $mailout;?></span>
				<br>
				<button class="button_0" style="" type="submit" name="submit"  value="submit">SENDEN</button>	
			</form>
 <div class="bit-1">
 <p style="text-align:center;padding:30px 0px;font-size:15px;font-family:Helvetica;color:#2f2f2f;">Sollte ich nicht für den Live-Chat verfügbar sein können <br>sie mich gerne auch per E-Mail oder Telefon erreichen..</p>

    
    </p>
  </div>
  <div class="bit-1">
    <?php include ($_SERVER['DOCUMENT_ROOT'] . '/inc/bits/company-credentials.php'); ?>

  </div>
		</div>
		<div class="bit-20" style="padding:30px;">
			<br>
			</div>
		<div class="break40"><br></div>
		<?php include ($_SERVER['DOCUMENT_ROOT'] . '/inc/parts/footer.php'); ?>
	</div>
<?php include ($_SERVER['DOCUMENT_ROOT'] . '/inc/parts/static-bottom.php'); ?>
