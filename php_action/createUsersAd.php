<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$usersAdName = $_POST['usersAdName'];
	$password = md5($_POST['password']);
    $usersAdEmail = $_POST['email'];

    $user_id = $_SESSION['userId'];

	$sql = "INSERT INTO users (username, password, users_status, email, rol, sucursales_id, creado_por) VALUES ('$usersAdName', '$password', 1, '$usersAdEmail', 3, null, '$user_id')";

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