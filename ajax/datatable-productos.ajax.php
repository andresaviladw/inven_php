<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/impuestos.controlador.php";
require_once "../modelos/impuestos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/subcategorias.controlador.php";
require_once "../modelos/subcategorias.modelo.php";



class TablaProductos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaProductos(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);	

  		if(count($productos) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){

		  	/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/ 

		  	$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";

		  	/*=============================================
 	 		TRAEMOS LA CATEGORÍA
  			=============================================*/ 

		  	$item = "id";
		  	$valor = $productos[$i]["id_categoria"];

			  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
			  



			  	/*=============================================
 	 		TRAEMOS LA SUBCATEGORÍA
  			=============================================*/ 

		  	$item = "id";
		  	$valor = $productos[$i]["id_subcategoria"];

		  	$subcategorias = ControladorSubCategorias::ctrMostrarSubCategorias($item, $valor);

			  	/*=============================================
 	 		TRAEMOS LOS IMPUESTOS
  			=============================================*/ 

		  	$item = "id";
		  	$valor = $productos[$i]["id_impuesto"];

		  	$impuestos = ControladorImpuestos::ctrMostrarImpuestos($item, $valor);


		  	/*=============================================
 	 		STOCK
  			=============================================*/ 

  			if($productos[$i]["stock"] <= 10){

  				$stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";

  			}else if($productos[$i]["stock"] >= 11 && $productos[$i]["stock"] <= 15){

  				$stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";

  			}else{

  				$stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";

  			}

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

  			if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial"){

				$botones =  "<button>Sin Accion</button>"; 

  			}else{

				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["codigo"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button></div>"; 

				if($productos[$i]['estado'] != 0){

                    $estado= "<button class='btn btn-success btn-xs btnHabilitarProducto' idProductoEstado='".$productos[$i]["codigo"]."' productoEstado='0'>Habilitado</button>";

                  }else{

                    $estado= "<button class='btn btn-danger btn-xs btnHabilitarProducto' idProductoEstado='".$productos[$i]["codigo"]."' productoEstado='1'>Deshabilitado</button>";

                  }
				

  			}

		 
		  	$datosJson .='[
			      "'.$imagen.'",
			      "'.$productos[$i]["codigo"].'",
			      "'.$productos[$i]["descripcion"].'",
				  "'.$categorias["categoria"].'",
				  "'.$subcategorias["subcategoria"].'",
			      "'.$stock.'",
				  "'.$productos[$i]["precio_compra"].'",
			      "'.$impuestos["valor"].'",
			      "'.$productos[$i]["fecha"].'",
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
$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();

