<!DOCTYPE html>
<html lang="fr">

<head>
	<title>Septillion / Mon panier</title>
	<?php include('header_link.php'); ?>
</head>
<body class="animsition">

	<!-- BDD AND CART -->
	<?php
	// get data in cookie
	$cookie = isset($_COOKIE['cart_items_cookie']) ? $_COOKIE['cart_items_cookie'] : "";
	$cookie = stripslashes($cookie); // Supprime les antislashs d'une chaîne
	$cart = json_decode($cookie, true);

	// bdd
	$conn = Connect::connexion();
	$imageManager = new ImageManager($conn);

	// get products list
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
							<?php if ($product->id() != "" && $cart[$key]['quantity'] > 0){ ?>
								<tr class="table-row product">
									<td class="column-1">
										<div class="cart-img-product b-rad-4 o-f-hidden">
											<img src="data:image/jpeg;base64,<?php echo (base64_encode($imageManager->get($product->id_img())->image())); ?>" alt="IMG-PRODUCT">
										</div>
									</td>
									<td class="product-id" hidden><?php echo $product->id();?></td>
									<td class="column-2 product-name"><?php echo $product->name();?></td>
									<td class="column-3 product-price"><?php echo $product->price();?></td>
									<td class="column-4 product-quantity-control">
										<div class="flex-w bo5 of-hidden w-size17">
											<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2 product-remove">
												<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
											</button>

											<input class="size8 m-text18 t-center num-product product-quantity" onkeypress="return isNumberKey(event)" type="number" value="<?php echo $cart[$key]['quantity'];?>">

											<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2 product-add">
												<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
											</button>
										</div>
									</td>
									<td class="column-5 product-line-price"><?php echo $product->price()*$cart[$key]['quantity'];?></td>
								</tr>
							<?php }}} ?>
						</table>
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
						<span class="m-text22 w-size19 w-full-sm">
							Total:
						</span>

						<span class="m-text21 w-size20 w-full-sm cart-total">
							PRIX
						</span>
					</div>
					<div class="size10 trans-0-4 m-t-10 m-b-10">
						<!-- Button -->
						<?php if (isset($_SESSION['mail']) && isset($_SESSION['id_client'])): ?>
							<?php if (isset($_GET['erreur'])) {
								if ($_GET['erreur'] == 3) {
									?><p class="m-b-20" style="color : #F08080">Erreur lors du payement.</p> <?php
								}
							} ?>
							<p class="CSRFtoken" hidden><?php echo $_SESSION['CSRFtoken'] ?></p>
							<p class="IPtoken" hidden><?php echo $_SESSION['IPtoken'] ?></p>
							<p class="UAtoken" hidden><?php echo $_SESSION['UAtoken'] ?></p>
							<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4 btn-paycart">
								Payer
							</button>
						<?php else:?>
							<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4 btn-connect">
								Se connecter
							</button>
						<?php endif ?>
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

		<!--===============================================================================================-->
		<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
		<!--===============================================================================================-->
		<script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
		<!--===============================================================================================-->
		<script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
		<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<!--===============================================================================================-->
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<!--===============================================================================================-->
		<script>
		// jquery extend function
		$.extend(
		{
				redirectPost: function(location, args)
				{
						var form = '';
						$.each( args, function( key, value ) {
								form += '<input type="hidden" name="'+key+'" value="'+value+'">';
						});
						$('<form action="'+location+'" method="POST">'+form+'</form>').submit();
				}
		});

		var fadeTime = 300;

		// On load
		$(document).ready(function(){
			recalculateCart();
		});

		// get change with keys
		$('.product-quantity').change( function(){
			updateQuantity(this, "O");
			updateWidgetQuantity(this,"O");
		});

		// get change with +
		$('.product-add').click( function(){
			updateQuantity(this, "P");
			updateWidgetQuantity(this,"P");
		});

		// get change with -
		$('.product-remove').click( function(){
			updateQuantity(this, "M");
			updateWidgetQuantity(this,"M");
		});

		// connect button
		$('.btn-connect').click(function(){
			window.location.replace('login.php');
		});

		// payement button
		$('.btn-paycart').click(function(){
			swal({
				title: "Continuer ?",
				text: "Voulez-vous valider et payer votre commande ?",
				icon: 'warning',
				buttons: {
					cancel: "Non",
					catch: {
						text: "Oui",
						value: "pay",
					}
				}
			}).then((value) => {
				if (value == "pay") {
					change_cart()
					if (getCookie('cart_items_cookie') == "") {
						swal("Oops…","Le panier est vide !", "error");
					} else {
						//$.redirectPost('script_payement.php', {'CSRFtoken': $('.CSRFtoken').html()});
						//document.cookie = "cart_items_cookie=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
						function url_redirect(options){
                 var $form = $("<form />");

                 $form.attr("action",options.url);
                 $form.attr("method",options.method);

                 for (var data in options.data)
                 $form.append('<input type="hidden" name="'+data+'" value="'+options.data[data]+'" />');

                 $("body").append($form);
                 $form.submit();
            }

            $(function(){
                /*jquery statements */
                url_redirect({url: "script_payement.php",
                  method: "post",
                  data: {"CSRFtoken":$('.CSRFtoken').html()}
                 });
            });
					}
				}
			});
		});

		// recalculate price of the cart
		function recalculateCart(){
			var total = 0;

			// rows sum
			$('.product').each(function (){
				total += parseFloat($(this).children('.product-line-price').text());
			});

			// recalculate total price
			$('.totals-value').fadeOut(fadeTime, function() {
				$('.cart-total').html(total.toFixed(2));
				if(total == 0){
					$('.checkout').fadeOut(fadeTime);
				}else{
					$('.checkout').fadeIn(fadeTime);
				}
				$('.totals-value').fadeIn(fadeTime);
			});
			change_cart()
		}

		// recalculate row price
		function updateQuantity(quantityInput, instruction){

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

			if (quantity != "0" && quantity != null && quantity != "" && quantity != " "){
				var linePrice = price * quantity;
				// Update line price display and recalc cart totals
				productRow.children('.product-line-price').each(function (){
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

		// delete product
		function removeItem(removeObject)
		{
			var productRow = $(removeObject);
			productRow.slideUp(fadeTime, function(){
				productRow.remove();
				recalculateCart();
			});
		}

		// only digit
		function isNumberKey(evt){
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
			return true;
		}

		// get cookie
		function getCookie(cname){
			var name = cname + "=";
			var ca = document.cookie.split(';');
			for(var i=0; i<ca.length; i++) {
				var c = ca[i].trim();
				if (c.indexOf(name)==0) return c.substring(name.length,c.length);
			}
			return "";
		}

		// save cart in cookie
		function change_cart() {
			var url = "script_change_to_cart.php?";
			var count = 0;
			$('.product').each(function() {
				var q = $(this).children('.product-quantity-control').children().children('.product-quantity').val();
				url += "id"+count+"="+($(this).children('.product-id').text())+"&quantity"+count+"="+q+"&";
				count+=1;
			});
			// Request to change cookie
			var arf = new XMLHttpRequest();
			arf.open("GET",url,false);
			arf.send(null);
		}
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
