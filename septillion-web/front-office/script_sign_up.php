<?php
require('connexion.php');
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
  $configClient = array(
    "mail" => $_POST['mail'],
    "password" => md5($_POST['password']),
    "address" => $_POST['address'],
    "first_name" => $_POST['first_name'],
    "last_name" => $_POST['last_name'],
    "phone_number" => $_POST['phone_number']
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
