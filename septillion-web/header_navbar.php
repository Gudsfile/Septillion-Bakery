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
                <a href="#" class="header-cart-item-name"><?php echo $product->name();?></a>

                <span class="header-cart-item-info">
                  <?php echo $cart2[$key]['quantity'];?> x <?php echo $product->price();?>
                </span>
              </div>
            </li>
          <?php } ?>
          </ul>

          <div class="header-cart-total">
            Total: prix
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
