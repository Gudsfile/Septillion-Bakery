<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Septillion / Nous contacter</title>
	<?php include('header_link.php'); ?>
	<script src="https://api.tiles.mapbox.com/mapbox-gl-js/v0.44.0/mapbox-gl.js"></script>
	<link href="https://api.tiles.mapbox.com/mapbox-gl-js/v0.44.0/mapbox-gl.css" rel="stylesheet">
</head>
<body class="animsition">

	<!-- Header -->
	<header class="header1">
		<?php include('header_navbar.php'); ?>
	</header>

	<!-- BDD -->
	<?php
	// récupération des infos get
	if(isset($_SESSION['mail'])): $sessionMail = $_SESSION['mail']; else: $sessionMail = null; endif;
	if(isset($_GET['o'])): $objetCmd = $_GET['o']; endif;
	if(isset($_GET['e'])): $employeeCmd = $_GET['e']; endif;

	// bdd
	$conn = Connect::connexion();

	// récupération de la liste des employées
	$employeeManager = new EmployeeManager($conn);
	$employeeList = $employeeManager->getList();
	?>

	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading-pages-06.jpg);">
		<h2 class="l-text2 t-center">
			Nous contacter
		</h2>
	</section>

	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 p-b-30">
					<div class="p-r-20 p-r-0-lg">
						<div class="contact-map size21" id='map'></div>
					</div>
				</div>

				<div class="col-md-6 p-b-30">
					<form class="leave-comment"	action="script_contact.php" method="post">
						<h4 class="m-text26 p-b-36 p-t-15">
							Envoyez nous un message
						</h4>

						<div class="rs2-select2 bo4 of-hidden size15 m-b-20">
							<select class="selection-2" name="Destinataire">
								<option value="" selected disabled hidden>Destinataire</option>
								<?php foreach ($employeeList as $e) { ?>
									<option value=" <?php echo $e->id(); ?>"> <?php echo $e->first_name(); ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="objet" placeholder="Objet"
							<?php if (isset($objetCmd)):?>
								value="<?php echo $objetCmd ?>" disabled
							<?php endif?>
							>
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="mail" placeholder="Mail"
							<?php if (isset($sessionMail)):?>
								value="<?php echo $sessionMail ?>"
							<?php endif?>
							>
						</div>

						<textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="message" placeholder="Message"></textarea>

						<?php if (isset($_GET['n'])): ?>
							<div class="size15 m-b-20">
								<p class="m-b-20" style="color : #F08080"><?php echo $_GET['n']; ?></p>
							</div>
						<?php ; endif ?>

						<div class="w-size25">
							<!-- Button -->
							<button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" name="send">
								Envoyer
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
	<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
	<script src="js/map-custom.js"></script>-->
	<script>
	mapboxgl.accessToken = 'pk.eyJ1IjoidG90b2xhbWFsaWNlIiwiYSI6ImNqZnIyZ295ZjE4MDMyeXBtYjBrOXlvMGsifQ.5xS1FTpt6zqcgZRvEg1MgA';
	var map = new mapboxgl.Map({
		container: "map",
		style: "mapbox://styles/mapbox/streets-v10",
		zoom:14.0,
		center: [-2.74839,47.64467]
	});

	map.on("load", function () {
		/* Image: An image is loaded and added to the map. */
		map.loadImage("https://i.imgur.com/MK4NUzI.png", function(error, image) {
			if (error) throw error;
			map.addImage("custom-marker", image);
			/* Style layer: A style layer ties together the source and image and specifies how they are displayed on the map. */
			map.addLayer({
				id: "markers",
				type: "symbol",
				/* Source: A data source specifies the geographic coordinate where the image marker gets placed. */
				source: {
					type: "geojson",
					data: {
						type: "FeatureCollection",
						features:[{"type":"Feature","geometry":{"type":"Point","coordinates":[-2.7483885418424734,47.644671337627614]}}]}
					},
					layout: {
						"icon-image": "custom-marker",
					}
				});
			});
		});
		</script>
		<!--===============================================================================================-->
		<script src="js/main.js"></script>

	</body>
	</html>
