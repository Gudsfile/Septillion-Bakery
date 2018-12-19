<?php
session_start();
require('script_check_string.php');
require('script_check_image.php');
require('connexion.php');

$CSRFtoken = isset($_POST['CSRFtoken']) ? $_POST['CSRFtoken'] : -1;
$IPtoken = isset($_SESSION['IPtoken']) ? $_SESSION['IPtoken'] : -1;
$UAtoken = isset($_SESSION['UAtoken']) ? $_SESSION['UAtoken'] : -1;

// compare CSRFtoken and ip
if (hash_equals($_SESSION['CSRFtoken'], $CSRFtoken) && $IPtoken == $_SERVER['REMOTE_ADDR'] && $UAtoken == $_SERVER['HTTP_USER_AGENT']) {
  if ($_POST['name'] == null
    || $_POST['description'] == null
    || $_POST['stock'] == null
    || $_POST['price'] == null
    || $_POST['category'] == null
  ){
    header('Location: add_product.php?erreur=1');
    exit();
  }

  $pdo = Connect::connexion();
  $categoryManager = new CategoryManager($pdo);
  $productManager = new ProductManager($pdo);

// secure post's data
  $name = htmlentities($_POST['name'], ENT_QUOTES, "ISO-8859-1");
  $stock = htmlentities($_POST['stock'], ENT_QUOTES, "ISO-8859-1");
  $description = htmlentities($_POST['description'], ENT_QUOTES, "ISO-8859-1");
  $price = htmlentities($_POST['price'], ENT_QUOTES, "ISO-8859-1");
  $category = htmlentities($_POST['category'], ENT_QUOTES, "ISO-8859-1");

  $productData = array(
    "name" => $name,
    "stock" => $stock,
    "description" => $description,
    "price" => $price,
    "created_by" => intval($_SESSION['id_admin']),
    "last_updated_by" => intval($_SESSION['id_admin']),
    "id_category" => $category,
    "id_img" => transfert(),
  );

  if ($productData['id_img'] != 0) {
    if(check_str($productData['name']) && check_str($productData['description'])){
      $newProduct = new Product($productData);
      $idProduct = $productManager->add($newProduct);
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
    header('Location: add_product.php?erreur='.$erreur);
    exit();
  } else { // add ok
    $_SESSION['CSRFtoken'] = bin2hex(random_bytes(32));
    header('Location: list_product.php?erreur=5');
    exit();
  }
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
