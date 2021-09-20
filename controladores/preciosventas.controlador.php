<?php

class ControladorPreciosVentas{

	/*=============================================
	CREAR PRECIO VENTA
	=============================================*/

	static public function ctrCrearPrecioVenta(){

		if(isset($_POST["nuevoPrecioVenta"])){

			if(preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta"])){

				$tabla = "preciosventas";

				$datos = array("id_producto"=>trim($_POST["nuevoProducto"]),
								"precio_venta"=>trim(ucwords($_POST["nuevoPrecioVenta"])));

								var_dump($datos);

				$respuesta = ModeloPreciosVentas::mdlIngresarPrecioVenta($tabla, $datos);

				var_dump($respuesta);

				if($respuesta == "ok"){


					echo'<script>

					swal({
						  type: "success",
						  title: "El precio venta ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "preciosventas";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El precio venta no puede ir vacio!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "preciosventas";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR PRECIOS VENTAS
	=============================================*/

	static public function ctrMostrarPreciosVentas($item, $valor){

		$tabla = "preciosventas";
		

		$respuesta = ModeloPreciosVentas::mdlMostrarPreciosVentas($tabla, $item, $valor);

		return $respuesta;
	
	}
	/*=============================================
	MOSTRAR PRECIOS VENTAS TODOS
	=============================================*/

	static public function ctrMostrarPreciosVentasVarios($item, $valor){

		$tabla = "preciosventas";
		

		$respuesta = ModeloPreciosVentas::mdlMostrarPreciosVentasVarios($tabla, $item, $valor);

		return $respuesta;
	
	}




	/*=============================================
	EDITAR PRECIOSVENTAS
	=============================================*/

	static public function ctrEditarPrecioVenta(){

		if(isset($_POST["editarPrecioVenta"])){

			

				$tabla = "preciosventas";

				$datos = array("id_producto"=>trim($_POST["editarProducto"]),
								"precio_venta"=>trim($_POST["editarPrecioVenta"]),
							   "id"=>trim($_POST["idPrecioVenta"]));

							   var_dump($datos);

				$respuesta = ModeloPreciosVentas::mdlEditarPrecioVenta($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El precio de venta ha sido modificado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
                            window.location = "preciosventas";
								})

					</script>';

				}


			

		}

	}

}
