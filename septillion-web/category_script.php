<?php


require('BDD/Category.php');
require('BDD/CategoryManager.php');
$conn = new PDO("mysql:host=localhost;dbname=septillion", "root", "root");
$productManager = new CategoryManager($conn);
$productManager->setDb($conn);
$error = 100;
if (isset($_GET["erreur"]))
    $error = $_GET["erreur"];


$categoryList = $productManager->getList();

?>
