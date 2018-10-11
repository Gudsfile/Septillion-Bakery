<?php function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Septillion / Nos produits</title>
	<?php include('header_link.php'); ?>
	<?php require('BDD/ProductManager.php'); ?>
	<?php require('BDD/Product.php'); ?>
	<?php require('BDD/CategoryManager.php'); ?>
	<?php require('BDD/Category.php'); ?>
	<?php require('connexion.php')?>
</head>
<body class="animsition">

	<!-- BDD -->
	<?php
		// récupération des infos get
		if(isset($_GET['category'])): $getCategory = $_GET['category']; else: $getCategory = null; endif;
		if(isset($_GET['order'])): $getOrder = $_GET['order']; else: $getOrder = null; endif;

		// bdd
		$conn = Connect::connexion();

		// récupération de la liste des porduits
		$productManager = new ProductManager($conn);
		$productList = $productManager->getList();

		// réduction de la liste des produits
		if ($getCategory != null) {
			$tmp = array();
			foreach ($productList as $e) {
				if ($e->id_category() == $getCategory): $tmp[] = $e; endif;
			}
			$productList = $tmp;
		}

		// récupération de la liste des catégories
		$categoryManager = new CategoryManager($conn);
		$categoryList = $categoryManager->getList();

	?>

	<!-- Header -->
	<header class="header1">
		<?php include('header_navbar.php'); ?>
	</header>

	<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/heading-pages-02.jpg);">
		<h2 class="l-text2 t-center">
			Hey hey hey
		</h2>
		<p class="m-text13 t-center">
			New Arrivals of Yann Collection
		</p>
	</section>


	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
					<div class="leftbar p-r-20 p-r-0-sm">
						<!--  -->
						<h4 class="m-text14 p-b-7">
							Categories
						</h4>

						<ul class="p-b-54">
							<li class="p-t-4">
								<a href="product.php" class="s-text13 <?php if ($getCategory == null): ?>active1<?php ; endif; ?>">
									Tous les produits
								</a>
							</li>

								<?php foreach ($categoryList as $e) { ?>
									<li class="p-t-4">
									<a href="product.php?category=<?php echo $e->id(); ?>" class="s-text13 <?php if ($getCategory==$e->id()):?>active1<?php ; endif; ?>">
										<?php echo $e->nameCategory();?>
									</a>
								</li>
									<?php
								}
								?>
						</ul>

						<div class="search-product pos-relative bo4 of-hidden">
							<input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search-product" placeholder="Recherche de produits...">

							<button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
								<i class="fs-12 fa fa-search" aria-hidden="true"></i>
							</button>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<!--  -->
					<div class="flex-sb-m flex-w p-b-35">
						<div class="flex-w">
							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-2" name="sorting" onchange="location = this.value;">
									<option value="product.php?<?php if ($getCategory != null): echo 'category='.$getCategory; endif;?>">Tri par défaut</option>
									<option value="product.php?<?php if ($getCategory != null): echo 'category='.$getCategory.'&'; endif;?>order=category" <?php if ($getOrder == 'category'):?>selected="selected"<?php ; endif;?>>Tri par catégorie</option>
									<option value="product.php?<?php if ($getCategory != null): echo 'category='.$getCategory.'&'; endif;?>order=name" <?php if ($getOrder == 'name'):?>selected="selected"<?php ; endif;?>>Tri par nom</option>
									<option value="product.php?<?php if ($getCategory != null): echo 'category='.$getCategory.'&'; endif;?>order=price" <?php if ($getOrder == 'price'):?>selected="selected"<?php ; endif;?>>Tri par prix</option>
								</select>
							</div>
						</div>

						<span class="s-text8 p-t-5 p-b-5">
							<?php echo sizeof($productList);?> produit(s) trouvé(s)
						</span>
					</div>

					<!-- Product -->
					<div class="row">

						<?php foreach ($productList as $e) { ?>
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative <?php if ($e->stock_quantity() < 1): ?> block2-labelsale <?php ; elseif ($e->stock_quantity() < 6): ?> block2-labellast <?php ; else: ?> block2-labelstock <?php ; endif ;?> ">
									<img src="images/produits/<?php echo $e->image(); ?>" alt="IMG-PRODUCT">
									<div class="block2-overlay trans-0-4">
										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button -->
											<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Ajouter au panier
											</button>
										</div>
									</div>
								</div>
								<div class="block2-txt p-t-20">
									<a href="product-detail.php/?product=<?php echo $e->name_product();?>" class="block2-name dis-block s-text3 p-b-5">
										<?php echo $e->name_product(); ?>
									</a>
									<span class="block2-price m-text6 p-r-5">
										<?php echo $e->price(); ?>
									</span>
								</div>
							</div>
						</div>
						<?php } ?>

					</div>
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
	<script type="text/javascript" src="vendor/daterangepicker/moment.min.js"></script>
	<script type="text/javascript" src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
	<script type="text/javascript">
		$('.block2-btn-addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').php();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});

		$('.block2-btn-addwishlist').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').php();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");
			});
		});
	</script>

<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/noui/nouislider.min.js"></script>
	<script type="text/javascript">
		/*[ No ui ]
	    ===========================================================*/
	    var filterBar = document.getElementById('filter-bar');

	    noUiSlider.create(filterBar, {
	        start: [ 50, 200 ],
	        connect: true,
	        range: {
	            'min': 50,
	            'max': 200
	        }
	    });

	    var skipValues = [
	    document.getElementById('value-lower'),
	    document.getElementById('value-upper')
	    ];

	    filterBar.noUiSlider.on('update', function( values, handle ) {
	        skipValues[handle].innerHTML = Math.round(values[handle]) ;
	    });
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
