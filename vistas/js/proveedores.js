'use strict'
 /**
  * EDITAR PROVEEDOR
  */

 $(document).on("click", ".btnEditarProveedor", function(){

  var idProveedor = $(this).attr("idProveedor");
  

  
	
	var datos = new FormData();
	datos.append("idProveedor", idProveedor);

	$.ajax({

		url:"ajax/proveedores.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
      $("#idProveedor").val(respuesta["id"]);
			
			$("#tipoDocumentoProveedorEditar").val(respuesta["tipoDocumento"]);
			$("#editarCodigoCliente").val(respuesta["codigo"]);
			$("#editarIdDocumento").val(respuesta["documentoId"]);
			$("#editarCodigoProveedor").val(respuesta["codigo"]);
			$("#editarProveedor").val(respuesta["proveedor"]);
			$("#editarDireccion").val(respuesta["direccion"]);
     $("#editarTelefono").val(respuesta["telefono"]);
            
    $("#editarCelular").val(respuesta["celular"]);
            $("#editarEmail").val(respuesta["email"]);
            $("#editarNuevaReferencia").val(respuesta["nombre_referencia"]);
            $("#editarMovilReferencia").val(respuesta["movil_referencia"]);

		}

	})

})

 
 


 /*=============================================
REVISAR SI EL DOCUMENTOID ES VALIDO
=============================================*/

 
$("#nuevoIdDocumento, #documentoProveedor").change(function(){
	var documentoSelectProveedor = $('#documentoProveedor').val();
	var idDocumentoProveedor = $("#nuevoIdDocumento").val();
console.log('Seleccion',documentoSelectProveedor);
console.log('Documento',idDocumentoProveedor);

var datosIdProveedor = new FormData();
datosIdProveedor.append("tipoSelect", documentoSelectProveedor);
datosIdProveedor.append("id", idDocumentoProveedor);

	 $.ajax({
		url:"ajax/proveedores.ajax.php",
		method:"POST",
		data: datosIdProveedor,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success
			:function(respuesta){

				var documentoIdProveedor=$("#nuevoIdDocumento");

				console.log(respuesta);
				
				

				switch (documentoSelectProveedor) {
					case 'cedula':
						if (respuesta) {
					
							documentoIdProveedor[0].setCustomValidity('');
			
							
		
						}else{
							documentoIdProveedor[0].setCustomValidity('La cedula es invalida');
							
						}
						break;

						case 'ruc_natural':
						if (respuesta) {
					
							console.log("Ruc Persona natural valido");
							documentoIdProveedor[0].setCustomValidity('');
							
		
						}else{
							console.log("Ruc Persona natural no valido");
							documentoIdProveedor[0].setCustomValidity('Ruc Persona natural no valido');
							
						}
						break;

						
						case 'ruc_privada':
						if (respuesta) {
					
							console.log("Ruc Persona privada valido");

							documentoIdProveedor[0].setCustomValidity('');
							
							
		
						}else{
							console.log("Ruc Persona privada no valido");

							documentoIdProveedor[0].setCustomValidity('Ruc Persona privada no valido');
							
						}
						break;

						case 'ruc_publica':
						if (respuesta) {
					
							console.log("Ruc Persona publica valido");

							documentoIdProveedor[0].setCustomValidity('');
							
							
		
						}else{
							console.log("Ruc Persona publica no valido");

							documentoIdProveedor[0].setCustomValidity('Ruc Persona publica no valido');
							
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

$("#nuevoIdDocumento").change(function(){

	$(".alert").remove();
	console.log('CAmbio de campo');
	
		
	
		var documento = $(this).val();
	
		var datos = new FormData();
		datos.append("noRepetirDocumento", documento);
	
	
		 $.ajax({
			url:"ajax/proveedores.ajax.php",
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

						  $("#nuevoIdDocumento").val("");
						  
		
					}
	
				}
	
		})
	})



	$("#editarIdDocumento, #tipoDocumentoProveedorEditar").change(function(){
		var documentoEditarSelect = $('#tipoDocumentoProveedorEditar').val();
		var idEditar = $("#editarIdDocumento").val();
	console.log('Seleccion',documentoEditarSelect);
	
	
	var datosIdEditar = new FormData();
		datosIdEditar.append("tipoSelect", documentoEditarSelect);
		datosIdEditar.append("id", idEditar);
	
		 $.ajax({
			url:"ajax/proveedores.ajax.php",
			method:"POST",
			data: datosIdEditar,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success
				:function(respuesta){
	
					var documentoIdEditar=$("#editarIdDocumento");
	
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
ACTIVAR PROVEEDOR
=============================================*/
$(".tablas").on("click", ".btnHabilitarProveedor", function(){
	console.log('Activar o no categoria');

	var idProveedor = $(this).attr("idProveedorHabilitar");
	var estadoProveedor = $(this).attr("estadoProveedor");

	console.log('id Categoria: ',idProveedor);
	console.log('estado Proveedor: ',estadoProveedor);
	

	var datos = new FormData();
 	datos.append("activarIdProveedor", idProveedor);
  	datos.append("activarProveedor", estadoProveedor);

  	$.ajax({

	  url:"ajax/proveedores.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

		console.log('Respesta activar o no proveedor',respuesta);
		

	      		 swal({
			      title: "El proveedor ha sido actualizada",
			      type: "success",
			      confirmButtonText: "¡Cerrar!"
			    }).then(function(result) {
			        if (result.value) {

			        	window.location = "proveedores";

			        }


				});

			

      }

  	})

  	if(estadoProveedor == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Deshabilitado');
  		$(this).attr('estadoProveedor',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Habilitado');
  		$(this).attr('estadoProveedor',0);

  	}

})