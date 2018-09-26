<!-- Header Mobile -->
<div class="wrap_header_mobile">
  <!-- Logo moblie -->
  <a href="index.php" class="logo-mobile">
    <img src="images/icons/logo.png" alt="IMG-LOGO">
  </a>

  <!-- Button show menu -->
  <div class="btn-show-menu">
    <!-- Header Icon mobile -->
    <div class="header-icons-mobile">
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

      <span class="linedivide2"></span>

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
                Panier
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

    <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
      <span class="hamburger-box">
        <span class="hamburger-inner"></span>
      </span>
    </div>
  </div>
</div>

<!-- Menu Mobile -->
<div class="wrap-side-menu" >
  <nav class="side-menu">
    <ul class="main-menu">

      <li class="item-menu-mobile">
        <a href="index.php">Accueil</a>
      </li>

      <li class="item-menu-mobile">
        <a href="about.php">Notre histoire</a>
      </li>

      <li class="item-menu-mobile">
        <a href="product.php">Nos produits</a>
      </li>

      <li class="item-menu-mobile">
        <a href="cart.php">Mon panier</a>
      </li>

      <li class="item-menu-mobile">
        <a href="contact.php">Nous contacter</a>
      </li>
    </ul>
  </nav>
</div>
