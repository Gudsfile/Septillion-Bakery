<!DOCTYPE html>
<html>
<head>

	<?php
    // verification s'il y a des erreur !
    $erreur = 100;
    if (isset($_GET['erreur']))
        $erreur = $_GET['erreur'];
    session_start();
    if(!isset($_SESSION['data']))
        $_SESSION['data']=null;
    ?>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Septillion Bakery - Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Connexion</div>
				<div class="panel-body">
					<form role="form" action="script_login_admin.php" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="mail" type="mail" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
							<button type="submit" class="col-xs-12 btn btn-primary">Login</button>
					</form>
					<?php if ($erreur == '0'): ?><p class="m-b-20" style="color : #F08080"> Erreur </p><?php ; endif ?>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->
<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
