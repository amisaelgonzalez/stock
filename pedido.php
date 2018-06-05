<?php require_once 'includes/header.php'; ?>
<?php include('modal/pedidoModal.php');?>
<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Inicio</a></li>
		  <li class="active">Pedidos</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Listado de Pedidos</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" data-target="#addPedidoModel" onclick="addPedido()"> <i class="glyphicon glyphicon-plus-sign"></i> Agregar pedido </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="managePedidoTable">
					<thead>
						<tr>
							<th>Fabricante</th>
							<th>Descripcion del pedido</th>
							<th style="width:15%;">Opciones</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->







<script src="custom/js/pedido.js"></script>

<?php require_once 'includes/footer.php'; ?>