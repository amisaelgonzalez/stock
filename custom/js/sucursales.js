var manageSucursalesTable;

$(document).ready(function() {
	// top bar active
	$('#navSucursales').addClass('active');
	
	// manage sucursales table
	manageSucursalesTable = $("#manageSucursalesTable").DataTable({
		'ajax': 'php_action/fetchSucursales.php',
		'order': []		
		
		
	});

	// submit sucursales form function
	$("#submitSucursalesForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var sucursalesName = $("#sucursalesName").val();

		if(sucursalesName == "") {
			$("#sucursalesName").after('<p class="text-danger">Este campo es obligatorio</p>');
			$('#sucursalesName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#sucursalesName").find('.text-danger').remove();
			// success out for form 
			$("#sucursalesName").closest('.form-group').addClass('has-success');	  	
		}

		if(sucursalesName) {
			var form = $(this);
			// button loading
			$("#createSucursalesBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createSucursalesBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageSucursalesTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitSucursalesForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-sucursales-messages').html('<div class="alert alert-success">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
          '</div>');

  	  			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					}  // if

				} // /success
			}); // /ajax	
		} // if

		return false;
	}); // /submit sucursales form function

});

function editSucursales(sucursalesId = null) {
	if(sucursalesId) {
		// remove hidden sucursales id text
		$('#sucursalesId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-sucursales-result').addClass('div-hide');
		// modal footer
		$('.editSucursalesFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedSucursales.php',
			type: 'post',
			data: {sucursalesId : sucursalesId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-sucursales-result').removeClass('div-hide');
				// modal footer
				$('.editSucursalesFooter').removeClass('div-hide');

				// setting the sucursales name value 
				$('#editSucursalesName').val(response.sucursales_name);
				// sucursales id 
				$(".editSucursalesFooter").after('<input type="hidden" name="sucursalesId" id="sucursalesId" value="'+response.sucursales_id+'" />');

				// update sucursales form 
				$('#editSucursalesForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var sucursalesName = $('#editSucursalesName').val();

					if(sucursalesName == "") {
						$("#editSucursalesName").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editSucursalesName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editSucursalesName").find('.text-danger').remove();
						// success out for form 
						$("#editSucursalesName").closest('.form-group').addClass('has-success');	  	
					}

					if(sucursalesName) {
						var form = $(this);

						// submit btn
						$('#editSucursalesBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editSucursalesBtn').button('reset');

									// reload the manage member table 
									manageSucursalesTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-sucursales-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								} // /if
									
							}// /success
						});	 // /ajax												
					} // /if

					return false;
				}); // /update sucursales form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit sucursales function

function removeSucursales(sucursalesId = null) {
	if(sucursalesId) {
		$('#removeSucursalesId').remove();

		$.ajax({
			url: 'php_action/fetchSelectedSucursales.php',
			type: 'post',
			data: {sucursalesId : sucursalesId},
			dataType: 'json',
			success:function(response) {
				$('.removeSucursalesFooter').after('<input type="hidden" name="removeSucursalesId" id="removeSucursalesId" value="'+response.sucursales_id+'" /> ');

				// click on remove button to remove the sucursales
				$("#removeSucursalesBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeSucursalesBtn").button('loading');

					$.ajax({
						url: 'php_action/removeSucursales.php',
						type: 'post',
						data: {sucursalesId : sucursalesId},
						dataType: 'json',
						success:function(response) {

							// button loading
							$("#removeSucursalesBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeMemberModal').modal('hide');

								// reload the sucursales table 
								manageSucursalesTable.ajax.reload(null, false);
								
								$('.remove-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
							} else {

							} // /else
						} // /response messages
					}); // /ajax function to remove the sucursales

				}); // /click on remove button to remove the sucursales

			} // /success
		}); // /ajax

		$('.removeSucursalesFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove sucursales function