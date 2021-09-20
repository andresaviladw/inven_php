/*=============================================
EDITAR EMISOR
=============================================*/
$(".tablas").on("click", ".btnEditarEmisor", function(){

	var idEmisor = $(this).attr("idEmisor");

	
	

	var datos = new FormData();
	datos.append("idEmisor", idEmisor);

	$.ajax({
		url: "ajax/emisor.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){



			 $("#editarDocumentoEmisor").val(respuesta["tipoDocumento"]);
			 $("#editarDocumentoIdEmisor").val(respuesta["documento_id"]);
			 $("#editarRazonSocial").val(respuesta["razon_social"]);
			 $("#editarNombreComercial").val(respuesta["nombre_comercial"]);
			 $("#editarDireccion").val(respuesta["direccion"]);
			 $("#editarTelefono").val(respuesta["telefono"]);
			 $("#editarCelular").val(respuesta["celular"]);
			 $("#editarEmail").val(respuesta["email"]);
			 $("#editarCodigoEstablecimiento").val(respuesta["codigo_establecimiento"]);
			 $("#editarPuntoEmision").val(respuesta["punto_emision"]);
			 $("#editarSecuenciaFactura").val(respuesta["secuencia_factura"]);
			 $("#editarNumeroAutorizacion").val(respuesta["numero_autorizacion"]);

			 

     		$("#idEmisor").val(respuesta["id"]);

     	}

	})


})


$("#editarDocumentoIdEmisor, #editarDocumentoEmisor").change(function(){
	var documentoSelect = $('#editarDocumentoEmisor').val();
	var id = $("#editarDocumentoIdEmisor").val();
console.log('Seleccion',documentoSelect);
console.log('Documento',id);

var datosId = new FormData();
	datosId.append("tipoSelect", documentoSelect);
	datosId.append("id", id);

	 $.ajax({
		url:"ajax/emisor.ajax.php",
		method:"POST",
		data: datosId,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success
			:function(respuesta){

				documentoId=$("#editarDocumentoIdEmisor");

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








