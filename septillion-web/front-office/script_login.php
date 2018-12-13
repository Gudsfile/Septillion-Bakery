<?php
require('connexion.php');
$conn = Connect::connexion();
$clientManager = new ClientManager($conn);

if (empty($_POST['mail']) || empty($_POST['password'])) {
    header("Location: login.php?erreur=0");
} else {

    $mail = htmlentities($_POST['mail'], ENT_QUOTES, "ISO-8859-1");
    $password = htmlentities($_POST['password'], ENT_QUOTES, "ISO-8859-1");
    $verif = $clientManager->getByMail($mail);

    if (is_int($verif) && $verif == 0){
        header("Location: login.php?erreur=0");
    } else if(!hash_equals($verif->password(), crypt($password, $verif->password()))) {
        header("Location: login.php?erreur=0");
    } else {
        if (isset($_SESSION)){
          $_SESSION = array();
          session_destroy();
        }
        session_start();
        $rand = 199;
        $_SESSION['mail'] = $_POST['mail'];
        $_SESSION['id_client'] = $verif->id();
        $_SESSION['CSRFtoken'] = $rand;
        header("Location: index.php");
    }
}
?>
