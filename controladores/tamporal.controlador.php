<?php



class ControladorTemporalKardex{


	
	/*=============================================
	EDITAR ENTRADA
	=============================================*/

	static public function ctrActualizarKardex(){

	if (isset($_POST['autoconsumodetalle']) && isset($_POST['entradadetalle']) && isset($_POST['ventadetalle'])) {
        # code...
    
        $tblentrada=$_POST['entradadetalle'];
        $tblautoconsumo=$_POST['autoconsumodetalle'];
        $tblventa=$_POST['ventadetalle'];
			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tablaEntradas = "entradas";

			$itemEntradas = null;
			$valorEntradas = null;

            $traerEntrada = ModeloEntradas::mdlMostrarEntradasKardex($tablaEntradas, $itemEntradas, $valorEntradas);

            
            

			$tablaAutoconsumos = "autoconsumos";

			$itemAutoconsumos = null;
			$valorAutoconsumos = null;

            $traerAutoconsumo = ModeloAutoconsumos::mdlMostrarAutoconsumosKardex($tablaAutoconsumos, $itemAutoconsumos, $valorAutoconsumos);
            

			$tablaVentas = "ventas";
			$itemVentas = null;
			$valorVentas = null;

            $traerVenta = ModeloVentas::mdlMostrarVentasKardex($tablaVentas, $itemVentas, $valorVentas);

          foreach ($traerEntrada as $key => $valueEntrada) {

            $productosEntradas=json_decode($valueEntrada["productos"], true);
            foreach ($productosEntradas as $key => $valueEntr) {
                
                
                $datosEntrada=array(
                   'id_entrada'=>$valueEntrada['id'],
                   'id_producto'=>$valueEntr['id'],
                   'codigo'=>$valueEntrada['codigo'],
                   'comprobante'=>$valueEntrada['comprobante'],
                   'secuencia'=>$valueEntrada['secuencia'],
                   'descripcion'=>$valueEntrada['descripcion'],
                   'fecha_emision'=>$valueEntrada['fecha_emision'],
                   'impuesto'=>$valueEntr['impuesto'],
                   'cantidad'=>$valueEntr['cantidad'],
                   'valor_impuesto'=>$valueEntr['valorImpuesto'],
                   'impuesto_total'=>$valueEntr['impuestoTotal'],
                   'total'=>$valueEntr['total']
                   
                );

                var_dump($datosEntrada);

                $actualizarEntrada = ModeloTemporalKardex::mdlActualizarEntradaAhora($tblentrada, $datosEntrada);

                var_dump($actualizarEntrada); 

                
             }

             /* if ($actualizarEntrada="ok") {
                echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "Las tablas han sido actualizadas correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "actualizar-tablas";

								}
							})

				</script>';
             } */
            
          
          }


          foreach ($traerAutoconsumo as $key => $valueAutoconsumo) {

            $productosAutoconsumo=json_decode($valueAutoconsumo["productos"], true);
            foreach ($productosAutoconsumo as $key => $valueAut) {

                $datosAutoconsumo=array(
                    'id_autoconsumo'=>$valueAutoconsumo['id'],
                    'id_producto'=>$valueAut['id'],
                    'codigo'=>$valueAutoconsumo['codigo'],
                    'descripcion'=>$valueAutoconsumo['descripcion'],
                    'cantidad'=>$valueAut['cantidad'],
                    'motivo'=>$valueAut['motivo'],
                    'total'=>$valueAut['total'],
                    'fecha_emision'=>$valueAutoconsumo['fecha_emision']
                );

               /*  var_dump($datosAutoconsumo); */

                $actualizarAutoconsumo = ModeloTemporalKardex::mdlActuallizarAutoconsumo($tblautoconsumo, $datosAutoconsumo);

                var_dump($actualizarAutoconsumo); 

                
          
             }
            
          
          }


          foreach ($traerVenta as $key => $valueVenta) {

            $productosVentas=json_decode($valueVenta["productos"], true);
            foreach ($productosVentas as $key => $valueVent) {

                $datosVenta=array(
                    'id_venta'=>$valueVenta['id'],
                    'descripcion'=>$valueVenta['descripcion'],
                    'id_producto'=>$valueVent['id'],
                    'codigo'=>$valueVenta['codigo'],
                    'cantidad'=>$valueVent['cantidad'],
                    'precio_venta'=>$valueVent['precio'],
                    'impuesto'=>$valueVent['impuesto'],
                    'valor_impuesto'=>$valueVent['valorImpuesto'],
                    'impuesto_total'=>$valueVent['impuestoTotal'],
                    'precioIva'=>$valueVent['precioIva'],
                    'precioSinIva'=>$valueVent['precioSinIva'],
                    'utilidad'=>$valueVent['utilidad'],
                    'utilidadTotal'=>$valueVent['utilidadTotal'],
                    'fecha_emision'=>$valueVenta['fecha_emision']
                    
                );

                var_dump($datosVenta);

                $actualizarVenta = ModeloTemporalKardex::mdlActualizarVentaA($tblventa, $datosVenta);

                var_dump($actualizarVenta); 

                
               
             }
          }

        }
	}

	

    static public function ctrTruncateKardex(){
        if (isset($_POST['autoconsumo']) && isset($_POST['entrada']) && isset($_POST['venta'])) {

            $tablaAutoconsumos=$_POST['autoconsumo'];
            $tablaEntradas=$_POST['entrada'];
            $tablaVentas=$_POST['venta'];

            $respuestaTruncate = ModeloTemporalKardex::mdlTruncarTabla($tablaAutoconsumos,$tablaEntradas,$tablaVentas);

            var_dump($respuestaTruncate);

            if ($respuestaTruncate=="ok") {
                echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "Las tablas han sido formateadas correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "actualizar-tablas";

								}
							})

				</script>';
            }else {
                echo'<script>
		
				swal({
					  type: "error",
					  title: "El autoconsumo no se ha ejecuta si no hay productos",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {
		
								window.location = "formatear-tablas";
		
								}
							})
		
				</script>';
                
            }
            
        }

    }	

}