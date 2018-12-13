<?php
session_start();

require('connexion.php');
$conn = Connect::connexion();

// read cart cookie
$cookie = isset($_COOKIE['cart_items_cookie']) ? $_COOKIE['cart_items_cookie'] : "";
$cookie = stripslashes($cookie);
$cart = json_decode($cookie, true);
// get CSRFtoken
$CSRFtoken = isset($_POST['CSRFtoken']) ? $_POST['CSRFtoken'] : -1;

if (hash_equals($_SESSION['CSRFtoken'], $CSRFtoken)) {
// new token
$rand = bin2hex(random_bytes(32));
$_SESSION['CSRFtoken'] = $rand;

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
