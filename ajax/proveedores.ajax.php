<?php

require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";
require "validando.php";

class AjaxProveedores
{
    /**
     * EDITAR PROVEEDORES
     */

    public $idProveedor;

	public function ajaxEditarProveedor(){

		$item = "id";
		$valor = $this->idProveedor;

		$respuesta = ControladorProveedores::ctrMostrarProveedores($item, $valor);

		echo json_encode($respuesta);

	}



	/*=============================================
	VALIDAR  DOCUMENTOID
	=============================================*/	

	public $tipoSelect;
	public $id;

	public function ajaxValidarDocumentoIdProveedor(){

		$tipo = $this->tipoSelect;
		
		
		switch ($tipo) {
        
        case 'cedula':
                        /*
        ========================================
    
        VALIDACION CEDULA NORMAL
    
        ===========================================
    
		*/
		
		$documentoId = $this->id;
		$respuesta=validarCedula($documentoId,$tipo);
		
		echo json_encode($respuesta);
		
            
            break;
    
            case 'ruc_natural':
                    /*
            ========================================
    
            VALIDACION CEDULA PERSONA NATURAL
    
            ===========================================
            */
    
			$documentoId = $this->id;
			$respuesta=validarRucPersonaNatural($documentoId,$tipo);
			
			echo json_encode($respuesta);
    
    
            break;
    
        case 'ruc_privada':
            /*
        ========================================
    
        VALIDACION SOCIEDAD PRIVADA
    
        ===========================================
        */
    
        	$documentoId = $this->id;
			$respuesta=validarRucSociedadPrivada($documentoId,$tipo);
			
			echo json_encode($respuesta);
    
            break;
        case 'ruc_publica':
            /*
            ========================================
    
            VALIDACION SOCIEDAD PUBLICA
    
            ===========================================
            */
    
            $documentoId = $this->id;
			$respuesta=validarRucSociedadPublica($documentoId,$tipo);
			
			echo json_encode($respuesta);
    
            break;
		default:
		
		
            echo 'Documento no existente';

            
        }


	}


	/*=============================================
	VALIDAR NO REPETIR DOCUMENTOID
	=============================================*/	

	public $noRepetirDocumento;

	public function ajaxValidarNoRepetirDocumentoPoveedor(){

		$item = "documentoId";
		$valor = $this->noRepetirDocumento;

		$respuesta = ControladorProveedores::ctrMostrarProveedores($item, $valor);

		echo json_encode($respuesta);

	}

		/*=============================================
	ACTIVAR PROVEEDOR
	=============================================*/	

	public $activarProveedor;
	public $activarIdProveedor;


	public function ajaxActivarProveedor(){

	$tabla = "proveedores";

		$item1 = "estado";
		$valor1 = $this->activarProveedor;

		$item2 = "id";
		$valor2 = $this->activarIdProveedor;

		$respuesta = ModeloProveedor::mdlActualizarProveedor($tabla, $item1, $valor1, $item2, $valor2);

	}

}

/*=============================================
ACTIVAR PROVEEDOR
=============================================*/	

if(isset($_POST["activarIdProveedor"])){

	$actCategoria = new AjaxProveedores();
	$actCategoria -> activarProveedor = $_POST["activarProveedor"];
	$actCategoria -> activarIdProveedor = $_POST["activarIdProveedor"];
	$actCategoria -> ajaxActivarProveedor();

}

/*
EDITAR PROVEEDORES
 */

if(isset($_POST["idProveedor"])){

	$proveedor = new AjaxProveedores();
	$proveedor -> idProveedor = $_POST["idProveedor"];
	$proveedor -> ajaxEditarProveedor();
}

/*=============================================
VALIDAR DOCUMENTO RUC - CEDULA
=============================================*/

if(isset($_POST["tipoSelect"])){
	$validarProveedor = new AjaxProveedores();
	$validarProveedor -> tipoSelect=$_POST["tipoSelect"];
	$validarProveedor -> id=$_POST["id"];
	$validarProveedor -> ajaxValidarDocumentoIdProveedor();
	
	}
	
	
	/*=============================================
	VALIDAR NO REPETIR DOCUMENTO
	=============================================*/
	
	if(isset( $_POST["noRepetirDocumento"])){
	
		$valDocumentoProveedor = new AjaxProveedores();
		$valDocumentoProveedor -> noRepetirDocumento = $_POST["noRepetirDocumento"];
		$valDocumentoProveedor -> ajaxValidarNoRepetirDocumentoPoveedor();
	
	}
