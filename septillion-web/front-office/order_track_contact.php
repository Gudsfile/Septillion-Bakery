<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Septillion| Mes commandes</title>
  <link href="css/track.css" rel="stylesheet" type="text/css"/>
  <?php include('header_link.php'); ?>
  <?php session_start() ?>
  <?php if(!isset($_SESSION['mail']) && !isset($_SESSION['password'])){
    header("Location: index.php");
    exit();
  }
  ?>
  <?php if (!isset($_GET['id'])) {
    header("Location: order_track.php");
    exit();
  }
  ?>
</head>
<body class="animsition">

  <!-- Header -->
  <header class="header1">
    <?php include('header_navbar.php'); ?>
  </header>

  <!-- Title Page -->
  <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading-pages-06.jpg);">
    <h2 class="l-text2 t-center">
      Mes commandes
    </h2>
  </section>


  <?php

  $conn = Connect::connexion();
  $orderManager =  new OrderManager($conn);
  $employeeManager = new EmployeeManager($conn);
  $isOrderedManager = new IsOrderedManager($conn);
  $productManager = new ProductManager($conn);
  $clientManager = new ClientManager($conn);
  $order = $orderManager->get($_GET['id']);
  $employee=$employeeManager->get($order->employee());
  $client=$clientManager->get($order->client());




  ?>

  <!-- Content page -->
  <?php //test etat :
  $Etat; $color;
  if ($order->collected()){
    $Etat="Collectée";
    $color="red";
  }

  elseif ($order->ready()) {
    $Etat="Prête";
    $color="green";
  }elseif ($order->validated()) {
    $Etat="Validée";
    $color="#45c4ff";

  }else{
    $Etat="En cours de traitement";
    $color="#ffe945";
  }
  ?>

  <section class="bgwhite p-t-66 p-b-60">
    <div class="container">
      <div class="row">
        <div class="col-md-6 p-b-30">
          <div class="p-r-20 p-r-0-lg">
            <header class="pricing-header">
              <?php
              $date = strtotime($order->order_date());
              ?>
              <h2><?php echo date( 'l d F Y',$date);?></h2>
              <div class="price">
                <?php $isOrdered = $isOrderedManager->getByOrder($order->id());
                $total=0;
                foreach ($isOrdered as $key => $valu) {
                  $product=$productManager->get($valu->id_product());
                  $price=$product->price();
                  $quantity=$valu->quantity();
                  $total+=($price*$quantity);
                }
                ?>
                <span class="value"><?php echo $total; ?></span>
                <span class="currency">€</span>
              </div>
            </header>
            <div class="pricing-body">
              <ul class="pricing-features">
                <?php foreach ($isOrdered as $key => $valuep) {
                  $product=$productManager->get($valuep->id_product());
                  ?>

                  <li><em><?php echo $valuep->quantity(); ?> </em> <?php echo $product->name()." - ".$product->price()." € ";?></li>

                <?php } ?>
              </ul>
            </div>
            <footer class="pricing-footer">
              <h2>la commande est : </h2>
              <h2 style="color: <?php echo $color;?>"> <?php echo $Etat;?></h2>
            </footer>
          </div>
        </div>
        <div class="col-md-6 p-b-30">
          <form class="leave-comment" action="script_track_contact.php" method="post">
            <br><br><br>
            <h4 class="m-text26 p-b-36 p-t-15">
              Contactez-nous
            </h4>
            <input type="hidden" name="id_order" value="<?php echo $order->id();?>">
            <div class="bo4 of-hidden size15 m-b-20">
              commande : <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="description" value="<?php echo $order->description(); ?>" disabled>
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              Client :  <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="client" value="<?php echo $client->first_name()." ".$client->last_name(); ?>" disabled>
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              Employee : <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="employee" value="<?php echo $employee->first_name()." ".$employee->last_name(); ?>" disabled>
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="objet" placeholder="Objet" required>
            </div>


            <textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="message" placeholder="Message" required></textarea>

            <div class="w-size25">
              <!-- Button -->
              <input type="submit" class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" name="Envoyer" value="Envoyer" >

            </div>
          </form>
        </div>
      </div>
    </div>
  </section>



</body>
<!-- Footer -->
<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
  <?php include('footer_navbar.php'); ?>
</footer>


<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn">
  <span class="symbol-btn-back-to-top">
    <i class="fa fa-angle-double-up" aria-hidden="true"></i>
  </span>
</div>

<!-- Container Selection -->
<div id="dropDownSelect1"></div>
<div id="dropDownSelect2"></div>

<!--================================================================================================-->

<script type="text/javascript">
var fields = {};
$("#theForm").find(":input").each(function() {
  // The selector will match buttons; if you want to filter
  // them out, check `this.tagName` and `this.type`; see
  // below
  fields[this.name] = $(this).val();
});
var obj = {fields: fields}; // You said you wanted an object with a `fields` property, so



</script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/select2/select2.min.js"></script>
<script type="text/javascript">
$(".selection-1").select2({
  minimumResultsForSearch: 20,
  dropdownParent: $('#dropDownSelect1')
});

$(".selection-2").select2({
  minimumResultsForSearch: 20,
  dropdownParent: $('#dropDownSelect2')
});
</script>
<!--===============================================================================================-->
<script src="js/main.js"></script>
