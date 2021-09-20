<?php

class ControladorSubCategorias{

	/*=============================================
	CREAR SUBCATEGORIAS
	=============================================*/

	static public function ctrCrearSubCategoria(){

		if(isset($_POST["nuevaSubCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaSubCategoria"])){

				$tabla = "subcategorias";

				$datos = array("id_categoria"=>trim($_POST["nuevaCategoria"]),
								"subcategoria"=>trim(ucwords($_POST["nuevaSubCategoria"])));

								var_dump($datos);

				$respuesta = ModeloSubCategorias::mdlIngresarSubCategoria($tabla, $datos);

				var_dump($respuesta);

				if($respuesta == "ok"){


					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "subcategorias";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La sub categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "subcategorias";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR SUBCATEGORIAS
	=============================================*/

	static public function ctrMostrarSubCategorias($item, $valor){

		$tabla = "subcategorias";
		

		$respuesta = ModeloSubCategorias::mdlMostrarSubCategorias($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	TRAER CATEGORIAS
	=============================================*/

	static public function ctrTraerCategorias($item, $valor){

		$tabla = "subcategorias";
		

		$respuesta = ModeloSubCategorias::mdlTraerCategorias($tabla, $item, $valor);

		return $respuesta;
	
	}


	/*=============================================
	EDITAR SUBCATEGORIA
	=============================================*/

	static public function ctrEditarSubCategoria(){

		if(isset($_POST["editarSubCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])){

				$tabla = "subcategorias";

				$datos = array("id_categoria"=>trim($_POST["editarCategoria"]),
								"subcategoria"=>trim(ucwords($_POST["editarSubCategoria"])),
							   "id"=>trim($_POST["idSubCategoria"]));

							   var_dump($datos);

				$respuesta = ModeloSubCategorias::mdlEditarSubCategoria($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido cambiada correctamente",
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
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "categorias";

							}
						})

			  	</script>';

			}

		}

	}

}
