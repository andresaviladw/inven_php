/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarImpuesto", function(){

	var idImpuesto = $(this).attr("idImpuesto");

	var datos = new FormData();
	datos.append("idImpuesto", idImpuesto);

	$.ajax({
		url: "ajax/impuestos.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#editarCodigo").val(respuesta["codigo"]);
     		$("#editarNombre").val(respuesta["nombre"]);
     		$("#editarValor").val(respuesta["valor"]);
     		$("#idImpuesto").val(respuesta["id"]);

     	}

	})


})

/*=============================================
REVISAR SI EL EMPUESTO YA ESTA REGISTRADO
=============================================*/

$("#nuevoCodigo").change(function(){

	$(".alert").remove();

	var impuesto = $(this).val();

	var datos = new FormData();
	datos.append("validarImpuesto", impuesto);

	 $.ajax({
	    url:"ajax/impuestos.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoCodigo").parent().after('<div class="alert alert-warning">El impuesto ya se encuentra registrado</div>');

	    		$("#nuevoCodigo").val("");

	    	}

	    }

	})
})


/*=============================================
ACTIVAR IMPUESTO
=============================================*/
$(".tablas").on("click", ".btnHabilitarImpuesto", function(){
	console.log('Activar o no impuesto');

	var idImpuesto = $(this).attr("idImpuestoHabilitar");
	var estadoImpuesto = $(this).attr("estadoImpuesto");

	console.log('id impuesto: ',idImpuesto);
	console.log('estado impusto: ',estadoImpuesto);
	

	var datos = new FormData();
 	datos.append("activarIdImpuesto", idImpuesto);
  	datos.append("activarImpuesto", estadoImpuesto);

  	$.ajax({

	  url:"ajax/impuestos.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

		/* console.log('Respesta actiuvar o no impuesto',respuesta);
		

	      		 swal({
			      title: "El impuesto ha sido actualizado",
			      type: "success",
			      confirmButtonText: "¡Cerrar!"
			    }).then(function(result) {
			        if (result.value) {

			        	window.location = "impuestos";

			        }


				}); */

			

      }

  	})

  	if(estadoImpuesto == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Deshabilitado');
  		$(this).attr('estadoImpuesto',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Habilitado');
  		$(this).attr('estadoImpuesto',0);

  	}

})