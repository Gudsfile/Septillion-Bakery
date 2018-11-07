<?php
session_start();

require('BDD/IsOrdered.php');
require('BDD/IsOrderedManager.php');
require('BDD/Order.php');
require('BDD/OrderManager.php');
require('BDD/Product.php');
require('BDD/ProductManager.php');
require('BDD/Client.php');
require('BDD/ClientManager.php');

require('connexion.php');
$conn = Connect::connexion();

// read cart cookie
$cookie = isset($_COOKIE['cart_items_cookie']) ? $_COOKIE['cart_items_cookie'] : "";
$cookie = stripslashes($cookie);
$cart = json_decode($cookie, true);

// get clientID
$clientManager = new ClientManager($conn);
$clientId = ($clientManager->getByMailAndPassword($_SESSION['mail'], $_SESSION['password']))->id();

// create order
$orderConfig = array(
    'description' => "commande en ligne",
    'validated'  => 0,
    'ready'  => 0,
    'collected'  => 0,
    'id_client'  => $clientId,
    'id_employee' => 1001
);

$order = new Order($orderConfig);
$orderManager = new OrderManager($conn);
$orderId = $orderManager->add($order);

// Toutes les commandes pour chaque produits
$isOrderedManager = new IsOrderedManager($conn);

foreach ($cart as $id=>$quantity) {
  $isOrderedConfig = array(
    'id_order' => $orderId,
    'id_product' => $id,
    'quantity' => $quantity['quantity']
  );
  $isOrderedManager->add(new IsOrdered($isOrderedConfig));
}

die();
?>
