<?php

class ControladorEmisor{


	/*=============================================
	EDITAR EMISOR
	=============================================*/

	static public function ctrEditarEmisor(){

		if(isset($_POST["editarDocumentoIdEmisor"])){

			if(preg_match('/^[0-9]+$/', $_POST["editarDocumentoIdEmisor"]) && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarRazonSocial"]) && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreComercial"]) && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDireccion"]) 
			&& preg_match('/^[0-9]+$/', $_POST["editarTelefono"])
			&& preg_match('/^[0-9]+$/', $_POST["editarCelular"]) 
			&& preg_match('/^[0-9]+$/', $_POST["editarCodigoEstablecimiento"]) && preg_match('/^[0-9]+$/', $_POST["editarPuntoEmision"])){
				$tabla = "emisor";



				$datos = array("tipoDocumento"=>trim($_POST["seleccionarDocumentoEmisor"]), "documento_id"=>trim($_POST["editarDocumentoIdEmisor"]), "razon_social"=>trim(ucwords($_POST["editarRazonSocial"])), "nombre_comercial"=>trim(ucwords($_POST["editarNombreComercial"])), 
				"direccion"=>trim(ucwords($_POST["editarDireccion"])),
				"telefono"=>trim($_POST["editarTelefono"]),
				"celular"=>trim($_POST["editarCelular"]),
				"email"=>trim($_POST["editarEmail"]),
				 "codigo_establecimiento"=>trim($_POST["editarCodigoEstablecimiento"]),"punto_emision"=>trim($_POST["editarPuntoEmision"]), 
				 "secuencia_factura"=>trim($_POST["editarSecuenciaFactura"]),
				 "numero_autorizacion"=>trim($_POST["editarNumeroAutorizacion"]),
							   "id"=>$_POST["idEmisor"],);
var_dump($datos);


				$respuesta = ModeloEmisor::mdlEditarEmisor($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El emisor ha sido modificado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									
								})

					</script>';

				}else{
					
					echo'<script>

					swal({
						  type: "error",
						  title: "El emisor no ha sido modificado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									
								})

					</script>';
				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El emisor no puede ir vacio o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "configuracion-emisor";

							}
						})

			  	</script>';

			
		}
		}

    }
    	/*=============================================
	MOSTRAR Emisor
	=============================================*/

	static public function ctrMostrarEmisor($item, $valor){

		$tabla = "emisor";

		$respuesta = ModeloEmisor::mdlMostrarEmisor($tabla, $item, $valor);

		return $respuesta;
	
	}



	}

    
    
