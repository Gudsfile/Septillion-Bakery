<?php


require('BDD/Product.php');
require('BDD/ProductManager.php');
$conn = new PDO("mysql:host=localhost;dbname=septillion", "root", "root");
$productManager = new ProductManager($conn);
$productManager->setDb($conn);
$error = 100;
if (isset($_GET["erreur"]))
    $error = $_GET["erreur"];


$categoryList = $productManager->getList();

?>