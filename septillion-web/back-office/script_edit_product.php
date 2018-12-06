<?php
session_start();
require('script_check_string.php');
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
      header('Location: list_product.php?erreur=2');
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
  if (check_str_img($imageData["name"])){
  	$newImage = new Image($imageData);
  	$imageId = $imageManager->add($newImage);
  }
  else {
  	$imageId = 0;
  	$erreur = 4;
  }
  return $imageId;
}

$lastProduct = $productManager->get($_GET['id']);

$productData = array(
  "name" => $_POST['name'],
  "stock" => $_POST['stock'],
  "description" => $_POST['description'],
  "price" => $_POST['price'],
  "Id_img" => transfert(),
  "created_by" => intval($productManager->get($_GET['id'])->created_by()),
  "last_updated_by" => intval($_SESSION['id_admin']),  //Replace By session id
  "id_category" => $_POST['category'],
);

if(check_str($productData['name']) && check_str($productData['description'])){
	$newProduct = new Product($productData);
	$idProduct = $productManager->update($_GET['id'],$newProduct);
}

else{
	$erreur = 4;
}

if ($erreur != 4){
	header('Location: list_product.php?erreur=3');
	exit();
}

header('Location: edit_product.php?erreur=4&id='.$_GET['id']);
exit();
?>
