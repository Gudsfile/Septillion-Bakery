<?php
require('connexion.php');
require('script_check_string.php');
$conn = Connect::connexion();
$clientManager = new ClientManager($conn);

echo '1';

session_start();
session_unset();

if ($clientManager->getMail($_POST['mail'])) {
  $_SESSION['data'] = $_POST;
  header("Location: login.php?erreur=3");
  exit();
}
if ($_POST['mail_conf']!=$_POST['mail']) {
  $_SESSION['data'] = $_POST;
  exit();
  header("Location: login.php?erreur=4");
}
if ($_POST['password_conf']!=$_POST['password']) {
  $_SESSION['data'] = $_POST;
  header("Location: login.php?erreur=5");
}
elseif($_POST!=null) {
  $mail = htmlentities($_POST['mail']);
  $password = crypt(htmlentities($_POST['password'], ENT_QUOTES, "ISO-8859-1"));
  $address = htmlentities($_POST['address']);
  $first_name = htmlentities($_POST['first_name']);
  $last_name = htmlentities($_POST['last_name']);
  $phone_number = htmlentities($_POST['phone_number']);

  echo ' \n mail: '.check_str_mail($mail);
  echo ' \n address: '.check_str_hard($address);
  echo ' \n first_name: '.check_str_letter($first_name);
  echo ' \n last_name: '.check_str_letter($last_name);
  echo ' \n phone_number: '.check_str_number($phone_number);

  if(!check_str_mail($mail)) {
    header("Location: login.php?erreur=2");
    die();
  } else if(!check_str_hard($address)) {
    header("Location: login.php?erreur=2");
    die();
  } else if(!check_str_letter($first_name)) {
    header("Location: login.php?erreur=2");
    die();
  } else if(!check_str_letter($last_name)) {
    header("Location: login.php?erreur=2");
    die();
  } else if(!check_str_number($phone_number)) {
    header("Location: login.php?erreur=2");
    die();
  }
  
  $configClient = array(
    "mail" => $mail,
    "password" => $password,
    "address" => $address,
    "first_name" => $first_name,
    "last_name" => $last_name,
    "phone_number" => $phone_number,
  );

  $newClient = new Client($configClient);
  $verif = $clientManager->add($newClient);
  if($verif>0){
    session_start();
    session_unset ();
    $_SESSION['mail'] = $mail;
    $_SESSION['id_client'] = $verif;
    $_SESSION['CSRFtoken'] = $rand;
    $_SESSION['IPtoken'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['UAtoken'] = $_SERVER['HTTP_USER_AGENT'];
    header("Location: index.php");
  }
}
?>
