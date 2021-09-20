<?php

require_once "conexion.php";

class ModeloTemporalKardex{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarTemporalKardex($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT productos FROM $tabla WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT productos FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlActualizarEntradaAhora($tablaentrada, $datosentrada){
		
		

	
	$stmt = Conexion::conectar()->prepare("INSERT INTO $tablaentrada (id_entrada, id_producto, codigo,comprobante,secuencia, descripcion,cantidad, fecha_emision,impuesto,valor_impuesto,impuesto_total,total) VALUES (:id_entrada, :id_producto,:codigo,:comprobante,:secuencia,:descripcion,:cantidad, :fecha_emision,:impuesto,:valor_impuesto,:impuesto_total,:total)");
	
			$stmt->bindParam(":id_entrada", $datosentrada["id_entrada"], PDO::PARAM_INT);
			$stmt->bindParam(":id_producto", $datosentrada["id_producto"], PDO::PARAM_INT);
			$stmt->bindParam(":codigo", $datosentrada["codigo"], PDO::PARAM_STR);
			$stmt->bindParam(":comprobante", $datosentrada["comprobante"], PDO::PARAM_STR);
			$stmt->bindParam(":secuencia", $datosentrada["secuencia"], PDO::PARAM_STR);
			$stmt->bindParam(":descripcion", $datosentrada["descripcion"], PDO::PARAM_STR);
			$stmt->bindParam(":cantidad", $datosentrada["cantidad"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_emision", $datosentrada["fecha_emision"], PDO::PARAM_STR);
			$stmt->bindParam(":impuesto", $datosentrada["impuesto"], PDO::PARAM_STR);
			$stmt->bindParam(":valor_impuesto", $datosentrada["valor_impuesto"], PDO::PARAM_STR);
			$stmt->bindParam(":impuesto_total", $datosentrada["impuesto_total"], PDO::PARAM_STR);		
			$stmt->bindParam(":total", $datosentrada["total"], PDO::PARAM_STR);		






		if($stmt->execute()){

			return "ok";



			

		}else{

			return $stmt->errorInfo();
		
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlActuallizarAutoconsumo($tablaautoconsumo, $datosautoconsumo){
		
		

	
	$stmt = Conexion::conectar()->prepare("INSERT INTO $tablaautoconsumo (id_autoconsumo, id_producto, codigo, descripcion,cantidad,motivo,total,fecha_emision) VALUES (:id_autoconsumo, :id_producto, :codigo,:descripcion,:cantidad,:motivo,:total,:fecha_emision)");
	
			$stmt->bindParam(":id_autoconsumo", $datosautoconsumo["id_autoconsumo"], PDO::PARAM_INT);
			$stmt->bindParam(":id_producto", $datosautoconsumo["id_producto"], PDO::PARAM_INT);
			$stmt->bindParam(":codigo", $datosautoconsumo["codigo"], PDO::PARAM_STR);
		
			$stmt->bindParam(":descripcion", $datosautoconsumo["descripcion"], PDO::PARAM_STR);
			$stmt->bindParam(":cantidad", $datosautoconsumo["cantidad"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_emision", $datosautoconsumo["fecha_emision"], PDO::PARAM_STR);
			$stmt->bindParam(":motivo", $datosautoconsumo["motivo"], PDO::PARAM_STR);		
			$stmt->bindParam(":total", $datosautoconsumo["total"], PDO::PARAM_STR);		






		if($stmt->execute()){

			return "ok";

			

		}else{

			return $stmt->errorInfo();
		
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlActualizarVentaA($tablaventa, $datosventa){
		
		

	
	$stmt = Conexion::conectar()->prepare("INSERT INTO $tablaventa (id_venta, id_producto,codigo,descripcion,cantidad, precio_venta,impuesto,valor_impuesto,impuesto_total,precioIva,precioSinIva,utilidad,utilidadTotal,fecha_emision) VALUES (:id_venta, :id_producto,:codigo,:descripcion,:cantidad,:precio_venta,:impuesto,:valor_impuesto,:impuesto_total,:precioIva,:precioSinIva,:utilidad,:utilidadTotal,:fecha_emision)");
	
			$stmt->bindParam(":id_venta", $datosventa["id_venta"], PDO::PARAM_INT);
			$stmt->bindParam(":id_producto", $datosventa["id_producto"], PDO::PARAM_INT);
			$stmt->bindParam(":cantidad", $datosventa["cantidad"], PDO::PARAM_STR);
			$stmt->bindParam(":codigo", $datosventa["codigo"], PDO::PARAM_STR);
			$stmt->bindParam(":descripcion", $datosventa["descripcion"], PDO::PARAM_STR);
			$stmt->bindParam(":precio_venta", $datosventa["precio_venta"], PDO::PARAM_STR);
			$stmt->bindParam(":impuesto", $datosventa["impuesto"], PDO::PARAM_STR);
			$stmt->bindParam(":precioIva", $datosventa["precioIva"], PDO::PARAM_STR);
			$stmt->bindParam(":precioIva", $datosventa["precioIva"], PDO::PARAM_STR);
			$stmt->bindParam(":valor_impuesto", $datosventa["valor_impuesto"], PDO::PARAM_STR);		
			$stmt->bindParam(":impuesto_total", $datosventa["impuesto_total"], PDO::PARAM_STR);		
			$stmt->bindParam(":precioIva", $datosventa["precioIva"], PDO::PARAM_STR);		
			$stmt->bindParam(":precioSinIva", $datosventa["precioSinIva"], PDO::PARAM_STR);		
			$stmt->bindParam(":utilidad", $datosventa["utilidad"], PDO::PARAM_STR);		
			$stmt->bindParam(":utilidadTotal", $datosventa["utilidadTotal"], PDO::PARAM_STR);		
			$stmt->bindParam(":fecha_emision", $datosventa["fecha_emision"], PDO::PARAM_STR);	

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

	static public function mdlTruncarTabla($tablaAutoconsumos,$tablaEntradas,$tablaVentas){

		
		$stmt = Conexion::conectar()->prepare("SET FOREIGN_KEY_CHECKS=0;
		TRUNCATE $tablaAutoconsumos;
		TRUNCATE $tablaEntradas;
		TRUNCATE $tablaVentas;
		SET FOREIGN_KEY_CHECKS=1;");

		if($stmt->execute()){

			return "ok";

		}else{

			$stmt->errorInfo();
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function mdlEliminarEntrada($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasTemporalKardex($tabla, $fechaInicial, $fechaFinal){

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
	SUMAR EL TOTAL DE TemporalKardex
	=============================================*/

	static public function mdlSumaTotalTemporalKardex($tabla){	

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