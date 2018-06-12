<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$usersName = $_POST['usersName'];
	$password = md5($_POST['password']);
    $usersEmail = $_POST['email'];
    $usersRol = $_POST['rol'];
	$sucursal =  $_POST['sucursal'];;
    if ($usersRol != 2) {
    	$sucursal = null;
    }
    $user_id = $_SESSION['userId'];

	$sql = "INSERT INTO users (username, password, users_status, email, rol, sucursales_id, creado_por) VALUES ('$usersName', '$password', 1, '$usersEmail', '$usersRol', '$sucursal', '$user_id')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Creado exitosamente";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido guardar";
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST