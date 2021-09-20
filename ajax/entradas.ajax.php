<?php

require_once "../controladores/entradas.controlador.php";
require_once "../modelos/entradas.modelo.php";
require "validando.php";

class AjaxEntradas{

	/*=============================================
	ACTIVAR ENTRADA
	=============================================*/	

	public $activarEntrada;
	public $activarIdEntrada;


	public function ajaxActivarEntrada(){

	$tabla = "entradas";

		$item1 = "estado";
		$valor1 = $this->activarEntrada;

		$item2 = "id";
		$valor2 = $this->activarIdEntrada;

		$respuesta = ModeloEntradas::mdlActualizarEntradaEstado($tabla, $item1, $valor1, $item2, $valor2);

		var_dump($respuesta);

	}


}

/*=============================================
ACTIVAR VENTA
=============================================*/	

if(isset($_POST["activarEntrada"])){

	$actVenta = new AjaxEntradas();
	$actVenta -> activarEntrada = $_POST["activarEntrada"];
	$actVenta -> activarIdEntrada = $_POST["activarIdEntrada"];
	$actVenta -> ajaxActivarEntrada();

}
