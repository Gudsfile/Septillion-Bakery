<?php
session_start();
require('connexion.php');

if (!isset($_GET['id'])) {
  header('Location: list_product.php');
}

$pdo = Connect::connexion();
$categoryManager = new CategoryManager($pdo);
$productManager = new ProductManager($pdo);
$product = $productManager->get($_GET['id']);



function transfert() {
  $pdo = Connect::connexion();
  if (empty(is_uploaded_file($_FILES['product_img']['tmp_name']))){
        $productManager = new ProductManager($pdo);
        $product = $productManager->get($_GET['id']);
        $image = $product->id_img();
        return $image;
  }
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
  "Id_img" => transfert(),
  "created_by" => intval($_SESSION['id_client']),       //Replace By session id
  "last_updated_by" => intval($_SESSION['id_client']),  //Replace By session id
  "id_category" => $_POST['category'],
);
$newProduct = new Product($productData);
$productManager-> update($_GET['id'],$newProduct);

header('Location: edit_product.php?erreur=3');
?>
