<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";


class AjaxTablaProductosAutoconsumos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 
	  public $idProveedor;
	public function AjaxMostrarTablaProductosAutoconsumo(){

		$item = 'estado';
    	$valor = 1;
    	$orden = "id";

  		$productos = ControladorProductos::ctrMostrarProductosHabilitados($item, $valor, $orden);

  		if(count($productos) == 0){

  			echo '{"data": []}';

		  	return;
  		}else {
			$datosJson = '{
				"data": [';
	  
				for($i = 0; $i < count($productos); $i++){
	  
					/*=============================================
					TRAEMOS LA IMAGEN
					=============================================*/ 
	  
					$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";
	  
					/*=============================================
					STOCK
					=============================================*/ 
	  
					if($productos[$i]["stock"] <= 11){
	  
						$stock = "<button class='btn btn-danger '>".$productos[$i]["stock"]."</button>";
	  
					}else if($productos[$i]["stock"] >= 12 && $productos[$i]["stock"] <= 15){
	  
						$stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";
	  
					}else{
	  
						$stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";
	  
					}
	  
					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/ 
	  
					$botones =  "<div class='btn-group'><button class='btn btn-primary agregarProductoAutoconsumo recuperarBotonAutoconsumo' idProducto='".$productos[$i]["id"]."'>Agregar</button></div>"; 
	  
					$datosJson .='[
						"'.$imagen.'",
						"'.$productos[$i]["codigo"].'",
						"'.$productos[$i]["descripcion"].'",
						"'.$stock.'",
						"'.$botones.'"
					  ],';
	  
				}
	  
				$datosJson = substr($datosJson, 0, -1);
	  
			   $datosJson .=   '] 
	  
			   }';
			  
			  echo $datosJson;
	  
	  
		  }
	  
		  }	
		
  		

}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 

	$activarProductosEntradas = new AjaxTablaProductosAutoconsumos();
	$activarProductosEntradas -> AjaxMostrarTablaProductosAutoconsumo();	


