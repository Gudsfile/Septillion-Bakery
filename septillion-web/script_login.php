<?php
require('BDD/Client.php');
require('BDD/ClientManager.php');
require('connexion.php');
$conn = Connect::connexion();
$clientManager = new ClientManager($conn);


if (empty($_POST['mail']) || empty($_POST['password'])) {
    header("Location: login.php?erreur=0");
} else {

    // les champs sont bien posté et pas vide, on sécurise les données entrées par le membre:
    $Mail = htmlentities($_POST['mail'], ENT_QUOTES, "ISO-8859-1"); // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
    $MotDePasse = htmlentities($_POST['password'], ENT_QUOTES, "ISO-8859-1");
    $verif = $clientManager->getByMailAndPassword($Mail, $MotDePasse);
    if ($verif == 0)
        header("Location: login.php?erreur=0");
    else {
        session_start();
        // on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) (notez bien que l'on utilise pas le $ pour enregistrer ces variables)
        $_SESSION['mail'] = $_POST['mail'];
        $_SESSION['password'] = $_POST['password'];
        header("Location: index.php");
    }
}


?>
