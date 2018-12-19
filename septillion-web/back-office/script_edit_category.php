<?php
session_start();
require('script_check_string.php');
require('connexion.php');
$pdo = Connect::connexion();
$categoryManager = new CategoryManager($pdo);

$CSRFtoken = isset($_POST['CSRFtoken']) ? $_POST['CSRFtoken'] : -1;
$IPtoken = isset($_SESSION['IPtoken']) ? $_SESSION['IPtoken'] : -1;
$UAtoken = isset($_SESSION['UAtoken']) ? $_SESSION['UAtoken'] : -1;

// compare CSRFtoken and ip
if (hash_equals($_SESSION['CSRFtoken'], $CSRFtoken) && $IPtoken == $_SERVER['REMOTE_ADDR'] && $UAtoken == $_SERVER['HTTP_USER_AGENT']) {
  if ($_POST['name'] == null) {
    $erreur = 1;
    header('Location: edit_category.php?erreur=1&id='.$_GET['id']);
    exit();
  }
  $category = $categoryManager->get($_GET['id']);
  //secure post's data
  $name = htmlentities($_POST['name'], ENT_QUOTES, "ISO-8859-1");
  $description = htmlentities($_POST['description'], ENT_QUOTES, "ISO-8859-1");
  $categoryData = array(
    "name" => $name,
    "description" =>   $description,
    "created_by" => $category->created_by(),
  );

  if (check_str($categoryData["name"]) && check_str($categoryData["description"])){
  	$newCategory = new Category($categoryData);
  	$idCategory = $categoryManager->update($_GET['id'], $newCategory);
  }
  else{
  	$erreur = 4;
  }
  if ($erreur == 4){
  	header('Location: edit_category.php?erreur=4');
      exit();
  }
  if ($idCategory == 0){
    $erreur = 2;
    header('Location: edit_category.php?erreur=2');
    exit();
  } else {
    $erreur = 3;
    header('Location: edit_category.php?erreur=3');
    $_SESSION['CSRFtoken'] = bin2hex(random_bytes(32));
    exit();
  }
}
?>
