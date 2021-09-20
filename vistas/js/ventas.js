/*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/

// $.ajax({

// 	url: "ajax/datatable-ventas.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// })// 

$('.tablaVentas').DataTable( {
    "ajax": "ajax/datatable-ventas.ajax.php",
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
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

var numventas=0;

$(".tablaVentas tbody").on("click", "button.agregarProductoVentas", function(){

	numventas++;

	var idProducto = $(this).attr("idProducto");

	$(this).removeClass("btn-primary agregarProductoVentas");

	$(this).addClass("btn-default");

	

	var datos = new FormData();
    datos.append("idProductoVAProducto", idProducto);

     $.ajax({

     	url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){

      	    var id = respuesta["id"];
      	    var codigo = respuesta["codigo"];
      	    var descripcion = respuesta["descripcion"];
          	var stock = respuesta["stock"];
          	var precio_compra = respuesta["precio_compra"];
          	
     
			
			
			

			
	var datosVenta = new FormData();
    datosVenta.append("idProductoVenta", respuesta['id']);

	

	
     $.ajax({

     	url:"ajax/preciosventas.ajax.php",
      	method: "POST",
      	data: datosVenta,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuestaVenta){

		var precioventa=respuestaVenta[0]['precio_venta']
			

			
			
			
	var datosImpuesto = new FormData();
    datosImpuesto.append("idImpuestoVenta", respuesta['id_impuesto']);

	console.log('Valor Impuesto',respuesta['id_impuesto']);
	

	
     $.ajax({

     	url:"ajax/impuestos.ajax.php",
      	method: "POST",
      	data: datosImpuesto,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuestaImpuesto){

			impuesto=respuestaImpuesto['valor'];
			

			
			
			

				
          	/*=============================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	=============================================*/

          	if(stock == 0){

      			swal({
			      title: "No hay stock disponible",
			      type: "error",
			      confirmButtonText: "¡Cerrar!"
			    });

			    $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProductoVentas");

			    return;

			  }
			  


          	$(".nuevoProducto").append(

          	'<div class="row" style="padding:2px 5px">'+

			  '<!-- Descripción del producto -->'+
	          
	          '<div class="col-xs-5" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

	              '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProductoVentas" value="'+descripcion+'" readonly required>'+
	              '<input type="hidden" class="form-control nuevoCodigoProducto" idProducto="'+idProducto+'" name="agregarProductoVentas" value="'+codigo+'" readonly required>'+

	            '</div>'+

	          '</div>'+

	          '<!-- Cantidad del producto -->'+

	          '<div class="col-xs-3">'+
	            
				 '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto[]" min="1" value="1" step="any" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+
				 
				 '<input type="hidden" class="form-control idVentaForaneo" idProducto="'+idProducto+'" value="'+$('#idventa').val()+'" readonly required>'+
				 
				 '<input type="hidden" class="form-control idProductoForaneo" idProducto="'+idProducto+'" name="idProductoForaneo[]" value="'+id+'" readonly required>'+

			  '</div>' +
			  
			  '<!-- Precio del producto VENTA -->'+

	          '<div class="col-xs-3 ingresoPrecioVenta">'+
 
				'<select class="form-control nuevoproductoventa" id="productoventa'+numventas+'" idProducto="'+idProducto+'" name="nuevoproductoventa[]" required>'+
				
	 
	            '</div>'+

	         
	          '<!-- Precio del producto -->'+

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              
	                 
				  '<input type="hidden" class="form-control nuevoPrecioProductoImpuesto" name="nuevoPrecioProductoImpuesto[]" id="nuevoPrecioProductoImpuesto'+numventas+'" readonly required>'+
				  
	              
				  '<input type="hidden" class="form-control nuevoImpuesto" id="impuestoventa'+numventas+'"  name="nuevoImpuesto[]" readonly required>'+
				  '<input type="hidden" class="form-control impuesto" id="impuesto'+numventas+'"  name="impuesto[]" readonly required>'+
				  
				  
				  '<input type="hidden" class="form-control nuevoPrecioImpuestoAcumulado" id="nuevoPrecioImpuestoAcumulado'+numventas+'" name="nuevoImpuestoAcumulado[]" readonly required>'+
				  
	              '<input type="hidden" class="form-control nuevoPrecioSinImpuesto" name="nuevoPrecioSinImpuesto[]" id="nuevoPrecioSinImpuesto'+numventas+'" readonly required>'+
				  '<input type="hidden" class="form-control nuevoPrecioCompra" value="'+precio_compra+'" name="nuevoPrecioCompra" id="nuevoPrecioCompra'+numventas+'" readonly required>'+
				  
	              '<input type="hidden" class="form-control nuevoPrecioUtilidadVenta" name="nuevoPrecioUtilidadVenta[]" id="nuevoPrecioUtilidadVenta'+numventas+'" readonly required>'+
	              '<input type="hidden" class="form-control diferenciaUtilidad" name="diferenciaUtilidad[]" id="diferenciaUtilidad'+numventas+'" readonly required>'+
	 
	            '</div>'+
	             
			  '</div>'+
			 
	             
	          '</div>'+

			'</div>') 

			
				
			
			
			$.each(respuestaVenta, function(i, item) {
			
				console.log('Respuesta venta=',item.precio_venta);

				$("#productoventa"+numventas).append(

					
					'<option value="'+item.precio_venta+'">'+item.precio_venta+'</option>'
				 )

				 $("#impuestoventa"+numventas).attr("value",item.valor);
			
			
				
				 
			})
			
			
			$.each(respuestaImpuesto, function(i, item) {
			
				

				$("#impuestoventa"+numventas).attr("value",item.valor);

				var precioImpuesto=precioventa*item.valor;

				var impuestoDefinitivo=precioImpuesto/100;



				var precioUnitario=Number(precioventa)+Number(impuestoDefinitivo);

				$('#nuevoPrecioImpuestoAcumulado'+numventas).attr("value",impuestoDefinitivo);
				$('#impuesto'+numventas).attr("value",impuestoDefinitivo);
				$('#nuevoPrecioProductoImpuesto'+numventas).attr("value",precioUnitario);
				$('#nuevoPrecioSinImpuesto'+numventas).attr("value",precioventa);

				utilidad=Number(precioventa)-Number(precio_compra);

				$('#nuevoPrecioUtilidadVenta'+numventas).attr("value",utilidad);
				$('#diferenciaUtilidad'+numventas).attr("value",utilidad);


				

				
			
				
				 
			})

			
		
			// AGREGAR IMPUESTO

			Descuento()
			
			//SUMA TOTAL IMPUESTOS
			sumarTotalPreciosImpuesto();

			//SUMA TOTAL SUBTOTAL
			sumarTotalPreciosSubtotal();
			

	        // SUMAR TOTAL DE PRECIOS

			sumarTotalPrecios()
			

			
	        // SUMAR TOTAL DE PRECIOS UTILIDAD

	        sumarTotalPreciosUtilidad()

	       

	        // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductos();

	        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

	        $(".nuevoPrecioProductoImpuesto").number(true, 2);
	        $(".nuevoPrecioSinImpuesto").number(true, 2);
	        $("#nuevoPrecioSubtotal").number(true, 2);
	        $("#nuevoPrecioImpuesto").number(true, 2);
	        $(".nuevoPrecioImpuestoAcumulado").number(true, 2);
	        $(".nuevoPrecioCompra").number(true, 2);
	        $(".nuevoPrecioUtilidadVenta").number(true, 2);
	        $(".diferenciaUtilidad").number(true, 2);
	     
	        $("#nuevoTotalUtilidadVenta").number(true, 2);
	        

			localStorage.removeItem("quitarProducto");
		}
	
	})
		}
	
	})
      	}
	
     

})
})

