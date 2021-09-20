<?php

require_once "../controladores/autoconsumos.controlador.php";
require_once "../modelos/autoconsumos.modelo.php";
require "validando.php";

class AjaxAutoconsumo{

	/*=============================================
	ACTIVAR AUTOCONSUMO
	=============================================*/	

	public $activarAutoconsumo;
	public $activarIdAutoconsumo;


	public function ajaxActivarAutoconsumo(){

	$tabla = "autoconsumos";

		$item1 = "estado";
		$valor1 = $this->activarAutoconsumo;

		$item2 = "id";
		$valor2 = $this->activarIdAutoconsumo;

		$respuesta = ModeloAutoconsumos::mdlActualizarAutoconsumoEstado($tabla, $item1, $valor1, $item2, $valor2);

		var_dump($respuesta);

	}


}

/*=============================================
ACTIVAR AUTOCONSUMO
=============================================*/	

if(isset($_POST["activarAutoconsumo"])){

	$actVenta = new AjaxAutoconsumo();
	$actVenta -> activarAutoconsumo = $_POST["activarAutoconsumo"];
	$actVenta -> activarIdAutoconsumo = $_POST["activarIdAutoconsumo"];
	$actVenta -> ajaxActivarAutoconsumo();

}
