/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/

/*$.ajax({

	url: "ajax/datatable-productos.ajax.php",
	success:function(respuesta){
		
		console.log("respuesta", respuesta);

	}

})*/

/*
=================================================
CARGAR SUBCATEGORIAS SEGUN LA CATEGORIA
=================================================0
*/
$("#nuevaCategoria").change(function(){
	var select=$("#nuevaSubCategoria");

	select.empty()
	$(".alert").remove();

   var categoria = $(this).val();

   var datos = new FormData();


   datos.append("traercategoria", categoria);
   $.ajax({
	url:"ajax/productos.ajax.php",
	method:"POST",
	data: datos,
	cache: false,
	contentType: false,
	processData: false,
	dataType: "json",
	success:function(respuesta){

		console.log(respuesta);	

		$.each(respuesta, function(i, item) {

			console.log(respuesta[i].id);
			console.log(respuesta[i].subcategoria);
		
			
			
			select.append(
                $('<option></option>').val(respuesta[i].id).html(respuesta[i].subcategoria)
            );

			
		})
		
	}

})   
})
   

var perfilOculto = $("#perfilOculto").val();

$('.tablaProductos').DataTable( {
    "ajax": "ajax/datatable-productos.ajax.php?perfilOculto="+perfilOculto,
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
CAPTURANDO LA CATEGORIA PARA ASIGNAR CÓDIGO
=============================================*/
// $("#nuevaCategoria").change(function(){

// 	var idCategoria = $(this).val();

// 	var datos = new FormData();
//   	datos.append("idCategoria", idCategoria);

//   	$.ajax({

//       url:"ajax/productos.ajax.php",
//       method: "POST",
//       data: datos,
//       cache: false,
//       contentType: false,
//       processData: false,
//       dataType:"json",
//       success:function(respuesta){

//       	if(!respuesta){

//       		var nuevoCodigo = idCategoria+"01";
//       		$("#nuevoCodigo").val(nuevoCodigo);

//       	}else{

//       		var nuevoCodigo = Number(respuesta["codigo"]) + 1;
//           	$("#nuevoCodigo").val(nuevoCodigo);

//       	}
                
//       }

//   	})

// })

/*=============================================
AGREGANDO PRECIO DE VENTA
=============================================*/
$("#nuevoPrecioCompra, #editarPrecioCompra").change(function(){

	if($(".porcentaje").prop("checked")){

		var valorPorcentaje = $(".nuevoPorcentaje").val();

		var valorPorcentaje2 = $(".editarPorcentaje").val();

		
		
		var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

		var editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje2/100))+Number($("#editarPrecioCompra").val());

		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly",true);

		$("#editarPrecioVenta").val(editarPorcentaje);
		$("#editarPrecioVenta").prop("readonly",true);

	}

})

/*=============================================
CAMBIO DE PORCENTAJE
=============================================*/
$(".nuevoPorcentaje, .editarPorcentaje").change(function(){

	if($(".porcentaje").prop("checked")){

		var valorPorcentaje = $(this).val();
		
		var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

		var porcentaje2 = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());


		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly",true);

		$("#editarPrecioVenta").val(porcentaje2);
		$("#editarPrecioVenta").prop("readonly",true);

	}

})

$(".porcentaje").on("ifUnchecked",function(){

	$("#nuevoPrecioVenta").prop("readonly",false);
	$("#editarPrecioVenta").prop("readonly",false);

})

$(".porcentaje").on("ifChecked",function(){

	$("#nuevoPrecioVenta").prop("readonly",true);
	$("#editarPrecioVenta").prop("readonly",true);

})

/*=============================================
SUBIENDO LA FOTO DEL PRODUCTO
=============================================*/

$(".nuevaImagen").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaImagen").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaImagen").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})

