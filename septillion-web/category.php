<!DOCTYPE html>
<html lang="en">
<head>
	<title>Administration / Categorie</title>
	<?php include('header_link_admin.php'); ?>
	<?php require('category_script.php') ?>
</head>
<body class="animsition">

	<!-- Header -->
	<header class="header1">
		<?php include('header_navbar_admin.php'); ?>
	</header>

	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading-pages-06.jpg);">
		<h2 class="l-text2 t-center">
			Les catégories
		</h2>
	</section>

	<!-- content page -->
	<section class="bg-dark p-t-66 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-12 p-b-30">
					<form class="leave-comment" action="category_script.php" method="get">
						<h4 class="m-text26 p-b-36 p-t-15">
							<title-admin> Catégorie </title-admin>
						</h4>


						<table class="table table-hover table-dark">
							<thead>
								<tr>
									<th scope="col">ID_Category</th>
									<th scope="col">Name_Category</th>
									<th scope="col">Description</th>
									<th scope="col">Icon_Category</th>
									<th scope="col">Created_By_IDEmp</th>
								</tr>
							</thead>
							<thead>
								<tr>
									<?php foreach ($categoryList as $row) { ?>

									<td><?php var_dump($row->id()); ?></td>
									<td><?php var_dump($row->nameCategory()); ?></td>
									<td><?php var_dump($row->description()); ?></td>
									<td><?php var_dump($row->iconCategory()); ?></td>
									<td><?php var_dump($row->createdByIdEmp()); ?></td>

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
								Creer une catégorie
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
