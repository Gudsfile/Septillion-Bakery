<?php
require('connexion.php');
$conn = Connect::connexion();
$employeeManager = new EmployeeManager($conn);

if (empty($_POST['mail']) || empty($_POST['password'])) {
    header("Location: login.php?erreur=0");
} else {

    $mail = htmlentities($_POST['mail'], ENT_QUOTES, "ISO-8859-1"); // le htmlentities() limite les injections sql (passe les guillemets en entité html)
    $password = htmlentities($_POST['password'], ENT_QUOTES, "ISO-8859-1");
    $verif = $employeeManager->getByMail($mail);

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
        // variables de session
        $_SESSION['mail'] = $_POST['mail'];
        $_SESSION['id_admin'] = $verif->id();
        $_SESSION['name'] = $verif->first_name()." ".$verif->last_name();
        $_SESSION['connect'] = 1;
        $_SESSION['CSRFtoken'] = bin2hex(random_bytes(32));
        header("Location: index.php");
    }
}
?>
