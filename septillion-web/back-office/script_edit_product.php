<?php
session_start();
require('script_check_string.php');
require('script_check_image.php');
require('connexion.php');

if (!isset($_GET['id'])) {
  header('Location: list_product.php');
}

if ($_POST['name'] == null
  || $_POST['description'] == null
  || $_POST['stock'] == null
  || $_POST['price'] == null
  || $_POST['category'] == null
  ){
  header('Location: edit_product.php?erreur=1');
  exit();
}

$pdo = Connect::connexion();
$categoryManager = new CategoryManager($pdo);
$productManager = new ProductManager($pdo);
$lastProduct = $productManager->get($_GET['id']);

$productData = array(
  "name" => $_POST['name'],
  "stock" => $_POST['stock'],
  "description" => $_POST['description'],
  "price" => $_POST['price'],
  "id_img" => transfert(),
  "created_by" => intval($productManager->get($_GET['id'])->created_by()),
  "last_updated_by" => intval($_SESSION['id_admin']),
  "id_category" => $_POST['category'],
);

if ($productData['id_img'] != 0) {
  if(check_str($productData['name']) && check_str($productData['description'])){
    $newProduct = new Product($productData);
    $idProduct = $productManager->update($_GET['id'],$newProduct);
  } else {
    $erreur = 1;
  }
} else {
  $erreur = 4;
}

if ($idProduct == 0) {
  $erreur = 5;
}

if ($erreur != 0){ // add err
  header('Location: edit_product.php?erreur='.$erreur);
  exit();
} else { // add ok
  header('Location: list_product.php?erreur=3');
  exit();
}

function transfert() {
  $blob = '';
  $size = 0;
  $type = '';
  $name = '';
  $max_size = 500000; // in Bytes

  $result = check_image($_FILES['product_img']['tmp_name'], $max_size);

  if ($result == 0) {
    $name = $_FILES['product_img']['name'];
    $type = $_FILES['product_img']['type'];
    $size = $_FILES['product_img']['size'];
    $blob = file_get_contents($_FILES['product_img']['tmp_name']);

    $imageData = array(
      "name" => $name,
      "type" => $type,
      "size" => $size,
      "image" => $blob,
    );

    $pdo = Connect::connexion();
    $imageManager = new ImageManager($pdo);
    $imageId = 0;

    if (check_str_img($imageData["name"])){
      $newImage = new Image($imageData);
      $imageId = $imageManager->add($newImage);

      $file = 'log.txt';
      $current = file_get_contents($file);
      $current .= "\n".$newImage->name();
      $current .= "\n".$newImage->type();
      $current .= "\n".$newImage->size();
      $current .= "\n".$imageId."\n";
      file_put_contents($file, $current);
    } else {
      header('Location: add_product.php?erreur=4');
      exit();
    }
    return $imageId;
  } else if ($result == 2) {
    header('Location: add_product.php?erreur=2');
    exit();
  } else if ($result == 3) {
    header('Location: add_product.php?erreur=3');
    exit();
  } else {
    header('Location: add_product.php?erreur=4');
    exit();
  }
}

?>
