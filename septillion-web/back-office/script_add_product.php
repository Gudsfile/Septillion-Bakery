<?php
session_start();
require('script_check_string.php');
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






$productData = array(
  "name" => $_POST['name'],
  "stock" => $_POST['stock'],
  "description" => $_POST['description'],
  "price" => $_POST['price'],

  "created_by" => intval($_SESSION['id_admin']),       
  "last_updated_by" => intval($_SESSION['id_admin']), 
  "id_category" => $_POST['category'],
  "id_img" => transfert(),
);




if(check_str($productData['name']) && check_str($productData['description'])){
	$newProduct = new Product($productData);
	$idProduct = $productManager->add($newProduct);
}

else{
	$erreur = 4;
}

if ($erreur == 4){
	header('Location: add_product.php?erreur=4');
	exit();
}

if ($idProduct == 0){
  $erreur = 2;
  /*
  echo $newProduct->name();
  echo "\n";
  echo $newProduct->stock();
  echo "\n";
  echo $newProduct->description();
  echo "\n";
  echo $newProduct->price();
  echo "\n";
  echo $newProduct->image();
  echo "\n";
  echo $newProduct->created_by();
  echo "\n";
  echo $newProduct->last_updated_by();
  echo "\n";
  echo $newProduct->id_category();
  echo "\n";
  */
  header('Location: add_product.php?erreur=2');
  exit();
} else {
  $erreur = 5;
  header('Location: list_product.php?erreur=5');
  exit();
}
?>
