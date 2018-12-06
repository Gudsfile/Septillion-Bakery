<?php
session_start();
require('script_check_string.php');
require('connexion.php');
$pdo = Connect::connexion();
$categoryManager = new CategoryManager($pdo);

if ($_POST['name'] == null) {
  $erreur = 1;
  header('Location: add_category.php?erreur=1');
  exit();
}

$categoryData = array(
  "name" => $_POST['name'],
  "description" => $_POST['description'],
  "created_by" => intval($_SESSION['id_admin']),
);

if (check_str($categoryData["name"]) && check_str($categoryData["description"])){
	$newCategory = new Category($categoryData);
	$idCategory = $categoryManager->add($newCategory);
}
else{
	$erreur = 4;
}

if ($erreur == 4){
	header('Location: add_category.php?erreur=4');
    exit();
}


if ($idCategory == 0){
  $erreur = 2;
  header('Location: add_category.php?erreur=2');
  exit();
} else {
  $erreur = 3;
  header('Location: add_category.php?erreur=3');
  exit();
}
?>
