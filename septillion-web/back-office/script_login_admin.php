<?php
require('../BDD/Employee.php');
require('../BDD/EmployeeManager.php');
$pdo = new PDO("mysql:host=localhost;dbname=septillion","root");
$employeeManager= new EmployeeManager($pdo);
$res = $employeeManager->getByMailAndPassword($_POST['mail'], $_POST['password']);

// Comparaison du pass envoyé via le formulaire avec la base
$isPasswordCorrect = password_verify($_POST['pass'], $resultat['pass']);

if (!$resultat) {
    echo 'Mauvais identifiant ou mot de passe !';
} else {
    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['pseudo'] = $pseudo;
        echo 'Vous êtes connecté !';
    }
    else {
        echo 'Mauvais identifiant ou mot de passe !';
    }
}
?>
