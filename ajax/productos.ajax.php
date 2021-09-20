<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/subcategorias.controlador.php";
require_once "../modelos/subcategorias.modelo.php";



class AjaxProductos{

  public $traercategoria; 
public function ajaxTraerSubcategoria(){
  $item = "id_categoria";
  $valor=$this->traercategoria;


  $respuesta=ControladorSubCategorias::ctrTraerCategorias($item, $valor);

  


  echo json_encode($respuesta);
  
  
}




  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $idProducto;
  public $idVentaProducto;
  public $idProductoVAProducto;
  public $traerProductos;
  public $nombreProducto;

  public function ajaxEditarProducto(){

    if($this->traerProductos == "ok"){

      $item = null;
      $valor = null;
      $orden = "id";

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,
        $orden);

      echo json_encode($respuesta);


    }else if($this->nombreProducto != ""){

      $item = "descripcion";
      $valor = $this->nombreProducto;
      $orden = "id";

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }else{

      $item = "codigo";
      $valor = $this->idProducto;
      $orden = "id";

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }


  }

  public function ajaxEditarProductoVenta(){

    if($this->traerProductos == "ok"){

      $item = null;
      $valor = null;
      $orden = "id";

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,
        $orden);

      echo json_encode($respuesta);


    }else if($this->nombreProducto != ""){

      $item = "descripcion";
      $valor = $this->nombreProducto;
      $orden = "id";

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }else{

      $item = "id";
      $valor = $this->idProductoVAProducto;
      $orden = "id";

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }

  }


  /*=============================================
	VALIDAR NO REPETIR CODIGO
	=============================================*/	

	public $validarCodigo;

	public function ajaxValidarCodigo(){

		$item = "codigo";
    $valor = $this->validarCodigo;
    $orden='id';

		$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor,$orden);

		echo json_encode($respuesta);

  }
  
  	/*=============================================
	ACTIVAR PRODUCTO
	=============================================*/	

	public $activarProductoEstado;
	public $activarIdProducto;


	public function ajaxActivarProducto(){

	$tabla = "productos";

		$item1 = "estado";
		$valor1 = $this->activarProductoEstado;

		$item2 = "codigo";
		$valor2 = $this->activarIdProducto;

    $respuesta = ModeloProductos::mdlActualizarProductoEstado($tabla, $item1, $valor1, $item2, $valor2);
    
    var_dump($respuesta);

	}



}

/*=============================================
ACTIVAR PRODUCTO
=============================================*/	

if(isset($_POST["activarProductoEstado"])){

	$actSubCategoria = new AjaxProductos();
	$actSubCategoria -> activarProductoEstado = $_POST["activarProductoEstado"];
	$actSubCategoria -> activarIdProducto = $_POST["activarIdProducto"];
	$actSubCategoria -> ajaxActivarProducto();

}




/*=============================================
EDITAR PRODUCTO
=============================================*/ 

if(isset($_POST["idProducto"])){

  $editarProducto = new AjaxProductos();
  $editarProducto -> idProducto = $_POST["idProducto"];
  $editarProducto -> ajaxEditarProducto();

}
/*=============================================
EDITAR PRODUCTO
=============================================*/ 

if(isset($_POST["idProductoVAProducto"])){

  $editarProductoVentass = new AjaxProductos();
  $editarProductoVentass -> idProductoVAProducto = $_POST["idProductoVAProducto"];
  $editarProductoVentass -> ajaxEditarProductoVenta();

}


/*=============================================
TRAER PRODUCTO PARA DISPOSITIVOS
=============================================*/ 

if(isset($_POST["traerProductos"])){

  $traerProductos = new AjaxProductos();
  $traerProductos -> traerProductos = $_POST["traerProductos"];
  $traerProductos -> ajaxEditarProducto();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["nombreProducto"])){

  $nombreProducto = new AjaxProductos();
  $nombreProducto -> nombreProducto = $_POST["nombreProducto"];
  $nombreProducto -> ajaxEditarProducto();

}

/*=============================================
TRAER SUBCATEGORIA
=============================================*/ 

if(isset($_POST["traercategoria"])){
  $traerSubcategoria = new AjaxProductos();
  $traerSubcategoria -> traercategoria = $_POST["traercategoria"];
  $traerSubcategoria -> ajaxTraerSubcategoria();

}

/*=============================================
VALIDAR NO REPETIR CODIGO
=============================================*/

if(isset( $_POST["validarCodigo"])){

	$valCodigo = new AjaxProductos();
	$valCodigo -> validarCodigo = $_POST["validarCodigo"];
	$valCodigo -> ajaxValidarCodigo();

}





