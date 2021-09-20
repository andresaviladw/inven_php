/*=============================================
EDITAR COMPROBANTE
=============================================*/
$(".tablas").on("click", ".btnEditarComprobante", function(){

	var idComprobante = $(this).attr("idComprobante");

	var datos = new FormData();
	datos.append("idComprobante", idComprobante);

	$.ajax({
		url: "ajax/comprobantes.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            console.log(respuesta);
            

     		$("#editarCodigo").val(respuesta["codigo"]);
     		$("#editarNombre").val(respuesta["nombre"]);
     		$("#idComprobante").val(respuesta["id"]);

     	}

	})


})

	/*=============================================
ACTIVAR COMPROBANTE
=============================================*/
$(".tablas").on("click", ".btnHabilitarComprobante", function(){
	console.log('Activar o no entrada');

	var idComprobanteHabilitar = $(this).attr("idComprobanteHabilitar");
	var estadoComprobante = $(this).attr("estadoComprobante");

	console.log('id comprobante: ',idComprobanteHabilitar);
	console.log('estado comprobante: ',estadoComprobante);
	

	var datos = new FormData();
 	datos.append("activarIdComprobante", idComprobanteHabilitar);
  	datos.append("activarComprobante", estadoComprobante);

  	$.ajax({

	  url:"ajax/comprobantes.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

		console.log('Respesta actiuvar o no comprobante',respuesta);
		

	      		 

			

      }

  	})

  	if(estadoComprobante == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Deshabilitado');
  		$(this).attr('estadoComprobante',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Habilitado');
  		$(this).attr('estadoComprobante',0);

  	}

})
