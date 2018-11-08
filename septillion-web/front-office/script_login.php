<?php
require('connexion.php');
$conn = Connect::connexion();
$clientManager = new ClientManager($conn);

if (empty($_POST['mail']) || empty($_POST['password'])) {
    header("Location: login.php?erreur=0");
} else {

    $Mail = htmlentities($_POST['mail'], ENT_QUOTES, "ISO-8859-1"); // le htmlentities() limite les injections sql (passe les guillemets en entité html)
    $MotDePasse = md5(htmlentities($_POST['password'], ENT_QUOTES, "ISO-8859-1")); // le md5 permet de chiffrer (trop) simplement
    $verif = $clientManager->getByMailAndPassword($Mail, $MotDePasse);
    if ($verif == 0)
        header("Location: login.php?erreur=0");
    else {
        session_start();
        // variables de session
        $_SESSION['mail'] = $_POST['mail'];
        $_SESSION['id_client'] = $verif->id();
        header("Location: index.php");
    }
}
?>
