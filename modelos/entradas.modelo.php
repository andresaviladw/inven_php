<?php

require_once "conexion.php";

class ModeloEntradas{

	/*=============================================
	MOSTRAR ENTRADAS
	=============================================*/

	static public function mdlMostrarEntradas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarEntradasKardex($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarEntrada($tabla, $datos){
		
		

	
	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_responsable, id_proveedor,id_comprobante,comprobante, secuencia, descripcion, productos,neto,impuesto,total_pagar,fecha_emision,fecha_vencimiento) VALUES (:codigo, :id_responsable, :id_proveedor,:id_comprobante,:comprobante, :secuencia, :descripcion, :productos,:neto,:impuesto,:total_pagar,:fecha_emision,:fecha_vencimiento)");
	
			$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
			$stmt->bindParam(":id_responsable", $datos["id_responsable"], PDO::PARAM_INT);
			$stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_STR);
			$stmt->bindParam(":id_comprobante", $datos["id_comprobante"], PDO::PARAM_INT);
			$stmt->bindParam(":comprobante", $datos["comprobante"], PDO::PARAM_STR);
			$stmt->bindParam(":secuencia", $datos["secuencia"], PDO::PARAM_STR);
			$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
			$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
			$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
			$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
			$stmt->bindParam(":total_pagar", $datos["total_pagar"], PDO::PARAM_STR);		
			$stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);		
			$stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);		






		if($stmt->execute()){

			return "ok";

			

		}else{

			return $stmt->errorInfo();
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlEditarEntrada($tabla, $datos){

		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  id_responsable = :id_responsable,id_proveedor=:id_proveedor,id_comprobante=:id_comprobante, comprobante=:comprobante, descripcion=:descripcion, productos = :productos,impuesto=:impuesto,neto=:neto, total_pagar= :total_pagar, fecha_emision= :fecha_emision, fecha_vencimiento= :fecha_vencimiento WHERE codigo = :codigo");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_responsable", $datos["id_responsable"], PDO::PARAM_INT);
		$stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_STR);
		$stmt->bindParam(":id_comprobante", $datos["id_comprobante"], PDO::PARAM_INT);
		$stmt->bindParam(":comprobante", $datos["comprobante"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":total_pagar", $datos["total_pagar"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();
		
		}

		$stmt->close();
		$stmt = null;

	}



	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasEntradas($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_entrada like '%$fechaFinal%'");

			$stmt -> bindParam(":fecha_entrada", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_entrada BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_entrada BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	SUMAR EL TOTAL DE ENTRADAS
	=============================================*/

	static public function mdlSumaTotalEntradas($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(neto) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	
	/*=============================================
	ACTUALIZAR ENTRADA
	=============================================*/

	static public function mdlActualizarEntradaEstado($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
			
		
		}else{

			return $stmt->errorInfo();	

		}

		$stmt -> close();

		$stmt = null;

	}

	
}