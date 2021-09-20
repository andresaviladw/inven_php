<?php

class ControladorAutoconsumos{

	/*=============================================
	MOSTRAR AUTOCONSUMOS
	=============================================*/

	static public function ctrMostrarAutoconsumos($item, $valor){

		$tabla = "autoconsumos";

		$respuesta = ModeloAutoconsumos::mdlMostrarAutoconsumos($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR AUTOCONSUMO
	=============================================*/

	static public function ctrCrearAutoconsumo(){

		
		

			/*=============================================
			GUARDAR EL AUTOCONSUMO
			=============================================*/	

			if(isset($_POST['nuevoAutoconsumo'])){

			$tabla = "autoconsumos";
			$totalAutoconsumo=str_replace(',', '', $_POST["nuevoTotalAutoconsumo"]);

			$datos = array("id_usuario"=>$_POST["idResponsable"],
						   "codigo"=>$_POST["nuevoAutoconsumo"],
						   "descripcion"=>$_POST["nuevaDescripcion"],
						   "productos"=>$_POST["listaProductosAutoconsumo"],
						   "fecha_emision"=>$_POST["fecha_emision_autoconsumo"],
						   "total"=>$totalAutoconsumo);


						   var_dump($datos);

						  

			 $respuesta = ModeloAutoconsumos::mdlIngresarAutoconsumo($tabla, $datos);

			 var_dump($respuesta);

			
			if($respuesta == "ok"){

				if($_POST['listaProductosAutoconsumo'] == ""){

					echo'<script>
		
				swal({
					  type: "error",
					  title: "El autoconsumo no se ha ejecuta si no hay productos",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {
		
								window.location = "autoconsumos";
		
								}
							})
		
				</script>';
		
			
			}

				$listaProductos = json_decode($_POST["listaProductosAutoconsumo"], true);

				

		



				$totalProductosComprados = array();

			foreach ($listaProductos as $key => $value) {

			   array_push($totalProductosComprados, $value["cantidad"]);
				
			   $tablaProductos = "productos";

			    $item = "id";
			    $valor = $value["id"];
			    $orden = "id";

			    $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

				$item1a = "autoconsumos";
				$valor1a = $value["cantidad"] + $traerProducto["autoconsumos"];

			$nuevosAutoconsumos = ModeloProductos::mdlActualizarProductoSalida($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProductoSalida($tablaProductos, $item1b, $valor1b, $valor);

			}

			

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "El autoconsumo ha sido guardado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "autoconsumos";

								}
							})

				</script>';

			}else {
				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "error",
					  title: "El autoconsumo no ha sido guardado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								
							})

				</script>';
			}

		
 
	}
	}

	/*=============================================
	EDITAR Autoconsumo
	=============================================*/

	static public function ctrEditarAutoconsumo(){

		if(isset($_POST["editarAutoconsumo"])){

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "autoconsumos";

			$item = "codigo";
			$valor = $_POST["editarAutoconsumo"];

			$traerAutoconsumo = ModeloAutoconsumos::mdlMostrarAutoconsumos($tabla, $item, $valor);

			/*=============================================
			REVISAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/

			if($_POST['listaProductosAutoconsumo'] == ""){

				$listaProductos = $traerAutoconsumo["productos"];
				$cambioProducto = false;


			}else{

				$listaProductos = $_POST['listaProductosAutoconsumo'];
				$cambioProducto = true;
			}

			if($cambioProducto){

				$productos =  json_decode($traerAutoconsumo["productos"], true);

				$totalProductosComprados = array();

				foreach ($productos as $key => $value) {

					array_push($totalProductosComprados, $value["cantidad"]);
					
					$tablaProductos = "productos";

					$item = "id";
					$valor = $value["id"];
					$orden = "id";

					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

					$item1a = "autoconsumos";
					$valor1a = $traerProducto["autoconsumos"] - $value["cantidad"];

					$nuevosAutoconsumos = ModeloProductos::mdlActualizarProductoSalida($tablaProductos, $item1a, $valor1a, $valor);

					$item1b = "stock";
					$valor1b = $value["cantidad"] + $traerProducto["stock"];

					$nuevoStock = ModeloProductos::mdlActualizarProductoSalida($tablaProductos, $item1b, $valor1b, $valor);

				}


				
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

					$item1a_2 = "autoconsumos";
					$valor1a_2 = $value["cantidad"] + $traerProducto_2["autoconsumos"];

					$nuevasVentas_2 = ModeloProductos::mdlActualizarProductoSalida($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);

					$item1b_2 = "stock";
					$valor1b_2 = $traerProducto_2["stock"] - $value["cantidad"];

					$nuevoStock_2 = ModeloProductos::mdlActualizarProductoSalida($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);

				}

				

				
			

			}

			/*=============================================
			GUARDAR CAMBIOS DE LA COMPRA
			=============================================*/	

			$datos = array(
				"id_usuario"=>$_POST["idResponsable"],
			"codigo"=>$_POST["editarAutoconsumo"],
			"descripcion"=>$_POST["editarDescripcion"],
			"productos"=>$listaProductos,
			"fecha_emision"=>$_POST["fecha_emision_autoconsumo"],
			"total"=>$_POST["nuevoTotalAutoconsumo"]);

			var_dump($datos);

						 


			 $respuesta = ModeloAutoconsumos::mdlEditarAutoconsumo($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "El autoconsumo ha sido guardado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
						if (result.value) {
							window.location = "autoconsumos";
							}
							})

				</script>';

			} 
		}

	}


	/*=============================================
	ANULAR AUTOCONSUMO
	=============================================*/

	static public function ctrAnularAutoconsumo(){
		if (isset($_GET['idAutoconsumoHabilitarAprobar'])) {
		
		
			$tabla = "autoconsumos";

			$item = "id";
			$valor = $_GET["idAutoconsumoHabilitarAprobar"];
	
			$traerAutoconsumo = ModeloAutoconsumos::mdlMostrarAutoconsumos($tabla, $item, $valor);
	
	
			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
	
			$productos =  json_decode($traerAutoconsumo["productos"], true);

			var_dump($productos);
	
			$totalProductosComprados = array();
	
			foreach ($productos as $key => $value) {
	
				array_push($totalProductosComprados, $value["cantidad"]);
				
				$tablaProductos = "productos";
	
				$item = "id";
				$valor = $value["id"];
				$orden = "id";
	
				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);
	
				$item1a = "autoconsumos";
				$valor1a = $traerProducto["autoconsumos"] - $value["cantidad"];
	
				$nuevasVentas = ModeloProductos::mdlActualizarProductoSalida($tablaProductos, $item1a, $valor1a, $valor);
	
				$item1b = "stock";
				$valor1b = $traerProducto["stock"] + $value['cantidad'];
	
				$nuevoStock = ModeloProductos::mdlActualizarProductoSalida($tablaProductos, $item1b, $valor1b, $valor);

				var_dump($nuevoStock);
	
			}
	
			
		}
			
	
	
	}
	/*=============================================
	APROBAR VENTA
	=============================================*/

	static public function ctrAprobarAutoconsumo(){

		if (isset($_GET['idAutoconsumoHabilitarAnular'])) {
			$tabla = "autoconsumos";

		$item = "id";
		$valor = $_GET["idAutoconsumoHabilitarAnular"];

		$traerAutoconsumo = ModeloAutoconsumos::mdlMostrarAutoconsumos($tabla, $item, $valor);



		/*=============================================
		FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
		=============================================*/

		$productos =  json_decode($traerAutoconsumo["productos"], true);

		$totalProductosComprados = array();

		foreach ($productos as $key => $value) {

			array_push($totalProductosComprados, $value["cantidad"]);
			
			$tablaProductos = "productos";

			$item = "id";
			$valor = $value["id"];
			$orden = "id";

			$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

			$item1a = "autoconsumos";
			$valor1a = $traerProducto["autoconsumos"] - $value["cantidad"];

			$nuevasVentas = ModeloProductos::mdlActualizarProductoSalida($tablaProductos, $item1a, $valor1a, $valor);

			$item1b = "stock";
			$valor1b = $traerProducto["stock"] - $value['cantidad'];

			$nuevoStock = ModeloProductos::mdlActualizarProductoSalida($tablaProductos, $item1b, $valor1b, $valor);

			var_dump($nuevoStock);

		}

	

		}
	}
	
	

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasAutoconsumo($fechaInicial, $fechaFinal){

		$tabla = "autoconsumos";

		$respuesta = ModeloAutoconsumos::mdlRangoFechasAutoconsumos($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	public function ctrDescargarReporte(){

		if(isset($_GET["reporte"])){

			$tabla = "autoconsumos";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$autoconsumos = ModeloAutoconsumos::mdlRangoFechasAutoconsumos($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$autoconsumos = ModeloAutoconsumos::mdlMostrarAutoconsumos($tabla, $item, $valor);

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
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO AUTOCONSUMO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>DESCRIPCION</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>USUARIO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>CODIGO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>PRECIO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>MOTIVO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VALOR UNITARIO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>	
					<td style='font-weight:bold; border:1px solid #eee;'>ESTADO</td>	
					</tr>");

			foreach ($autoconsumos as $row => $item){

			
				$usuario = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_usuario"]);

			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
			 			<td style='border:1px solid #eee;'>".$item["descripcion"]."</td>
			 			<td style='border:1px solid #eee;'>".$usuario["nombre"]."</td>
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
			 			
					echo utf8_decode($valueProductos["precio"]."<br>");
				}
				 echo utf8_decode("</td><td style='border:1px solid #eee;'>");	
				 
				 foreach ($productos as $key => $valueProductos) {
			 			
					echo utf8_decode($valueProductos["motivo"]."<br>");
				}
				 echo utf8_decode("</td><td style='border:1px solid #eee;'>");	
				 
				 foreach ($productos as $key => $valueProductos) {
			 			
					echo utf8_decode(number_format($valueProductos["total"],2)."<br>");
				}


		 		echo utf8_decode("</td>
					<td style='border:1px solid #eee;'> ".number_format($item["total"],2)."</td>	
					
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

	static public function ctrSumaTotalAutoconsumos(){

		$tabla = "autoconsumos";

		$respuesta = ModeloAutoconsumos::mdlSumaTotalAutoconsumos($tabla);

		return $respuesta;

	}

}