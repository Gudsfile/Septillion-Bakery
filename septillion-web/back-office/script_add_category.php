<?php
session_start();
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
  "created_by" => intval($_SESSION['id_client']),
);
$newCategory = new Category($categoryData);
$idCategory = $categoryManager->add($newCategory);

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