/*=============================================
EDITAR PRODUCTO
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function(){

	var idProducto = $(this).attr("idProducto");

	
	
	var datos = new FormData();
    datos.append("idProducto", idProducto);

     $.ajax({

      url:"ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
		var datosProveedor = new FormData();
		datosProveedor.append("idProveedor",respuesta["id_proveedor"]);

		 $.ajax({

			url:"ajax/proveedores.ajax.php",
			method: "POST",
			data: datosProveedor,
			cache: false,
			contentType: false,
			processData: false,
			dataType:"json",
			success:function(respuesta){
				
				$("#editarProveedor").val(respuesta["id"]);
				$("#editarProveedor").html(respuesta["proveedor"]);

			}

		})
		var datosImpuesto = new FormData();
		datosImpuesto.append("idImpuestoVenta",respuesta["id_impuesto"]);

		console.log('id_impuestos',respuesta['id_impuesto']);
		

		 $.ajax({

			url:"ajax/impuestos.ajax.php",
			method: "POST",
			data: datosImpuesto,
			cache: false,
			contentType: false,
			processData: false,
			dataType:"json",
			success:function(respuestaImpuesto){

				console.log(' impuesto',respuestaImpuesto);
				
				
				$("#editarImpuesto").val(respuestaImpuesto[0]["id"]);
				$("#editarImpuesto").html(respuestaImpuesto[0]["valor"]);


			}

		})
        
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

		  var datosSubCategoria = new FormData();
		  datosSubCategoria.append("idSubCategoria",respuesta["id_subcategoria"]);
		

           $.ajax({

              url:"ajax/subcategorias.ajax.php",
              method: "POST",
              data: datosSubCategoria,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){

				console.log('ID -> Subcategoria elegida', respuesta['id']);
				console.log('Subcategoria elegida', respuesta['subcategoria']);
				
                  
                  $("#editarSubC").val(respuesta["id"]);
                  $("#editarSubC").html(respuesta["subcategoria"]);

              }

		  })
		 /* =================================================
CARGAR SUBCATEGORIAS SEGUN LA CATEGORIA
=================================================0
*/
$("#editarCategorias").change(function(){

	
	var select=$("#editarSubCategorias");
	var opt=$("#editarSubC");
	select.empty();
	opt.empty();
	
	$(".alert").remove();

   var categoria = $(this).val();

   var datos = new FormData();

  
  
   datos.append("traercategoria", categoria);
   $.ajax({
	url:"ajax/productos.ajax.php",
	method:"POST",
	data: datos,
	cache: false,
	contentType: false,
	processData: false,
	dataType: "json",
	success:function(respuesta){

		

		$.each(respuesta, function(i) {

			
			
			select.append(
                $('<option></option>').val(respuesta[i].id).html(respuesta[i].subcategoria)
			);
		
		})

		
		
	}

})   
})




           $("#editarCodigo").val(respuesta["codigo"]);

           $("#editarDescripcion").val(respuesta["descripcion"]);

           $("#editarStock").val(respuesta["stock"]);

		   $("#editarPrecioCompra").val(respuesta["precio_compra"]);
		   
		   $("#editarPorcentaje").val(respuesta["porcentaje"]);

           $("#editarPrecioVenta").val(respuesta["precio_venta"]);

           if(respuesta["imagen"] != ""){

           	$("#imagenActual").val(respuesta["imagen"]);

           	$(".previsualizar").attr("src",  respuesta["imagen"]);

           }

      }

  })

})





/*=============================================
REVISAR SI EL CODIGO YA ESTÁ REGISTRADO
=============================================*/

$("#nuevoCodigo").change(function(){

	console.log('CodigoNuevo');
	

	$(".alert").remove();

	var codigoProducto = $(this).val();

	

	var datos = new FormData();

	datos.append("validarCodigo", codigoProducto);

	

	 $.ajax({
	    url:"ajax/productos.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
			
			console.log('Respuesta no repetir',respuesta);
			
	    	if(respuesta){

	    		$("#nuevoCodigo").parent().after('<div class="alert alert-warning">Este codigo ya existe en la base de datos</div>');

	    		$("#nuevoCodigo").val("");

	    	}

	    }

	})
})


/*=============================================
ACTIVAR PRODUCTO
=============================================*/
$(".tablaProductos").on("click", ".btnHabilitarProducto", function(){
	console.log('Activar o no productp');

	var idProductoEs = $(this).attr("idProductoEstado");
	var estadoProducto = $(this).attr("productoEstado");

	console.log('id Producto: ',idProductoEs);
	console.log('estado Producto: ',estadoProducto);
	

	var datos = new FormData();
 	datos.append("activarIdProducto", idProductoEs);
  	datos.append("activarProductoEstado", estadoProducto);

  	$.ajax({

	  url:"ajax/productos.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){




	      		 swal({
			      title: "El estado de producto ha sido actualizado",
			      type: "success",
			      confirmButtonText: "¡Cerrar!"
			    }).then(function(result) {
			        if (result.value) {

			        	window.location = "productos";

			        }


				});

			

      }

  	})

  	if(estadoProducto == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Deshabilitado');
  		$(this).attr('estadoProducto',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Habilitado');
  		$(this).attr('estadoProducto',0);

  	}

})
