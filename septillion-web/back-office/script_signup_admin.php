<?php
function console_log( $data ) {
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

console_log("here");

require('../BDD/Employee.php');
require('../BDD/EmployeeManager.php');
$pdo = new PDO("mysql:host=localhost;dbname=septillion","root");
$employeeManager= new EmployeeManager($pdo);

if ($employeeManager->getByMail($_POST['mail'])) {
  // Erreur mail existant
}
if ($_POST['password_verif']!=$_POST['password']) {
  // Erreur password != password verif
}

$employeeData = new Array(
  'first_name'=>$_POST['first_name'],
  'last_name'=>$_POST['last_name'],
  'mail'=>$_POST['mail'],
  'password'=>password_hash($_POST['pass'], PASSWORD_DEFAULT),
  'address'=>$_POST['address'],
  'phone_number'=>$_POST['phone_number'],
  'role'=>$_POST['role']
);
$newEmployee = new Employee($employeeData);
$id = $employeeManager->add($newEmployee);
$_SESSION['mail'] = $newEmployee->mail();
$_SESSION['password'] = $newEmployee->password();
?>