;

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaVentas").on("draw.dt", function(){

	if(localStorage.getItem("quitarProducto") != null){

		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

		for(var i = 0; i < listaIdProductos.length; i++){

			$("button.recuperarBotonVenta[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBotonVenta[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProductoVentas');

		}


	}


})


/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioVenta").on("click", "button.quitarProducto", function(){

	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");

	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarProducto") == null){

		idQuitarProducto = [];
	
	}else{

		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

	}

	idQuitarProducto.push({"idProducto":idProducto});

	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

	
	$("button.recuperarBotonVentas[idProducto='"+idProducto+"']").removeClass('btn-default');

	$("button.recuperarBotonVentas[idProducto='"+idProducto+"']").addClass('btn-primary agregarProductoVentas');

	if($(".nuevoProducto").children().length == 0){
		

		$("#nuevoPrecioSubtotal").val(0);
		$("#nuevoImpuestoVenta").val(0);
		$(".nuevoPrecioImpuestoAcumulado").val(0);
		$("#nuevoTotalVenta").val(0);
		$("#nuevoTotalUtilidadVenta").val(0);
		$("#totalUtilidadVenta").val(0);
		$("#nuevoTotalUtilidadVenta").val(0);
		$("#nuevoPrecioImpuesto").val(0);
		$("#nuevoDescuentoVenta").val(0);
		$(".nuevoPrecioSinImpuesto").val(0);
		$(".nuevoPrecioUtilidadVenta").val(0);
		

	}else{
			// AGREGAR IMPUESTO
	        
			Descuento()
		

			//SUMA TOTAL SUBTOTAL
			sumarTotalPreciosSubtotal();
		
	     //SUMA TOTAL IMPUESTOS
			sumarTotalPreciosImpuesto();
			


		// SUMAR TOTAL DE PRECIOS

		sumarTotalPrecios();
		
		// SUMAR TOTAL DE PRECIOS UTILIDAD

		sumarTotalPreciosUtilidad()

    	

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos();

	}

})

