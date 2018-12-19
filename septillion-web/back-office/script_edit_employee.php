<?php
session_start();
require('script_check_string.php');
require('connexion.php');
$conn = Connect::connexion();
$employeeManager = new EmployeeManager($conn);

$CSRFtoken = isset($_POST['CSRFtoken']) ? $_POST['CSRFtoken'] : -1;
$IPtoken = isset($_SESSION['IPtoken']) ? $_SESSION['IPtoken'] : -1;
$UAtoken = isset($_SESSION['UAtoken']) ? $_SESSION['UAtoken'] : -1;

// compare CSRFtoken and ip
if (hash_equals($_SESSION['CSRFtoken'], $CSRFtoken) && $IPtoken == $_SERVER['REMOTE_ADDR'] && $UAtoken == $_SERVER['HTTP_USER_AGENT']) {
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
  else $password = crypt(htmlentities($_POST['password'], ENT_QUOTES, "ISO-8859-1"));
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
    $_SESSION['CSRFtoken'] = bin2hex(random_bytes(32));
    header('Location: list_employee.php?erreur=10');
    exit();
  }
}
?>
