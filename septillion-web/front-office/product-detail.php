<!DOCTYPE html>
<html lang="fr">

<head>
	<?php include('header_link.php'); ?>
</head>

<body class="animsition">

	<!-- BDD -->
	<?php
		// get data in GET
		if(isset($_GET['product'])): $getProduct = $_GET['product']; else: $getProduct = null; endif;

		// bdd
		$conn = Connect::connexion();
		$imageManager = new ImageManager($conn);

		// get product
		$productManager = new ProductManager($conn);
		$product = $productManager->get($getProduct);

		// redirect if the product doesn't exists
		if(empty($product->id())){
			header('Location: product.php');
		}

		// get category list
		$categoryManager = new CategoryManager($conn);
		$category = $categoryManager->get($product->id_category())
	?>

	<!-- Header -->
	<header class="header1">
		<?php include('header_navbar.php'); ?>
		<title>Septillion / <?php echo $product->name(); ?></title>
	</header>

	<!-- breadcrumb -->
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="product.php" class="s-text16">
			Nos produits
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="product.php?category=<?php echo $category->id(); ?>" class="s-text16">
			<?php echo $category->name(); ?>
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
			<?php echo $product->name(); ?>
		</span>
	</div>

	<!-- Product Detail -->
	<div class="container bgwhite p-t-35 p-b-80">
		<div class="flex-w flex-sb">
			<div class="w-size13 p-t-30 respon5">
				<div class="wrap-slick3 flex-sb flex-w">
					<div class="slick3">
						<div class="item-slick3" data-thumb="images/thumb-item-01.jpg">
							<div class="wrap-pic-w">
								<img src="data:image/jpeg;base64,<?php echo (base64_encode($imageManager->get($product->id_img())->image())); ?>" alt="IMG-PRODUCT">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="w-size14 p-t-30 respon5">
				<p hidden class="product-detail-id" name="id"><?php echo $product->id(); ?></p>

				<h4 class="product-detail-name m-text16 p-b-13">
					<?php echo $product->name(); ?>
				</h4>

				<span class="m-text17">
					<?php echo $product->price(); ?> €
				</span>

				<p class="s-text8 p-t-10">
					<?php echo $product->description(); ?>
				</p>

				<!--  -->
				<div class="p-t-33 p-b-60">
					<div class="flex-r-m flex-w p-t-10">
						<div class="w-size16 flex-m flex-w">
							<div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
								<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
								</button>

								<input class="size8 m-text18 t-center num-product product-detail-quantity" onkeypress="return isNumberKey(event)" type="number" name="quantity" value="1">

								<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
								</button>
							</div>

							<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
								<!-- Button -->
								<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
									Ajouter au panier
								</button>
							</div>
						</div>
					</div>
				</div>

				<!--  -->
				<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Description
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							<?php echo $product->description(); ?>
						</p>
					</div>
				</div>

				<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Plus d'informations
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
								<?php echo $category->description(); ?>
						</p>
					</div>
				</div>

			</div>
		</div>
	</div>

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
	<script type="text/javascript" src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
	<script type="text/javascript">

	// add on the cart
	$('.btn-addcart-product-detail').each(function(){
		$(this).on('click', function(){
			var idProduct = $('.product-detail-id').html();
			var nameProduct = $('.product-detail-name').html();
			var quantityProduct = document.getElementsByClassName("product-detail-quantity")[0].value;
			var arf = new XMLHttpRequest();
			arf.open("GET","script_add_to_cart.php?id="+idProduct+"&quantity="+quantityProduct,false);
			arf.send(null);
			swal(nameProduct, "a été ajouté à votre panier !", "success");
		});
	});

	// only digit
	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
