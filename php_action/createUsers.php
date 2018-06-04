<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$usersName = $_POST['usersName'];
	$password = md5($_POST['password']);
    $usersEmail = $_POST['email'];
    //$usersRol = $_POST['usersRol'];

	$sql = "INSERT INTO users (username, password, users_status, email, rol) VALUES ('$usersName', '$password', 1, '$usersEmail', 1)";

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