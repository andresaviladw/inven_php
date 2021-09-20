<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";
require "validando.php";

class AjaxClientes{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idCliente;

	public function ajaxEditarCliente(){

		$item = "id";
		$valor = $this->idCliente;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);


	}


	/*=============================================
	VALIDAR  DOCUMENTOID
	=============================================*/	

	public $tipoSelect;
	public $id;

	public function ajaxValidarDocumentoIdCliente(){

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

	public function ajaxValidarNoRepetirDocumentoCliente(){

		$item = "documento";
		$valor = $this->noRepetirDocumento;

		$valido = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($valido);

	}

	/*=============================================
	ACTIVAR CLIENTE
	=============================================*/	

	public $activarCliente;
	public $activarIdCliente;

	public function ajaxActivarCliente(){

	$tabla = "clientes";

		$item1 = "estado";
		$valor1 = $this->activarCliente;

		$item2 = "id";
		$valor2 = $this->activarIdCliente;

		$respuesta = ModeloClientes::mdlActualizarClienteEstado($tabla, $item1, $valor1, $item2, $valor2);

		var_dump($respuesta);

	}


}

/*=============================================
ACTIVAR CLIENTE
=============================================*/	

if(isset($_POST["activarCliente"])){

	$actCliente = new AjaxClientes();
	$actCliente -> activarCliente = $_POST["activarCliente"];
	$actCliente -> activarIdCliente = $_POST["activarIdCliente"];
	$actCliente -> ajaxActivarCliente();

}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["idCliente"])){

	$cliente = new AjaxClientes();
	$cliente -> idCliente = $_POST["idCliente"];
	$cliente -> ajaxEditarCliente();

}

/*=============================================
VALIDAR DOCUMENTO RUC - CEDULA
=============================================*/

if(isset($_POST["tipoSelect"])){
$validarP = new AjaxClientes();
$validarP -> tipoSelect=$_POST["tipoSelect"];
$validarP -> id=$_POST["id"];
$validarP -> ajaxValidarDocumentoIdCliente();

}


/*=============================================
VALIDAR NO REPETIR DOCUMENTO
=============================================*/

if(isset( $_POST["noRepetirDocumento"])){

	$valDocumento = new AjaxClientes();
	$valDocumento -> noRepetirDocumento = $_POST["noRepetirDocumento"];
	$valDocumento -> ajaxValidarNoRepetirDocumentoCliente();

}