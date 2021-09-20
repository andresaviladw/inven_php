<?php

class ControladorImportarExcel{

	
	/*=============================================
	CREAR AUTOCONSUMO
	=============================================*/

	static public function ctrSubirImporte(){

			/*=============================================
			GUARDAR EL AUTOCONSUMO
			=============================================*/	

			if(isset($_FILES['file_importar']['name'])){

			$file_importar=$_FILES['file_importar']['name'];

			
			$rows=0;
			$datos1=array();
			$datos3=array();
			$datos;
			$elementos='';
			$id_responsable=$_POST['idResponsable'];
			$productos=$_POST['listaProductosEntradaImporte'];
			$fecha='';
			$fecha_vencimiento='';
			$id_proveedor='';
			$id_proveedor='';
			$id_documento='';
			$codigo='';
			$secuencia='';
			$forma_cobro='';
			$descripcion='';
			$subtotal=0;
			$impuesto=0;
			$total=0;
			$codigoEntr=0;

		
		

			echo $file_importar;


			$archivocopiado=$_FILES['file_importar']['tmp_name'];

			$archivoguardado='copia_'.$file_importar;


			echo '<br> El '.$file_importar.' esta en la ruta de: '.$archivocopiado;

			if (copy($archivocopiado,$archivoguardado)) {
				echo '<br> Se copio correctamente a la carpeta<br>';
			}else {
				echo 'hubo un error';
			}
			
			if (file_exists($archivoguardado)) {



				$fp=fopen($archivoguardado,'r');



				

				while ($datos=fgetcsv($fp,1000,";")) {

					$rows++;

					if ($rows>1) {
						
					$id_proveedor=$datos[0];
					$id_documento=$datos[1];
					$codigo=$datos[2];
					$secuencia=$datos[3];
					$forma_cobro=$datos[6];
					$descripcion=$datos[7];
					$fecha=date( "Y-m-d", strtotime(str_replace('/', '-', $datos[2])) );
					$fecha_vencimiento=date( "Y-m-d", strtotime(str_replace('/', '-', $datos[3])) );
					

					

						
					

					
					$item = "codigo";
					$valor = $datos[5];
					$orden = "id";

					$respuestaProducto = ControladorProductos::ctrMostrarProductos($item, $valor,
						$orden);


						

						$item="id";
						$valor=$respuestaProducto['id_impuesto'];

						

					$respuestaImpuesto=ControladorImpuestos::ctrMostrarImpuestoVentasVarios($item,$valor);

					
						foreach ($respuestaImpuesto as $key => $valueImpuesto) {
							
						}


						

						$calculoImpuesto=$respuestaProducto['precio_compra']*$valueImpuesto['valor'];


						$precioImpuesto=$calculoImpuesto/100;

						$cantidadConImpuesto=$datos[7]*$precioImpuesto;

						$valorUnitario=$respuestaProducto['precio_compra']*$datos[7];

						$item="id";
						$valor=$respuestaProducto['id_impuesto'];

						

						

					$datos2=array(
						'id'=>$respuestaProducto['id'],
						'codigo'=>$datos[5],
						"descripcion"=>substr($datos[6],1),'cantidad'=>$datos[7], 
					'precio'=>$respuestaProducto['precio_compra'],
					'valorimpuesto'=>$valueImpuesto['valor'],'impuesto'=>$precioImpuesto,
					'valorimpuesto'=>$valueImpuesto['valor'],
					'totalimpuesto'=>$cantidadConImpuesto, 'valorUnitario'=>$valorUnitario);

					

					if ($rows==2) {

						$itemEntr = null;
						$valorEntr = null;

						$respuestaEntradaMostrar=ControladorEntradas::ctrMostrarEntradas($itemEntr,$valorEntr);

						foreach ($respuestaEntradaMostrar as $key => $valueEntr) {

							
								$codigoEntr = ($valueEntr["codigo"]);
								if ($valueEntr["codigo"]==0) {
									$codigoEntr=$valueEntr["codigo"]+2;
								}else {
									$codigoEntr=$valueEntr["codigo"]+1;
								}
							
                        
							
                      
						}

						
						
  
						

						$datos1=[
							"id_responsable"=>$_POST['idResponsable'],
							"proveedor"=>$datos[0],
							"transaccion"=>$codigoEntr,"referencia"=>$datos[1],
						"fecha"=>$fecha,
	
						"fecha_vencimiento"=>$fecha_vencimiento,
						"forma_cobro"=>$datos[4],
						"descripcion"=>$datos[7],
						];
						echo '
						Id responsabe:&nbsp
						<input class="col-xs-* id_responsableImportar" type="text"  value="'.$datos1['id_responsable'].'" readonly>&nbsp &nbsp
						Codigo proveedor: &nbsp
						<input class="col-xs-* id_proveedorImportar" type="text"  value="'.$datos1['proveedor'].'" readonly>&nbsp &nbsp
						
						Transaccion: &nbsp';
						if ($datos1['transaccion']==0) {
							echo '<input class="col-xs-* codigoImportar" type="text"  value="1" readonly>&nbsp &nbsp<p></p>';
						} else {
							echo '<input class="col-xs-* codigoImportar" type="text"  value="'.$datos1['transaccion'].'" readonly>&nbsp &nbsp<p></p>';
						}
						
						
						echo '
						<div class="form-group">
						  
						<div class="input-group">
					  
					  <span>Tipo de comprobante</span> 
		
					  <select class="id_documentoImportar" name="nuevoComprobante" required>
						';
		
						
		
						$item = 'estado';
						$valor = 1;
		
						$comprobantes = ControladorComprobantes::ctrMostrarComprobantesHabilitados($item, $valor);
		
						foreach ($comprobantes as $key => $value) {
						  
						  echo '<option value="'.$value["id"].'">'.$value["codigo"].' '.$value["nombre"].'</option>';
						}
		
					
		
					 echo ' </select>
		
					
		
		
					</div>
					
		
				  </div>
						<p></p>
						Establecimiento:&nbsp
						<input class="col-xs-* establecimientoImportar" type="text" maxlength="3" placeholder="Establecimiento">&nbsp &nbsp
						Punto de emision:&nbsp
						<input class="col-xs-* puntoImportar" type="text" maxlength="3" placeholder="Punto de emision">&nbsp &nbsp
						Referencia:&nbsp
						<input class="col-xs-* secuenciaImportar" type="text"  value="'.$datos1['referencia'].'" readonly>&nbsp &nbsp
						ReferenciaComprobante:&nbsp
						<input class="col-xs-* secuenciaComprobante" type="text"  value="'.str_pad($datos1['referencia'], 9, "0", STR_PAD_LEFT).'" readonly>&nbsp &nbsp<p></p>
						Forma de cobro: &nbsp
						<input class="col-xs-* forma_cobroImportar" type="text"  value="'.$datos1['forma_cobro'].'" readonly>&nbsp &nbsp
						Descripcion: &nbsp
						<input class="col-xs-* descripcionImportar" type="text"  value="Entrada">&nbsp &nbsp
						fecha_emision:&nbsp
						<input class="col-xs-* fechaImportar" type="text"  value="'.$datos1['fecha'].'" readonly>&nbsp &nbsp<p></p>
						Fecha vencimiento:&nbsp
						<input class="col-xs-* fecha_vencimientoImportar" type="text"  value="'.$datos1['fecha_vencimiento'].'" readonly>&nbsp &nbsp
						<p></p>';

						

						
					}


						

					$listaProductos='
					<br>
						<input class="col-xs-* idEntradaImporte" type="text"  value="'.$datos2['id'].'" readonly>
						
						<input class="col-xs-* codigoEntradaImporte" type="text"  value="'.$datos2['codigo'].'" readonly>

						<input class="col-xs-* descripcionEntradaImporte" type="text"  value="'.$datos2['descripcion'].'"  readonly>

						<input class="col-xs-* cantidadEntradaImporte" type="text"  value="'.$datos2['cantidad'].'" readonly>

						<input class="col-xs-* impuestoEntradaImporte" type="text"  value="'.$datos2['valorimpuesto'].'" readonly>
						<input class="col-xs-* impuestoImporte" type="text"  value="'.$datos2['impuesto'].'" readonly>
						<input class="col-xs-* impuestoValorTotal" type="text"  value="'.$datos2['totalimpuesto'].'" readonly>

						

						<input class="col-xs-* precioImporte" type="text" value="'.$datos2['precio'].'" readonly>
						
						<input class="col-xs-* valorUnitarioImporte" type="text"  value="'.$datos2['valorUnitario'].'" readonly>';

						echo $listaProductos;

						
				}

				}


			}else {
				
				echo '<br>No existe una copia';
			}		
			
		}

		echo '<p></p><label class="subtotal">Subtotal:</label>&nbsp&nbsp&nbsp <input class="col-xs-* subtotalImportar" type="text" readonly><br>
						<label class="impuesto">Impuesto:</label>&nbsp&nbsp<input class="col-xs-* impuestoImportar" type="text" readonly><br>
						<label class="total">Total:</label>
						&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input class="col-xs-* totalImportar" type="text" readonly>';

	

			
	}

