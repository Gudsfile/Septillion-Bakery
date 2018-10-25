<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Septillion| Mes commandes</title>
	<?php include('header_link.php'); ?>
	<?php require('BDD/ProductManager.php'); ?>
	<?php require('BDD/Product.php'); ?>
	<?php require('BDD/OrderManager.php'); ?>
	<?php require('BDD/Order.php'); ?>
	<?php require('BDD/IsOrderedManager.php'); ?>
	<?php require('BDD/IsOrdered.php'); ?>
	<?php require('connexion.php'); ?>
	<?php session_start() ?>
	<?php if(!isset($_SESSION['mail']) && !isset($_SESSION['password'])){
		header("Location: index.php");
		exit();
	}
	?>
</head>

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

<!-- content page -->
<section class="bgwhite p-t-66 p-b-60">
    <div class="container">
    	<!-- BDD -->
    	<?php 
    		$conn = Connect::connexion();
    		$orderManager =  new OrderManager($conn);
    		$isOrderedManager =  new IsOrderedManager($conn);
    		$order = $orderManager->getByClient($_SESSION['id_client']); ?>


			<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
			<!-- Cart item -->
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1">Date</th>
							<th class="column-2">Description</th>
							<th class="column-3">Total</th>
							<th class="column-4"></th>
						</tr>

						<?php foreach ($order as $key=>$value) { ?>
							<?php //$isOrderedManager=get ?>
							<tr class="table-row">
												<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Commande <?php echo $value->description()." 	".$value->order_date();?>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
					</h5>
					
					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							<?php echo $value->description(); ?>
						</p>
					</div>
				</div>
								<td class="column-1"><?php echo $value->order_date();?></td>
								<td class="column-2"><?php echo $value->description();?></td>
								<td class="column-3"><?php echo $value->description();?></td>
								<td class="column-4"><?php ?></td>
								<td class="column-5"> <a href="#"> <?php echo "view details";?> </a></td>

							
							</tr>
						<?php } ?>


					</table>
				</div>
			</div>


		</div>
	</section>


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