/*=============================================
SELECCIONAR PRODUCTO
=============================================*/

$(".formularioVenta").on("change", "select.nuevoproductoventa", function(){

	console.log('cambio de select');
	
	
	
	var precio = $(this).parent().parent().children(".ingresoPrecioVenta").children(".nuevoPrecioProductoImpuesto");
	var precioVenta = $(this).parent().parent().children(".ingresoPrecioVenta").children(".nuevoproductoventa");
	var impuestoVenta = $(this).parent().parent().children(".ingresoPrecioVenta").children(".nuevoImpuesto").val();
	var subtotalUnitario = $(this).parent().parent().children(".ingresoPrecioVenta").children(".nuevoPrecioSinImpuesto");
	var impuestoSuma = $(this).parent().parent().children(".ingresoPrecioVenta").children(".nuevoPrecioImpuestoAcumulado");
	var impuestoestatico = $(this).parent().parent().children(".ingresoPrecioVenta").children(".impuesto");
	var cantidad = $(this).parent().parent().children().children(".nuevaCantidadProducto");
	var precio_comp = $(this).parent().parent().children(".ingresoPrecioVenta").children(".nuevoPrecioCompra").val();
	var utilidadIndividual = $(this).parent().parent().children(".ingresoPrecioVenta").children(".nuevoPrecioUtilidadVenta");
	var diferencia = $(this).parent().parent().children(".ingresoPrecioVenta").children(".diferenciaUtilidad");

	
	

	var subtotal=precioVenta.val()*cantidad.val()
	subtotalUnitario.val(subtotal);

	diferencia.val(Math.abs(precioVenta.val()-precio_comp));


	totalUtilidad=diferencia.val()*cantidad.val();
	



	utilidadIndividual.val(totalUtilidad);

	var impuesto=precioVenta.val()*impuestoVenta/100

	impuestoestatico.val(impuesto);


	var impuestoAc=impuesto*cantidad.val();

	var total=subtotal+=impuestoAc;
	impuestoSuma.val(impuestoAc);
	precio.val(total);

	// SUMAR TOTAL DE PRECIOS DE UTILIDAD
		
	sumarTotalPreciosUtilidad()
	
	        // SUMAR TOTAL DE IMPUESTOS
			Descuento()
			
			sumarTotalPrecios();

		

			//SUMA TOTAL SUBTOTAL
			sumarTotalPreciosSubtotal();
			
	

	//SUMA TOTAL IMPUESTOS
	sumarTotalPreciosImpuesto();

	//LISTA DE PRODUCTOS
	listarProductos();
	

})

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

	$(".formularioVenta").on("change", " input.nuevaCantidadProducto", function(){

		console.log('cantidad',$(this).val());
		

		var precio = $(this).parent().parent().children(".ingresoPrecioVenta").children(".nuevoPrecioProductoImpuesto");
		var precioVenta = $(this).parent().parent().children(".ingresoPrecioVenta").children(".nuevoproductoventa");
		var impuestoestatic = $(this).parent().parent().children(".ingresoPrecioVenta").children(".impuesto");
		var impuestoVenta = $(this).parent().parent().children(".ingresoPrecioVenta").children(".nuevoImpuesto");
		var impuestoVentaAcumulado = $(this).parent().parent().children(".ingresoPrecioVenta").children(".nuevoPrecioImpuestoAcumulado");
		var subtotal = $(this).parent().parent().children(".ingresoPrecioVenta").children(".nuevoPrecioSinImpuesto");
		var precio_comp = $(this).parent().parent().children(".ingresoPrecioVenta").children(".nuevoPrecioCompra").val();
		var utilidadIndividual = $(this).parent().parent().children(".ingresoPrecioVenta").children(".nuevoPrecioUtilidadVenta");
		var diferencia = $(this).parent().parent().children(".ingresoPrecioVenta").children(".diferenciaUtilidad");
	
		var precioSubtotal = $(this).val() * precioVenta.val();
		
		subtotal.val(precioSubtotal);
		

		diferencia.val(Math.abs(precioVenta.val()-precio_comp));


		totalUtilidad=diferencia.val()* $(this).val();
		
		console.log('Diferencia',totalUtilidad);


		utilidadIndividual.val(totalUtilidad);


		var precioporImpuesto=precioVenta.val()*impuestoVenta.val()/100;

		impuestoestatic.val(precioporImpuesto);

		

		var impuestoSuma=precioporImpuesto*$(this).val();

		
		
	
		impuestoVentaAcumulado.val(impuestoSuma);
		
		precioFinal=precioSubtotal+=impuestoSuma;

		
		
		


		/* var precioFinalUtilidad = $(this).val() * utilidad.attr("precioReal"); */
		
		console.log('precio total',precioFinal);
		console.log('precio total impuesto',precioFinal);
		
		precio.val(precioFinal);
	
	
		

		console.log('precio final',precioFinal);
	
		
		
	
		var nuevoStock = Number($(this).attr("stock")) - $(this).val();
	
		$(this).attr("nuevoStock", nuevoStock);
	
		if(Number($(this).val()) > Number($(this).attr("stock"))){
	
			/*=============================================
			SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
			=============================================*/
	
			$(this).val(0);
			precio.val(0);
			impuestoVentaAcumulado.val(0);
			subtotal.val(0);
			utilidadIndividual.val(0);
			diferencia.val(0);

		
	
			$(this).attr("nuevoStock", $(this).attr("stock"));
	
			var precioFinal = $(this).val() * precioVenta.val();
	
			precio.val(precioFinal);

			

			//SUMA TOTAL SUBTOTAL
			sumarTotalPreciosSubtotal();

			//LISTA DE PRODUCTOS
			listarProductos();
			
	     
			sumarTotalPrecios();
			
			//SUMA TOTAL IMPUESTOS
			sumarTotalPreciosImpuesto();
	
			// SUMAR TOTAL DE PRECIOS UTILIDAD
	
			sumarTotalPreciosUtilidad()
	
			// AGREGAR IMPUESTO
							
			Descuento()
		
			swal({
			  title: "La cantidad supera el Stock",
			  text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
			  type: "error",
			  confirmButtonText: "¡Cerrar!"
			});
	
			return;
	
		}
			// AGREGAR IMPUESTO
							
			Descuento()
		

			//SUMA TOTAL SUBTOTAL
			sumarTotalPreciosSubtotal();
		
		// SUMAR TOTAL DE PRECIOS
		
		sumarTotalPrecios()
		
		// SUMAR TOTAL DE PRECIOS DE UTILIDAD
		
		sumarTotalPreciosUtilidad()
		
		//SUMA TOTAL IMPUESTOS
		sumarTotalPreciosImpuesto();
					
		// SUMAR TOTAL DE PRECIOS UTILIDAD
	
		sumarTotalPreciosUtilidad()
	
		
	
		// AGRUPAR PRODUCTOS EN FORMATO JSON
	
		listarProductos()
	
	})
	





