<?php
session_start();
require('../BDD/Image.php');
require('../BDD/ImageManager.php');
require('../BDD/Product.php');
require('../BDD/ProductManager.php');
require('../BDD/Category.php');
require('../BDD/CategoryManager.php');
require('connexion.php');

$pdo = Connect::connexion();
$categoryManager = new CategoryManager($pdo);
$productManager = new ProductManager($pdo);

if ($_POST['name'] == null) {
  $erreur = 1;
  header('Location: add_product.php?erreur=1');
  exit();
}

function transfert() {
  $ret        = false;
  $blob   = '';
  $size = 0;
  $type   = '';
  $name    = '';
  $max_size = 250000;
  $ret = is_uploaded_file($_FILES['product_img']['tmp_name']);

  if (!$ret) {
    return 0;
  } else {
    $size = $_FILES['product_img']['size'];

    if ($size > $max_size) {
      header('Location: add_product.php?erreur=2');
      exit();
    }

    $type = $_FILES['product_img']['type'];
    $name  = $_FILES['product_img']['name'];
  }
  $blob = file_get_contents ($_FILES['product_img']['tmp_name']);

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
  return $imageId;
}

$productData = array(
  "name" => $_POST['name'],
  "stock" => $_POST['stock'],
  "description" => $_POST['description'],
  "price" => $_POST['price'],
  "image" => transfert(),
  "created_by" => $_SESSION['id_client'],       //Replace By session id
  "last_updated_by" => $_SESSION['id_client'],  //Replace By session id
  "id_category" => $_POST['category'],
);
$newProduct = new Product($productData);
$idProduct = $productManager->add($newProduct);
if ($idProduct == 0){
  $erreur = 2;
  header('Location: add_product.php?erreur=2');
  exit();
} else {
  $erreur = 3;
  header('Location: add_product.php?erreur=3');
  exit();
}
?>
