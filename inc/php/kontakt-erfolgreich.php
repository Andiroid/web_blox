<?php
//require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");
//include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/easylogin/easylogin.php');
$mailout = '';
$nameErr = $emailErr = $commentErr = "";
$name = $email = $comment = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Ihr Name wird benötigt";
  } else {
    $name = validate_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Nur Buchstaben und Leerzeichen sind erlaubt";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Ihre E-Mail Adresse wird benötigt";
  } else {
    $email = validate_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Das Format ihrer E-Mail Adresse ist ungültig";
    }
  }
    

  if (empty($_POST["comment"])) {
    $commentErr = "Eine Nachricht wird benötigt";
  } else {
    $comment = validate_input($_POST["comment"]);
  }


}

function validate_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


if (!empty($name) && !empty($email) && !empty($comment)) {
$name = $_POST['name'];
$email = $_POST['email'];
$comment = $_POST['comment'];
$to = "andi-le@hotmail.com";
$subject = "Web > Kunstcafe > Kontakt";
$result = mail($to, $subject, $comment, "From: $name <$email>");
}
if(!$result) {   
       
} else {
    header('Location: http://kunstcafe.info/erfolg');
}
/*
$cookie_name = "amn";
$cookie_value = $name;
setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day
header('Location: http://www.example.com/');
$cookie_email = "ame";
$cookie_value2 = $email;
setcookie($cookie_email, $cookie_value2, time() + (86400 * 365), "/"); // 86400 = 1 day
*/

?>