<?php

class ControladorVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarVentas($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearVenta(){

		if(isset($_POST["nuevaSecuencia"])){

			/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/

			if($_POST["listaProductos"] == ""){

					echo'<script>

				swal({
					  type: "error",
					  title: "La venta no se ha ejecuta si no hay productos",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

				return;
			}
			$neto=str_replace(',', '', $_POST["nuevoPrecioSubtotal"]);
			$utilidad=str_replace(',', '', $_POST["nuevoTotalUtilidadVenta"]);
			$impuesto=str_replace(',', '', $_POST["nuevoPrecioImpuesto"]);
			$totalVenta=str_replace(',', '', $_POST["nuevoTotalVenta"]);
			$descuento=str_replace(',', '', $_POST["nuevoDescuentoVenta"]);


			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "ventas";

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["nuevaSecuencia"],
						   "descripcion"=>$_POST["nuevaDescripcion"],
						   "detalle"=>$_POST["nuevaDetalleVenta"],
						   "productos"=>$_POST["listaProductos"],
						   "impuesto"=>$impuesto,
						   "descuento"=>$descuento,
						   "neto"=>$neto,
						   "utilidad"=>$utilidad,
						   "fecha_emision"=>$_POST["fecha_emision"],
						   "fecha_vencimiento"=>$_POST["fecha_vencimiento"],
						   "forma_pago"=>$_POST["nuevoFormaPagoVenta"],
						   "total"=>$totalVenta);

						   var_dump($datos);

						  

			 $respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

			 var_dump($respuesta);

			
			if($respuesta == "ok"){

				$listaProductos = json_decode($_POST["listaProductos"], true);

				$totalProductosComprados = array();
	
				foreach ($listaProductos as $key => $value) {
					

					var_dump($value['stock']);
				   array_push($totalProductosComprados, $value["cantidad"]);
					
				   $tablaProductos = "productos";
	
					$item = "id";
					$valor = $value["id"];
					$orden = "id";
	
					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);
	
					$item1a = "ventas";
					$valor1a = $traerProducto["ventas"]+$value["cantidad"] ;

					var_dump($traerProducto["ventas"]);
	
				$nuevasVentas = ModeloProductos::mdlActualizarProductoSalida($tablaProductos, $item1a, $valor1a, $valor);
	
					$item1b = "stock";
					$valor1b = $value["stock"];
	
					$nuevoStock = ModeloProductos::mdlActualizarProductoSalida($tablaProductos, $item1b, $valor1b, $valor);
	
				}
	
				$tablaClientes = "clientes";
	
				$item = "id";
				$valor = $_POST["seleccionarCliente"];
	
				//$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);
	
				
	
				$item1b = "ultima_compra";
	
				date_default_timezone_set('America/Guayaquil');
	
				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$valor1b = $fecha.' '.$hora;
	
				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);
	
 
				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>'; 

				

			}else {
				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "error",
					  title: "La venta no ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								
							})

				</script>';
			}
 
		}

	}
	
	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function ctrEditarVenta(){

		if(isset($_POST["editarVenta"])){

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "ventas";

			$item = "codigo";
			$valor = $_POST["editarVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*=============================================
			REVISAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/

			if($_POST["listaProductos"] == ""){

				$listaProductos = $traerVenta["productos"];
				$cambioProducto = false;


			}else{

				$listaProductos = $_POST["listaProductos"];
				$cambioProducto = true;
			}

			if($cambioProducto){

				$productos =  json_decode($traerVenta["productos"], true);

				$totalProductosComprados = array();

				foreach ($productos as $key => $value) {

					array_push($totalProductosComprados, $value["cantidad"]);
					
					$tablaProductos = "productos";

					$item = "id";
					$valor = $value["id"];
					$orden = "id";

					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

					$item1a = "ventas";
					$valor1a = $traerProducto["ventas"] - $value["cantidad"];

					$nuevasVentas = ModeloProductos::mdlActualizarProductoSalida($tablaProductos, $item1a, $valor1a, $valor);

					$item1b = "stock";
					$valor1b = $value["cantidad"] + $traerProducto["stock"];

					$nuevoStock = ModeloProductos::mdlActualizarProductoSalida($tablaProductos, $item1b, $valor1b, $valor);

				}

				$tablaClientes = "clientes";

				$itemCliente = "id";
				$valorCliente = $_POST["seleccionarCliente"];

				$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

				
				/*=============================================
				ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
				=============================================*/

				$listaProductos_2 = json_decode($listaProductos, true);

				$totalProductosComprados_2 = array();

				foreach ($listaProductos_2 as $key => $value) {

					array_push($totalProductosComprados_2, $value["cantidad"]);
					
					$tablaProductos_2 = "productos";

					$item_2 = "id";
					$valor_2 = $value["id"];
					$orden = "id";

					$traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2, $orden);

					$item1a_2 = "ventas";
					$valor1a_2 = $value["cantidad"] + $traerProducto_2["ventas"];

					$nuevasVentas_2 = ModeloProductos::mdlActualizarProductoSalida($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);

					$item1b_2 = "stock";
					$valor1b_2 = $traerProducto_2["stock"] - $value["cantidad"];

					$nuevoStock_2 = ModeloProductos::mdlActualizarProductoSalida($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);

				}

				$tablaClientes_2 = "clientes";

				$item_2 = "id";
				$valor_2 = $_POST["seleccionarCliente"];

				$traerCliente_2 = ModeloClientes::mdlMostrarClientes($tablaClientes_2, $item_2, $valor_2);

				
				$item1b_2 = "ultima_compra";

				date_default_timezone_set('America/Guayaquil');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$valor1b_2 = $fecha.' '.$hora;

				$fechaCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2);

			}

			$neto=str_replace(',', '', $_POST["nuevoPrecioSubtotal"]);
			$utilidad=str_replace(',', '', $_POST["nuevoTotalUtilidadVenta"]);
			$impuesto=str_replace(',', '', $_POST["nuevoPrecioImpuesto"]);
			$totalVenta=str_replace(',', '', $_POST["nuevoTotalVenta"]);
			$descuento=str_replace(',', '', $_POST["nuevoDescuentoVenta"]);
			var_dump($neto);

			/*=============================================
			GUARDAR CAMBIOS DE LA COMPRA
			=============================================*/	

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["editarVenta"],
						   "descripcion"=>$_POST["editarDescripcion"],
						   "detalle"=>$_POST["editarVentaOtros"],
						   "productos"=>$listaProductos,
						   "impuesto"=>$impuesto,
						   "descuento"=>$_POST["nuevoDescuentoVenta"],
						   "neto"=>$neto,
						   "utilidad"=>$utilidad,
						   "fecha_emision"=>$_POST["fecha_emision"],
						   "fecha_vencimiento"=>$_POST["fecha_vencimiento"],
						   "forma_pago"=>$_POST["nuevoFormaPagoVenta"],
						   "total"=>$totalVenta
						);

					
						 


			$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);

			var_dump($respuesta);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido editada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
						if (result.value) {

							window.location = "ventas";

							}
							})

				</script>';

			}
 
		}

	}


	/*=============================================
	ANULAR VENTA
	=============================================*/

	static public function ctrAnularVenta(){
		if (isset($_GET['idVentaHabilitarAprobar'])) {
		
		
			$tabla = "ventas";

			$item = "id";
			$valor = $_GET["idVentaHabilitarAprobar"];
	
			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
	
			/*=============================================
			ACTUALIZAR FECHA ÚLTIMA COMPRA
			=============================================*/
	
			$tablaClientes = "clientes";
	
			$itemVentas = null;
			$valorVentas = null;
	
			$traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);
	
	
			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
	
			$productos =  json_decode($traerVenta["productos"], true);
	
			$totalProductosComprados = array();
	
			foreach ($productos as $key => $value) {
	
				array_push($totalProductosComprados, $value["cantidad"]);
				
				$tablaProductos = "productos";
	
				$item = "id";
				$valor = $value["id"];
				$orden = "id";
	
				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);
	
				$item1a = "ventas";
				$valor1a = $traerProducto["ventas"] + $value["cantidad"];
	
				$nuevasVentas = ModeloProductos::mdlActualizarProductoSalida($tablaProductos, $item1a, $valor1a, $valor);
	
				$item1b = "stock";
				$valor1b = $traerProducto["stock"] - $value['cantidad'];
	
				$nuevoStock = ModeloProductos::mdlActualizarProductoSalida($tablaProductos, $item1b, $valor1b, $valor);
	
			}
	
			$tablaClientes = "clientes";
	
			$itemCliente = "id";
			$valorCliente = $traerVenta["id_cliente"];
	
			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);
	
			$item1b = "ultima_compra";
	
				date_default_timezone_set('America/Guayaquil');
	
				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$valor1b = $fecha.' '.$hora;
	
				$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);
	
	
	
			
		}
			
	
	
	}
	/*=============================================
	APROBAR VENTA
	=============================================*/

	static public function ctrAprobarVenta(){

		if (isset($_GET['idVentaHabilitarAnular'])) {
			$tabla = "ventas";

		$item = "id";
		$valor = $_GET["idVentaHabilitarAnular"];

		$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		/*=============================================
		ACTUALIZAR FECHA ÚLTIMA COMPRA
		=============================================*/

		$tablaClientes = "clientes";

		$itemVentas = null;
		$valorVentas = null;

		$traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);


		/*=============================================
		FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
		=============================================*/

		$productos =  json_decode($traerVenta["productos"], true);

		$totalProductosComprados = array();

		foreach ($productos as $key => $value) {

			array_push($totalProductosComprados, $value["cantidad"]);
			
			$tablaProductos = "productos";

			$item = "id";
			$valor = $value["id"];
			$orden = "id";

			$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

			$item1a = "ventas";
			$valor1a = $traerProducto["ventas"] - $value["cantidad"];

			$nuevasVentas = ModeloProductos::mdlActualizarProductoSalida($tablaProductos, $item1a, $valor1a, $valor);

			$item1b = "stock";
			$valor1b = $traerProducto["stock"] + $value['cantidad'];

			$nuevoStock = ModeloProductos::mdlActualizarProductoSalida($tablaProductos, $item1b, $valor1b, $valor);

		}

		$tablaClientes = "clientes";

		$itemCliente = "id";
		$valorCliente = $traerVenta["id_cliente"];

		$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

		$item1b = "ultima_compra";

			date_default_timezone_set('America/Guayaquil');

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$valor1b = $fecha.' '.$hora;

			$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);


	

		}
	}
	
	

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	public function ctrDescargarReporte(){

		if(isset($_GET["reporte"])){

			$tabla = "ventas";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			}


			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			//Nombre del archivo
			$Name = $_GET["reporte"].'.xls';

			
			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO FACTURA</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CODIGO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRECIO SIN IMPUESTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRECIO CON IMPUESTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>IMPUESTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>IMPUESTO TOTAL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>UTILIDAD</td>
					<td style='font-weight:bold; borde r:1px solid #eee;'>UTILIDAD TOTAL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>NETO</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>IMPUESTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>DESCUENTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>	
					<td style='font-weight:bold; border:1px solid #eee;'>UTILIDAD TOTAL</td>	
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>	
					<td style='font-weight:bold; border:1px solid #eee;'>ESTADO</td>	
					<td style='font-weight:bold; border:1px solid #eee;'>IMAGEN</td>	
					</tr>");

			foreach ($ventas as $row => $item){

				$cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
				$vendedor = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_vendedor"]);

			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["detalle"].' - '.$item["codigo"]."</td> 
			 			<td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>".$vendedor["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>");

						 
				 $productos =  json_decode($item["productos"], true);
				 
				 
		 		foreach ($productos as $key => $valueProductos) {
			 			
					echo utf8_decode($valueProductos["codigo"]."<br>");
				
				}

			 	

				 echo utf8_decode("</td><td style='border:1px solid #eee;'>");	
				 
				 foreach ($productos as $key => $valueProductos) {
			 			
					echo utf8_decode($valueProductos["descripcion"]."<br>");
				}
				 echo utf8_decode("</td><td style='border:1px solid #eee;'>");	
				 
				 foreach ($productos as $key => $valueProductos) {
			 			
					echo utf8_decode($valueProductos["cantidad"]."<br>");
				}
				
				 echo utf8_decode("</td><td style='border:1px solid #eee;'>");	
				 
				 foreach ($productos as $key => $valueProductos) {
			 			
					echo utf8_decode(number_format($valueProductos["precioSinIva"],2,',', '')."<br>");
				}
				 echo utf8_decode("</td><td style='border:1px solid #eee;'>");	
				 
				 foreach ($productos as $key => $valueProductos) {
			 			
					echo utf8_decode(number_format($valueProductos["precioIva"],2,',', '')."<br>");
				}
				 echo utf8_decode("</td><td style='border:1px solid #eee;'>");	
				 
				 foreach ($productos as $key => $valueProductos) {
			 			
					echo utf8_decode(number_format($valueProductos["impuestoTotal"],2,',', '')."<br>");
				}
				 echo utf8_decode("</td><td style='border:1px solid #eee;'>");	
				 
				 foreach ($productos as $key => $valueProductos) {
			 			
					echo utf8_decode(number_format($valueProductos["impuesto"],2,',', '')."<br>");
				}
				 echo utf8_decode("</td><td style='border:1px solid #eee;'>");	
				 
				 foreach ($productos as $key => $valueProductos) {
			 			
					echo utf8_decode(number_format($valueProductos["utilidad"],2,',', '')."<br>");

				 }
				 foreach ($productos as $key => $valueProductos) {
			 			
					echo utf8_decode($valueProductos["imagen"]."<br>");

				 }
				 echo utf8_decode("</td><td style='border:1px solid #eee;'>");	
				 
				 foreach ($productos as $key => $valueProductos) {
			 			
					echo utf8_decode(number_format($valueProductos["utilidadTotal"],2,',', '')."<br>");

				 }
				


		 		echo utf8_decode("</td>
				    <td style='border:1px solid #eee;'> ".number_format($item["neto"],2,',', '')."</td>	
					<td style='border:1px solid #eee;'> ".number_format($item["impuesto"],2,',', '')."</td>
					<td style='border:1px solid #eee;'>".number_format($item["descuento"],2,',', '')."</td>
					

					<td style='border:1px solid #eee;'> ".number_format($item["total"],2,',', '')."</td>
					<td style='border:1px solid #eee;'>".number_format($item["utilidad"],2,',', '')."</td>		
					
					<td style='border:1px solid #eee;'>".substr($item["fecha_emision"],0,10)."</td>		
					<td style='border:1px solid #eee;'>".substr($item["estado"],0,10)."</td>
					 </tr>");
					 
					


			}


			echo "</table>";

		}

	}


	/*=============================================
	SUMA TOTAL VENTAS
	=============================================*/

	static public function ctrSumaTotalVentas(){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

		return $respuesta;

	}

}