<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";
require "validando.php";

class AjaxVentas{

	/*=============================================
	ACTIVAR VENTA
	=============================================*/	

	public $activarVenta;
	public $activarIdVenta;


	public function ajaxActivarVenta(){

	$tabla = "ventas";

		$item1 = "estado";
		$valor1 = $this->activarVenta;

		$item2 = "id";
		$valor2 = $this->activarIdVenta;

		$respuesta = ModeloVentas::mdlActualizarVentaEstado($tabla, $item1, $valor1, $item2, $valor2);

		var_dump($respuesta);

	}


}

/*=============================================
ACTIVAR VENTA
=============================================*/	

if(isset($_POST["activarVenta"])){

	$actVenta = new AjaxVentas();
	$actVenta -> activarVenta = $_POST["activarVenta"];
	$actVenta -> activarIdVenta = $_POST["activarIdVenta"];
	$actVenta -> ajaxActivarVenta();

}
