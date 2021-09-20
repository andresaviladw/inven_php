window.onload= function() {
  $(".subtotalImportar").number(true, 2);
  $(".impuestoImportar").number(true, 2);
  $(".subtotalImportar").hide();
  $(".impuestoImporte").number(true, 4);
  $(".impuestoValorTotal").number(true, 4);
  $(".impuestoImportar").hide();
  $(".totalImportar").hide();
  $(".subtotal").hide();
  $(".impuesto").hide();
  $(".total").hide();
  listarProductosImporteEntrada();


  

};


/*=============================================
SUMA PARA IMPUESTO
=============================================*/

function sumarSubtotal(){
  var subtotal=$('.valorUnitarioImporte');

  var arraySumarSubtotal=[];

  for (var i = 0; i < subtotal.length; i++) {

    //Se almacena en el array con la funcion Number para que nos e una como un strig
    arraySumarSubtotal.push(Number($(subtotal[i]).val()));
    
  }

  function sumarTotalArrayPrecios(totales,numeros){
    return totales+numeros;
  }

  var sumarTotalDeSubtotal=arraySumarSubtotal.reduce(sumarTotalArrayPrecios);

 
  console.log('Suma total del subtotal ',sumarTotalDeSubtotal);

  $('.subtotalImportar').val(sumarTotalDeSubtotal);

  
}
function sumarImpuesto(){
  var impuesto=$('.impuestoValorTotal');

  var arraySumarImpuesto=[];

  for (var i = 0; i < impuesto.length; i++) {

    //Se almacena en el array con la funcion Number para que nos e una como un strig
    arraySumarImpuesto.push(Number($(impuesto[i]).val()));
    
  }

  function sumarTotalArrayImpuesto(totales,numeros){
    return totales+numeros;
  }

  var sumarTotalDeImpuestos=arraySumarImpuesto.reduce(sumarTotalArrayImpuesto);

 
  console.log('Suma total del impuesto ',sumarTotalDeImpuestos);

  $('.impuestoImportar').val(sumarTotalDeImpuestos);

  
}
function sumarTotalImporte(){
 
  var subtotal = $('.subtotalImportar').val();
  var impuesto = $('.impuestoImportar').val();
 
  console.log('impuesto',impuesto);
  console.log('subtotal',subtotal);
  
 
    var total=Number(subtotal)+Number(impuesto);
  $('.totalImportar').val(total);
 
  console.log('Suma total',total);
  
}


/*=============================================
  LISTAR TODOS LOS PRODUCTOS
  =============================================*/
  
  function listarProductosImporteEntrada(){
  
      var listaImporteProductos = [];
  
    
      var id = $(".idEntradaImporte");

      var codigo = $(".codigoEntradaImporte");
    
      var descripcion = $(".descripcionEntradaImporte");
    
      var cantidad = $(".cantidadEntradaImporte");
  
      var precio = $(".precioImporte");

      var valorUnitario = $(".valorUnitarioImporte");
      var valorImpuesto = $(".impuestoEntradaImporte");
      var impuesto = $(".impuestoImporte");
      var impuestoTotal = $(".impuestoValorTotal");

    var valor=document.querySelectorAll(".cantidadEntradaImporte");


    for (var i = 0; i < valor.length; i++) {
      listaImporteProductos.push({ 
        "id" : $(id[i]).val(),
        "codigo" : $(codigo[i]).val(),
        "descripcion" : $(descripcion[i]).val(), 
        "cantidad" : $(cantidad[i]).val(),
        "precio" : $(precio[i]).val(),
        "impuesto" : $(impuesto[i]).val(),
        "valorImpuesto" : $(valorImpuesto[i]).val(),
        "impuestoTotal" : $(impuestoTotal[i]).val(),
        "total" : $(valorUnitario[i]).val()})

        
        
      
      }

      $("#listaProductosEntradaImporte").val(JSON.stringify(listaImporteProductos)); 
  }

  $("#Importe").on("click", function(e){
    e.preventDefault();
    listarProductosImporteEntrada();

    sumarSubtotal();
    sumarImpuesto();
    sumarTotalImporte();

    $(".subtotalImportar").show();
    $(".impuestoImportar").show();
    $(".totalImportar").show();
    $(".subtotal").show();
    $(".impuesto").show();
    $(".total").show();


    var id_responsableImportar=$('.id_responsableImportar').val();
    var id_proveedorImportar=$('.id_proveedorImportar').val();
    var id_documentoImportar=$('.id_documentoImportar').val();
    var codigoImportar=$('.codigoImportar').val();
    var secuenciaImportar=$('.secuenciaImportar').val();
    var establecimientoImportar=$('.establecimientoImportar').val();
    var puntoImportar=$('.puntoImportar').val();
    var comprobanteImportar=$('.secuenciaComprobante').val();
    var forma_cobroImportar=$('.forma_cobroImportar').val();
    var descripcionImportar=$('.descripcionImportar').val();
    var productosImportar=$('.productosImportar').val();
    var fechaImportar=$('.fechaImportar').val();
    var fecha_vencimientoImportar=$('.fecha_vencimientoImportar').val();
    var subtotalImportar=$('.subtotalImportar').val();
    var impuestoImportar=$('.impuestoImportar').val();
    var totalImportar=$('.totalImportar').val();

    var comprobante=establecimientoImportar+puntoImportar+comprobanteImportar;

    console.log('comprobante',comprobante);
    

    /* console.log(`Id responsable: ${id_responsableImportar}, 
    Codigo de proveedor: ${id_proveedorImportar}
    Id documento: ${id_documentoImportar}
    Codigo: ${codigoImportar}
    Secuencia: ${secuenciaImportar}
    comprobante: ${comprobante}
    Forma de cobro: ${forma_cobroImportar}
    Descripcion: ${descripcionImportar}
    Productos: ${productosImportar}
    Fecha de emision: ${fechaImportar}
    Fecha de vencimiento: ${fecha_vencimientoImportar}
    subtotal: ${subtotalImportar}
    impuesto: ${impuestoImportar}
    total: ${totalImportar}
    `); */

    


    
    

  
    var datos = new FormData();
      datos.append("id_responsable1", id_responsableImportar);
      datos.append("id_proveedor1", id_proveedorImportar);
      datos.append("id_documento1", id_documentoImportar);
      datos.append("codigo1", codigoImportar);
      datos.append("secuencia1", secuenciaImportar);
      datos.append("comprobante1", comprobante);
      datos.append("forma_cobro1", forma_cobroImportar);
      datos.append("descripcion1", descripcionImportar);
      datos.append("productos1", productosImportar);
      datos.append("fecha1", fechaImportar);
      datos.append("fecha_vencimiento1", fecha_vencimientoImportar);
      datos.append("subtotal1", subtotalImportar);
      datos.append("impuesto1", impuestoImportar);
      datos.append("total1", totalImportar);

     
      
  
      $.ajax({
  
      url:"ajax/importar-entradas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){

      

    
            setTimeout(function(){
          

              swal({
                  type: "success",
                  title: "La Entrada de productos ha sido guardada correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                  if (result.value) {
      
                    window.location = "gestionar-entradas";
      
                  }
                    
                    })
      
            
                  }, 3500);

        }
  
      }) 
  })
  