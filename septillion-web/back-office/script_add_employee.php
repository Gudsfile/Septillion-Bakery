<?php
session_start();
require('script_check_string.php');
require('connexion.php');
$conn = Connect::connexion();
$employeeManager = new EmployeeManager($conn);

$CSRFtoken = isset($_POST['CSRFtoken']) ? $_POST['CSRFtoken'] : -1;
$ip = $_SERVER['REMOTE_ADDR'];

if (hash_equals($_SESSION['CSRFtoken'], $CSRFtoken) && $ip == $_SESSION['ip']) {
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

// secure post's data
  $fname = htmlentities($_POST['first_name'], ENT_QUOTES, "ISO-8859-1");
  $lname = htmlentities($_POST['last_name'], ENT_QUOTES, "ISO-8859-1");
  $mail = htmlentities($_POST['mail'], ENT_QUOTES, "ISO-8859-1");
  $role = htmlentities($_POST['role'], ENT_QUOTES, "ISO-8859-1");

  $employeeData = array(
    "first_name" => $fname,
    "last_name" => $lname,
    "mail" => $mail,
    "password" => $password,
    "role" => $role,
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