	static public function ctrCrearImporte($datos){
		

		$tabla='entradas';
				
		$listaProductosEntrada = json_decode($datos['productos'], true);

		

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
				$valor1b = $traerProducto["stock"]+$value["cantidad"];

			/* 	var_dump($valor1b); */

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			/* 	var_dump($nuevoStock); */

			}

			$tablaEntradasImportar="entradas";


			$datosAInsertar=array(
				"id_responsable"=>$datos['id_responsable'],
				"id_proveedor"=>$datos['id_proveedor'],
				"id_comprobante"=>$datos['id_comprobante'],
				"codigo"=>$datos['codigo'],
				"secuencia"=>$datos['secuencia'],
				"comprobante"=>$datos['comprobante'],
				"forma_cobro"=>$datos['forma_cobro'],
				"descripcion"=>$datos['descripcion'],
				"productos"=>$datos['productos'],
				"fecha_emision"=>$datos['fecha_emision'],
				"fecha_vencimiento"=>$datos['fecha_vencimiento'],
				"neto"=>floatval($datos['neto']),
				"impuesto"=>floatval($datos['impuesto']),
				"total_pagar"=>floatval($datos['total_pagar']));

				var_dump($datosAInsertar);

			

			$respuestaEntrada = ModeloImportarEntradas::mdlIngresarImportarEntrada($tablaEntradasImportar, $datosAInsertar);

			var_dump($respuestaEntrada);
			
			


}
}