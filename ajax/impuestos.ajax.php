<?php

require_once "../controladores/impuestos.controlador.php";
require_once "../modelos/impuestos.modelo.php";

class AjaxImpuestos{


	public $idImpuestoVenta;

	public function ajaxTraerImpuestoVentas(){
		$item="id";
		$valor=$this->idImpuestoVenta;

		$respuesta=ControladorImpuestos::ctrMostrarImpuestoVentasVarios($item,$valor);

		echo json_encode($respuesta);
	}

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idImpuesto;

	public function ajaxEditarImpuesto(){

		$item = "id";
		$valor = $this->idImpuesto;

		$respuesta = ControladorImpuestos::ctrMostrarImpuestos($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	VALIDAR NO REPETIR IMPUESTO
	=============================================*/	

	public $validarImpuesto;

	public function ajaxValidarImpuesto(){

		$item = "codigo";
		$valor = $this->validarImpuesto;

		$respuesta = ControladorImpuestos::ctrMostrarImpuestos($item, $valor);

		echo json_encode($respuesta);

	}

		/*=============================================
	ACTIVAR IMPUESTO
	=============================================*/	

	public $activarImpuesto;
	public $activarIdImpuesto;


	public function ajaxActivarImpuesto(){

	$tabla = "impuestos";

		$item1 = "estado";
		$valor1 = $this->activarImpuesto;

		$item2 = "id";
		$valor2 = $this->activarIdImpuesto;

		$respuesta = ModeloImpuestos::mdlActualizarImpuesto($tabla, $item1, $valor1, $item2, $valor2);

	}

}

/*=============================================
EDITAR IMPUESTO
=============================================*/	
if(isset($_POST["idImpuesto"])){

	$impuesto = new AjaxImpuestos();
	$impuesto -> idImpuesto = $_POST["idImpuesto"];
	$impuesto -> ajaxEditarImpuesto();
}

/*=============================================
VALIDAR NO REPETIR CATEGORIA
=============================================*/

if(isset( $_POST["validarImpuesto"])){

	$valImpuesto = new AjaxImpuestos();
	$valImpuesto -> validarImpuesto = $_POST["validarImpuesto"];
	$valImpuesto -> ajaxValidarImpuesto();

}


/*=============================================
ACTIVAR CATEGORIA
=============================================*/	

if(isset($_POST["activarIdImpuesto"])){

	$actImpuesto = new AjaxImpuestos();
	$actImpuesto -> activarImpuesto = $_POST["activarImpuesto"];
	$actImpuesto -> activarIdImpuesto = $_POST["activarIdImpuesto"];
	$actImpuesto -> ajaxActivarImpuesto();

}


if (isset($_POST['idImpuestoVenta'])) {
	$traerImpuesto=new AjaxImpuestos();
	$traerImpuesto->idImpuestoVenta=$_POST['idImpuestoVenta'];
	$traerImpuesto->ajaxTraerImpuestoVentas();
}