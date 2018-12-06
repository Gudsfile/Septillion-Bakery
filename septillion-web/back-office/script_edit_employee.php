<?php
session_start();
require('script_check_string.php');
require('connexion.php');
$conn = Connect::connexion();
$employeeManager = new EmployeeManager($conn);

if ($employeeManager->getByMail($_POST['mail'])->id() != intval($_GET['id']) && $employeeManager->getByMail($_POST['mail'])->id() != 0) {
  $erreur = 1;
  $location = 'Location: edit_employee.php?erreur=1&id='.$_GET['id'];
  
  header($location);
  exit();
}
if ($_POST['first_name'] == null) {
  $erreur = 2;
  $location = 'Location: edit_employee.php?erreur=2&id='.$_GET['id'];
  header($location);
  exit();
}
if ($_POST['last_name'] == null) {
  $erreur = 3;
  $location = 'Location: edit_employee.php?erreur=3&id='.$_GET['id'];
  header($location);
  exit();
}
if ($_POST['mail'] == null) {
  $erreur = 4;
  $location = 'Location: edit_employee.php?erreur=4&id='.$_GET['id'];
  header($location);
  exit();
}

if ($_POST['mail'] != $_POST['verif_mail']) {
  $erreur = 6;
  $location = 'Location: edit_employee.php?erreur=6&id='.$_GET['id'];
  header($location);
  exit();
}
if ($_POST['password'] != $_POST['verif_password']) {
  $erreur = 7;
  $location = 'Location: edit_employee.php?erreur=7&id='.$_GET['id'];
  header($location);
  exit();
}

if (is_null($_POST['password'])) $password = $employeeManager->get($_GET['id'])->password();
else $password = md5(htmlentities($_POST['password'], ENT_QUOTES, "ISO-8859-1"));

$employeeData = array(
  "first_name" => $_POST['first_name'],
  "last_name" => $_POST['last_name'],
  "mail" => $_POST['mail'],
  "password" => $password,
  "role" => $_POST['role'],
);


if(check_str($employeeData["first_name"]) && check_str($employeeData["last_name"]) && check_str_mail($employeeData["mail"]) && check_str($employeeData["role"]))
{
	$newEmployee = new Employee($employeeData);
	$idEmployee = $employeeManager->update($_GET['id'],$newEmployee);	
}
else
{
	$erreur = 10;
    header('Location: edit_employee.php?erreur=10&id='.$_GET['id']);
    exit();
}
if ($idEmployee == 0){
  $erreur = 8;
  header('Location: edit_employee.php?erreur=8&id='.$_GET['id']);
  exit();
} else {
  $erreur = 9;
  header('Location: list_employee.php?erreur=10');
  exit();
}
?>
