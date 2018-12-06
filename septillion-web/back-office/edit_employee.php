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
  $erreur = 100;
  if (isset($_GET['erreur']))
      $erreur = $_GET['erreur'];
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
				<li class="parent"><a data-toggle="collapse" href="#sub-item-1">
					<em class="fa fa-tags">&nbsp;</em> Produits <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="list_product.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Consulter
					</a></li>
					<li ><a class="" href="add_product.php">
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
</div>
<!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="#">
        <em class="fa fa-home"></em>
      </a></li>
      <li class="active">Editer un employé</li>
    </ol>
  </div><!--/.row-->
  <?php
    $id= $_GET['id'];
    $employeeManager = new EmployeeManager($conn);
    $employee =$employeeManager->get($id);
  ?>
  <div class="row">
    <div class="panel-body">
      <form class="form-horizontal row-border" enctype="multipart/form-data" action="script_edit_employee.php?id=<?php echo $employee->id(); ?>" method="post">
        <div class="form-group">
          <label class="col-md-2 control-label">Prénom</label>
          <div class="col-md-10">
            <input type="text" name="first_name" class="form-control" value="<?php echo $employee->first_name(); ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label">Nom</label>
          <div class="col-md-10">
            <input type="text" name="last_name" class="form-control" value="<?php echo $employee->last_name(); ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label">E-Mail</label>
          <div class="col-md-10">
            <input type="text" name="mail" class="form-control" value="<?php echo $employee->mail(); ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label">Confirmer E-Mail</label>
          <div class="col-md-10">
            <input type="text" name="verif_mail" class="form-control" value="<?php echo $employee->mail(); ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label">Mot de passe</label>
          <div class="col-md-10">
            <input type="password" name="password" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label">Confirmer Mot de passe</label>
          <div class="col-md-10">
            <input type="password" name="verif_password" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label">Role</label>
          <div class="col-md-10">
            <input type="text" name="role" class="form-control" value="<?php echo $employee->role(); ?>" required>
          </div>
        </div>
        <button class="col-xs-12 btn btn-lg btn-primary" type="submit"><span class="fa fa-plus"></span> &nbsp;Editer</button>
      </form>
      <br>
      <br>
      <br>

      <?php if ($erreur == '1'): ?><div class="alert bg-warning" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Erreur : Mail existant </div><?php ; endif ?>
      <?php if ($erreur == '2'): ?><div class="alert bg-warning" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Prenom vide </div><?php ; endif ?>
      <?php if ($erreur == '3'): ?><div class="alert bg-warning" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Nom vide </div><?php ; endif ?>
      <?php if ($erreur == '4'): ?><div class="alert bg-warning" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Adresse E-Mail vide </div><?php ; endif ?>
      <?php if ($erreur == '5'): ?><div class="alert bg-warning" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Mot de passe vide </div><?php ; endif ?>
      <?php if ($erreur == '6'): ?><div class="alert bg-warning" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Erreur : Les mails ne correspondent pas </div><?php ; endif ?>
      <?php if ($erreur == '7'): ?><div class="alert bg-warning" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Erreur : Les mots de passe ne correspondent pas </div><?php ; endif ?>
      <?php if ($erreur == '8'): ?><div class="alert bg-warning" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Erreur BDD </div><?php ; endif ?>
      <?php if ($erreur == '9'): ?><div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Employé ajouté !</div><?php ; endif ?>
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