/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPrecios(){

	var precioItem = $(".nuevoPrecioProductoImpuesto");
	
	var arraySumaPrecio = [];  

	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecio.push(Number($(precioItem[i]).val()));
		
		 
	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios,0);
	
	$("#nuevoTotalVenta").val(sumaTotalPrecio);
	$("#totalVenta").val(sumaTotalPrecio);
	$("#nuevoTotalVenta").attr("total",sumaTotalPrecio);
	$('#nuevoTotalPagado').val(sumaTotalPrecio);


}

/*=============================================
SUMAR TODOS LOS PRECIOS PARA SUBTOTAL
=============================================*/

function sumarTotalPreciosSubtotal(){

	var precioItemSubtotal = $(".nuevoPrecioSinImpuesto");
	
	var arraySumaPrecioSubtotal = [];  

	for(var i = 0; i < precioItemSubtotal.length; i++){

		 arraySumaPrecioSubtotal.push(Number($(precioItemSubtotal[i]).val()));
		
		 
	}

	function sumaArrayPreciosSubtotal(total, numero){

		return total + numero;

	}

	var sumaTotalPrecioSubtotal = arraySumaPrecioSubtotal.reduce(sumaArrayPreciosSubtotal,0);
	
	$("#nuevoPrecioSubtotal").val(sumaTotalPrecioSubtotal);
	$("#totalSubtotal").val(sumaTotalPrecioSubtotal);
	$("#nuevoPrecioSubtotal").attr("totalsubtotal",sumaTotalPrecioSubtotal);


}
/*=============================================
SUMAR TODOS LOS PRECIOS DE IMPUESTOS
=============================================*/

