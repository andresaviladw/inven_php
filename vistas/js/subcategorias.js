/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/

/*$.ajax({

	url: "ajax/datatable-subcategorias.ajax.php",
	success:function(respuesta){
		
		console.log("respuesta", respuesta);

	}

})*/

var perfilOculto = $("#perfilOculto").val();

$('.tablasubCategoria').DataTable( {
    "ajax": "ajax/datatable-subcategorias.ajax.php?perfilOculto="+perfilOculto,
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );


/*=============================================
EDITAR SUBCATEGORIA
=============================================*/

$(".tablasubCategoria tbody").on("click", "button.btnEditarSubCategoria", function(){

	var idSubCategoria = $(this).attr("idSubCategoria");
	
	console.log("idSubCategoria",idSubCategoria);
	
	var datos = new FormData();
    datos.append("idSubCategoria", idSubCategoria);


	$.ajax({

		url:"ajax/subcategorias.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			var datosCategoria = new FormData();
          datosCategoria.append("idCategoria",respuesta["id_categoria"]);

           $.ajax({

              url:"ajax/categorias.ajax.php",
              method: "POST",
              data: datosCategoria,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){
				
                  $("#editarCategoria").val(respuesta["id"]);
				  $("#editarCategoria").html(respuesta["categoria"]);
				  
				  

              }

		  })
		  $("#idSubCategoria").val(respuesta["id"]);
		  $("#editarSubCategoria").val(respuesta["subcategoria"]);



		}
	})
})





/*=============================================
ELIMINAR SUBCATEGORIA
=============================================*/
$(".tablasubCategoria").on("click", ".btnEliminarSubcategoria", function(){

	var idSubCategoria = $(this).attr("idSubCategoria");

	swal({
		title: '¿Está seguro de borrar la subcategoría?',
		text: "¡Si no lo está puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar subcategoría!'
	}).then(function(result){

		if(result.value){

			window.location = "index.php?ruta=subcategorias&idSubCategoria="+idSubCategoria;

		}

	})

})

/*=============================================
REVISAR SI LA SUBCATEGORIA YA ESTÁ REGISTRADA
=============================================*/

$("#nuevaSubCategoria").change(function(){

	$(".alert").remove();

	var subcategoria = $(this).val();

	var datos = new FormData();
	datos.append("validarSubCategoria", subcategoria);

	 $.ajax({
	    url:"ajax/subcategorias.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevaSubCategoria").parent().after('<div class="alert alert-warning">Esta subcategoria ya se encuentra registrada</div>');

	    		$("#nuevaSubCategoria").val("");

	    	}

	    }

	})
})

/*=============================================
ACTIVAR SUBCATEGORIA
=============================================*/
$(".tablasubCategoria").on("click", ".btnHabilitarSubCategoria", function(){
	console.log('Activar o no subcategoria');

	var idSubCategoria = $(this).attr("idSubCategoria");
	var estadoSubCategoria = $(this).attr("estadoSubCategoria");

	console.log('id SUBCategoria: ',idSubCategoria);
	console.log('estado Categoria: ',estadoSubCategoria);
	

	var datos = new FormData();
 	datos.append("activarIdSub", idSubCategoria);
  	datos.append("activarSubCategoria", estadoSubCategoria);

  	$.ajax({

	  url:"ajax/subcategorias.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

		console.log('Respesta actiuvar o no categoria',respuesta);
		

	      		 swal({
			      title: "La Subcategoria ha sido actualizada",
			      type: "success",
			      confirmButtonText: "¡Cerrar!"
			    }).then(function(result) {
			        if (result.value) {

			        	window.location = "subcategorias";

			        }


				});

			

      }

  	})

  	if(estadoSubCategoria == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Deshabilitado');
  		$(this).attr('estadoSubCategoria',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Habilitado');
  		$(this).attr('estadoSubCategoria',0);

  	}

})

