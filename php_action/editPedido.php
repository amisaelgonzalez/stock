<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$pedidoName = $_POST['editPedidoName'];
    $pedidoId = $_POST['pedidoId'];

	$sql = "UPDATE pedidos SET pedido_name = '$pedidoName' WHERE pedido_id = '$pedidoId'";

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