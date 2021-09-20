<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/preciosventas.controlador.php";
require_once "../modelos/preciosventas.modelo.php";




class TablaPreciosVentas{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaPreciosVentas(){

		$item = null;
    	$valor = null;
    	

  		$preciosventas = ControladorPreciosVentas::ctrMostrarPreciosVentas($item, $valor);	

  		if(count($preciosventas) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($preciosventas); $i++){

		
		  	/*=============================================
 	 		TRAEMOS EL PRODUCTO
  			=============================================*/ 

		  	$item = "id";
		  	$orden = "id";
		  	$valor = $preciosventas[$i]["id_producto"];
		  	

              $productos = ControladorProductos::ctrMostrarProductos($item, $valor,$orden);

              
			  


			/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 
			  if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial"){

				$botones =  "<button>Sin Accion</button>";
				


  			}else{
				
				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarPrecioVenta' idPrecioVenta='".$preciosventas[$i]["id"]."' data-toggle='modal' data-target='#modalEditarPrecioVenta'><i class='fa fa-pencil'></i></button></div>"; 
			
				if($preciosventas[$i]['estado'] != 0){

                    $estado= "<button class='btn btn-success btn-xs btnHabilitarPrecioVenta' idPrecioVenta='".$preciosventas[$i]["id"]."' estadoPrecioVenta='0'>Habilitado</button>";

                  }else{

                    $estado= "<button class='btn btn-danger btn-xs btnHabilitarPrecioVenta' idPrecioVenta='".$preciosventas[$i]["id"]."' estadoPrecioVenta='1'>Deshabilitado</button>";

                  }
				  
			  }
				
		  	$datosJson .='[
				  "'.$productos["codigo"].'",
				  "'.$productos["descripcion"].'",
				  "'.$productos["precio_compra"].'",
			      "'.$preciosventas[$i]["precio_venta"].'",
				  "'.$botones.'",
				  "'.$estado.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarSubcategorias = new TablaPreciosVentas();
$activarSubcategorias -> mostrarTablaPreciosVentas();

