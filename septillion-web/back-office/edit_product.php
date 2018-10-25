<?php function console_log( $data ){ echo '<script>'; echo 'console.log('. json_encode( $data ) .')'; echo '</script>'; }?> 

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Administration / Editer un produit</title>
	<?php include('header_link_admin.php'); ?>
	<?php require('edit_product_script.php'); ?>
	

</head>
<body class="animsition">

	<!-- Header -->
	<header class="header1">
		<?php include('header_navbar_admin.php'); ?>
	</header>

	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading-pages-06.jpg);">
		<h2 class="l-text2 t-center">
			Les produits
		</h2>
	</section>

	<!-- content page -->
	<section class="bg-dark p-t-66 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-12 p-b-30">
					<form class="leave-comment" action="category_script.php" method="get">
						<h4 class="m-text26 p-b-36 p-t-15">
							Produit
						</h4>


						<table class="table table-hover table-dark">
							<thead>
								<tr>
									<th scope="col">_id_product</th>
									<th scope="col">_name</th>
									<th scope="col">_stock</th>
									<th scope="col">_description</th>
									<th scope="col">_price</th>
									<th scope="col">_image</th>
									<th scope="col">_created_by</th>
									<th scope="col">_last_updated_by</th>
									<th scope="col">_id_category</th>
								</tr>
							</thead>
							<thead>
								<tr>
									<?php foreach ($categoryList as $row) { ?>

									<td><?php echo strval($row->id()); ?></td>
									<td><?php echo strval($row->name()); ?></td>
									<td><?php echo strval($row->stock()); ?></td>
									<td><?php echo strval($row->description()); ?></td>
									<td><?php echo strval($row->price()."€"); ?></td>
									<td><?php echo strval($row->image()); ?></td>
									<td><?php echo strval($row->created_by()); ?></td>
									<td><?php echo strval($row->last_updated_by()); ?></td>
									<td><?php echo strval($row->id_category()); ?></td>

									<?php console_log($row->name()); ?>

								</tr>
							</thead>
							<?php }?>
						
						</table>


						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Nom de la catégorie">
						</div>

						<textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="Description" placeholder="Description"></textarea>
						
						<div class="w-size25">
							<!-- Button -->
							<button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" name="connexion">
								Editer un produit
							</button>
						</div>
					</form>
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
	<script src="js/main.js"></script>

</body>
</html>
