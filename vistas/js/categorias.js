/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarCategoria", function(){

	var idCategoria = $(this).attr("idCategoria");

	var datos = new FormData();
	datos.append("idCategoria", idCategoria);

	$.ajax({
		url: "ajax/categorias.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#editarCategoria").val(respuesta["categoria"]);
     		$("#idCategoria").val(respuesta["id"]);

     	}

	})


})

/*=============================================
REVISAR SI LA CATEGORIA YA ESTÁ REGISTRADA
=============================================*/

$("#nuevaCategoria").change(function(){

	$(".alert").remove();

	var categoria = $(this).val();

	var datos = new FormData();
	datos.append("validarCategoria", categoria);

	 $.ajax({
	    url:"ajax/categorias.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevaCategoria").parent().after('<div class="alert alert-warning">Esta categoria ya se encuentra registrada</div>');

	    		$("#nuevaCategoria").val("");

	    	}

	    }

	})
})


/*=============================================
ACTIVAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnHabilitarCategoria", function(){
	console.log('Activar o no categoria');

	var idCategoria = $(this).attr("idCategoriaHabilitar");
	var estadoCategoria = $(this).attr("estadoCategoria");

	console.log('id Categoria: ',idCategoria);
	console.log('estado Categoria: ',estadoCategoria);
	

	var datos = new FormData();
 	datos.append("activarId", idCategoria);
  	datos.append("activarCategoria", estadoCategoria);

  	$.ajax({

	  url:"ajax/categorias.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

		console.log('Respesta actiuvar o no categoria',respuesta);
		

	      		 swal({
			      title: "La categoria ha sido actualizada",
			      type: "success",
			      confirmButtonText: "¡Cerrar!"
			    }).then(function(result) {
			        if (result.value) {

			        	window.location = "categorias";

			        }


				});

			

      }

  	})

  	if(estadoCategoria == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Deshabilitado');
  		$(this).attr('estadoCategoria',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Habilitado');
  		$(this).attr('estadoCategoria',0);

  	}

})