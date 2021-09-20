<?php

require_once "../controladores/subcategorias.controlador.php";
require_once "../modelos/subcategorias.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";




class TablaSubcategorias{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaSubCategorias(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$subcategorias = ControladorSubCategorias::ctrMostrarSubCategorias($item, $valor, $orden);	

  		if(count($subcategorias) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($subcategorias); $i++){

		
		  	/*=============================================
 	 		TRAEMOS LA CATEGORĂA
  			=============================================*/ 

		  	$item = "id";
		  	$valor = $subcategorias[$i]["id_categoria"];

			  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
			  


			/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 
			  if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial"){

				$botones =  "<button>Sin Accion</button>";
				


  			}else{
				
				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarSubCategoria' idSubCategoria='".$subcategorias[$i]["id"]."' data-toggle='modal' data-target='#modalEditarSubcategoria'><i class='fa fa-pencil'></i></button></div>"; 
			
				if($subcategorias[$i]['estado'] != 0){

                    $estado= "<button class='btn btn-success btn-xs btnHabilitarSubCategoria' idSubCategoria='".$subcategorias[$i]["id"]."' estadoSubCategoria='0'>Habilitado</button>";

                  }else{

                    $estado= "<button class='btn btn-danger btn-xs btnHabilitarSubCategoria' idSubCategoria='".$subcategorias[$i]["id"]."' estadoSubCategoria='1'>Deshabilitado</button>";

                  }
				  
			  }
				
		  	$datosJson .='[
			      "'.$subcategorias[$i]["subcategoria"].'",
				  "'.$categorias["categoria"].'",
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
$activarSubcategorias = new TablaSubcategorias();
$activarSubcategorias -> mostrarTablaSubCategorias();

