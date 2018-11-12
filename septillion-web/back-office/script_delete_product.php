<?php
session_start();
require('connexion.php');
$pdo = Connect::connexion();
$productManager = new ProductManager($pdo);
$productManager->delete($_GET['id']);
header('Location: list_product.php');
exit();
?>
