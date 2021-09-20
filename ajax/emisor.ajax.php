<?php

require_once "../controladores/emisor.controlador.php";
require_once "../modelos/emisor.modelo.php";
require "validando.php";
class AjaxEmisor{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idEmisor;

	public function ajaxEditarEmisor(){

		$item = "id";
		$valor = $this->idEmisor;

		$respuesta = ControladorEmisor::ctrMostrarEmisor($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	VALIDAR  DOCUMENTOID
	=============================================*/	

	public $tipoSelect;
	public $id;

	public function ajaxValidarDocumentoIdEmisor(){

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





}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["idEmisor"])){

	$emisor = new AjaxEmisor();
	$emisor -> idEmisor = $_POST["idEmisor"];
	$emisor -> ajaxEditarEmisor();
}

/*=============================================
VALIDAR DOCUMENTO RUC - CEDULA
=============================================*/

if(isset($_POST["tipoSelect"])){
	$validarP = new AjaxEmisor();
	$validarP -> tipoSelect=$_POST["tipoSelect"];
	$validarP -> id=$_POST["id"];
	$validarP -> ajaxValidarDocumentoIdEmisor();
	
	}


