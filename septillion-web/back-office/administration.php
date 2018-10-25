<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Septillion / Administration</title>
	<?php
	include('header_link_admin.php');
	require('BDD/Message.php');
	require('BDD/MessageManager.php');
	require('BDD/Order.php');
	require('BDD/OrderManager.php');
	require('BDD/Employee.php');
	require('BDD/EmployeeManager.php');
	require('BDD/Client.php');
	require('BDD/ClientManager.php');
	$conn = new PDO("mysql:host=localhost;dbname=Septillion", "root");
	?>
</head>
<body class="animsition">

	<!-- Header -->
	<header class="header1">
		<?php include('header_navbar_admin.php'); ?>
	</header>

	<section class="bg-light p-t-66 p-b-60">
		<div class="container">
			<div class="column">
				<div class="col-md-12 p-b-30">
					<h4 class="m-text26 p-b-36 p-t-15">
						Messages
					</h4>
					<?php
					$messageManager = new MessageManager($conn);
					$employeeManager = new EmployeeManager($conn);
					$messageList = $messageManager->getByReceiver(1001);	//REPLACE BY SESSION ID
					?>
					<table class="table table-hover table-light" align="center" id="tableID">
						<?php
						foreach ($messageList as $value) {
							echo "<tr>";
							echo "<td>".$employeeManager->get($value->id_sender())->first_name()." ".$employeeManager->get($value->id_sender())->last_name()."</td>";
							echo "<td>".$value->message_object()."</td>";
							echo "<td>".$value->sent_date()."</td>";
							echo "</tr>";
						}
						?>
					</table>
				</div>
				<div class="col-md-12 p-b-30">
					<h2 class="m-text26 p-b-36 p-t-15">
						Commandes
					</h2>
				</div>
				<div class="col-md-12 p-b-30">
					<h4 class="m-text26 p-b-36 p-t-15">
						Commandes
					</h4>
					<?php
						$orderManager = new OrderManager($conn);
						$clientManager = new ClientManager($conn);
						$orderList = $orderManager->getByEmployee(1001);	//REPLACE BY SESSION ID
					?>
					<table class="table table-hover table-light">
						<tr>
							<th>N°</th>
							<th>Date</th>
							<th>Description</th>
							<th>Validée</th>
							<th>Prête</th>
							<th>Collectée</th>
							<th>Client</th>
						</tr>
						<?php
						foreach ($orderList as $value) {
							echo "<tr>";
							echo "<td>".$value->id()."</td>";
							echo "<td>".$value->order_date()."</td>";
							echo "<td>".$value->description()."</td>";
							echo "<td>".$value->validated()."</td>";
							echo "<td>".$value->ready()."</td>";
							echo "<td>".$value->collected()."</td>";
							echo "<td>".$clientManager->get($value->client())->first_name." ".$clientManager->get($value->client())->last_name."</td>";
							echo "</tr>";
						}
						?>
					</table>
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

	<!-- Container Selection1 -->
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
	$(".selection-1").select2({
		minimumResultsForSearch: 20,
		dropdownParent: $('#dropDownSelect1')
	});
	</script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/slick-custom.js"></script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/lightbox2/js/lightbox.min.js"></script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
	<script type="text/javascript">
	$('.block2-btn-addcart').each(function(){
		var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
		$(this).on('click', function(){
			swal(nameProduct, "is added to cart !", "success");
		});
	});

	$('.block2-btn-addwishlist').each(function(){
		var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
		$(this).on('click', function(){
			swal(nameProduct, "is added to wishlist !", "success");
		});
	});
	</script>

	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
