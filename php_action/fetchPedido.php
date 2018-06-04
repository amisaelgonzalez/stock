<?php 	

require_once 'core.php';

$brandId = $_GET['proveedor_id'];

$sql = "SELECT pedido_id, pedido_name FROM pedidos WHERE pedido_status = 1 AND brand_id=".$brandId;
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

// $row = $result->fetch_array();

 while($row = $result->fetch_array()) {
 	$pedidoId = $row[0];

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editPedidoModel" onclick="editPedido('.$pedidoId.')"> <i class="glyphicon glyphicon-edit"></i> Editar</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removePedido('.$pedidoId.')"> <i class="glyphicon glyphicon-trash"></i> Eliminar</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row[1],
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);