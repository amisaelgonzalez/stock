<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$passwordAdmin = md5($_POST['passwordAdmin']);
    $password = md5($_POST['password1']);
    $usersId = $_POST['usersId'];

	$sqlAdmin = "SELECT user_id FROM users WHERE password = '$passwordAdmin' AND user_id = 1";
	$result = $connect->query($sqlAdmin);

	if($result->num_rows > 0) {
		$sql = "UPDATE users SET password = '$password' WHERE user_id = '$usersId'";

		if($connect->query($sql) === TRUE) {
		 	$valid['success'] = true;
			$valid['messages'] = "Actualizado exitosamente";	
		} else {
		 	$valid['success'] = false;
		 	$valid['messages'] = "Error no se ha podido actualizar";
		}
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error el password del administrador no es correcta";
	}

	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST