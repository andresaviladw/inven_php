<?php

require_once "conexion.php";

class ModeloImportarEntradas{


	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarImportarEntrada($tablaEntradasImportar, $datosAInsertar){						
		

	$stmt = Conexion::conectar()->prepare("INSERT INTO $tablaEntradasImportar (id_responsable, id_proveedor,id_comprobante,codigo,comprobante,secuencia,descripcion,productos,neto,impuesto,fecha_emision,fecha_vencimiento,total_pagar) VALUES (:id_responsable, :id_proveedor,:id_comprobante,:codigo,:comprobante ,:secuencia, :descripcion,:productos,:neto,:impuesto,:fecha_emision,:fecha_vencimiento,:total_pagar)");


			
			$stmt->bindParam(":id_responsable", $datosAInsertar["id_responsable"], PDO::PARAM_INT);
			$stmt->bindParam(":id_proveedor", $datosAInsertar["id_proveedor"], PDO::PARAM_STR);
			$stmt->bindParam(":id_comprobante", $datosAInsertar["id_comprobante"], PDO::PARAM_INT);
			$stmt->bindParam(":codigo", $datosAInsertar["codigo"], PDO::PARAM_STR);
			$stmt->bindParam(":comprobante", $datosAInsertar["comprobante"], PDO::PARAM_STR);
			$stmt->bindParam(":secuencia", $datosAInsertar["secuencia"], PDO::PARAM_STR);
			$stmt->bindParam(":descripcion", $datosAInsertar["descripcion"], PDO::PARAM_STR);
			$stmt->bindParam(":productos", $datosAInsertar["productos"], PDO::PARAM_STR);
			$stmt->bindParam(":neto", $datosAInsertar["neto"], PDO::PARAM_STR);
			$stmt->bindParam(":impuesto", $datosAInsertar["impuesto"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_emision", $datosAInsertar["fecha_emision"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_vencimiento", $datosAInsertar["fecha_vencimiento"], PDO::PARAM_STR);
			$stmt->bindParam(":total_pagar", $datosAInsertar["total_pagar"], PDO::PARAM_STR);		


		if($stmt->execute()){

			return 'ok';

			

		}else{

			return $stmt ->errorInfo();

			
		}

		$stmt->close();
		$stmt = null;

	}

	
	
}