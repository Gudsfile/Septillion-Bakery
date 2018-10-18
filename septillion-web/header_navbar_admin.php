<?php session_start (); ?>

<!-- Header desktop -->
<div class="container-menu-header">

  <div class="wrap_header_admin">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <img src="images/icons/logo.png" alt="IMG-LOGO">
    </a>

    <!-- Menu -->
    <div class="wrap_menu">
      <nav class="menu">
        <ul class="main_menu_admin">
          <li
          <?php if (basename($_SERVER['PHP_SELF'])=='index.php'): ?>
            class="sale-noti"
          <?php ; endif?>
          >
            <a href="administration.php">Accueil administration</a>
          </li>


            <li
            <?php if (basename($_SERVER['PHP_SELF'])=='about.php'): ?>
              class="sale-noti"
            <?php ; endif?>
            >
            <a href="about.php">Gestion des produits</a>
          </li>

            <li
            <?php if (basename($_SERVER['PHP_SELF'])=='about.php'): ?>
              class="sale-noti"
            <?php ; endif?>
            >
            <a href="about.php">Créer un produit</a>
          </li>

            <li
            <?php if (basename($_SERVER['PHP_SELF'])=='product.php' || basename($_SERVER['PHP_SELF'])=='product-detail.php' ): ?>
              class="sale-noti"
            <?php ; endif?>
            >
            <a href="edit_product.php">Editer un produit</a>
          </li>

            <li
            <?php if (basename($_SERVER['PHP_SELF'])=='cart.php'): ?>
              class="sale-noti"
            <?php ; endif?>
            >
            <a href="category.php">Catégorie</a>
          </li>

            <li
            <?php if (basename($_SERVER['PHP_SELF'])=='contact.php'): ?>
              class="sale-noti"
            <?php ; endif?>
            >
            <a href="logout_script.php">Déconnexion</a>
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
            <li><a href="logout_script.php">Se déconnecter</a></li>
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
        <img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
        <span class="header-icons-noti">0</span>

        <!-- Header cart noti -->
        <div class="header-cart header-dropdown">
          <ul class="header-cart-wrapitem">
            <li class="header-cart-item">
              <div class="header-cart-item-img">
                <img src="images/item-cart-id_article.jpg" alt="IMG">
              </div>

              <div class="header-cart-item-txt">
                <a href="#" class="header-cart-item-name">
                  nom_article
                </a>

                <span class="header-cart-item-info">
                  quantité x prix
                </span>
              </div>
            </li>
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
              <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                Payer
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include("header_mobile_admin.php"); ?>
