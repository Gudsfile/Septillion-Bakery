<?php
session_start();

echo 'wesh';

require('connexion.php');
$conn = Connect::connexion();

// read cart cookie
$cookie = isset($_COOKIE['cart_items_cookie']) ? $_COOKIE['cart_items_cookie'] : "";
$cookie = stripslashes($cookie);
$cart = json_decode($cookie, true);

// get CSRFtoken and special session token
$CSRFtoken = isset($_POST['CSRFtoken']) ? $_POST['CSRFtoken'] : -1;
$IPtoken = isset($_SESSION['IPtoken']) ? $_SESSION['IPtoken'] : -1;
$UAtoken = isset($_SESSION['UAtoken']) ? $_SESSION['UAtoken'] : -1;

// compare CSRFtoken and ip
if (hash_equals($_SESSION['CSRFtoken'], $CSRFtoken) && $IPtoken == $_SERVER['REMOTE_ADDR'] && $UAtoken == $_SERVER['HTTP_USER_AGENT']) {
  // new token
  $rand = bin2hex(random_bytes(32));
  $_SESSION['CSRFtoken'] = $rand;

  // check quantity
  foreach ($cart as $id=>$quantity) {
    if (!isset($quantity['quantity'])){
      setcookie("cart_items_cookie", null, time() + (600), '/');
      $_COOKIE['cart_items_cookie'] = null;
      header("Location: cart.php?erreur=3");
      die();
    }
    if ($quantity['quantity'] <= 0) {
      setcookie("cart_items_cookie", null, time() + (600), '/');
      $_COOKIE['cart_items_cookie'] = null;
      header("Location: cart.php?erreur=3");
      die();
    }
  }

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
  setcookie("cart_items_cookie", null, time() + (600), '/'); // 600 = 10 minutes
  $_COOKIE['cart_items_cookie'] = null;

  header("Location: cart.php?");
} else {
  session_unset ();
  session_destroy ();
  header("Location: cart.php?erreur=3");
}
die();
?>