function sumarTotalPreciosImpuesto(){

	var precioImpuesto = $(".nuevoPrecioImpuestoAcumulado");
	
	var arraySumaImpuesto = [];  

	for(var i = 0; i < precioImpuesto.length; i++){

		 arraySumaImpuesto.push(Number($(precioImpuesto[i]).val()));
		
		 
	}

	function sumaArrayImpuestos(total, numero){

		return total + numero;

	}

	var sumaTotalImpuesto = arraySumaImpuesto.reduce(sumaArrayImpuestos,0);
	
	$("#nuevoImpuestoVenta").val(sumaTotalImpuesto);
	$("#nuevoPrecioImpuesto").val(sumaTotalImpuesto);
	$("#nuevoImpuestoVenta").attr("totalimpuesto",sumaTotalImpuesto);


}

/*=============================================
SUMAR TODOS LOS PRECIOS PARA OBTENER LA UTILIDAD
=============================================*/

function sumarTotalPreciosUtilidad(){

	var precioItem = $(".nuevoPrecioUtilidadVenta");
	
	var arraySumaPrecio = [];  

	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecio.push(Math.abs(Number($(precioItem[i]).val())));
		
		 
	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios,0);
	
	$("#nuevoTotalUtilidadVenta").val(sumaTotalPrecio);
	$("#totalUtilidadVenta").val(sumaTotalPrecio);
	$("#nuevoTotalUtilidadVenta").attr("totalUtilidad",sumaTotalPrecio);

	console.log('Suma total de utilidad',sumaTotalPrecio);
	


}

/** =============================================
FUNCIÓN AGREGAR IMPUESTO Y DESCUENTO
=============================================*/

function  Descuento() {
	 var descuento = $("#nuevoDescuentoVenta").val();
	 
	 var subtotal = $("#nuevoPrecioSubtotal").val();
	 

 	var impuesto = $("#nuevoPrecioImpuesto").val();

	var precioTotal = $("#nuevoTotalVenta").val();
	

	var precio = Number(subtotal)+Number(impuesto);

	precioTotal=Number(precio)-Number(descuento);




	var totalConDescuento = precioTotal;

	$("#nuevoTotalVenta").val(totalConDescuento);
	$("#nuevoPrecioDescuento").val(precioTotal);

	
}

