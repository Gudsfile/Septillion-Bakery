<?php

require('console_log.php');
console_log('toto');
// get the product id
$count = 0;
while (isset($_GET['id'.$count])) {
  $id[] = $_GET['id'.$count];
  $quantity[] = $_GET['quantity'.$count];
  $count += 1;
}

if (!isset($id) || !isset($quantity)) {
  echo("suppr");
  setcookie("cart_items_cookie", null, time() + (600), '/'); // 600 = 10 minutes
  $_COOKIE['cart_items_cookie']=null;
}
else {
  echo("change");
  $count = 0;
  foreach ($id as $key) {
    $cart_items[$key]=array(
      'quantity'=>$quantity[$count]
    );
    $count+=1;
  }

  // put item to cookie
  $json = json_encode($cart_items, true);
  setcookie("cart_items_cookie", $json, time() + (600), '/'); // 600 = 10 minutes
  $_COOKIE['cart_items_cookie']=$json;
}
die();
?>
