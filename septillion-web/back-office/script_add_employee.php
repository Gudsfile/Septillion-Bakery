<?php
session_start();
require('connexion.php');
$conn = Connect::connexion();
$employeeManager = new EmployeeManager($conn);

if ($employeeManager->getByMail($_POST['mail'])->id() != 0) {
  $erreur = 1;
  header('Location: add_employee.php?erreur=1');
  exit();
}
if ($_POST['first_name'] == null) {
  $erreur = 2;
  header('Location: add_employee.php?erreur=2');
  exit();
}
if ($_POST['last_name'] == null) {
  $erreur = 3;
  header('Location: add_employee.php?erreur=3');
  exit();
}
if ($_POST['mail'] == null) {
  $erreur = 4;
  header('Location: add_employee.php?erreur=4');
  exit();
}
if ($_POST['password'] == null) {
  $erreur = 5;
  header('Location: add_employee.php?erreur=5');
  exit();
}
if ($_POST['mail'] != $_POST['verif_mail']) {
  $erreur = 6;
  header('Location: add_employee.php?erreur=6');
  exit();
}
if ($_POST['password'] != $_POST['verif_password']) {
  $erreur = 7;
  header('Location: add_employee.php?erreur=7');
  exit();
}

$employeeData = array(
  "first_name" => $_POST['first_name'],
  "last_name" => $_POST['last_name'],
  "mail" => $_POST['mail'],
  "password" => crypt(htmlentities($_POST['password'], ENT_QUOTES, "ISO-8859-1")),
  "role" => $_POST['role'],
);

$newEmployee = new Employee($employeeData);
$idEmployee = $employeeManager->add($newEmployee);
if ($idEmployee == 0){
  $erreur = 8;
  header('Location: add_employee.php?erreur=8');
  exit();
} else {
  $erreur = 9;
  header('Location: add_employee.php?erreur=9');
  exit();
}
?>
