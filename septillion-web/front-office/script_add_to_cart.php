<?php
// get data in GET
$id = isset($_GET['id']) ? $_GET['id'] : null;
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;

if ($id == null) {
  header('Location: product.php');
}
else {
  // quantity have a minimum of 1
  $quantity=$quantity<=0 ? 1 : $quantity;

  // read cookie
  $cookie = isset($_COOKIE['cart_items_cookie']) ? $_COOKIE['cart_items_cookie'] : "";
  $cookie = stripslashes($cookie);
  $saved_cart_items = json_decode($cookie, true);

  // if no previous cookie
  if(!$saved_cart_items){
    $saved_cart_items=array();
  }

  // get old quantity and add
  if(array_key_exists($id, $saved_cart_items)){
    $quantity += $saved_cart_items[$id]['quantity'];
  }

  // get old products and add in the new cart
  if(count($saved_cart_items)>0){
    foreach($saved_cart_items as $key=>$value){
      $cart_items[$key]=array(
        'quantity'=>$value['quantity']
      );
    }
  }

  // add new item on the cart
  $cart_items[$id]=array(
    'quantity'=>$quantity
  );

  // put cart to cookie
  $json = json_encode($cart_items, true);
  setcookie("cart_items_cookie", $json, time() + (600), '/'); // 600 = 10 minutes
  $_COOKIE['cart_items_cookie']=$json;
}

die();
?>
