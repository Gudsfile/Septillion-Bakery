<?php
session_start();
require('connexion.php');
$pdo = Connect::connexion();
$orderManager = new OrderManager($pdo);
$orderManager->delete($_GET['id']);
header('Location: list_order.php');
exit();
?>
