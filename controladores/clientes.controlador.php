<?php

class ControladorClientes{

	/*=============================================
	CREAR CLIENTES
	=============================================*/

	static public function ctrCrearCliente(){

		if(isset($_POST["nuevoCliente"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoDocumentoId"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"])){

			   	$tabla = "clientes";

			   	$datos = array(
					"codigo"=>trim(ucwords($_POST["nuevoCodigoCliente"])),   
					"nombre"=>trim(ucwords($_POST["nuevoCliente"])),
			   	"tipoDocumento"=>trim($_POST["tipoDocumento"]),
					           "documento"=>trim($_POST["nuevoDocumentoId"]),
					           "email"=>trim($_POST["nuevoEmail"]),
					           "telefono"=>trim($_POST["nuevoTelefono"]),
					           "celular"=>trim($_POST["nuevoCelular"]),
							   "direccion"=>trim(ucwords($_POST["nuevaDireccion"])));
							   
							   var_dump($datos);

			   	$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El cliente ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

								window.location = "clientes";
	
								}
								})

					</script>';

				}else {
					
				echo'<script>

				swal({
					  type: "error",
					  title: "¡No se insert ningun registro!",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  })

			  </script>';
				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "clientes";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarClientes($item, $valor){

		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

		return $respuesta;

	}
	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarClientesHabilitados($item, $valor){

		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarClientesHabilitados($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function ctrEditarCliente(){

		if(isset($_POST["editarCliente"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarDocumentoId"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDireccion"])){

			   	$tabla = "clientes";

			   	$datos = array("id"=>$_POST["idCliente"],
			   				   "codigo"=>trim($_POST["editarCodigoCliente"]),
			   				   "nombre"=>trim(ucwords($_POST["editarCliente"])),
					           "documento"=>trim($_POST["editarDocumentoId"]),
					           "tipoDocumento"=>trim($_POST["seleccionarDocumento"]),
					           "email"=>trim($_POST["editarEmail"]),
					           "telefono"=>trim($_POST["editarTelefono"]),
					           "celular"=>trim($_POST["editarCelular"]),
					           "direccion"=>trim(ucwords($_POST["editarDireccion"])));

			   	$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

				   var_dump($respuesta);
			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El cliente ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "clientes";

							}
						})

			  	</script>';



			}

		}

	}
}
	