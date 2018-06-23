<?php 
require_once 'config/db_connect.php';

session_start();

if(isset($_SESSION['userId'])) {
	switch ($_SESSION['rol']) {
		case '1':
			header('location: dashboard.php');
			break;
		case '2':
			header('location: dashboard.php');
			break;
		case '3':
			header('location: stock.php');
			break;
		case '4':
			header('location: orders.php?o=manord');
			break;

		default:
			# code...
			break;
	}
}

$errors = array();

if($_POST) {		

	$username = $connect->real_escape_string($_POST['username']); // Escapando caracteres especiales

	//convertir en minuscula
	$username = strtolower($username);

	$password = $_POST['password'];

	if(empty($username) || empty($password)) {
		if($username == "") {
			$errors[] = "Se requiere nombre de usuario";
		} 

		if($password == "") {
			$errors[] = "Se requiere contraseña";
		}
	} else {
		$sql = "SELECT * FROM users WHERE username = '$username'";
		$result = $connect->query($sql);

		if($result->num_rows == 1) {
			$password = md5($password);
			// exists 
			$mainSql = "SELECT s.user_id as user_id, s.rol as rol, s.sucursales_id as sucursales_id, su.sucursales_status as sucursales_status FROM users s LEFT JOIN sucursales su ON s.sucursales_id = su.sucursales_id WHERE username = '$username' AND password = '$password'";
			$mainResult = $connect->query($mainSql);

			if($mainResult->num_rows == 1) {
				$value = $mainResult->fetch_assoc();
				if ($value['rol'] == 2) {
					if ($value['sucursales_status'] != 1) {
						$login = false;
					}else{
						$login = true;
					}
				}else{
					$login = true;
				}

				if ($login == true) {
					$user_id = $value['user_id'];
	                $rol     = $value['rol'];
	                $sucursal= $value['sucursales_id'];
	              
	                // set session
	                $_SESSION['userId'] = $user_id;
	                $_SESSION['rol']    = $rol;
	                $_SESSION['sucursales_id'] = $sucursal;
	                if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 4) {
						header('location: dashboard.php');
	                }elseif ($_SESSION['rol'] == 3) {
	                	header('location: stock.php');
	                }
				}else{
					$errors[] = "La sucursal que administra ha sido eliminada";
				}

			} else{
				
				$errors[] = "Combinación incorrecta de nombre de usuario y/o contraseña";
			} // /else
		} else {		
			$errors[] = "El nombre de usuario no existe";		
		} // /else
	} // /else not empty username // password
	
} // /if $_POST
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Sistema de Gestión de Inventario</title>

	<!-- bootstrap -->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- bootstrap theme-->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="custom/css/custom.css">	

  <!-- jquery -->
	<script src="assests/jquery/jquery.min.js"></script>
  <!-- jquery ui -->  
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>

  <!-- bootstrap js -->
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row vertical">
			<div class="col-md-5 col-md-offset-4">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Inicio de sesión</h3>
					</div>
					<div class="panel-body">

						<div class="messages">
							<?php if($errors) {
								foreach ($errors as $key => $value) {
									echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									'.$value.'</div>';										
									}
								} ?>
						</div>

						<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm">
							<fieldset>
							  <div class="form-group">
									<label for="username" class="col-sm-3 control-label">Usuario</label>
									<div class="col-sm-9">
									  <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario" autocomplete="off" required />
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-sm-3 control-label">Contraseña</label>
									<div class="col-sm-9">
									  <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" autocomplete="off" required />
									</div>
								</div>								
								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-9">
									  <button type="submit" class="btn btn-default"> <i class="glyphicon glyphicon-log-in"></i> Ingresar</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
					<!-- panel-body -->
				</div>
				<!-- /panel -->
			</div>
			<!-- /col-md-4 -->
		</div>
		<!-- /row -->
	</div>
	<!-- container -->	
</body>
</html>







	