/*=============================================
CUANDO CAMBIA EL IMPUESTO
=============================================*/

$(".nuevaCantidadProducto").change(function(){

	Descuento()

});
/*=============================================
CUANDO CAMBIA EL DESCUENTO
=============================================*/

$("#nuevoDescuentoVenta").change(function(){

	Descuento()

});






/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

$("#nuevoTotalVenta").number(true,2);


/*=============================================
SELECCIONAR MÉTODO DE PAGO
=============================================*/

$("#nuevoFormaPagoVenta").change(function(){

	var forma = $(this).val();

	if(forma == 1){

		$(this).parent().parent().removeClass("col-xs-6");

		$(this).parent().parent().addClass("col-xs-4");

		$(this).parent().parent().parent().children(".cajasFormaPagoVenta").html(

			 '<div class="col-xs-4">'+ 

			 	'<div class="input-group">'+ 

			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 

			 		'<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="0.00">'+

			 	'</div>'+

			 '</div>'+

			 '<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">'+

			 	'<div class="input-group">'+

			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

			 		'<input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="0.00" readonly>'+

			 	'</div>'+

			 '</div>'

		 )

		
	}else{

		$(this).parent().parent().removeClass('col-xs-4');

		$(this).parent().parent().addClass('col-xs-6');

		 $(this).parent().parent().parent().children('.cajasFormaPagoVenta').html(

		 	'<div class="col-xs-6" style="padding-left:0px">'+

              '</div>')

	}

	

})

/*=============================================
CAMBIO EN EFECTIVO
=============================================*/
$(".formularioVenta").on("change", "input#nuevoValorEfectivo", function(){

	var efectivo = $(this).val();

	var cambio =  Number(efectivo) - Number($('#nuevoTotalVenta').val());

	var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

	nuevoCambioEfectivo.val(cambio);

})




/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos(){

	var listaProductos = [];

	 var idVenta=$(".idVentaForaneo");

	var descripcion = $(".nuevaDescripcionProducto");

	var cantidad = $(".nuevaCantidadProducto");

	var precio = $(".nuevoproductoventa");

	var precioConIva = $(".nuevoPrecioProductoImpuesto");

	var precioSinIva = $(".nuevoPrecioSinImpuesto");

	var codigo = $(".nuevoCodigoProducto");

	var impuestoTotal = $(".nuevoPrecioImpuestoAcumulado");

	var impuesto = $(".impuesto");

	var utilidad = $(".diferenciaUtilidad");

	var totalUtilidad = $(".nuevoPrecioUtilidadVenta");

	var valorImpuesto=$(".nuevoImpuesto");

	var precio_compra=$(".nuevoPrecioCompra");

	for(var i = 0; i < descripcion.length; i++){

		listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"), 
							  
							  "idVenta" : $(idVenta[i]).val(),
							  "descripcion" : $(descripcion[i]).val(),
							  "codigo" : $(codigo[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "stock" : $(cantidad[i]).attr("nuevoStock"),
							  "precio_compra" : $(precio_compra[i]).val(),
							  "precio" : $(precio[i]).val(),
							  "precioSinIva" : $(precioSinIva[i]).val(),
							  "precioIva" : $(precioConIva[i]).val(),
							  "impuesto" : $(impuesto[i]).val(),
							  "valorImpuesto" : $(valorImpuesto[i]).val(),
							  "impuestoTotal" : $(impuestoTotal[i]).val(),
							  "utilidad" :  Math.abs($(utilidad[i]).val()),
							  "utilidadTotal" : Math.abs($(totalUtilidad[i]).val()),
							 })

	}

	$("#listaProductos").val(JSON.stringify(listaProductos)); 

	console.log('Lista a guardar',listaProductos);
	
}



