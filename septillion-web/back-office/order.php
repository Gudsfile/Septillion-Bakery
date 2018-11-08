<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Septillion Bakery - Dashboard</title>
	<?php
	require('connexion.php');
	$conn = Connect::connexion();
  $productManager = new ProductManager($conn);
  $clientManager = new ClientManager($conn);
  $employeeManager = new EmployeeManager($conn);
  $oderManager = new OrderManager($conn);
	$isOrderedManager = new IsOrderedManager($conn);
  $order = $oderManager->get($_GET['id']);
	$client = $clientManager->get($order->client());
	?>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">

	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
					<a class="navbar-brand" href="#"><span>Septillion Bakery</span>Admin</a>
				</div>
			</div><!-- /.container-fluid -->
		</nav>
		<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
			<div class="profile-sidebar">
				<div class="profile-usertitle">
					<div class="profile-usertitle-name"><?php echo $_SESSION['name']?></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="divider"></div>
			<ul class="nav menu">
				<li><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Tableau de bord</a></li>
				<li><a href="list_order.php"><em class="fa fa-calendar">&nbsp;</em> Commandes</a></li>
				<li><a href="mails.php"><em class="fa fa-envelope-o">&nbsp;</em> Messages</a></li>
				<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
					<em class="fa fa-tags">&nbsp;</em> Produits <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="list_product.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Consulter
					</a></li>
					<li><a class="" href="add_product.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Ajouter
					</a></li>
				</ul>
			</li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-bookmark">&nbsp;</em> Catégories <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
			</a>
			<ul class="children collapse" id="sub-item-2">
				<li><a class="" href="list_category.php">
					<span class="fa fa-arrow-right">&nbsp;</span> Consulter
				</a></li>
				<li><a class="" href="add_category.php">
					<span class="fa fa-arrow-right">&nbsp;</span> Ajouter
				</a></li>
			</ul>
		</li>
		<li class="parent "><a data-toggle="collapse" href="#sub-item-3">
			<em class="fa fa-user">&nbsp;</em> Employé <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><em class="fa fa-plus"></em></span>
		</a>
		<ul class="children collapse" id="sub-item-3">
			<li><a class="" href="list_employee.php">
				<span class="fa fa-arrow-right">&nbsp;</span> Consulter
			</a></li>
			<li><a class="" href="add_employee.php">
				<span class="fa fa-arrow-right">&nbsp;</span> Ajouter
			</a></li>
		</ul>
	</li>
	<li><a href="script_logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
</ul>
</div>
<!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="index.php"><em class="fa fa-home"></em></a></li>
      <li><a href="list_order.php">Liste commandes</a></li>
      <li class="active">Commande N° <?php echo $order->id() ?></li>
		</ol>
	</div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Commande N° <?php echo $order->id()." - ".date("l j F H:i", strtotime($order->order_date()))?></h2>
			<h3>Client : <?php echo $client->first_name()." ".$client->last_name() ?></h3>
			<p>Adresse : <?php echo $client->address() ?></p>
			<p>E-Mail : <?php echo $client->mail() ?></p>
			<p>Téléphone : <?php echo $client->phone_number() ?></p>
    </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-body tabs">
          <ul class="nav nav-tabs">
						<li class="active"><a href="<?php echo "order.php?id=".$order->id()."#tab1"; ?>" data-toggle="tab">Articles</a></li>
						<li><a href="<?php echo "order.php?id=".$order->id()."#tab2"; ?>" data-toggle="tab">Options</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade in active" id="tab1">
							<table class="table table-hover" id="orderTable">
								<tr>
									<th>N° Article</th>
									<th>Nom</th>
									<th>Quantité</th>
									<th>Prix unitaire</th>
									<th>Prix total</th>
								</tr>
								<?php
								$isOrderedList = $isOrderedManager->getByOrder($order->id());
								$totalPrice = 0;
								foreach ($isOrderedList as $value) {
										$product = $productManager->get($value->id_product());
										echo "<tr>";
										echo "<td>".$product->id()."</td>";
										echo "<td>".$product->name()."</td>";
										echo "<td>".$value->quantity()."</td>";
										echo "<td>".$product->price()."</td>";
										echo "<td>".$value->quantity()*$product->price()."</td>";
										echo "</tr>";
										$totalPrice += $value->quantity()*$product->price();
									}
								?>
							</table>
							<h3>Prix total : <?php echo $totalPrice ?> </>
            </div>
            <div class="tab-pane fade" id="tab2">
							<label class="checkbox-inline">
								<input type="checkbox" id="validatedCheckBox" value="validatedOption" <?php if ($order->validared() == 1){ echo 'checked=""';} ?>>Validée
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" id="readyCheckBox" value="readyOption" <?php if ($order->ready() == 1){ echo 'checked=""';} ?>>Validée
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" id="collectedCheckBox" value="collectedOption" <?php if ($order->collected() == 1){ echo 'checked=""';} ?>>Validée
							</label>
							<br>
							<h3>Employé : </h3>
							<?php
							$res = $employeeManager->getList();
							?>
							<select class="col-lg-4 form-control" name="category">
								<?php
								foreach($res as $employee) {
									if ($order->employee() == $employee->id()) {
										echo '<option value="'.$employee->id().'" selected="selected">'.$employee->first_name().' '.$employee->last_name().'</option>';
									} else {
										echo '<option value="'.$employee->id().'">'.$employee->first_name().' '.$employee->last_name().'</option>';
									}
								}
								?>
							</select>
							<br>
							<br>
							<br>
							<button class="btn btn-default" onclick="location.href='script_update_order.php?id=<?php echo($order->id())  ?>'"><span class="fa fa-check"></span> &nbsp;Valider les modifications</button>
							<button class="btn btn-default margin pull-right" onclick="location.href='script_delete_order.php?id=<?php echo($order->id())  ?>'"><span class="fa fa-trash"></span> &nbsp;Delete</button>
						</div>
          </div>
        </div>
      </div><!--/.panel-->
    </div><!--/.col-->

</div>	<!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/chart.min.js"></script>
<script src="js/chart-data.js"></script>
<script src="js/easypiechart.js"></script>
<script src="js/easypiechart-data.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
