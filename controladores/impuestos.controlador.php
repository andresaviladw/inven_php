<?php

class ControladorImpuestos{

	/*=============================================
	CREAR IMPUESTOS
	=============================================*/

	static public function ctrCrearImpuesto(){

		if(isset($_POST["nuevoCodigo"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCodigo"])){

				$tabla = "impuestos";

                $datos = array("codigo"=>trim($_POST["nuevoCodigo"]),
                "nombre"=>trim(ucwords($_POST["nuevoNombre"])),
                "valor"=>trim($_POST["nuevoValor"])
            
            );

				var_dump($datos);

				$respuesta = ModeloImpuestos::mdlIngresarImpuesto($tabla, $datos);

				var_dump($respuesta);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El impuesto ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "impuestos";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La impuesto no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "impuestos";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR IMPUESTOS
	=============================================*/

	static public function ctrMostrarImpuestos($item, $valor){

		$tabla = "impuestos";

		$respuesta = ModeloImpuestos::mdlMostrarImpuestos($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR IMPUESTO
	=============================================*/

	static public function ctrEditarImpuesto(){

		if(isset($_POST["editarCodigo"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCodigo"])){

				$tabla = "impuestos";

				$datos = array("codigo"=>trim($_POST["editarCodigo"]),
                "nombre"=>trim(ucwords($_POST["editarNombre"])),
                "valor"=>trim($_POST["editarValor"]),
                "id"=>trim($_POST["idImpuesto"])
            
            );

            var_dump($datos);
                $respuesta = ModeloImpuestos::mdlEditarImpuesto($tabla, $datos);
                
                var_dump($respuesta);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La impuesto ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "impuestos";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El impuesto no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "impuestos";

							}
						})

			  	</script>';

			}

		}

	}


	/*=============================================
	MOSTRAR PRECIOS VENTAS TODOS
	=============================================*/

	static public function ctrMostrarImpuestoVentasVarios($item, $valor){

		$tabla = "impuestos";
		

		$respuesta = ModeloImpuestos::mdlMostrarImpuestosVentasVarios($tabla, $item, $valor);

		return $respuesta;
	
	}
	/*=============================================
	MOSTRAR PRECIOS VENTAS HABILITADOS
	=============================================*/

	static public function ctrMostrarImpuestoVentasHabilitadas(){

		$tabla = "impuestos";
		

		$respuesta = ModeloImpuestos::mdlMostrarImpuestosVentasHabilitado($tabla);

		return $respuesta;
	
	}

}
