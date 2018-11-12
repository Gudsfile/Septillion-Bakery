<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Septillion / Mes commandes</title>
	<link href="css/track.css" rel="stylesheet" type="text/css"/>
	<!-- BDD includes -->
	<?php include('header_link.php'); ?>
</head>
<body class="animsition">

	<!-- verif -->
	<?php
	if(!isset($_SESSION['mail']) || !isset($_SESSION['id_client'])){
		header("Location: index.php");
		exit();
	}
	?>

	<!-- Header -->
	<header class="header1">
		<?php include('header_navbar.php'); ?>
	</header>

	<!-- BDD -->
	<?php
	$conn = Connect::connexion();
	$orderManager =  new OrderManager($conn);
	$isOrderedManager =  new IsOrderedManager($conn);
	$productManager= new ProductManager($conn);
	$order = $orderManager->getByClient($_SESSION['id_client']);
	?>

	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading-pages-06.jpg);">
		<h2 class="l-text2 t-center">
			Mes commandes
		</h2>
	</section>

	<section class="bgwhite p-t-66 p-b-60">
		<div class="container">
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1">Date</th>
							<th class="column-2">Commande</th>
							<th class="column-3">Prix</th>
							<th class="column-4">Status</th>
						</tr>
						<?php
						$order=array_reverse($order);
						foreach ($order as $key=>$value) { ?>
							<tr class="table-row product">
								<td class="date">
									<?php echo date($value->order_date()); ?>
								</td>
								<td class="cmd">
									<ul>
										<?php
										$isOrdered = $isOrderedManager->getByOrder($value->id());
										foreach ($isOrdered as $key => $valuep) {
											$product=$productManager->get($valuep->id_product());
											?>
											<li><?php echo $valuep->quantity().' x '; echo $product->name()." - ".$product->price()." € ";?></li>
										<?php } ?>
									</ul>
								</td>
								<td class="prix">
									<?php
									$isOrdered = $isOrderedManager->getByOrder($value->id());
									$total=0;
									foreach ($isOrdered as $key => $valu) {
										$product=$productManager->get($valu->id_product());
										$price=$product->price();
										$quantity=$valu->quantity();
										$total+=($price*$quantity);
									}
									echo $total.' €';
									?>
								</td>
								<?php
								if ($value->collected()){
									$Etat="Collectée";
									$color="#E65540";
								}
								elseif ($value->ready()) {
									$Etat="Prête";
									$color="#0C9957";
								}elseif ($value->validated()) {
									$Etat="Validée";
									$color="#57B7F3";
								}else{
									$Etat="En cours de traitement";
									$color="#FDB542";
								}
								?>
								<td class="status" style="color:<?php echo $color; ?>">
									<?php echo $Etat;?>
								</td>
								<tr/>
							<?php } ?>
						</table>
					</div>
				</div>
			</div>
		</section>
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

<!--===============================================================================================-->
<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="js/main.js"></script>
