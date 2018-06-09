<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$usersAdName = $_POST['editUsersAdName'];
    $usersAdEmail = $_POST['editEmail'];
    $usersAdId = $_POST['usersAdId'];

	$sql = "UPDATE users SET username = '$usersAdName', email = '$usersAdEmail' WHERE user_id = '$usersAdId'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Actualizado exitosamente";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido actualizar";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST