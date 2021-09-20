/*=============================================
CARGAR LA TABLA DINÁMICA DE AUTOCONSUMOS
=============================================*/


$('.tablaAutoconsumos').DataTable( {
    "ajax": "ajax/datatable-autoconsumos.ajax.php",
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
      
  
  
  var numautoconsumos=0;
  
    
  
  $(".tablaAutoconsumos tbody").on("click", "button.agregarProductoAutoconsumo", function(){
  
    numautoconsumos++;
  
      //Se captura el Id del producto a agregar
      var idProducto = $(this).attr("idProducto");
      
      console.log('idProducto',idProducto);
  
      //Se remueve la clase de agregar Producto y el boton de color azul
      $(this).removeClass("btn-primary agregarProductoAutoconsumo");
  
      //Se anade la clase de del boton plomo para sabe que ya ha sido agregado el producto
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
  
              console.log(respuesta);
              var idProducto = respuesta["id"];
              var codigo = respuesta["codigo"];
              var descripcion = respuesta["descripcion"];
                var stock = Number(respuesta["stock"]);
                var precio = respuesta["precio_compra"];
  
                
            /*=============================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	=============================================*/

          	if(stock == 0){

              swal({
              title: "No hay stock disponible",
              type: "error",
              confirmButtonText: "¡Cerrar!"
            });
  
            $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProductoAutoconsumo");
  
            return;
  
          }
                $(".nuevoProductoAutoconsumo").append(
  
                 
  
                  '<div class="row" style="padding:5px 15px">'+
    
                  '<!-- Descripción del producto -->'+
                  
                  '<div class="col-xs-6" style="padding-right:0px">'+
                  
                    '<div class="input-group">'+
                      
                      '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProductoAutonconsumo" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+
                      
    
                      '<input type="text" class="form-control nuevaDescripcionProductoAutoconsumo" idProducto="'+idProducto+'" name="agregarProductoAutoconsumo" value="'+descripcion+'" readonly required>'+
    
                      '<input type="text" class="form-control nuevoCodigoProductoAutoconsumo" idProducto="'+idProducto+'" name="agregarProductoAutoconsumo" value="'+codigo+'" readonly required>'+
    
                    '</div>'+
    
                  '</div>' +
  
  
                  '<!-- Cantidad del producto -->'+
    
                  '<div class="col-xs-3">'+
                    
                     '<input type="number" class="form-control nuevaCantidadProductoAutoconsumo" name="nuevaCantidadProductoAutoconsumo" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" step="any" required>'+
                     
    
                  '</div>' +
                  
    
                  '<!-- Precio del producto -->'+
    
                  '<div class="col-xs-3 ingresoPrecioAutoconsumo" style="padding-left:0px">'+
    
                    '<div class="input-group">'+
    
                      '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                         
                      '<input type="text" class="form-control nuevoPrecioProductoAutoconsumo" precioReal="'+precio+'"  name="nuevoPrecioProductoAutoconsumo" value="'+precio+'" readonly required>'+
                      

         
                    '</div>'+
                     

                  '</div>'+


                  '<!-- Motivo autoproducto -->'+
    
                  '<div class="col-xs-12 ingresoMotivo" style="padding-left:15px">'+
                  '<div>'+
                        
                         
                      '<input type="text" class="form-control nuevoMotivoAutoconsumo" name="nuevoMotivoAutoconsumo"  required>'+
                      

                     

                  '</div>'+

                  
                  
    
                '</div>')

                $(".nuevoPrecioProductoAutoconsumo").number(true, 4);
                $("#nuevoTotalAutoconsumo").number(true, 2);
    
  
                  // AGRUPAR PRODUCTOS EN FORMATO JSON
  
                  listarProductosAutoconsumo();
                
               
  
                /* Suma de todos los precios */
                
                sumarTotalPreciosAutoconsumos(); 
              
           }   
  })
          
  
  })


  // PONER FORMATO AL PRECIO DE LOS PRODUCTOS
  
 
  

  $('#fecha_emision_autoconsumo').daterangepicker({
    "singleDatePicker": true,
    "locale": {
      "format": "YYYY/MM/DD",
    }
     
  });
  
  /*=============================================
  CUANDO SE CARGUE EN LA TABLA Y SE NAVEGUE EN LA MISMA
  =============================================*/
  
  var idQuitarProductoAutonconsumo=[];
  
  //Se elimina el item cada vez que se carga la pagina
  localStorage.removeItem("quitarProductoAutonconsumo");
  
  
  $('.tablaAutoconsumos').on('draw.dt',function(){
  
    console.log('Se navenga en la tabla');
  
    //Si existe en la tabla un registro diferente de nulo entonces ...
    if(localStorage.getItem('quitarProductoAutonconsumo')!=null){
  
  
      var listaIdProductos=JSON.parse(localStorage.getItem('quitarProductoAutonconsumo'));
  
      for (var i = 0; i < listaIdProductos.length; i++) {
        
        //Marca el boton plomo para cuando se agrega un producti al formulario autoconsumo 
        $("button.recuperarBotonAutoconsumo[idProducto='"+idProducto+"']").removeClass('btn-default');
  
  
        //Marca el boton plomo para cuando se quita un producti al formulario autoconsumo 
        $("button.recuperarBotonAutoconsumo[idProducto='"+idProducto+"']").addClass('btn-primary agregarProductoAutoconsumo');
        
      }
  
  
    }
  
  
  });
  
  
  
  /*=============================================
  QUITAR PRODUCTOS DE LA ENTRADA Y RECUPERAR BOTÓN
  =============================================*/
  
  
  
  $(".formularioAutoconsumo").on("click", "button.quitarProductoAutonconsumo", function(){
  
    console.log('Formulario entrada click');
  
    //Borra el boton o lo que aparece en el fromularioEntrada
  $(this).parent().parent().parent().parent().remove();
  
  
  //Se captura el idProducto
  var idProducto=$(this).attr("idProducto");
  
  //ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR, SE QUEDA GRABADO AL CAMBIAR LA PAGINACION
  
  if(localStorage.getItem('quitarProductoAutonconsumo')==null){
    idQuitarProductoAutonconsumo=[];
  }else{
    idQuitarProductoAutonconsumo.concat(localStorage.getItem("quitarProductoAutonconsumo"));
  }
  
  idQuitarProductoAutonconsumo.push({'idProducto':idProducto});
  
  localStorage.setItem('quitarProductoAutonconsumo',JSON.stringify(idQuitarProductoAutonconsumo));
  
  
  
  //Marca el boton plomo para cuando se agrega un producti al formulario entrada 
  $("button.recuperarBotonAutoconsumo[idProducto='"+idProducto+"']").removeClass('btn-default');
  
  
  //Marca el boton plomo para cuando se quita un producti al formulario entrada 
  $("button.recuperarBotonAutoconsumo[idProducto='"+idProducto+"']").addClass('btn-primary agregarProductoAutoconsumo');
  
  if ($('.nuevoProductoEntrada').children().length==0) {
    $('#nuevoTotalAutoconsumo').val(0);
   
  }else{
    
  
    // AGRUPAR PRODUCTOS EN FORMATO JSON


  
  listarProductosAutoconsumo();


  sumarTotalPreciosAutoconsumos();
  }
  
  })
  
  $('#fecha_emision_autoconsumo').daterangepicker({
      "singleDatePicker": true,
      "locale": {
          "format": "YYYY/MM/DD",
      }
     
  });
  

  
  $(".formularioAutoconsumo").on("change", "input.nuevaCantidadProductoAutoconsumo", function(){
    
  
    var precio=$(this).parent().parent().children('.ingresoPrecioAutoconsumo').children().children('.nuevoPrecioProductoAutoconsumo');
  
  
    var precio2=$(this).parent().parent().parent().children('.ingresoPrecioAutoconsumo').children().children('.nuevoPrecioProductoAutoconsumo');

  
  

  
    console.log('precio 1',precio);
    console.log('precio 2',precio2);
    
    
    //Calcula la cantidad segun ingrese 
    var precioFinal=$(this).val()*precio.attr('precioReal');
    var precioFinal1=$(this).val()*precio2.attr('precioReal');
  
    precio.val(precioFinal);

    precio2.val(precioFinal1);



    // AGRUPAR PRODUCTOS EN FORMATO JSON


  
  listarProductosAutoconsumo();


  sumarTotalPreciosAutoconsumos();
  
    var nuevoStock = Number($(this).attr("stock")) - Number($(this).val());

    console.log('Stock a guardar',nuevoStock);
    
  
      $(this).attr("nuevoStock", nuevoStock);

      if(Number($(this).val()) > Number($(this).attr("stock"))){
	
        /*=============================================
        SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
        =============================================*/
    
        $(this).val(0);
        
      
    
    
        $(this).attr("nuevoStock", $(this).attr("stock"));
    
        var precioFinal = $(this).val() * precio;
        var precioFinal2 = $(this).val() * precio2;


    
        precio.val(precioFinal);

        precio2.val(precioFinal2);

        listarProductosAutoconsumo();


        sumarTotalPreciosAutoconsumos();
  
        
  
    
        swal({
          title: "La cantidad supera el Stock",
          text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });
    
        return;

        listarProductosAutoconsumo();


        sumarTotalPreciosAutoconsumos();
    
    
  
      }
  })
  
  /*=============================================
  CUANDO CAMBIA el motivo
  =============================================*/
  $(".formularioAutoconsumo").on("change", ".nuevoMotivoAutoconsumo", function(){
  
    console.log('cambio de motivo');
    
    listarProductosAutoconsumo();
  
  });
  
  
  
  /*=============================================
  SUMAR TODOS LOS PRECIOS
  =============================================*/
  
  function sumarTotalPreciosAutoconsumos(){
    var precioItem=$('.nuevoPrecioProductoAutoconsumo');
  
  
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
    
  
    $('#nuevoTotalAutoconsumo').val(sumarTotalDePrecios);
  
 
    
  }
 
  
  
  /*=============================================
  LISTAR TODOS LOS PRODUCTOS
  =============================================*/
  
  function listarProductosAutoconsumo(){
  
      var listaProductosAutoconsumo = [];
  
    var descripcion = $(".nuevaDescripcionProductoAutoconsumo");

    var codigo = $(".nuevoCodigoProductoAutoconsumo");
    
      var cantidad = $(".nuevaCantidadProductoAutoconsumo");
  
      var motivo = $(".nuevoMotivoAutoconsumo");

      var precio = $(".nuevoPrecioProductoAutoconsumo");

  
      for(var i = 0; i < descripcion.length; i++){
  
          listaProductosAutoconsumo.push({ "id" : $(descripcion[i]).attr("idProducto"), 
                  "codigo" : $(codigo[i]).val(),
                  "descripcion" : $(descripcion[i]).val(),
                                "cantidad" : $(cantidad[i]).val(),
                                "motivo" : $(motivo[i]).val(),
                                "stock" : $(cantidad[i]).attr("nuevoStock"),
                                "precio" : $(precio[i]).attr("precioReal"),
                                "total" : $(precio[i]).val()
                                
                              })
  
    }
    
    console.log('Listado de productos',listaProductosAutoconsumo);
    
    console.log('Lista en cadena de texto',JSON.stringify(listaProductosAutoconsumo));
    
  
      $("#listaProductosAutoconsumo").val(JSON.stringify(listaProductosAutoconsumo)); 
  
  }
  
  /*=============================================
  BOTON EDITAR AUTOCONSUMOS
  =============================================*/
  $(".tablas").on("click", ".btnEditarAutoconsumo", function(){
  
      var idAutoconsumo = $(this).attr("idAutoconsumo");
  
    window.location = "index.php?ruta=editar-autoconsumo&idAutoconsumo="+idAutoconsumo;
  })
  
  /*=============================================
  FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
  =============================================*/
  
  function quitaragregarProductoAutoconsumo(){
  
      //Capturamos todos los id de productos que fueron elegidos en la autoconsumo
      var idProductos = $(".quitarProductoAutonconsumo");
  
      //Capturamos todos los botones de agregar que aparecen en la tabla
      var botonesTabla = $(".tablaAutoconsumos tbody button.agregarProductoAutoconsumo");
  
      //Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la autoconsumo
      for(var i = 0; i < idProductos.length; i++){
  
          //Capturamos los Id de los productos agregados a la autoconsumo
          var boton = $(idProductos[i]).attr("idProducto");
          
          //Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
          for(var j = 0; j < botonesTabla.length; j ++){
  
              if($(botonesTabla[j]).attr("idProducto") == boton){
  
                  $(botonesTabla[j]).removeClass("btn-primary agregarProductoAutoconsumo");
                  $(botonesTabla[j]).addClass("btn-default");
  
              }
          }
  
      }
      
  }
  
  
  /*=============================================
  CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
  =============================================*/
  
  $(".tablaAutoconsumos").on("draw.dt", function(){
  
      if(localStorage.getItem("quitarProductoAutonconsumo") != null){
  
          var listaIdProductos = JSON.parse(localStorage.getItem("quitarProductoAutonconsumo"));
  
          for(var i = 0; i < listaIdProductos.length; i++){
  
              $("button.recuperarBotonAutoconsumo[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
              $("button.recuperarBotonAutoconsumo[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProductoAutoconsumo');
  
          }
  
  
      }
  
  
  })
  
  $('.tablaAutoconsumos').on( 'draw.dt', function(){
  
      quitaragregarProductoAutoconsumo();
  
  })
  
  /*=============================================
  RANGO DE FECHAS
  =============================================*/
  
  $('#daterange-btn-autoconsumo').daterangepicker(
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
  
         window.location = "index.php?ruta=autoconsumos&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
  
    }
  
  )
  
  /*=============================================
  CANCELAR RANGO DE FECHAS
  =============================================*/
  
  $(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){
  
      localStorage.removeItem("capturarRango");
      localStorage.clear();
      window.location = "autoconsumos";
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
  
          window.location = "index.php?ruta=autoconsumos&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
  
      }
  
  })
  
      
  /*=============================================
  ANULAR autoconsumo
  =============================================*/
  $(".tablas").on("click", ".AutoconsumoAnular", function(){
  
    var tipo=$(this);
    
      swal({
        title: '¿Está seguro de Anular el autoconsumo?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, anular el autoconsumo!'
        }).then(function(result){
        if (result.value) {
          
          
          var idAutoconsumoHabilitarAnular = tipo.attr("idAutoconsumoHabilitarAnular");
          var estadoAutoconsumoAnular = tipo.attr("estadoAutoconsumoAnular");
          
          window.location = "index.php?ruta=autoconsumos&idAutoconsumoHabilitarAnular="+idAutoconsumoHabilitarAnular;
    
          console.log('id autoconsumo: ',idAutoconsumoHabilitarAnular);
          console.log('estado autoconsumo: ',estadoAutoconsumoAnular);
      
      
      var datos = new FormData();
      datos.append("activarIdAutoconsumo", idAutoconsumoHabilitarAnular);
        datos.append("activarAutoconsumo", estadoAutoconsumoAnular);
        
        $.ajax({
          
          url:"ajax/autoconsumos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
          contentType: false,
          processData: false,
          success: function(respuesta){
          
        console.log('Activar o no entradas',respuesta);
      }
      
        })
        if(estadoAutoconsumoAnular == 1){
          
          tipo.removeClass('btn-success');
          tipo.addClass('btn-danger');
          tipo.html('Anulado');
          tipo.attr('estadoAutoconsumoAnular',0);
          
      }
      }
    
      })
    
    
    })
    
    /*=============================================
    APROBAR autoconsumo
    =============================================*/
    $(".tablas").on("click", ".AutoconsumoAprobar", function(){
    
      var tipo=$(this);
      swal({
        title: '¿Está seguro de Aprobar el autoconsumo?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, aprobar autoconsumo!'
        }).then(function(result){
        if (result.value) {
          
          
          
       var idAutoconsumoHabilitarAprobar = tipo.attr("idAutoconsumoHabilitarAprobar");
      var estadoAutoconsumoAprobar = tipo.attr("estadoAutoconsumoAprobar");
    
      console.log('id autoconsumo: ',idAutoconsumoHabilitarAprobar);
      console.log('estado autoconsumo: ',estadoAutoconsumoAprobar);
      
      var datos = new FormData();
      datos.append("activarIdAutoconsumo", idAutoconsumoHabilitarAprobar);
        datos.append("activarAutoconsumo", estadoAutoconsumoAprobar);
        
        window.location = "index.php?ruta=autoconsumos&idAutoconsumoHabilitarAprobar="+idAutoconsumoHabilitarAprobar; 
        
        $.ajax({
          
          url:"ajax/autoconsumos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
          contentType: false,
          processData: false,
          success: function(respuesta){
          
        console.log('Activar o no entrada',respuesta);
        
        if(estadoAutoconsumoAprobar == 0){
          
          tipo.removeClass('btn-success');
          tipo.addClass('btn-danger');
          tipo.html('Anulado');
          tipo.attr('estadoAutoconsumoAprobar',1);
          
        }
      }
      
        })
        
       
      }
    
      })
    
    })
     
     