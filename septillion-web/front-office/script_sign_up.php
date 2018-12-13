<?php
require('connexion.php');
require('script_check_string.php');
$conn = Connect::connexion();
$clientManager = new ClientManager($conn);

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
  if(!check_str_mail($_POST['mail'])) {
    header("Location: login.php?erreur=2");
    die();
  } else if(!check_str_hard($_POST['address'])) {
    header("Location: login.php?erreur=2");
    die();
  } else if(!check_str_letter($_POST['first_name'])) {
    header("Location: login.php?erreur=2");
    die();
  } else if(!check_str_letter($_POST['last_name'])) {
    header("Location: login.php?erreur=2");
    die();
  } else if(!check_str_number($_POST['phone_number'])) {
    header("Location: login.php?erreur=2");
    die();
  }

  $configClient = array(
    "mail" => htmlentities($_POST['mail']),
    "password" => crypt($_POST['password']),
    "address" => htmlentities($_POST['address']),
    "first_name" => htmlentities($_POST['first_name']),
    "last_name" => htmlentities($_POST['last_name']),
    "phone_number" => htmlentities($_POST['phone_number'])
  );

  $newClient = new Client($configClient);
  $verif = $clientManager->add($newClient);
  if($verif>0){
    session_start();
    session_unset ();
    $_SESSION['mail'] = $_POST['mail'];
    $_SESSION['id_client'] = $verif;
    header("Location: index.php");
  }
}
?>
