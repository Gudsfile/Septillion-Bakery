<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Septillion| Mes commandes</title>
	<link href="css/track.css" rel="stylesheet" type="text/css"/>
	<!-- BDD includes -->
	<?php include('header_link.php'); ?>
	<!-- Session manager -->
	<?php session_start() ?>
	<?php if(!isset($_SESSION['mail']) && !isset($_SESSION['password'])){
		header("Location: index.php");
		exit();
	}
	?>

	<!-- Carousel manager -->
	  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <style>
  /* Make the image fully responsive */
  .carousel-inner img {
      width: 100%;
      height: 100%;
  }
  </style>













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


<section class="bgwhite p-t-66 p-b-60">
    <div class="container">
    	<!-- BDD -->
    	<?php
    		$conn = Connect::connexion();
    		$orderManager =  new OrderManager($conn);
    		$isOrderedManager =  new IsOrderedManager($conn);
    		$productManager= new ProductManager($conn);
    		$order = $orderManager->getByClient($_SESSION['id_client']);


    		?>

</div></section>

<!-- **************************************************** -->
<div id="demo" class="carousel slide" data-ride="carousel">
	<div class="pricing-container">
		<div class="pricing-switcher">
			<p class="fieldset">
				<?php
				// gestion du trie !
				$toutes='true';
				if (isset($_GET['toutes'])) {
					$toutes = $_GET['toutes'];
				}
				if($toutes=='true'){?>

				<input type="radio" name="duration-1" value="product.php" id="monthly-1" onclick="trier('true')" checked>
				<label for="monthly-1">Toutes</label>
				<input type="radio" name="duration-1" value="index.php" id="yearly-1" onclick="trier('false')" >
				<label for="yearly-1">En cours</label>
				<span class="switch"></span>
				<?php } else {?>
				<input type="radio" name="duration-1" value="product.php" id="monthly-1" onclick="trier('true')">
				<label for="monthly-1">Toutes</label>
				<input type="radio" name="duration-1" value="index.php" id="yearly-1" onclick="trier('false')" checked>
				<label for="yearly-1">En cours</label>
				<span class="switch"></span>
				<?php } ?>
			</p>
		</div>
	<div class="carousel-inner">
		<ul class="pricing-list bounce-invert">
					<?php $order=array_reverse($order);
							$carrou=0;
							foreach ($order as $key=>$value) { ?>
							<?php //test etat :
								$Etat; $color;
								if ($value->collected()){
									$Etat="Collectée";
									$color="red";
								}

								elseif ($value->ready()) {
									$Etat="Prête";
									$color="green";
								}elseif ($value->validated()) {
									$Etat="Validée";
									$color="#45c4ff";

								}else{
									$Etat="En cours de traitement";
									$color="#ffe945";
								}
								if ($toutes=="false" && $Etat=="Collectée") {

									continue;
								}

							 ?>
							 	<?php
								$carrou ++;
							 	$help="";
							 	if ($carrou ==1 ) {
							 		$help = "active";
							 	}

							 	?>
							 	<div class="carousel-item <?php echo $help ?>">
							 	<li class="exclusive">
									<ul class="pricing-wrapper">
										<li data-type="monthly" class="is-visible" >
											<header class="pricing-header">
												<?php
													$date = strtotime($value->order_date());
												?>
												<h2><?php echo date( 'l d F Y',$date);?></h2>
												<div class="price">
													<?php $isOrdered = $isOrderedManager->getByOrder($value->id());
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
												<br>
												<a style="color:#ff5f45;" href="order_track_contact.php?id=<?php echo $value->id(); ?>">Contactez-nous</a>
											</footer>
										</li>

									</ul>
								</li>
							 	</div>

									<?php } ?>
		</ul>
		  <!-- Left and right controls -->
  <a style="background: grey;" class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a style="background: grey;" class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
	</div>
	</div>
</div>
</body>
</html>


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
	function trier(value){
		window.location.href='order_track.php?toutes='+value;
	}
</script>
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
