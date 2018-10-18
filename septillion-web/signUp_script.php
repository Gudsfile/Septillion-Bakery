<?php
require('BDD/Client.php');
require('BDD/ClientManager.php');
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
    }if ($_POST['password_conf']!=$_POST['password']) {
             $_SESSION['data'] = $_POST;
            header("Location: login.php?erreur=5");
    }

   else {
        $newClient = new Client($_POST);
    if($clientManager->add($newClient)>0){
        session_start();
        session_unset ();
        $_SESSION['mail'] = $_POST['mail'];
        $_SESSION['password'] = $_POST['password'];
        header("Location: index.php");
   }

    }


?>