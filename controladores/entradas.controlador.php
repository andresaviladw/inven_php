<?php



class ControladorEntradas{

	/*=============================================
	MOSTRAR ENTRADAS
	=============================================*/

	static public function ctrMostrarEntradas($item, $valor){

		$tabla = "entradas";

		$respuesta = ModeloEntradas::mdlMostrarEntradas($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR ENTRADA
	=============================================*/

	static public function ctrCrearEntrada(){

		if(isset($_POST["nuevaEntrada"])){

			/*=============================================
			ACTUALIZAR LAS ENTRADAS DE LOS PRODUCTOS Y AUMENTAR EL STOCK
			=============================================*/

			if($_POST["listaProductosEntrada"] == ""){

					echo'<script>

				swal({
					  type: "error",
					  title: "La entrada no se ha ejecuta si no hay productos",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								
							})

				</script>';

				return;
			}


			$listaProductosEntrada = json_decode($_POST["listaProductosEntrada"], true);

			$totalProductosEntrada = array();

			foreach ($listaProductosEntrada as $key => $value) {

			   array_push($totalProductosEntrada, $value["cantidad"]);
				
			   $tablaProductos = "productos";

			    $item = "codigo";
			    $valor = $value["codigo"];
			    $orden = "id";

				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);
				
				$item1a = "entradas";
				$valor1a = $value["cantidad"] + $traerProducto["entradas"];

			    $nuevasEntradas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);


				$item1b = "stock";
				$valor1b = $value["stock"];

				var_dump($valor1b);

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

				var_dump($nuevoStock);

			}

			
			/*=============================================
			GUARDAR LA ENTRADA
			=============================================*/	

			$tabla = "entradas";
			$secuencia=str_pad($_POST["nuevaSecuencia"], 9, "0", STR_PAD_LEFT);

			$neto=str_replace(',', '', $_POST["nuevoSubTotalEntrada"]);
		
			$impuesto=str_replace(',', '', $_POST["nuevoImpuestoEntrada"]);
			$totalEntrada=str_replace(',', '', $_POST["totalEntrada"]);
			


			
		$datos = array("id_responsable"=>$_POST["idResponsable"], 
		"id_proveedor"=>$_POST["nuevoProveedor"], "id_comprobante"=>$_POST["nuevoComprobante"],"comprobante"=>$_POST["nuevoCodigoEstablecimiento"].$_POST["nuevoPuntoEmision"].$secuencia,

		"secuencia"=>trim(ucwords($_POST['nuevaSecuencia'])),
		"descripcion"=>trim(ucwords($_POST['nuevaDescripcion'])),

			"codigo"=>$_POST["nuevaEntrada"],
			"productos"=>$_POST["listaProductosEntrada"],
			"fecha_emision"=>$_POST["fecha_emision_entrada"],
			"fecha_vencimiento"=>$_POST["fecha_vencimiento_entrada"],
			"productos"=>$_POST["listaProductosEntrada"],
			"impuesto"=>$impuesto,
			"neto"=>$neto,
			"total_pagar"=>$totalEntrada);

		

			echo '<br>';

		
			var_dump($datos);



			$respuesta = ModeloEntradas::mdlIngresarEntrada($tabla, $datos);
			
			var_dump($respuesta);
			if($respuesta == "ok"){


	
				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La Entrada de productos ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
						if (result.value) {

							window.location = "gestionar-entradas";

						}
							
							})

				</script>';

			}
		else{
				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "error",
					  title: "La Entrada de productos no ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
						
							})

				</script>';
		} 

		}

	}

	
	/*=============================================
	EDITAR ENTRADA
	=============================================*/

	static public function ctrEditarEntrada(){

		if(isset($_POST["editarEntrada"])){

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "entradas";

			$item = "codigo";
			$valor = $_POST["editarEntrada"];

			$traerEntrada = ModeloEntradas::mdlMostrarEntradas($tabla, $item, $valor);

			/*=============================================
			REVISAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/

			if($_POST["listaProductosEntrada"] == ""){

				$listaProductosEntrada = $traerEntrada["productos"];
				$cambioProducto = false;


			}else{

				$listaProductosEntrada = $_POST["listaProductosEntrada"];
				$cambioProducto = true;
			}

			if($cambioProducto){

				$productos =  json_decode($traerEntrada["productos"], true);

				$totalProductosEntrada = array();

				foreach ($productos as $key => $value) {

					array_push($totalProductosEntrada, $value["cantidad"]);
					
					$tablaProductos = "productos";

					$item = "codigo";
					$valor = $value["codigo"];
					$orden = "id";

					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

					$item1a = "entradas";
					$valor1a = $traerProducto["entradas"] - $value["cantidad"];

					$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

					$item1b = "stock";
					$valor1b = $traerProducto["stock"]-$value["cantidad"];

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

				}


				/*=============================================
				ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
				=============================================*/

				$listaProductosEntrada2 = json_decode($listaProductosEntrada, true);

				$totalProductosEntrada_2 = array();

				foreach ($listaProductosEntrada2 as $key => $value) {

					

					array_push($totalProductosEntrada_2, $value["cantidad"]);
					
					$tablaProductos_2 = "productos";

					$item_2 = "codigo";
					$valor_2 = $value["codigo"];
					$orden = "id";

					$traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2, $orden);

					$item1a_2 = "entradas";
					$valor1a_2 = $value["cantidad"] +$traerProducto_2["entradas"];

					$nuevasVentas_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);

					$item1b_2 = "stock";
					$valor1b_2 = $traerProducto_2["stock"] +$value["cantidad"];

					$nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);

				}

				

			

			}

		
			$secuencia=str_pad($_POST["editarSecuencia"], 9, "0", STR_PAD_LEFT);

			$neto=str_replace(',', '', $_POST["nuevoSubTotalEntrada"]);
			$impuesto=str_replace(',', '', $_POST["nuevoImpuestoEntrada"]);
			$totalEntrada=str_replace(',', '', $_POST["nuevoTotalEntrada"]);

			/*=============================================
			GUARDAR CAMBIOS DE LA COMPRA
			=============================================*/	
			
			$datos = array("id_responsable"=>$_POST["idResponsable"],
			"id_proveedor"=>$_POST["editarProveedor"], "id_comprobante"=>$_POST["editarComprobante"],"comprobante"=>$_POST["editarCodigoEstablecimiento"].$_POST["editarPuntoEmision"].$secuencia,
			"descripcion"=>trim(ucwords($_POST['editarDescripcion'])),
			"codigo"=>$_POST["editarEntrada"],
			"productos"=>$listaProductosEntrada,
			"neto"=>$neto,
			"fecha_emision"=>$_POST["fecha_emision_entrada"],
			"fecha_vencimiento"=>$_POST["fecha_vencimiento_entrada"],
			"impuesto"=>$impuesto,
			"total_pagar"=>$totalEntrada
						);

						   //var_dump($datos);


			$respuesta = ModeloEntradas::mdlEditarEntrada($tabla, $datos);

			var_dump($respuesta);

			

	if($respuesta == "ok"){

				echo'<script>

			

				swal({
					  type: "success",
					  title: "La entrada ha sido editada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

									window.location = "gestionar-entradas";

								}
							})

				</script>';

			}else{
				echo'<script>


				swal({
					  type: "error",
					  title: "La entrada no ha sido editada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
						
							})
							
							</script>';

			}
			

		}

	}

	

