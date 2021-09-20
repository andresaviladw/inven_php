<?php

require_once "../controladores/preciosventas.controlador.php";
require_once "../modelos/preciosventas.modelo.php";

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
class AjaxPrecioVenta{

public $idProductoVenta;

	public function ajaxTraerProductoVentas(){
		$item="id_producto";
		$valor=$this->idProductoVenta;

		$respuesta=ControladorPreciosVentas::ctrMostrarPreciosVentasVarios($item,$valor);

		echo json_encode($respuesta);
	}
public $idPrecioVenta;

	public function ajaxEditarVentaPrecio(){
		$item="id";
		$valor=$this->idPrecioVenta;

		$respuesta=ControladorPreciosVentas::ctrMostrarPreciosVentas($item,$valor);

		echo json_encode($respuesta);
	}




		
	public $traerproducto; 
	
	public function ajaxTraerProducto(){
		$item = "id";
		$valor=$this->traerproducto;
	  
	  
		$respuesta=ControladorProductos::ctrTraerProductos($item, $valor);
	  
		
	  
	  
		echo json_encode($respuesta);
		
		
	  }



public $idPrecioCompra;

	public function ajaxNuevoPrecioVenta(){
		$item="id";
		$valor=$this->idPrecioCompra;

		$respuesta=ControladorPreciosVentas::ctrMostrarPreciosVentas($item,$valor);

		echo json_encode($respuesta);
	}




		/*=============================================
	ACTIVAR SUBCATEGORIA
	=============================================*/	

	public $activarPrecioVenta;
	public $activarIdPrecioVenta;


	public function ajaxActivarPrecioVenta(){

	$tabla = "preciosventas";

		$item1 = "estado";
		$valor1 = $this->activarPrecioVenta;

		$item2 = "id";
		$valor2 = $this->activarIdPrecioVenta;

		$respuesta = ModeloPreciosVentas::mdlActualizarPrecioventa($tabla, $item1, $valor1, $item2, $valor2);

		var_dump($respuesta);

	}



	
}

if (isset($_POST['idPrecioVenta'])) {
	$editarPrecioVenta=new AjaxPrecioVenta();
	$editarPrecioVenta->idPrecioVenta=$_POST['idPrecioVenta'];
	$editarPrecioVenta->ajaxEditarVentaPrecio();
}

if (isset($_POST['idProductoVenta'])) {
	$editaVenta=new AjaxPrecioVenta();
	$editaVenta->idProductoVenta=$_POST['idProductoVenta'];
	$editaVenta->ajaxTraerProductoVentas();
}




/*=============================================
ACTIVAR PRECIO VENTA
=============================================*/	

if(isset($_POST["activarPrecioVenta"])){

	$actPrecioVenta = new AjaxPrecioVenta();
	$actPrecioVenta -> activarPrecioVenta = $_POST["activarPrecioVenta"];
	$actPrecioVenta -> activarIdPrecioVenta = $_POST["activarIdPrecioVenta"];
	$actPrecioVenta -> ajaxActivarPrecioVenta();
}


/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["traerproducto"])){
	$traerProductos = new AjaxPrecioVenta();
	$traerProductos -> traerproducto = $_POST["traerproducto"];
	$traerProductos -> ajaxTraerProducto();
  
  }






