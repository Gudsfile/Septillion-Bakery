<?php
session_start();


require('../BDD/Image.php');
require('../BDD/ImageManager.php');
require('../BDD/Category.php');
require('../BDD/CategoryManager.php');
require('connexion.php');

$pdo = Connect::connexion();
$categoryManager = new CategoryManager($pdo);

if ($_POST['name'] == null) {
  $erreur = 1;
  header('Location: add_category.php?erreur=1');
  exit();
}

function transfert() {
  $imageId = 0;
  if(isset($_FILES['image'])){
  $ret        = false;
  $blob   = '';
  $size = 0;
  $type   = '';
  $name    = '';
  $max_size = 250000;
  $ret = is_uploaded_file($_FILES['category_img']['tmp_name']);
  
  if (!$ret) {
    return 0;
  } else {
    $size = $_FILES['category_img']['size'];

    if ($size > $max_size) {
      header('Location: add_category.php?erreur=2');

      exit();
    }

    $type = $_FILES['category_img']['type'];
    $name  = $_FILES['category_img']['name'];
  }
  $blob = file_get_contents ($_FILES['category_img']['tmp_name']);

  $imageData = array(
    "name" => $name,
    "type" => $type,
    "size" => $size,
    "image" => $blob,
  );
  $pdo = Connect::connexion();
  $imageManager = new ImageManager($pdo);
  $newImage = new Image($imageData);
  $imageId = $imageManager->add($newImage);
  
 }
 return $imageId;
}

$categoryData = array(
  "name" => $_POST['name'],
  "description" => $_POST['description'],
  "icon" => transfert(),
  "created_by" => $_SESSION['id_client'],       //Replace By session id
);
$newCategory = new Category($categoryData);
$idCategory = $categoryManager->add($newCategory);

if ($idCategory == 0){
  $erreur = 2;
  echo $categoryData['name'];
  //header('Location: add_category.php?erreur=2');
  exit();
} else {
  $erreur = 3;
  header('Location: add_category.php?erreur=3');
  exit();
}
?>
