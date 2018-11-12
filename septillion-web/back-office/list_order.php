<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Septillion Bakery - Dashboard</title>
	<?php
	require('connexion.php');
	$conn = Connect::connexion();
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
					<li class="active"><a href="list_order.php"><em class="fa fa-calendar">&nbsp;</em> Commandes</a></li>
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
		<?php 	//gestion du compte Admin
		$employeeManager = new EmployeeManager($conn);
		$employee = $employeeManager->get($_SESSION['id_admin']);
		if ($employee->role() == "admin") {?>
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
		<?php } ?>

					<li><a href="script_logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
			</ul>
</div>
<!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="index.php">
				<em class="fa fa-home"></em>
			</a></li>
			<li class="active">Commandes</li>
		</ol>
	</div><!--/.row-->

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          Commandes en cours
          <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
          <div class="panel-body">
            <div class="canvas-wrapper">
              <div class="panel panel-default">
                <div class="panel-body btn-margins">
                  <div class="col-md-12">
                    <?php
                    $orderManager = new OrderManager($conn);
                    $orderList = $orderManager->getNonCollectedOrdersByEmployee($_SESSION['id_admin']);	//REPLACE BY SESSION ID
                    $clientManager = new ClientManager($conn);
                    ?>
                    <table class="table" id="orderTable">
                      <tr>
                        <th>N°</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Validée</th>
                        <th>Prête</th>
												<th>Client</th>
                      </tr>
                      <?php
                      foreach ($orderList as $value) {
                        $client = $clientManager->get($value->client());
												$validated = ($value->validated() == 0)	? "non" : "oui";
												$ready = ($value->ready() == 0)	? "non" : "oui";
												if ($value->validated() == 0) $rowCollour = '<tr class="bg-danger">';
												if ($value->validated() == 1) $rowCollour = '<tr class="bg-warning">';
												if ($value->ready() == 1) $rowCollour = '<tr class="bg-info">';

												echo $rowCollour;
												echo "<td>".$value->id()."</td>";
                        echo "<td>".$value->order_date()."</td>";
                        echo "<td>".$value->description()."</td>";
                        echo "<td>".$validated."</td>";
                        echo "<td>".$ready."</td>";
                        echo "<td>".$client->first_name()." ".$client->last_name()."</td>";
                        echo "</tr>";
                      }
                      ?>
											<script>
                      function addRowHandlers() {
                        var table = document.getElementById("orderTable");
                        var rows = table.getElementsByTagName("tr");
												for (i = 0; i < rows.length; i++) {
													var currentRow = table.rows[i];
													var createClickHandler =
                          function(row)
                          {
														return function() {
															var cell = row.getElementsByTagName("td")[0];
                              var id = cell.innerHTML;
															window.open("order.php?id="+id,"_self");
                            };
                          };
                          currentRow.onclick = createClickHandler(currentRow);
                        }
                      }
                      window.onload = addRowHandlers();
                      </script>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!--/.row-->

		<div class="row">
	    <div class="col-md-12">
	      <div class="panel panel-default">
	        <div class="panel-heading">
	          Commandes terminées
	          <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
	          <div class="panel-body">
	            <div class="canvas-wrapper">
	              <div class="panel panel-default">
	                <div class="panel-body btn-margins">
	                  <div class="col-md-12">
	                    <?php
	                    $orderManager = new OrderManager($conn);
	                    $orderList = $orderManager->getCollectedOrdersByEmployee($_SESSION['id_admin']);	//REPLACE BY SESSION ID
	                    $clientManager = new ClientManager($conn);
	                    ?>
	                    <table class="table" id="allOrderTable">
	                      <tr>
	                        <th>N°</th>
	                        <th>Date</th>
	                        <th>Description</th>
													<th>Client</th>
	                      </tr>
	                      <?php
	                      foreach ($orderList as $value) {
	                        $client = $clientManager->get($value->client());
													if ($value->validated() == 0) $rowCollour = '<tr class="bg-danger">';
													if ($value->validated() == 1) $rowCollour = '<tr class="bg-warning">';
													if ($value->ready() == 1) $rowCollour = '<tr class="bg-info">';
													if ($value->collected() == 1) $rowCollour = '<tr class="bg-success">';
													echo $rowCollour;
													echo "<td>".$value->id()."</td>";
	                        echo "<td>".$value->order_date()."</td>";
	                        echo "<td>".$value->description()."</td>";
	                        echo "<td>".$client->first_name()." ".$client->last_name()."</td>";
	                        echo "</tr>";
	                      }
	                      ?>
												<script>
	                      function addRowHandlers() {
	                        var table = document.getElementById("allOrderTable");
	                        var rows = table.getElementsByTagName("tr");
													for (i = 0; i < rows.length; i++) {
														var currentRow = table.rows[i];
														var createClickHandler =
	                          function(row) {
															return function() {
																var cell = row.getElementsByTagName("td")[0];
	                              var id = cell.innerHTML;
																window.open("order.php?id="+id,"_self");
	                            };
	                          };
	                          currentRow.onclick = createClickHandler(currentRow);
	                        }
	                      }
	                      window.onload = addRowHandlers();
	                      </script>
	                    </table>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div><!--/.row-->

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