/*=============================================
	ANULAR VENTA
	=============================================*/

	static public function ctrAnularEntrada(){
		if (isset($_GET['idEntradaHabilitarAprobar'])) {
		
		
			$tabla = "entradas";

			$item = "id";
			$valor = $_GET["idEntradaHabilitarAprobar"];

			$traerEntrada = ModeloEntradas::mdlMostrarEntradas($tabla, $item, $valor);


			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/

			$productos =  json_decode($traerEntrada["productos"], true);

			$totalProductosEntrada = array();

			foreach ($productos as $key => $value) {

				array_push($totalProductosEntrada, $value["cantidad"]);
				
				$tablaProductos = "productos";

				$item = "codigo";
				$valor = $value["codigo"];
				$orden = "id";

				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

				$item1a = "entradas";
				$valor1a = $traerProducto["entradas"] + $value["cantidad"];

				$nuevasEntradas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $traerProducto["stock"] +$value["cantidad"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			
			}
	
	}
	}
	/*=============================================
	APROBAR VENTA
	=============================================*/

	static public function ctrAprobarEntrada(){

		if (isset($_GET['idEntradaHabilitarAnular'])) {
		
		
			$tabla = "entradas";

			$item = "id";
			$valor = $_GET["idEntradaHabilitarAnular"];

			$traerEntrada = ModeloEntradas::mdlMostrarEntradas($tabla, $item, $valor);


			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/

			$productos =  json_decode($traerEntrada["productos"], true);

			$totalProductosEntrada = array();

			foreach ($productos as $key => $value) {

				array_push($totalProductosEntrada, $value["cantidad"]);
				
				$tablaProductos = "productos";

				$item = "codigo";
				$valor = $value["codigo"];
				$orden = "id";

				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

				$item1a = "entradas";
				$valor1a = $traerProducto["entradas"] - $value["cantidad"];

				$nuevasEntradas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $traerProducto["stock"] -$value["cantidad"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			
			}
	
	}
	}
	
	


	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasEntradas($fechaInicial, $fechaFinal){

		$tabla = "entradas";

		$respuesta = ModeloEntradas::mdlRangoFechasEntradas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	




	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	public function ctrDescargarReporteEntradas(){

		if(isset($_GET["reporte"])){

			$tabla = "entradas";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$entradas = ModeloEntradas::mdlRangoFechasEntradas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$entradas = ModeloEntradas::mdlMostrarEntradas($tabla, $item, $valor);

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
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>RESPONSABLE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TIPO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>DOCUMENTO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>PROVEEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CODIGO PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>	
					<td style='font-weight:bold; border:1px solid #eee;'>PRECIO</td>	
					<td style='font-weight:bold; border:1px solid #eee;'>VALOR UNITARIO</td>	
					<td style='font-weight:bold; border:1px solid #eeee;'>NETO</td>
					<td style='font-weight:bold; border:1px solid #eeee;'>IVA</td>
					<td style='font-weight:bold; border:1px solid #eeee;'>TOTAL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
					</tr>");

			foreach ($entradas as $row => $item){

				
				$responsable = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_responsable"]);
				$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $item["id_comprobante"]);
				$proveedor = ControladorProveedores::ctrMostrarProveedores("codigo", $item["id_proveedor"]);

			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["codigo"]."</td>
			 			<td style='border:1px solid #eee;'>".$responsable["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>".$comprobante["nombre"]."</td>
						 <td style='border:1px solid #eee;'>".substr($item["comprobante"],0,3).'-'.substr($item["comprobante"],3,3).'-'.ltrim(substr($item["comprobante"],6,9),0)."</td>
			 			<td style='border:1px solid #eee;'>".$proveedor["proveedor"]."</td>
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
						
				   echo utf8_decode($valueProductos["total"]."<br>");
			   }

		 		echo utf8_decode("</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["neto"],2)."</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["impuesto"],2)."</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["total_pagar"],2)."</td>
					
					<td style='border:1px solid #eee;'>".substr($item["fecha_entrada"],0,10)."</td>		
		 			</tr>");


			}


			echo "</table>";

		}

	}


	

}