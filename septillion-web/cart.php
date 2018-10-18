<!DOCTYPE html>
<html lang="en">
<head>
	<title>Septillion / Mon panier</title>
	<?php include('header_link.php'); ?>
	<?php require('BDD/ProductManager.php'); ?>
	<?php require('BDD/Product.php'); ?>
	<?php require('connexion.php')?>
</head>
<body class="animsition">

	<!-- BDD AND CART -->
	<?php
	// récupération des infos du panier
	$cookie = isset($_COOKIE['cart_items_cookie']) ? $_COOKIE['cart_items_cookie'] : "";
	$cookie = stripslashes($cookie);
	$cart = json_decode($cookie, true);

	// bdd
	$conn = Connect::connexion();

	// récupération de la liste des produits
	$productManager = new ProductManager($conn);
	$productManager->getList();
	?>

	<!-- Header -->
	<header class="header1">
		<?php include('header_navbar.php'); ?>
	</header>


	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading-pages-01.jpg);">
		<h2 class="l-text2 t-center">
			Mon panier
		</h2>
	</section>

	<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
			<!-- Cart item -->
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1"></th>
							<th class="column-2">Produit</th>
							<th class="column-3">Prix</th>
							<th class="column-4 p-l-70">Quantité</th>
							<th class="column-5">Total</th>
						</tr>

						<?php if (isset($cart)){ foreach ($cart as $key=>$value) { ?>
							<?php $product = $productManager->get($key);?>
							<tr class="table-row product">
								<td class="column-1">
									<div class="cart-img-product b-rad-4 o-f-hidden">
										<img src="images/products/<?php echo $product->image();?>" alt="IMG-PRODUCT">
									</div>
								</td>
								<td class="product-id" hidden><?php echo $product->id();?></td>
								<td class="column-2"><?php echo $product->name();?></td>
								<td class="column-3 product-price"><?php echo $product->price();?></td>
								<td class="column-4 product-quantity-control">
									<div class="flex-w bo5 of-hidden w-size17">
										<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2 product-remove">
											<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
										</button>

										<input class="size8 m-text18 t-center num-product product-quantity" type="number" value="<?php echo $cart[$key]['quantity'];?>">

										<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2 product-add">
											<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
										</button>
									</div>
								</td>
								<td class="column-5 product-line-price"><?php echo $product->price()*$cart[$key]['quantity'];?></td>
							</tr>
						<?php }} ?>
					</table>
				</div>
			</div>

			<!-- MODIF -->
			<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
				<div class="flex-w flex-m w-full-sm">
					<div class="size11 bo4 m-r-10">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="coupon-code" placeholder="Coupon Code">
					</div>

					<div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
						<!-- Button -->
						<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
							Appliquer un code promo
						</button>
					</div>
				</div>

				<div class="size10 trans-0-4 m-t-10 m-b-10">
					<!-- Button -->
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4 btn-changecart">
						Appliquer les changements
					</button>
				</div>
			</div>

			<!-- TOTAL -->
			<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
				<div class="flex-w flex-m w-full-sm">
					<h5 class="m-text20 p-b-24">
						Panier total
					</h5>
				</div>

				<div class="size10 trans-0-4 m-t-10 m-b-10 totals-value">
					<!-- Button -->
					<span class="s-text18 w-size19 w-full-sm">
						Sous total:
					</span>
					<span class="m-text21 w-size20 w-full-sm cart-subtotal">
						SOUS TOTAL
					</span>
				</div>
				<div class="size10 trans-0-4 m-t-10 m-b-10 totals-value">
					<span class="m-text22 w-size19 w-full-sm">
						Total:
					</span>

					<span class="m-text21 w-size20 w-full-sm cart-total">
						PRIX
					</span>
				</div>
				<div class="size10 trans-0-4 m-t-10 m-b-10">
					<!-- Button -->
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
						Payer
					</button>
				</div>
			</div>

		</div>
	</section>



	<!-- Footer -->
	<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
		<?php include('footer_navbar.php');?>
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
	<script>
	/* Set rates + misc */
	var taxRate = 0.05;
	var shippingRate = 15.00;
	var fadeTime = 300;

	$(document).ready(function() {
		recalculateCart();
	});
	/* Assign actions */
	$('.product-quantity').change( function() {
		updateQuantity(this, "O");
	});

	$('.product-add').click( function() {
		updateQuantity(this, "P");
	});

	$('.product-remove').click( function() {
		updateQuantity(this, "M");
	});

	/* Recalculate cart */
	function recalculateCart()
	{
		var subtotal = 0;

		/* Sum up row totals */
		$('.product').each(function () {
			subtotal += parseFloat($(this).children('.product-line-price').text());
		});

		/* Calculate totals */
		//var tax = subtotal * taxRate;
		//var shipping = (subtotal > 0 ? shippingRate : 0);
		var total = subtotal //+ tax + shipping;

		/* Update totals display */
		$('.totals-value').fadeOut(fadeTime, function() {
			$('.cart-subtotal').html(subtotal.toFixed(2));
			$('.cart-total').html(total.toFixed(2));
			if(total == 0){
				$('.checkout').fadeOut(fadeTime);
			}else{
				$('.checkout').fadeIn(fadeTime);
			}
			$('.totals-value').fadeIn(fadeTime);
		});
	}

	/* Update quantity */
	function updateQuantity(quantityInput, instruction)
	{
		/* Calculate line price */
		var productRow = $(quantityInput).parent().parent().parent();
		var price = parseFloat(productRow.children('.product-price').text());

		if (instruction == "P") {
			var jsp = ($(quantityInput).parent().children('.product-quantity')).val()
			var quantity = (parseFloat(jsp)+1).toString();
		} else if (instruction == "M") {
			var jsp = ($(quantityInput).parent().children('.product-quantity')).val()
			var quantity = (parseFloat(jsp)-1).toString();
		} else {
			var quantity = $(quantityInput).val();
		}

		if (quantity != "0") {
			var linePrice = price * quantity;
			/* Update line price display and recalc cart totals */
			productRow.children('.product-line-price').each(function () {
				$(this).fadeOut(fadeTime, function() {
					$(this).text(linePrice.toFixed(2));
					recalculateCart();
					$(this).fadeIn(fadeTime);
				});
			});
		} else {
			removeItem(productRow);
		}
	}

	/* Remove item from cart */
	function removeItem(removeObject)
	{
		/* Remove row from DOM and recalc cart total */
		var productRow = $(removeObject);
		productRow.slideUp(fadeTime, function() {
			productRow.remove();
			recalculateCart();
		});
	}
	</script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
$('.btn-changecart').click(function(){
		// Get url
		var url = "change_to_cart.php?";
		var count = 0;
		$('.product').each(function () {
			url += "id"+count+"="+($(this).children('.product-id').text())+"&quantity"+count+"="+($(this).children('.product-quantity-control').children().children('.product-quantity').val()+"&");
			count+=1;
		});
		console.log(url);
		// Request
		var arf = new XMLHttpRequest();
		arf.open("GET",url,false);
		arf.send(null);
		swal("","Les changements ont bien été enregistrés !", "success");
	});
</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
