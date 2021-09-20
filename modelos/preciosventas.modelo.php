<?php

require_once "conexion.php";

class ModeloPreciosVentas{

	/*=============================================
	CREAR SUB CATEGORIA
	=============================================*/

	static public function mdlIngresarPrecioVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_producto,precio_venta) VALUES (:id_producto,:precio_venta)");

		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":precio_venta", $datos['precio_venta'], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR PRECIOS VENTAS
	=============================================*/

	static public function mdlMostrarPreciosVentas($tabla, $item, $valor){

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
	MOSTRAR PRECIOS VENTAS VARIOS
	=============================================*/

	static public function mdlMostrarPreciosVentasVarios($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND estado=1");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}



	
	/*=============================================
	EDITAR PRECIO VENTA
	=============================================*/

	static public function mdlEditarPrecioVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_producto=:id_producto ,precio_venta = :precio_venta WHERE id = :id");


		$stmt -> bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
		$stmt -> bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
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
	ACTUALIZAR PRECIO VENTA
	=============================================*/

	static public function mdlActualizarPrecioventa($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			$stmt->errorInfo();	

		}

		$stmt -> close();

		$stmt = null;

	}

}

