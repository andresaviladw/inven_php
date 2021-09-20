<?php

require_once "conexion.php";

class ModeloEmisor{

	/*=============================================
	MOSTRAR EMISOR
	=============================================*/

	static public function mdlMostrarEmisor($tabla, $item, $valor){

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
	EDITAR EMISOR
	=============================================*/

	static public function mdlEditarEmisor($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET tipoDocumento = :tipoDocumento,documento_id =:documento_id, razon_social=:razon_social, nombre_comercial=:nombre_comercial, direccion=:direccion,telefono=:telefono,celular=:celular,email=:email, codigo_establecimiento=:codigo_establecimiento, punto_emision=:punto_emision, secuencia_factura=:secuencia_factura, numero_autorizacion=:numero_autorizacion WHERE id = :id");

		$stmt -> bindParam(":tipoDocumento", $datos["tipoDocumento"], PDO::PARAM_STR);
		$stmt -> bindParam(":documento_id", $datos["documento_id"], PDO::PARAM_STR);
		$stmt -> bindParam(":razon_social", $datos["razon_social"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre_comercial", $datos["nombre_comercial"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt -> bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":codigo_establecimiento", $datos["codigo_establecimiento"], PDO::PARAM_STR);
		$stmt -> bindParam(":punto_emision", $datos["punto_emision"], PDO::PARAM_STR);
		$stmt -> bindParam(":secuencia_factura", $datos["secuencia_factura"], PDO::PARAM_STR);
		$stmt -> bindParam(":numero_autorizacion", $datos["numero_autorizacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


}

