<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$pedidoName = $_POST['pedidoName'];
    $brandId = $_POST['brandId']; 

	$sql = "INSERT INTO pedidos (pedido_id, pedido_name, brand_id) VALUES (default, '$pedidoName', '$brandId')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Creado exitosamente";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido guardar".$pedidoName;
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST