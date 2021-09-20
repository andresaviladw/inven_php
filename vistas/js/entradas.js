


/*=============================================
CARGAR LA TABLA DINÁMICA DE ENTRADAS
=============================================*/


$('.tablaEntradas').DataTable( {
  "ajax": "ajax/datatable-entradas.ajax.php",
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

$( document ).ready(function() {
  $("#nuevoImpuestoEntradaTotal").number(true, 2);
})
    


var numentradas=0;

  

$(".tablaEntradas tbody").on("click", "button.agregarProductoEntrada", function(){

  numentradas++;

    //Se captura el Id del producto a agregar
    var idProducto = $(this).attr("idProducto");
    
    console.log('idProducto',idProducto);

    //Se remueve la clase de agregar Producto y el boton de color azul
    $(this).removeClass("btn-primary agregarProductoEntrada");

    //Se anade la clase de del boton plomo para sabe que ya ha sido agregado el producto
    $(this).addClass("btn-default");
    

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

            console.log('res;uesta para algo',respuesta);
            var idP = respuesta["id"];
            var idProducto = respuesta["codigo"];
            var descripcion = respuesta["descripcion"];
          	var stock = Number(respuesta["stock"]);
              var precio = respuesta["precio_compra"];

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
			

			
              
              $(".nuevoProductoEntrada").append(

               

                '<div class="row" style="padding:5px 15px">'+
  
                '<!-- Descripción del producto -->'+
                
                '<div class="col-xs-6" style="padding-right:0px">'+
                
                  '<div class="input-group">'+
                    
                    '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProductoEntrada" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+
                    
  
                    '<input type="text" class="form-control nuevaDescripcionProductoEntrada" idProducto="'+idProducto+'" name="agregarProductoEntrada" value="'+descripcion+'" readonly required>'+
                    '<input type="hidden" class="form-control nuevaIdProductoEntrada" idProducto="'+idProducto+'" name="agregarProductoEntrada" value="'+idP+'" readonly required>'+
  
                  '</div>'+
  
                '</div>' +


                '<!-- Cantidad del producto -->'+
  
                '<div class="col-xs-3">'+
                  
                   '<input type="number" class="form-control nuevaCantidadProductoEntrada" name="nuevaCantidadProductoEntrada" min="1" value="1" stock="'+stock+'" nuevoStock="'+(stock+1)+'" step="any" required>'+
                   
  
                '</div>' +
                
  
                '<!-- Precio del producto -->'+
  
                '<div class="col-xs-3 ingresoPrecioEntrada" style="padding-left:0px">'+
  
                  '<div class="input-group">'+
  
                    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                       
                    '<input type="text" class="form-control nuevoPrecioProductoEntrada" precioReal="'+precio+'"  name="nuevoPrecioProductoEntrada" value="'+precio+'" readonly required>'+
                    
                    '<input type="hidden" class="form-control impuestoValorAsignado" id="impuestoValor'+numentradas+'"  readonly required>'+

                    '<input type="hidden" class="form-control nuevoPrecioReal" name="nuevoPrecioReal" value="'+precio+'" readonly required>'+

                    '<input type="hidden" class="form-control nuevoImpuestoEntrada" id="impuestoentrada'+numentradas+'"  name="nuevoImpuestoEntrada[]" readonly required>'+
                    '<input type="hidden" class="form-control nuevoImpuestoAcumuladoEntrada"  name="nuevoImpuestoAcumuladoEntrada[]" id="impuestoentradaAcumulado'+numentradas+'" readonly required>'+
       
                  '</div>'+
                  
                  '</div>'+
                   
                '</div>'+
  
              '</div>')

              $.each(respuestaImpuesto, function(i, item) {
			
				

                $("#impuestoValor"+numentradas).attr("value",item.valor);
              
                var impuesto=precio*item.valor;

                var impuestoFinal=impuesto/100;

              

              $("#nuevoPrecioProductoEntradas"+numentradas).attr("value",impuestoFinal);
              $("#impuestoentrada"+numentradas).attr("value",impuestoFinal);
              $("#impuestoentradaAcumulado"+numentradas).attr("value",impuestoFinal);
                 
              })
              

              // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

              $(".nuevoPrecioProductoEntrada").number(true, 4);
              /*=============================================
              FORMATO AL PRECIO FINAL
              =============================================*/

              $("#nuevoTotalEntrada").number(true, 2);
              $(".nuevoImpuestoAcumuladoEntrada").number(true, 2);
              $(".nuevoImpuestoEntrada").number(true, 4);
              $(".nuevoPrecioReal").number(true, 4);
              $("#nuevoSubTotalEntrada").number(true, 2);
              $("#nuevoImpuestoEntradaTotal").number(true, 2);
              /* Suma de los impuestos */

              sumarTotalPreciosImpuestos();

              /* Suma de todos los precios */
              
              sumarTotalPreciosEntradas();

              /* Suma total */
              
              sumarTotal();



              agregarTotalEntrada();
              
              // AGRUPAR PRODUCTOS EN FORMATO JSON

              listarProductosEntrada();
            
         }   
})
         }   
})

})


/*=============================================
CUANDO SE CARGUE EN LA TABLA Y SE NAVEGUE EN LA MISMA
=============================================*/

var idQuitarProductoEntrada=[];

//Se elimina el item cada vez que se carga la pagina
localStorage.removeItem("quitarProductoEntrada");


$('.tablaEntradas').on('draw.dt',function(){

  console.log('Se navenga en la tabla');

  //Si existe en la tabla un registro diferente de nulo entonces ...
  if(localStorage.getItem('quitarProductoEntrada')!=null){


    var listaIdProductos=JSON.parse(localStorage.getItem('quitarProductoEntrada'));

    for (var i = 0; i < listaIdProductos.length; i++) {
      
      //Marca el boton plomo para cuando se agrega un producti al formulario entrada 
      $("button.recuperarBotonEntrada[idProducto='"+idProducto+"']").removeClass('btn-default');


      //Marca el boton plomo para cuando se quita un producti al formulario entrada 
      $("button.recuperarBotonEntrada[idProducto='"+idProducto+"']").addClass('btn-primary agregarProductoEntrada');
      
    }


  }


});



/*=============================================
QUITAR PRODUCTOS DE LA ENTRADA Y RECUPERAR BOTÓN
=============================================*/



$(".formularioEntrada").on("click", "button.quitarProductoEntrada", function(){

  console.log('Formulario entrada click');

  //Borra el boton o lo que aparece en el fromularioEntrada
$(this).parent().parent().parent().parent().remove();


//Se captura el idProducto
var idProducto=$(this).attr("idProducto");

//ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR, SE QUEDA GRABADO AL CAMBIAR LA PAGINACION

if(localStorage.getItem('quitarProductoEntrada')==null){
  idQuitarProductoEntrada=[];
}else{
  idQuitarProductoEntrada.concat(localStorage.getItem("quitarProductoEntrada"));
}

idQuitarProductoEntrada.push({'idProducto':idProducto});

localStorage.setItem('quitarProductoEntrada',JSON.stringify(idQuitarProductoEntrada));



//Marca el boton plomo para cuando se agrega un producti al formulario entrada 
$("button.recuperarBotonEntrada[idProducto='"+idProducto+"']").removeClass('btn-default');


//Marca el boton plomo para cuando se quita un producti al formulario entrada 
$("button.recuperarBotonEntrada[idProducto='"+idProducto+"']").addClass('btn-primary agregarProductoEntrada');

if ($('.nuevoProductoEntrada').children().length==0) {
  $('#nuevoTotalEntrada').val(0);
  $('#nuevoImpuestoEntradaTotal').val(0);
  $('#nuevoSubTotalEntrada').val(0);
}else{
  sumarTotalPreciosEntradas();

  /* Suma de los impuestos */

  sumarTotalPreciosImpuestos();

              /* Suma total */
              
              sumarTotal();



  
              
  
  agregarTotalEntrada();

  // AGRUPAR PRODUCTOS EN FORMATO JSON

listarProductosEntrada();
}

})







$('#fecha_emision_entrada').daterangepicker({
"singleDatePicker": true,
	"locale": {
		"format": "YYYY/MM/DD",
	}
   
});

$('#fecha_vencimiento_entrada').daterangepicker({
	"singleDatePicker": true,
	"locale": {
		"format": "YYYY/MM/DD",
	}
	
});

$(".formularioEntrada").on("change", "input.nuevaCantidadProductoEntrada", function(){

  
              // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

              $(".nuevoPrecioProductoEntrada").number(true, 4);
              /*=============================================
              FORMATO AL PRECIO FINAL
              =============================================*/

              $("#nuevoTotalEntrada").number(true, 2);
              $(".nuevoImpuestoAcumuladoEntrada").number(true, 2);
              $(".nuevoImpuestoEntrada").number(true, 4);
              $(".nuevoPrecioReal").number(true, 4);
              $("#nuevoSubTotalEntrada").number(true, 2);
              $("#nuevoImpuestoEntradaTotal").number(true, 2);
              
  console.log('cantidad',$(this).val());
  var precio=$(this).parent().parent().children('.ingresoPrecioEntrada').children().children('.nuevoPrecioProductoEntrada');
 
  var impuestoAcumulado=$(this).parent().parent().children('.ingresoPrecioEntrada').children().children('.nuevoImpuestoAcumuladoEntrada');

  
  


  var resultadoImpuesto=$(this).parent().parent().children('.ingresoPrecioEntrada').children().children('.nuevoImpuestoEntrada').val();

  console.log(`Precio: ${precio.val()}, Impuesto Acumulado: ${impuestoAcumulado.val()}, resltado impuesto: ${resultadoImpuesto}`);
  


  /* Calculo de Impuesto */

impuestoAcumulado.val(resultadoImpuesto*$(this).val());

  
  //Calcula la cantidad segun ingrese 
  var precioFinal=$(this).val()*precio.attr('precioReal');

  precio.val(precioFinal);

  
  

  var nuevoStock = Number($(this).attr("stock")) + Number($(this).val());

	$(this).attr("nuevoStock", nuevoStock);
  
  sumarTotalPreciosEntradas();


  
              /* Suma de los impuestos */

              sumarTotalPreciosImpuestos();

              
              /* Suma total */
              
              sumarTotal();


  
  agregarTotalEntrada();
  // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductosEntrada();

  
})




/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPreciosEntradas(){
  var precioItem=$('.nuevoPrecioProductoEntrada');


  var arraySumarPrecio=[];

  for (var i = 0; i < precioItem.length; i++) {

    //Se almacena en el array con la funcion Number para que nos e una como un strig
    arraySumarPrecio.push(Number($(precioItem[i]).val()));
    
  }

  function sumarTotalArrayPrecios(totales,numeros){
    return totales+numeros;
  }

  var sumarTotalDePrecios=arraySumarPrecio.reduce(sumarTotalArrayPrecios);

 
  console.log('Suma total de los precios ',sumarTotalDePrecios);
  

  $('#nuevoSubTotalEntrada').val(sumarTotalDePrecios);

  $("#nuevoSubTotalEntrada").attr("subtotal",sumarTotalDePrecios);
  
}

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotal(){
  

 var subtotal = $('#nuevoSubTotalEntrada').val();
 var impuesto = $('#nuevoImpuestoEntradaTotal').val();

 console.log('impuesto',impuesto);
 console.log('subtotal',subtotal);
 

  var total=Number(subtotal)+Number(impuesto);
 $('#nuevoTotalEntrada').val(total);

 console.log('Suma total',total);
   
}

/*=============================================
SUMA PARA IMPUESTO
=============================================*/

function sumarTotalPreciosImpuestos(){
  var precioItem=$('.nuevoImpuestoAcumuladoEntrada');

  var arraySumarPrecio=[];

  for (var i = 0; i < precioItem.length; i++) {

    //Se almacena en el array con la funcion Number para que nos e una como un strig
    arraySumarPrecio.push(Number($(precioItem[i]).val()));
    
  }

  function sumarTotalArrayPrecios(totales,numeros){
    return totales+numeros;
  }

  var sumarTotalDePrecios=arraySumarPrecio.reduce(sumarTotalArrayPrecios);

 
  console.log('Suma total de los impuestos ',sumarTotalDePrecios);

  $('#nuevoImpuestoEntradaTotal').val(sumarTotalDePrecios);
  
  


  
}




/*=============================================
TOTAL PRECIO DE TODOS LOS PRODUCTOS EN ENTRADA
=============================================*/

function agregarTotalEntrada(){
  var precioTotal=$('#nuevoTotalEntrada').val();

  console.log('Total a almacenar',precioTotal);
  

  

 $('#totalEntrada').val(precioTotal);


}


/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductosEntrada(){

	var listaProductos = [];

  var id = $(".nuevaIdProductoEntrada");
  var descripcion = $(".nuevaDescripcionProductoEntrada");
  
	var cantidad = $(".nuevaCantidadProductoEntrada");

  var precio = $(".nuevoPrecioReal");
  
  var valorUnitario = $(".nuevoPrecioProductoEntrada");
   
  var valorImpuesto = $(".impuestoValorAsignado");
      
  var impuesto = $(".nuevoImpuestoEntrada");

      
  var impuestoTotal = $(".nuevoImpuestoAcumuladoEntrada");

	for(var i = 0; i < descripcion.length; i++){

		listaProductos.push({ 
                "id" : $(id[i]).val(), 
              "codigo" : $(descripcion[i]).attr("idProducto"), 
                "descripcion" : $(descripcion[i]).val(),
                "cantidad" : $(cantidad[i]).val(),
                "stock" : $(cantidad[i]).attr("nuevoStock"),
                "precio" : $(precio[i]).val(),
                "impuesto" : $(impuesto[i]).val(),
                "valorImpuesto" : $(valorImpuesto[i]).val(),
                "impuestoTotal" : $(impuestoTotal[i]).val(),
							  "total" : $(valorUnitario[i]).val()})

  }
  
  console.log('Listado de productos',listaProductos);
  
  console.log('Lista en cadena de texto',JSON.stringify(listaProductos));
  

	$("#listaProductosEntrada").val(JSON.stringify(listaProductos)); 

}

