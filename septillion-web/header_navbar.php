<?php session_start (); ?>

<!-- BDD -->

<?php
// get data in cookie
$cookie2 = isset($_COOKIE['cart_items_cookie']) ? $_COOKIE['cart_items_cookie'] : "";
$cookie2 = stripslashes($cookie2);
$cart2 = json_decode($cookie2, true);

// bdd
$conn2 = Connect::connexion();

// get products list
$productManager2 = new ProductManager($conn2);
$productManager2->getList();
?>

<!-- Header desktop -->
<div class="container-menu-header">

  <div class="wrap_header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <img src="images/icons/logo.png" alt="IMG-LOGO">
    </a>

    <!-- Menu -->
    <div class="wrap_menu">
      <nav class="menu">
        <ul class="main_menu">
          <li
          <?php if (basename($_SERVER['PHP_SELF'])=='index.php'): ?>
            class="sale-noti"
          <?php ; endif?>
          >
            <a href="index.php">Accueil</a>
          </li>

            <li
            <?php if (basename($_SERVER['PHP_SELF'])=='about.php'): ?>
              class="sale-noti"
            <?php ; endif?>
            >
            <a href="about.php">Notre histoire</a>
          </li>

            <li
            <?php if (basename($_SERVER['PHP_SELF'])=='product.php' || basename($_SERVER['PHP_SELF'])=='product-detail.php' ): ?>
              class="sale-noti"
            <?php ; endif?>
            >
            <a href="product.php">Nos produits</a>
          </li>

            <li
            <?php if (basename($_SERVER['PHP_SELF'])=='cart.php'): ?>
              class="sale-noti"
            <?php ; endif?>
            >
            <a href="cart.php">Mon panier</a>
          </li>

            <li
            <?php if (basename($_SERVER['PHP_SELF'])=='contact.php'): ?>
              class="sale-noti"
            <?php ; endif?>
            >
            <a href="contact.php">Nous contacter</a>
          </li>

        </ul>
      </nav>
    </div>
    <!-- Header Icon -->
    <div class="header-icons">
    <?php if (isset($_SESSION['mail']) && isset($_SESSION['password'])):?>
      <ul class="main_menu">
        <li>
          <img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
          <ul class="sub_menu">
            <li><a href="#">Mon compte</a></li>
            <li><a href="script_logout.php">Se déconnecter</a></li>
          </ul>
        </li>
      </ul>
    <?php else:?>
      <a href="login.php" class="header-wrapicon1 dis-block">
        <img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
      </a>
    <?php endif?>

      <span class="linedivide1"></span>
      <div class="header-wrapicon2">
        <img href="product.php" src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
        <!--<span class="header-icons-noti">0</span>--><!-- nbr d'elements dans le panier-->
        <!-- Header cart noti -->
        <div class="header-cart header-dropdown">
          <?php if (isset($cart2)){ ?>
          <ul class="header-cart-wrapitem">
          <?php foreach ($cart2 as $key=>$value) { ?>
            <?php $product = $productManager2->get($key);?>
            <li class="header-cart-item">
              <div class="header-cart-item-img">
                <img src="images/products/<?php echo $product->image();?>" alt="IMG">
              </div>

              <div class="header-cart-item-txt">
                <a href="product-detail.php?id=<?php echo $product->id();?>" class="header-cart-item-name"><?php echo $product->name();?></a>

                <span class="header-cart-item-info">
                  <a class="header-cart-item-quantity"><?php echo $cart2[$key]['quantity'];?></a> x <a class="header-cart-item-price"><?php echo $product->price();?></a>
                </span>
              </div>
            </li>
          <?php } ?>
          </ul>

          <div class="header-cart-total">
            Total: <a class="widget-cart-total"></a>
          </div>

          <div class="header-cart-buttons">
            <div class="header-cart-wrapbtn">
              <!-- Button -->
              <a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                Voir le panier
              </a>
            </div>

            <div class="header-cart-wrapbtn">
              <!-- Button -->
              <?php if (isset($_SESSION['mail'])): ?>
              <a href="cart.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                Payer
              </a>
              <?php else:?>
                <a href="login.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                  Se connecter
                </a>
              <?php endif ?>
            </div>
          </div>
        <?php } else { ?>
          <p> Panier vide </p>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include("header_mobile.php"); ?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script>
var fadeTime = 300;

$(document).ready(function(){
  recalculateWidgetCart();
});

// recalculate price of the cart
function recalculateWidgetCart(){
  var total = 0;

  // rows sum
  $('.header-cart-item').each(function (){
    var tmp = ($(this).children().children().children('.header-cart-item-price').text()*$(this).children().children().children('.header-cart-item-quantity').text());
    total += parseFloat(tmp);
  });

  // recalculate total price
  $('.header-cart-total').fadeOut(fadeTime, function() {
    $('.widget-cart-total').html(total.toFixed(2));
    if(total == 0){
      $('.checkout').fadeOut(fadeTime);
    }else{
      $('.checkout').fadeIn(fadeTime);
    }
    $('.header-cart-total').fadeIn(fadeTime);
  });
}

// recalculate row price
function updateWidgetQuantity(quantityInput, instruction){

  var productRow = $(quantityInput).parent().parent().parent();
  var price = parseFloat(productRow.children('.product-price').text());
  var name = productRow.children('.product-name').text();

  if (instruction == "P") {
    var jsp = ($(quantityInput).parent().children('.product-quantity')).val()
    var quantity = (parseFloat(jsp)+1).toString();
  } else if (instruction == "M") {
    var jsp = ($(quantityInput).parent().children('.product-quantity')).val()
    var quantity = (parseFloat(jsp)-1).toString();
  } else {
    var quantity = $(quantityInput).val();
  }

  var productHeader = null;
  var indexHeader = "";
  $('.header-cart-item').each(function (index){
    var tmp = $(this).children().children('.header-cart-item-name').text();
    if(tmp == name){
      indexHeader = index;
      productHeader = $(this);
    }
  });

  console.log(productHeader);
  console.log(productHeader.children('.header-cart-item-txt').children('.header-cart-item-price'));
  console.log(productHeader.children('.header-cart-item-txt').children('.header-cart-item-quantity'));

  if (quantity != "0" && quantity != null && quantity != "" && quantity != " "){
    // Update line price display and recalc cart totals
    productHeader.children('.header-cart-item-price').text(price.toFixed(2));
    productHeader.children('.header-cart-item-quantity').text(quantity.toFixed(2));
    recalculateWidgetCart();
  } else {
    removeWidgetItem(productRow);
  }
}

// delete product
function removeWidgetItem(removeObject)
{
  var productRow = $(removeObject);
  productRow.slideUp(fadeTime, function(){
    productRow.remove();
    recalculateCart();
  });
}
</script>
