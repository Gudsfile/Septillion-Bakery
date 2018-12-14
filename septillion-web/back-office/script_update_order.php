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

$CSRFtoken = isset($_POST['CSRFtoken']) ? $_POST['CSRFtoken'] : -1;
$ip = $_SERVER['REMOTE_ADDR'];

if (hash_equals($_SESSION['CSRFtoken'], $CSRFtoken) && $ip == $_SESSION['ip']) {
  if(isset($state['delete'])){
    $orderManager->delete($_GET['id']);
  }
  $order->setValidated((int) isset($state['validated']));
  $order->setReady((int) isset($state['ready']));
  $order->setCollected((int) isset($state['collected']));
  $orderManager ->update($order->id(),$order);
  $_SESSION['CSRFtoken'] = bin2hex(random_bytes(32));
  header('Location: list_order.php');
}
exit();
?>
