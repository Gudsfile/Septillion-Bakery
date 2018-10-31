<?php
// get the product id
$count = 0;
while (isset($_GET['id'.$count])) {
  $id[] = $_GET['id'.$count];
  $quantity[] = $_GET['quantity'.$count];
  $count += 1;
}

// delete cookie
if (!isset($id) || !isset($quantity)) {
  setcookie("cart_items_cookie", null, time() + (600), '/'); // 600 = 10 minutes
  $_COOKIE['cart_items_cookie'] = null;
}
// change cookie
else {
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
  $_COOKIE['cart_items_cookie'] = $json;
}

die();
?>
