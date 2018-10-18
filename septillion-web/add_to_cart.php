<?php

// get the product id
$id = isset($_GET['id']) ? $_GET['id'] : null;
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

if ($id == null) {
  header('Location: product.php');
}
else {
  // make quantity a minimum of 1
  $quantity=$quantity<=0 ? 1 : $quantity;

  // read
  $cookie = isset($_COOKIE['cart_items_cookie']) ? $_COOKIE['cart_items_cookie'] : "";
  $cookie = stripslashes($cookie);
  $saved_cart_items = json_decode($cookie, true);

  // if $saved_cart_items is null, prevent null error
  if(!$saved_cart_items){
      $saved_cart_items=array();
  }

  // check if the item is in the array, if it is add new element
  if(array_key_exists($id, $saved_cart_items)){
    $quantity += $saved_cart_items[$id]['quantity'];
  }

  // if cart has contents
  if(count($saved_cart_items)>0){
    foreach($saved_cart_items as $key=>$value){
      // add old item to array, it will prevent duplicate keys
      $cart_items[$key]=array(
        'quantity'=>$value['quantity']
      );
    }
  }

  // add new item on array
  $cart_items[$id]=array(
    'quantity'=>$quantity
  );

  // put item to cookie
  $json = json_encode($cart_items, true);
  setcookie("cart_items_cookie", $json, time() + (600), '/'); // 600 = 10 minutes
  $_COOKIE['cart_items_cookie']=$json;
}
die();
?>
