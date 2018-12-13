<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Septillion / Connexion</title>
  <?php include('header_link.php'); ?>
  <?php
  // verification s'il y a des erreur !
  $erreur = 100;
  if (isset($_GET['erreur']))
    $erreur = $_GET['erreur'];
  if(isset($_SESSION['id_client']))
    header('Location: index.php');
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
      Vous connecter
    </h2>
  </section>

  <!-- content page -->
  <section class="bgwhite p-t-66 p-b-60">
    <div class="container">
      <div class="row">
        <div class="col-md-6 p-b-30">
          <form class="leave-comment" action="script_login.php" method="post">
            <h4 class="m-text26 p-b-36 p-t-15">
              Vous connecter
            </h4>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="email" name="mail" placeholder="Votre mail" required>
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password"
              placeholder="Votre mot de passe" required>
            </div>
            <?php if ($erreur == '0'): ?><p class="m-b-20" style="color : #F08080">Le mail ou le mot de passe
        est incorrect, le compte n'a pas été trouvé.</p><?php ; endif ?>
            <div class="w-size25">
              <button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" name="connexion">
                Se connecter
              </button>
            </div>
          </form>
        </div>

        <div class="col-md-6 p-b-30">
          <form class="leave-comment" action="script_sign_up.php" method="post">
            <h4 class="m-text26 p-b-36 p-t-15">
              Créer un compte
            </h4>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="email" name="mail" placeholder="Email" value="<?php if(isset($_SESSION['data']['mail'])): echo $_SESSION['data']['mail']; endif; ?>" required>
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="email" name="mail_conf"
              placeholder="Confirmer votre email" required>
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password" placeholder="Mot de passe" required>
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password_conf" placeholder="Confirmer votre mot de passe" required>
            </div>
            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="first_name" value="<?php if(isset($_SESSION['data']['first_name'])): echo $_SESSION['data']['first_name']; endif; ?>"
              placeholder="Prénom" required>
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="last_name" placeholder="Nom" value="<?php if(isset($_SESSION['data']['last_name'])): echo $_SESSION['data']['last_name']; endif; ?>" required>
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="tel" name="phone_number"
              placeholder="Numéro de téléphone"  value="<?php if(isset($_SESSION['data']['phone_number'])): echo $_SESSION['data']['phone_number']; endif; ?>"  required>
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="address" placeholder="Address" value="<?php if(isset($_SESSION['data']['address'])): echo $_SESSION['data']['address']; endif; ?>" >
            </div>

            <?php if ($erreur == '2'): ?><p class="m-b-20" style="color : #F08080">Caractères incorrects.</p><?php ; endif ?>
              <?php if ($erreur == '3'): ?><p class="m-b-20" style="color : #F08080">Ce mail est déjà
                utilisé.</p><?php ; endif ?>
            <?php if ($erreur == '4'): ?><p class="m-b-20" style="color : #F08080">Les mails sont
              différents.</p><?php ; endif ?>
            <?php if ($erreur == '5'): ?><p class="m-b-20" style="color : #F08080">Les mots de passe sont
              différents.</p><?php ; endif ?>

            <div class="w-size25">
              <button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
                  Créer un compte
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

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
    fields[this.name] = $(this).val();
  });
  var obj = {fields: fields};
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

</body>
</html>
