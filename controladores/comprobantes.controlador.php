<?php

class ControladorComprobantes{

	/*=============================================
	CREAR COMPROBANTES
	=============================================*/

	static public function ctrCrearComprobante(){

		if(isset($_POST["nuevoCodigo"]) && isset($_POST["nuevoNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCodigo"])){

				$tabla = "comprobantes";

				$datos = array("codigo"=>trim($_POST["nuevoCodigo"]),
                "nombre"=>trim(ucwords($_POST["nuevoNombre"])));

                var_dump($datos);

				$respuesta = ModeloComprobantes::mdlIngresarComprobante($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El comprobante ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
								
								})

					</script>';

				}else {
					echo'<script>

					swal({
						  type: "error",
						  title: "¡El comprobante no se ha guardado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

								window.location = "comprobantes";
	
								}
						})

			  	</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "comprobantes";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR COMPROBANTES
	=============================================*/

	static public function ctrMostrarComprobantes($item, $valor){

		$tabla = "comprobantes";

		$respuesta = ModeloComprobantes::mdlMostrarComprobantes($tabla, $item, $valor);

		return $respuesta;
	
	}
	/*=============================================
	MOSTRAR COMPROBANTES HABILITADAS
	=============================================*/

	static public function ctrMostrarComprobantesHabilitados($item, $valor){

		$tabla = "comprobantes";

		$respuesta = ModeloComprobantes::mdlMostrarComprobantesHabilitados($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR COMPROBANTE
	=============================================*/

	static public function ctrEditarComprobate(){

		if(isset($_POST["editarCodigo"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCodigo"])){

				$tabla = "comprobantes";

				$datos = array("codigo"=>trim($_POST["editarCodigo"]),"nombre"=>trim(ucwords($_POST["editarNombre"])),
							   "id"=>$_POST["idComprobante"]);
				var_dump($datos);
				$respuesta = ModeloComprobantes::mdlEditarComprobante($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El comprobantes ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "comprobantes";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El comprobante no puede ir vacio o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "comprobantes";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR COMPROBANTES
	=============================================*/

	static public function ctrBorrarComprobante(){

		if(isset($_GET["idComprobante"])){

			$tabla ="comprobantes";
			$datos = $_GET["idComprobante"];

			$respuesta = ModeloComprobantes::mdlBorrarComprobante($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El comprobante ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "comprobantes";

									}
								})

					</script>';
			}
		}
		
	}
}