/*=============================================
BOTON EDITAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEditarVenta", function(){

	var idVenta = $(this).attr("idVenta");

	window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;


})

/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitaragregarProductoVentas(){

	//Capturamos todos los id de productos que fueron elegidos en la venta
	var idProductos = $(".quitarProducto");

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaVentas tbody button.agregarProductoVentas");

	//Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
	for(var i = 0; i < idProductos.length; i++){

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(idProductos[i]).attr("idProducto");
		
		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for(var j = 0; j < botonesTabla.length; j ++){

			if($(botonesTabla[j]).attr("idProducto") == boton){

				$(botonesTabla[j]).removeClass("btn-primary agregarProductoVentas");
				$(botonesTabla[j]).addClass("btn-default");

			}
		}

	}
	
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$('.tablaVentas').on( 'draw.dt', function(){

	quitaragregarProductoVentas();

})


/*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".tablas").on("click", ".btnImprimirFactura", function(){
	
	var codigoVenta = $(this).attr("codigoVenta");
	
	window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigoVenta, "_blank");
	
})

/*=============================================
RANGO DE FECHAS
=============================================*/

$('#daterange-btn').daterangepicker(
	{
	ranges: {
		'Hoy': [moment(), moment()],
		'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		'Los ultimos 7 dias': [moment().subtract(6, 'days'), moment()],
		'Los ultimos 30 dias': [moment().subtract(29, 'days'), moment()],
		'Este mes': [moment().startOf('month'), moment().endOf('month')],
	'El mes anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
	'Este Año': [moment().startOf('year'), moment().endOf('year')],
	'Los ultimos 6 meses': [moment().subtract(6, 'month'), moment()]
},
"locale": {
	"format": "MM/DD/YYYY",
		"separator": " - ",
		"applyLabel": "Aplicar",
		"cancelLabel": "Cancelar",
		"fromLabel": "Desde",
		"toLabel": "Hasta",
		"customRangeLabel": "Rango Personalizado",
		"weekLabel": "W",
		"daysOfWeek": [
			"Dom",
			"Lun",
			"Mar",
			"Mier",
			"Jue",
			"Vie",
			"Sa"
		],
		"monthNames": [
			"Enero",
			"Febrero",
			"Marzo",
			"Abril",
			"Mayo",
			"Junio",
			"Julio",
			"Agosto",
			"Septiembre",
			"Octubre",
			"Noviembre",
			"Diciembre"
		],
		"firstDay": 1
	},
	"linkedCalendars": false,
	"startDate": moment().subtract(1, 'month'),
	"endDate": moment()
  
},
  function (start, end) {
	  $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
	  
	  //Incio de la fecha y se cambia el formato al de la base de datos
	  var fechaInicial = start.format('YYYY-MM-DD');
	  
	  //""
	  var fechaFinal = end.format('YYYY-MM-DD');
	  
	  var capturarRango = $("#daterange-btn span").html();
	  
	  localStorage.setItem("capturarRango", capturarRango);
	  
   	window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
	   
  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){
	
	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "ventas";
})

/*=============================================
CAPTURAR HOY
=============================================*/

//Captura 
$(".daterangepicker.opensleft .ranges li").on("click", function(){
	
	var textoHoy = $(this).attr("data-range-key");
	
	if(textoHoy == "Hoy"){
		
		//Captura la fecha del dia actual
		var d = new Date();
		
		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var año = d.getFullYear();
		
		if(mes < 10){
			
			/**
			 * Si el mes es menor a 10 entonces se concatena con el 0 para que pueda ser leido en la consulta
			 */
			
			var fechaInicial = año+"-0"+mes+"-"+dia;
			var fechaFinal = año+"-0"+mes+"-"+dia;

		}else if(dia < 10){

			var fechaInicial = año+"-"+mes+"-0"+dia;
			var fechaFinal = año+"-"+mes+"-0"+dia;
			
		}else if(mes < 10 && dia < 10){
			
			var fechaInicial = año+"-0"+mes+"-0"+dia;
			var fechaFinal = año+"-0"+mes+"-0"+dia;

		}else{

			var fechaInicial = año+"-"+mes+"-"+dia;
	    	var fechaFinal = año+"-"+mes+"-"+dia;
			
		}	
		
    	localStorage.setItem("capturarRango", "Hoy");
		
    	window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}
	
})

