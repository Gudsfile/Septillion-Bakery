<?php
require('BDD/Client.php');
require('BDD/ClientManager.php');
require('connexion.php');
$conn = Connect::connexion();
$clientManager = new ClientManager($conn);

foreach ($_POST as $key => $value) {
    if($value == null){
        header("Location: login.php?erreur=1");
        exit();
    }
}
    if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
        header("Location: login.php?erreur=2");
        exit();
    }
    if ($_POST['mail']!=$_POST['mail_conf']){
        header("Location: login.php?erreur=4");
        exit();
    }
    if ($_POST['password_conf']!=$_POST['password']) {
        header("Location: login.php?erreur=5");
        exit();
    }

    $newClient = new Client($_POST);
    if($clientManager->add($newClient)>0){
        session_start();
        $_SESSION['mail'] = $_POST['mail'];
        $_SESSION['password'] = $_POST['password'];
        header("Location: index.php");
    }


?>