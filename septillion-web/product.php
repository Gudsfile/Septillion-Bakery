<!DOCTYPE html>
<html lang="fr">

<head>
	<title>Septillion / Nos produits</title>
	<?php include('header_link.php'); ?>
	<?php require('BDD/CategoryManager.php'); ?>
	<?php require('BDD/Category.php'); ?>
</head>

<body class="animsition">

	<!-- BDD AND GET -->
	<?php
	// get data GET
	if(isset($_GET['category'])): $getCategory = $_GET['category']; else: $getCategory = null; endif;
	if(isset($_GET['order'])): $getOrder = $_GET['order']; else: $getOrder = null; endif;

	// bdd
	$conn = Connect::connexion();

	// get category list
	$categoryManager = new CategoryManager($conn);
	$categoryList = $categoryManager->getList();

	// get poducts list
	$productManager = new ProductManager($conn);
	// organize products list
	if ($getOrder != null && $getCategory != null) {
		$method = 'getCategoryOrderBy'.ucfirst($getOrder);
		$productList = $productManager->$method($getCategory);
	} else if ($getCategory != null) {
		$productList = $productManager->getCategory($getCategory);
	} else if ($getOrder != null) {
		$method = 'getListBy'.ucfirst($getOrder);
		$productList = $productManager->$method();
	} else {
		$productList = $productManager->getList();
	}
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

						<!-- Liste des catégories -->
						<h4 class="m-text14 p-b-7">
							Categories
						</h4>

						<ul class="p-b-54">
							<li class="p-t-4">
								<a href="product.php<?php if ($getOrder != null): echo '?order='.$getOrder; endif;?>" class="s-text13 <?php if ($getCategory == null): ?>active1<?php ; endif; ?>">
									Tous les produits
								</a>
							</li>

							<?php foreach ($categoryList as $e) { ?>
								<li class="p-t-4">
									<a href="product.php?category=<?php echo $e->id(); if ($getOrder != null): echo '&order='.$getOrder; endif;?>" class="s-text13 <?php if ($getCategory==$e->id()):?>active1<?php ; endif; ?>">
										<?php echo $e->name();?>
									</a>
								</li>
							<?php } ?>
						</ul>

						<!-- Zone de recherche -->
						<div class="search-product pos-relative bo4 of-hidden">
							<input class="s-text7 size6 p-l-23 p-r-50 search-box" id="search-text" type="text" name="search-product" placeholder="Recherche de produits...">
							<button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
								<i class="fs-12 fa fa-search" aria-hidden="true"></i>
							</button>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">

					<div class="flex-sb-m flex-w p-b-35">

						<!-- Choix du tri-->
						<div class="flex-w">
							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-1" name="sorting" onchange="location = this.value;">
									<option value="product.php?<?php if ($getCategory != null): echo 'category='.$getCategory; endif;?>">Tri par défaut</option>
									<option value="product.php?<?php if ($getCategory != null): echo 'category='.$getCategory.'&'; endif;?>order=name" <?php if ($getOrder == 'name'):?>selected="selected"<?php ; endif;?>>Tri par nom</option>
									<option value="product.php?<?php if ($getCategory != null): echo 'category='.$getCategory.'&'; endif;?>order=price" <?php if ($getOrder == 'price'):?>selected="selected"<?php ; endif;?>>Tri par prix</option>
								</select>
							</div>
						</div>

						<!-- Nombre de résultats -->
						<span class="s-text8 p-t-5 p-b-5 list-count"></span>
					</div>

					<!-- Liste des produits -->
					<div class="row" id="list">
						<?php foreach ($productList as $e) { ?>
							<ressearch class="col-sm-12 col-md-6 col-lg-4 p-b-50 in">
								<!-- Block2 -->
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative <?php if ($e->stock() < 1): ?> block2-labelsale <?php ; elseif ($e->stock() < 6): ?> block2-labellast <?php ; else: ?> block2-labelstock <?php ; endif ;?> ">
										<img src="images/products/<?php echo $e->image(); ?>" alt="IMG-PRODUCT">
										<div class="block2-overlay trans-0-4">
											<div class="block2-btn-addcart w-size1 trans-0-4 btn-addcart-product-detail">
												<!-- Button -->
												<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Ajouter au panier</button>
											</div>
										</div>
									</div>
									<div class="block2-txt p-t-20 product-detail">
										<p hidden class="product-detail-id"><?php echo $e->id(); ?></p>
										<a href="product-detail.php?product=<?php echo $e->id();?>" class="block2-name dis-block s-text3 p-b-5 product-detail-name">
											<?php echo $e->name(); ?>
										</a>
										<span class="block2-price m-text6 p-r-5">
											<?php echo $e->price(); ?>
										</span>
									</div>
								</div>
							</ressearch>
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
	// Ordre de trie
	$(".selection-1").select2({
		minimumResultsForSearch: 20,
		dropdownParent: $('#dropDownSelect1')
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

	// on load (research)
	$(document).ready(function() {
		var jobCount = $('#list .in').length;
		$('.list-count').text(jobCount + ' produit(s) trouvé(s)');
		$("#search-text").keyup(function () {
			var searchTerm = $("#search-text").val();
			var listItem = $('#list').children('ressearch');
			var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
			$.extend($.expr[':'], {
				'containsi': function(elem, i, match, array)
				{
					return (elem.textContent || elem.innerText || '').toLowerCase()
					.indexOf((match[3] || "").toLowerCase()) >= 0;
				}
			});
			$("#list ressearch").not(":containsi('" + searchSplit + "')").each(function(e)   {
				$(this).addClass('hiding out').removeClass('in');
				setTimeout(function() {
					$('.out').addClass('hidden');
				}, 300);
			});
			$("#list ressearch:containsi('" + searchSplit + "')").each(function(e) {
				$(this).removeClass('hidden out').addClass('in');
				setTimeout(function() {
					$('.in').removeClass('hiding');
				}, 1);
			});
			var jobCount = $('#list .in').length;
			$('.list-count').text(jobCount + ' produit(s) trouvé(s)');
			if(jobCount == '0') {
				$('#list').addClass('empty');
			}
			else {
				$('#list').removeClass('empty');
			}
		});
	});

	// add on the cart
	$('.btn-addcart-product-detail').each(function(){
		var arf = new XMLHttpRequest();
		var quantityProduct = "1";
		var rowProduct = $(this).parent().parent().parent();
		var idProduct = rowProduct.children('.product-detail').children('.product-detail-id').text();
		var nameProduct = rowProduct.children('.product-detail').children('.product-detail-name').text();
		$(this).on('click', function(){
			arf.open("GET","script_add_to_cart.php?id="+idProduct+"&quantity="+quantityProduct,false);
			arf.send(null);
			swal(nameProduct, "a été ajouté à votre panier !", "success");
		});
	});
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
