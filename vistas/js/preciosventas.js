/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/

/* $.ajax({

	url: "ajax/datatable-preciosventas.ajax.php",
	success:function(respuesta){
		
		console.log("respuesta", respuesta);

	}

}) */

var perfilOculto = $("#perfilOculto").val();

$('.tablaPrecioVenta').DataTable( {
    "ajax": "ajax/datatable-preciosventas.ajax.php?perfilOculto="+perfilOculto,
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
EDITAR PRECIO VENTA
=============================================*/

$(".tablaPrecioVenta tbody").on("click", "button.btnEditarPrecioVenta", function(){

	var idPrecioVenta = $(this).attr("idPrecioVenta");

	
	
	
	console.log("idPrecioVenta ahora",idPrecioVenta);
	
	var datosPrecioVenta = new FormData();
    datosPrecioVenta.append("idPrecioVenta", idPrecioVenta);


	$.ajax({

		url:"ajax/preciosventas.ajax.php",
		method: "POST",
		data: datosPrecioVenta,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			console.log('Respuestade precio ventas',respuesta);
			
			var datosProducto = new FormData();
          datosProducto.append("idProductoVAProducto",respuesta["id_producto"]);

           $.ajax({

              url:"ajax/productos.ajax.php",
              method: "POST",
              data: datosProducto,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){

				console.log('Consulta editar producto',respuesta);
				
				
                  $("#editarProducto").val(respuesta["id"]);
				  $("#editarProducto").html(respuesta["descripcion"]);
				  $("#editarPrecioCompra").val(respuesta["precio_compra"]);
				  
				  

              }

		  })
		  $("#idPrecioVenta").val(respuesta["id"]);
		  $("#editarPrecioVenta").val(respuesta["precio_venta"]);



		}
	})
})






/*=============================================
ACTIVAR PRECIOVENTA
=============================================*/
$(".tablaPrecioVenta").on("click", ".btnHabilitarPrecioVenta", function(){
	console.log('Activar o no precio venta');

	var idPrecioVenta = $(this).attr("idPrecioVenta");
	var estadoPrecioVenta = $(this).attr("estadoPrecioVenta");

	console.log('id precio venta: ',idPrecioVenta);
	console.log('estado precio venta: ',estadoPrecioVenta);
	

	var datos = new FormData();
 	datos.append("activarIdPrecioVenta", idPrecioVenta);
  	datos.append("activarPrecioVenta", estadoPrecioVenta);

  	$.ajax({

	  url:"ajax/preciosventas.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

		console.log('Respesta actiuvar o no precio venta',respuesta);
		

	      		 swal({
			      title: "El precio de  venta ha sido actualizado",
			      type: "success",
			      confirmButtonText: "¡Cerrar!"
			    }).then(function(result) {
			        


				});

			

      }

  	})

  	if(estadoPrecioVenta == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Deshabilitado');
  		$(this).attr('estadoPrecioVenta',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Habilitado');
  		$(this).attr('estadoPrecioVenta',0);

  	}

})



/*
=================================================
CARGAR SUBCATEGORIAS SEGUN LA CATEGORIA
=================================================0
*/
$("#nuevoProducto").change(function(){
	var producto=$(this).val();
	var precio_compra=$("#nuevoPrecioCompra");

	precio_compra.empty()
	$(".alert").remove();

   var producto = $(this).val();

   var datos = new FormData();


   datos.append("traerproducto", producto);
   $.ajax({
	url:"ajax/preciosventas.ajax.php",
	method:"POST",
	data: datos,
	cache: false,
	contentType: false,
	processData: false,
	dataType: "json",
	success:function(respuesta){

		console.log('Respuesat de precios ventas',respuesta);
		precio_compra.val(respuesta["precio_compra"]);
		

	}

})   
})




/*
=================================================
CONTROLAR QUE LOS PRECIOS DE VENTAS NO SEAN INFERIORES AL PRECIO DE COMPRA
=================================================
*/
$("#nuevoPrecioVenta").change(function(){
	var precio_venta=$(this).val();
	var precio_venta_campo=$(this);
	var precio_compra=$("#nuevoPrecioCompra").val();



	var operacion_precio=precio_venta-precio_compra;
	
	
	

	if( operacion_precio<=0){



	
		swal({
			title: "No se permite un valor inferior al precio de compra",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		  });

	  precio_venta_campo.val("");

	}

})
/*
=================================================
CONTROLAR QUE LOS PRECIOS DE VENTAS NO SEAN INFERIORES AL PRECIO DE COMPRA AL EDITAR
=================================================
*/
$("#editarPrecioVenta").change(function(){
	var precio_venta=$(this).val();
	var precio_venta_campo=$(this);
	var precio_compra=$("#editarPrecioCompra").val();


	console.log('Precio compra',precio_compra);
	console.log('Precio venta',precio_venta);
	var operacion_precio=precio_venta-precio_compra;
	

	if(operacion_precio<=0){

	
		swal({
			title: "No se permite un valor de 0 o un valor inferior al precio de compra",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		  });

	  precio_venta_campo.val("");

	}

})

