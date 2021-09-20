<?php

require_once "../controladores/comprobantes.controlador.php";
require_once "../modelos/comprobantes.modelo.php";

class AjaxComprobantes{

	/*=============================================
	EDITAR COMPROBANTES
	=============================================*/	

	public $idComprobante;

	public function ajaxEditarComprobante(){

		$item = "id";
		$valor = $this->idComprobante;

		$respuesta = ControladorComprobantes::ctrMostrarComprobantes($item, $valor);

		echo json_encode($respuesta);

	}

		/*=============================================
	ACTIVAR COMPROBANTE
	=============================================*/	

	public $activarComprobante;
	public $activarIdComprobante;


	public function ajaxActivarComprobante(){

	$tabla = "comprobantes";

		$item1 = "estado";
		$valor1 = $this->activarComprobante;

		$item2 = "id";
		$valor2 = $this->activarIdComprobante;

		$respuesta = ModeloComprobantes::mdlActualizarComprobanteEstado($tabla, $item1, $valor1, $item2, $valor2);

	}
}

/*=============================================
ACTIVAR CATEGORIA
=============================================*/	

if(isset($_POST["activarIdComprobante"])){

	$actCategoria = new AjaxComprobantes();
	$actCategoria -> activarComprobante = $_POST["activarComprobante"];
	$actCategoria -> activarIdComprobante = $_POST["activarIdComprobante"];
	$actCategoria -> ajaxActivarComprobante();

}

/*=============================================
EDITAR COMPROBANTE
=============================================*/	
if(isset($_POST["idComprobante"])){

	$comprobantes = new AjaxComprobantes();
	$comprobantes -> idComprobante = $_POST["idComprobante"];
	$comprobantes -> ajaxEditarComprobante();
}
