<?php
session_start();
require('connexion.php');
//verif la session

$state = $_POST;
if (!isset($_GET['id'])) {
  header('Location: list_product.php');
  exit();
}


$pdo = Connect::connexion();
$orderManager = new OrderManager($pdo);
$order = $orderManager->get($_GET['id']);

if(isset($state['delete'])){
  $orderManager->delete($_GET['id']);
}
$order->setValidated((int) isset($state['validated']));
$order->setReady((int) isset($state['ready']));
$order->setCollected((int) isset($state['collected']));
$orderManager ->update($order->id(),$order);

header('Location: list_order.php');
exit();
?>