/* $("#fecha_emision").daterangepicker({
    locale: {
          format: 'DD/MM/YYYY',
    },
    singleDatePicker: true,
	showDropdowns: true,
	"startDate": moment().subtract(1, 'month'),
	"endDate": moment()
}); */

$('#fecha_emision').daterangepicker({
	"singleDatePicker": true,
	timePicker: true,
	timePicker24Hour: true,
	"locale": {
		"format": "YYYY/MM/DD hh:mm",
	}
   
});
/* $('#fecha_emision').on('apply.daterangepicker', function(ev, picker) {
	$(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
}); */
$('#fecha_vencimiento').daterangepicker({
	"singleDatePicker": true,
	timePicker: true,
	timePicker24Hour: true,
	  timePickerIncrement: 30,
	"locale": {
		"format": "YYYY/MM/DD hh:mm",
	}
	
});

/* $('#fecha_vencimiento').on('apply.daterangepicker', function(ev, picker) {
	$(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
});	 */	




            
         

/* $('#fecha_emision').daterangepicker({
    autoUpdateInput: false
}, function(start_date, end_date) {
    $('#fecha_emision').val(start_date.format('YYYY-MM-DD')+' - '+end_date.format('YYYY-MM-DD'));
}); */


/*=============================================
ANULAR VENTA
=============================================*/
$(".tablas").on("click", ".VentaAnular", function(){

var tipo=$(this);

  swal({
		title: '¿Está seguro de Anular la venta?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, anular venta!'
	  }).then(function(result){
		if (result.value) {
		  
			
			var idVentaHabilitarAnular = tipo.attr("idVentaHabilitarAnular");
			var estadoVentaAnular = tipo.attr("estadoVentaAnular");
			
			window.location = "index.php?ruta=ventas&idVentaHabilitarAnular="+idVentaHabilitarAnular;

			console.log('id venta: ',idVentaHabilitarAnular);
			console.log('estado venta: ',estadoVentaAnular);
	
	
	var datos = new FormData();
	datos.append("activarIdVenta", idVentaHabilitarAnular);
  	datos.append("activarVenta", estadoVentaAnular);
	  
  	$.ajax({
		  
		  url:"ajax/ventas.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){
		  
		console.log('Respesta actiuvar o no venta',respuesta);
	}
	
  	})
  	if(estadoVentaAnular == 1){
		  
  		tipo.removeClass('btn-success');
  		tipo.addClass('btn-danger');
  		tipo.html('Anulado');
  		tipo.attr('estadoVentaAnular',0);
		  
	}
	}

  })


})

/*=============================================
APROBAR VENTA
=============================================*/
$(".tablas").on("click", ".VentaAprobar", function(){

	var tipo=$(this);
	swal({
		title: '¿Está seguro de Aprobar la venta?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, aprobar venta!'
	  }).then(function(result){
		if (result.value) {
		  
			
			
	 var idVentaHabilitarAprobar = tipo.attr("idVentaHabilitarAprobar");
	var estadoVentaAprobar = tipo.attr("estadoVentaAprobar");

	console.log('id venta: ',idVentaHabilitarAprobar);
	console.log('estado venta: ',estadoVentaAprobar);
	
	var datos = new FormData();
	datos.append("activarIdVenta", idVentaHabilitarAprobar);
	  datos.append("activarVenta", estadoVentaAprobar);
	  
	  window.location = "index.php?ruta=ventas&idVentaHabilitarAprobar="+idVentaHabilitarAprobar; 
	  
  	$.ajax({
		  
		  url:"ajax/ventas.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){
		  
		console.log('Respesta actiuvar o no venta',respuesta);
	  
		if(estadoVentaAprobar == 0){
			
		  tipo.removeClass('btn-success');
		  tipo.addClass('btn-danger');
		  tipo.html('Anulado');
		  tipo.attr('estadoVentaAprobar',1);
			
	  }
	}
	
	  })
	  
	 
	}

  })

})
 
 