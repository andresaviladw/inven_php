<?php

require_once "../controladores/subcategorias.controlador.php";
require_once "../modelos/subcategorias.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";
class AjaxSubCategorias{

public $idSubCategoria;

	public function ajaxEditarSubCategoria(){
		$item="id";
		$valor=$this->idSubCategoria;

		$respuesta=ControladorSubCategorias::ctrMostrarSubCategorias($item,$valor);

		echo json_encode($respuesta);
	}

		/*=============================================
	VALIDAR NO REPETIR SUBCATEGORIA
	=============================================*/	

	public $validarSubCategoria;

	public function ajaxValidarSubCategoria(){

		$item = "subcategoria";
		$valor = $this->validarSubCategoria;

		$respuesta = ControladorSubCategorias::ctrMostrarSubCategorias($item, $valor);

		echo json_encode($respuesta);

	}


		/*=============================================
	ACTIVAR SUBCATEGORIA
	=============================================*/	

	public $activarSubCategoria;
	public $activarIdSub;


	public function ajaxActivarSubCategoria(){

	$tabla = "subcategorias";

		$item1 = "estado";
		$valor1 = $this->activarSubCategoria;

		$item2 = "id";
		$valor2 = $this->activarIdSub;

		$respuesta = ModeloSubCategorias::mdlActualizarSubCategoria($tabla, $item1, $valor1, $item2, $valor2);

	}



	
}

if (isset($_POST['idSubCategoria'])) {
	$editarSubcategoria=new AjaxSubCategorias();
	$editarSubcategoria->idSubCategoria=$_POST['idSubCategoria'];
	$editarSubcategoria->ajaxEditarSubCategoria();
}


/*=============================================
VALIDAR NO REPETIR SUBCATEGORIA
=============================================*/

if(isset( $_POST["validarSubCategoria"])){

	$valCategoria = new AjaxSubCategorias();
	$valCategoria -> validarSubCategoria = $_POST["validarSubCategoria"];
	$valCategoria -> ajaxValidarSubCategoria();

}

/*=============================================
ACTIVAR SUBCATEGORIA
=============================================*/	

if(isset($_POST["activarSubCategoria"])){

	$actSubCategoria = new AjaxSubCategorias();
	$actSubCategoria -> activarSubCategoria = $_POST["activarSubCategoria"];
	$actSubCategoria -> activarIdSub = $_POST["activarIdSub"];
	$actSubCategoria -> ajaxActivarSubCategoria();

}






