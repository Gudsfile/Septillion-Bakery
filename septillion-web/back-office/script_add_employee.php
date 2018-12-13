<?php
session_start();
require('script_check_string.php');
require('connexion.php');
$conn = Connect::connexion();
$employeeManager = new EmployeeManager($conn);

$CSRFtoken = isset($_POST['CSRFtoken']) ? $_POST['CSRFtoken'] : -1;
if (hash_equals($CSRFtoken, $_SESSION['CSRFtoken'])) {
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


  if(check_str($employeeData["first_name"]) && check_str($employeeData["last_name"]) && check_str_mail($employeeData["mail"]) && check_str($employeeData["role"]))
  {
  	$newEmployee = new Employee($employeeData);
  	$idEmployee = $employeeManager->add($newEmployee);
  } else {
  	$erreur = 10;
      header('Location: add_employee.php?erreur=10');
      exit();
  }


  if ($idEmployee == 0){
    $erreur = 8;
    header('Location: add_employee.php?erreur=8');
    exit();
  } else {
    $erreur = 11;
    $_SESSION['CSRFtoken'] = bin2hex(random_bytes(32));
    header('Location: list_employee.php?erreur=11');
    exit();
  }
}
?>
