<?php

require_once "conexion.php";

class ModeloComprobantes{

	/*=============================================
	CREAR COMPROBANTE
	=============================================*/

	static public function mdlIngresarComprobante($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, nombre) VALUES (:codigo,:nombre)");

		$stmt->bindParam(":codigo", $datos['codigo'], PDO::PARAM_STR);

        $stmt->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR COMPROBANTES
	=============================================*/

	static public function mdlMostrarComprobantes($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}
	/*=============================================
	MOSTRAR COMPROBANTES HABILITADOS
	=============================================*/

	static public function mdlMostrarComprobantesHabilitados($tabla, $item, $valor){

	

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		

			$stmt -> close();

			$stmt = null;

	}

	/*=============================================
	EDITAR COMPROBANTE
	=============================================*/

	static public function mdlEditarComprobante($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo = :codigo, nombre = :nombre WHERE id = :id");

        $stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
/*=============================================
	ACTUALIZAR ENTRADA
	=============================================*/

	static public function mdlActualizarComprobanteEstado($tabla, $item1, $valor1, $item2, $valor2){

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

