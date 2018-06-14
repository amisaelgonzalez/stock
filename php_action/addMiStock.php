<?php 	

require_once '../config/core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

  	$productId 	= $_POST['stockGeneralId'];
 	$quantity 		= $_POST['editQuantity'];

		
		$sql = "INSERT INTO stock (product_name, product_image, brand_id, categories_id, quantity, price_mayoreo, rate, active, status) 
		VALUES ('$productName', '$url', '$brandName', '$categoryName', '$quantity', '$priceMayoreo', '$priceMenudeo', '$productStatus', 1)";

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