/*=============================================
BOTON EDITAR ENTRADA
=============================================*/
$(".tablas").on("click", ".btnEditarEntrada", function(){

	var idEntrada = $(this).attr("idEntrada");

  window.location = "index.php?ruta=editar-entrada&idEntrada="+idEntrada;
})

/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitaragregarProductoEntrada(){

	//Capturamos todos los id de productos que fueron elegidos en la venta
	var idProductos = $(".quitarProductoEntrada");

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaEntradas tbody button.agregarProductoEntrada");

	//Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
	for(var i = 0; i < idProductos.length; i++){

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(idProductos[i]).attr("idProducto");
		
		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for(var j = 0; j < botonesTabla.length; j ++){

			if($(botonesTabla[j]).attr("idProducto") == boton){

				$(botonesTabla[j]).removeClass("btn-primary agregarProductoEntrada");
				$(botonesTabla[j]).addClass("btn-default");

			}
		}

	}
	
}


/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaEntradas").on("draw.dt", function(){

	if(localStorage.getItem("quitarProductoEntrada") != null){

		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProductoEntrada"));

		for(var i = 0; i < listaIdProductos.length; i++){

			$("button.recuperarBotonEntrada[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBotonEntrada[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProductoEntrada');

		}


	}


})

$('.tablaEntradas').on( 'draw.dt', function(){

	quitaragregarProductoEntrada();

})

/*=============================================
RANGO DE FECHAS
=============================================*/

$('#daterange-btn-entradas').daterangepicker(
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
    $('#daterange-btn-entradas span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

		//Incio de la fecha y se cambia el formato al de la base de datos
    var fechaInicial = start.format('YYYY-MM-DD');
		
		//""
    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#daterange-btn-entradas span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=gestionar-entradas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "gestionar-entradas";
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

    	window.location = "index.php?ruta=gestionar-entradas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})

	
/*=============================================
ANULAR VENTA
=============================================*/
$(".tablas").on("click", ".EntradaAnular", function(){

  var tipo=$(this);
  
    swal({
      title: '¿Está seguro de Anular la entrada?',
      text: "¡Si no lo está puede cancelar la accíón!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, anular entrada!'
      }).then(function(result){
      if (result.value) {
        
        
        var idEntradaHabilitarAnular = tipo.attr("idEntradaHabilitarAnular");
        var estadoEntradaAnular = tipo.attr("estadoEntradaAnular");
        
        window.location = "index.php?ruta=gestionar-entradas&idEntradaHabilitarAnular="+idEntradaHabilitarAnular;
  
        console.log('id venta: ',idEntradaHabilitarAnular);
        console.log('estado venta: ',estadoEntradaAnular);
    
    
    var datos = new FormData();
    datos.append("activarIdEntrada", idEntradaHabilitarAnular);
      datos.append("activarEntrada", estadoEntradaAnular);
      
      $.ajax({
        
        url:"ajax/entradas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
        
      console.log('Activar o no entradas',respuesta);
    }
    
      })
      if(estadoEntradaAnular == 1){
        
        tipo.removeClass('btn-success');
        tipo.addClass('btn-danger');
        tipo.html('Anulado');
        tipo.attr('estadoEntradaAnular',0);
        
    }
    }
  
    })
  
  
  })
  
  /*=============================================
  APROBAR VENTA
  =============================================*/
  $(".tablas").on("click", ".EntradaAprobar", function(){
  
    var tipo=$(this);
    swal({
      title: '¿Está seguro de Aprobar la entrada?',
      text: "¡Si no lo está puede cancelar la accíón!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, aprobar entrada!'
      }).then(function(result){
      if (result.value) {
        
        
        
     var idEntradaHabilitarAprobar = tipo.attr("idEntradaHabilitarAprobar");
    var estadoEntradaAprobar = tipo.attr("estadoEntradaAprobar");
  
    console.log('id venta: ',idEntradaHabilitarAprobar);
    console.log('estado venta: ',estadoEntradaAprobar);
    
    var datos = new FormData();
    datos.append("activarIdEntrada", idEntradaHabilitarAprobar);
      datos.append("activarEntrada", estadoEntradaAprobar);
      
      window.location = "index.php?ruta=gestionar-entradas&idEntradaHabilitarAprobar="+idEntradaHabilitarAprobar; 
      
      $.ajax({
        
        url:"ajax/entradas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
        
      console.log('Activar o no entrada',respuesta);
      
      if(estadoEntradaAprobar == 0){
        
        tipo.removeClass('btn-success');
        tipo.addClass('btn-danger');
        tipo.html('Anulado');
        tipo.attr('estadoEntradaAprobar',1);
        
      }
    }
    
      })
      
     
    }
  
    })
  
  })
   
   