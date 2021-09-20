<?php

require_once "conexion.php";

class ModeloImpuestos{

	/*=============================================
	CREAR CATEGORIA
	=============================================*/

	static public function mdlIngresarImpuesto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, nombre, valor) VALUES (:codigo, :nombre, :valor)");

		$stmt->bindParam(":codigo", $datos['codigo'], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
		$stmt->bindParam(":valor", $datos['valor'], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function mdlMostrarImpuestos($tabla, $item, $valor){

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
	EDITAR IMPUESTO
	=============================================*/

	static public function mdlEditarImpuesto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo = :codigo, nombre=:nombre, valor=:valor WHERE id = :id");

		$stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":valor", $datos["valor"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt;
		
		}

		$stmt->close();
		$stmt = null;

	}

	
	/*=============================================
	ACTUALIZAR IMPUESTO
	=============================================*/

	static public function mdlActualizarImpuesto($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


		/*=============================================
	MOSTRAR PRECIOS IMPUESTOS VARIOS
	=============================================*/

	static public function mdlMostrarImpuestosVentasVarios($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}
		/*=============================================
	MOSTRAR PRECIOS IMPUESTOS HABILITADO
	=============================================*/

	static public function mdlMostrarImpuestosVentasHabilitado($tabla){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado=1");

			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}
}

