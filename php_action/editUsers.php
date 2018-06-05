<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$usersName = $_POST['editUsersName'];
    //$usersStatus = $_POST['editUsersStatus'];
    $usersEmail = $_POST['editEmail'];
    $usersRol = $_POST['editRol'];
    $editSucursal = $_POST['editSucursal'];
    $usersId = $_POST['usersId'];
    if ($usersRol != 2) {
    	$editSucursal = null;
    }

	$sql = "UPDATE users SET username = '$usersName', email = '$usersEmail', rol = '$usersRol', sucursales_id = '$editSucursal' WHERE user_id = '$usersId'";

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