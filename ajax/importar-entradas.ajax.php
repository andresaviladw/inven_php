<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/entradas.controlador.php";
require_once "../modelos/entradas.modelo.php";

require_once "../controladores/importar-entradas.controlador.php";
require_once "../modelos/importar-entradas.modelo.php";



class AjaxImportarEntradas{
    public $id_responsable1;
    public $id_proveedor1;
    public $id_documento1;
    public $codigo1;
    public $secuencia1;
    public $comprobante1;
    public $forma_cobro1;
    public $descripcion1;
    public $productos1;
    public $fecha1;
    public $fecha_vencimiento1;
    public $subtotal1;
    public $impuesto1;
    public $total1;
    public $datos;

public function ajaxTraerImportacion(){

    
		
    $id_responsableImportar = $this->id_responsable1;
    $id_proveedorImportar = $this->id_proveedor1;
    $id_documentoImportar = $this->id_documento1;
    $codigoImportar = $this->codigo1;
    $secuenciaImportar = $this->secuencia1;
    $comprobanteImportar = $this->comprobante1;
    $forma_cobroImportar = $this->forma_cobro1;
    $descripcionImportar = $this->descripcion1;
    $productosImportar = $this->productos1;
    $fechaImportar = $this->fecha1;
    $fecha_vencimientoImportar = $this->fecha_vencimiento1;
    $subtotalImportar = $this->subtotal1;
    $impuestoImportar = $this->impuesto1;
    $totalImportar = $this->total1;
    
    $datos=[
      "id_responsable"=>$id_responsableImportar,
      "id_proveedor"=>$id_proveedorImportar,
      "id_comprobante"=>$id_documentoImportar,
      "codigo"=>$codigoImportar,
      "secuencia"=>$secuenciaImportar,
      "comprobante"=>$comprobanteImportar,
      "forma_cobro"=>$forma_cobroImportar,
      "descripcion"=>$descripcionImportar,
      "productos"=>$productosImportar,
      "fecha_emision"=>$fechaImportar,
      "fecha_vencimiento"=>$fecha_vencimientoImportar,
      "neto"=>$subtotalImportar,
      "impuesto"=>$impuestoImportar,
      "total_pagar"=>$totalImportar];


  $respuesta=ControladorImportarExcel::ctrCrearImporte($datos);

  var_dump($respuesta);

  


  
}

}


/*=============================================
VALIDAR NO REPETIR CODIGO
=============================================*/

if(isset($_POST["id_responsable1"],
$_POST["id_proveedor1"],$_POST["id_documento1"],$_POST["codigo1"],$_POST["secuencia1"],$_POST["comprobante1"],$_POST["forma_cobro1"],$_POST["descripcion1"],$_POST["productos1"],$_POST["fecha1"],$_POST["fecha_vencimiento1"],$_POST["subtotal1"],
$_POST["impuesto1"],$_POST["total1"])){

	$valCodigoImportar = new AjaxImportarEntradas();
	$valCodigoImportar -> id_responsable1 = $_POST["id_responsable1"];
	$valCodigoImportar -> id_proveedor1 = $_POST["id_proveedor1"];
	$valCodigoImportar -> id_documento1 = $_POST["id_documento1"];
	$valCodigoImportar -> codigo1 = $_POST["codigo1"];
	$valCodigoImportar -> secuencia1 = $_POST["secuencia1"];
	$valCodigoImportar -> comprobante1 = $_POST["comprobante1"];
	$valCodigoImportar -> forma_cobro1 = $_POST["forma_cobro1"];
	$valCodigoImportar -> descripcion1 = $_POST["descripcion1"];
	$valCodigoImportar -> productos1 = $_POST["productos1"];
	$valCodigoImportar -> fecha1 = $_POST["fecha1"];
	$valCodigoImportar -> fecha_vencimiento1 = $_POST["fecha_vencimiento1"];
	$valCodigoImportar -> subtotal1 = $_POST["subtotal1"];
	$valCodigoImportar -> impuesto1 = $_POST["impuesto1"];
	$valCodigoImportar -> total1 = $_POST["total1"];
	$valCodigoImportar -> ajaxTraerImportacion();
}






