/*=============================================
EDITAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEditarCliente", function(){

	var idCliente = $(this).attr("idCliente");

	var datos = new FormData();
    datos.append("idCliente", idCliente);

    $.ajax({

      url:"ajax/clientes.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
      
      	   $("#idCliente").val(respuesta["id"]);
      	   $("#editarCodigoCliente").val(respuesta["codigo"]);
	       $("#editarCliente").val(respuesta["nombre"]);
	       $("#editarDocumento").val(respuesta["tipoDocumento"]);
	       $("#editarDocumentoId").val(respuesta["documento"]);
	       $("#editarEmail").val(respuesta["email"]);
	       $("#editarTelefono").val(respuesta["telefono"]);
	       $("#editarCelular").val(respuesta["celular"]);
	       $("#editarDireccion").val(respuesta["direccion"]);
           $("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);
	  }

  	})

})

/* 

VALIDACION DE DOCUMENTO ID

*/
$("#nuevoDocumentoId, #documento").change(function(){
	var documentoSelect = $('#documento').val();
	var id = $("#nuevoDocumentoId").val();
console.log('Seleccion',documentoSelect);
console.log('Documento',id);

var datosId = new FormData();
	datosId.append("tipoSelect", documentoSelect);
	datosId.append("id", id);

	 $.ajax({
		url:"ajax/clientes.ajax.php",
		method:"POST",
		data: datosId,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success
			:function(respuesta){

				documentoId=$("#nuevoDocumentoId");

				console.log(respuesta);
				
				

				switch (documentoSelect) {
					case 'cedula':
						if (respuesta) {
					
							documentoId[0].setCustomValidity('');
			
							
		
						}else{
							documentoId[0].setCustomValidity('La cedula es invalida');
							
						}
						break;

						case 'ruc_natural':
						if (respuesta) {
					
							console.log("Ruc Persona natural valido");
							documentoId[0].setCustomValidity('');
							
		
						}else{
							console.log("Ruc Persona natural no valido");
							documentoId[0].setCustomValidity('Ruc Persona natural no valido');
							
						}
						break;

						
						case 'ruc_privada':
						if (respuesta) {
					
							console.log("Ruc Persona privada valido");

							documentoId[0].setCustomValidity('');
							
							
		
						}else{
							console.log("Ruc Persona privada no valido");

							documentoId[0].setCustomValidity('Ruc Persona privada no valido');
							
						}
						break;

						case 'ruc_publica':
						if (respuesta) {
					
							console.log("Ruc Persona publica valido");

							documentoId[0].setCustomValidity('');
							
							
		
						}else{
							console.log("Ruc Persona publica no valido");

							documentoId[0].setCustomValidity('Ruc Persona publica no valid');
							
						}
						break;
				
					default:
						break;
				}
		
				

			}

	})
	})

	
/*=============================================
REVISAR SI EL DOCUMENTOID YA ESTÁ REGISTRADO
=============================================*/

$("#nuevoDocumentoId").change(function(){

	$(".alert").remove();
	console.log('CAmbio de campo');
	
		
	
		var documento = $(this).val();
	
		var datos = new FormData();
		datos.append("noRepetirDocumento", documento);
	
	
		 $.ajax({
			url:"ajax/clientes.ajax.php",
			method:"POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success:function(respuesta){
				
					if(respuesta){
	
						swal({
							type: "error",
							title: "¡El documento ya existe!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
							 
						  })

						  $("#nuevoDocumentoId").val("");
						  
		
					}
	
				}
	
		})
	})



	$("#editarDocumentoId, #editarDocumento").change(function(){
		var documentoEditarSelect = $('#editarDocumento').val();
		var idEditar = $("#editarDocumentoId").val();
	console.log('Seleccion',documentoEditarSelect);
	
	
	var datosIdEditar = new FormData();
		datosIdEditar.append("tipoSelect", documentoEditarSelect);
		datosIdEditar.append("id", idEditar);
	
		 $.ajax({
			url:"ajax/clientes.ajax.php",
			method:"POST",
			data: datosIdEditar,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success
				:function(respuesta){
	
					documentoIdEditar=$("#editarDocumentoId");
	
					console.log(respuesta);
					
					
	
					switch (documentoEditarSelect) {
						case 'cedula':
							if (respuesta) {
						
								documentoIdEditar[0].setCustomValidity('');
				
								
			
							}else{
								documentoIdEditar[0].setCustomValidity('La cedula es invalida');
								
							}
							break;
	
							case 'ruc_natural':
							if (respuesta) {
						
								console.log("Ruc Persona natural valido");
								documentoIdEditar[0].setCustomValidity('');
								
			
							}else{
								console.log("Ruc Persona natural no valido");
								documentoIdEditar[0].setCustomValidity('Ruc Persona natural no valido');
								
							}
							break;
	
							
							case 'ruc_privada':
							if (respuesta) {
						
								console.log("Ruc Persona privada valido");
	
								documentoIdEditar[0].setCustomValidity('');
								
								
			
							}else{
								console.log("Ruc Persona privada no valido");
	
								documentoIdEditar[0].setCustomValidity('Ruc Persona privada no valido');
								
							}
							break;
	
							case 'ruc_publica':
							if (respuesta) {
						
								console.log("Ruc Persona publica valido");
	
								documentoIdEditar[0].setCustomValidity('');
								
								
			
							}else{
								console.log("Ruc Persona publica no valido");
	
								documentoIdEditar[0].setCustomValidity('Ruc Persona publica no valid');
								
							}
							break;
					
						default:
							break;
					}
			
					
	
				}
	
		})
		})

		/*=============================================
ACTIVAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnHabilitarCliente", function(){
	console.log('Activar o no cliente');

	var idClienteH = $(this).attr("idClienteHabilitar");
	var estadoCliente = $(this).attr("estadoCliente");

	console.log('id cliente: ',idClienteH);
	console.log('estado cliente: ',estadoCliente);
	

	var datos = new FormData();
 	datos.append("activarIdCliente", idClienteH);
  	datos.append("activarCliente", estadoCliente);

  	$.ajax({

	  url:"ajax/clientes.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

		console.log('Respesta actiuvar o no cliente',respuesta);
		

	      		 

			

      }

  	})

  	if(estadoCliente == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Deshabilitado');
  		$(this).attr('estadoCliente',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Habilitado');
  		$(this).attr('estadoCliente',0);

  	}

})