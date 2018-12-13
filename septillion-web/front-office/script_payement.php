<?php
session_start();

require('connexion.php');
$conn = Connect::connexion();

$CSRFtoken = isset($_POST['CSRFtoken']) ? $_POST['CSRFtoken'] : -1;

// read cart cookie
$cookie = isset($_COOKIE['cart_items_cookie']) ? $_COOKIE['cart_items_cookie'] : "";
$cookie = stripslashes($cookie);
$cart = json_decode($cookie, true);

if ($CSRFtoken == $_SESSION['CSRFtoken']) {

// get clientID
$clientManager = new ClientManager($conn);
$clientId = $_SESSION['id_client'];

//choose the employee
$employeeManager = new EmployeeManager($conn);
$employeeId = $employeeManager->attributEmployee();

// create order
$orderConfig = array(
  'description' => "commande en ligne",
  'validated'  => 0,
  'ready'  => 0,
  'collected'  => 0,
  'id_client'  => $clientId,
  'id_employee' => $employeeId
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
}
die();
?>
