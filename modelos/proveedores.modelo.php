<?php
require_once 'conexion.php';

class ModeloProveedor
{
    /**
     * CREAR PROVEEDOR
     */

     static public function mdlIngresarProveedor($tabla,$datos)
     {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (tipoDocumento,documentoId, codigo,proveedor,direccion,telefono,celular,email,nombre_referencia,movil_referencia) VALUES (:tipoDocumento,:documentoId, :codigo,:proveedor,:direccion,:telefono,:celular,:email,:nombre_referencia,:movil_referencia)");

        $stmt->bindParam(":tipoDocumento", $datos['tipoDocumento'], PDO::PARAM_STR);
        $stmt->bindParam(":documentoId", $datos['documentoId'], PDO::PARAM_STR);
        $stmt->bindParam(":codigo", $datos['codigo'], PDO::PARAM_STR);
        $stmt->bindParam(":proveedor", $datos['proveedor'], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos['direccion'], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos['telefono'], PDO::PARAM_STR);
        $stmt->bindParam(":celular", $datos['celular'], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos['email'], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_referencia", $datos['nombre_referencia'], PDO::PARAM_STR);
        $stmt->bindParam(":movil_referencia", $datos['movil_referencia'], PDO::PARAM_STR);



		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();
		
		}

		$stmt->close();
		$stmt = null;
	 }

	 /**
	  * MOSTRAR PROVEEDORES

	  */
	 
	 static public function mdlMostrarProveedores($tabla,$item,$valor)
	 {
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

	 /**
	  * MOSTRAR PROVEEDORES HABILITADOS

	  */
	 
	 static public function mdlMostrarProveedoresHabilitados($tabla,$item,$valor)
	 {
		

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

	

		$stmt -> close();

		$stmt = null;
	 }

	 /**
	  * EDITAR PROVEEDORES
	  */

	static public function mdlEditarProveedor($tabla,$datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET documentoId = :documentoId, codigo=:codigo, tipoDocumento=:tipoDocumento,proveedor=:proveedor,direccion=:direccion,telefono=:telefono,celular=:celular,email=:email,nombre_referencia=:nombre_referencia,movil_referencia=:movil_referencia WHERE  id = :id");



		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt -> bindParam(":documentoId", $datos["documentoId"], PDO::PARAM_STR);
		$stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt -> bindParam(":tipoDocumento", $datos["tipoDocumento"], PDO::PARAM_STR);
		$stmt -> bindParam(":proveedor", $datos["proveedor"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt -> bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_referencia", $datos['nombre_referencia'], PDO::PARAM_STR);
        $stmt->bindParam(":movil_referencia", $datos['movil_referencia'], PDO::PARAM_STR);
		
	


		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->errorInfo();
		
		}

		$stmt->close();
		$stmt = null;
	}


	/*=============================================
	ACTUALIZAR PROVEEDOR
	=============================================*/

	static public function mdlActualizarProveedor($tabla, $item1, $valor1, $item2, $valor2){

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
}

?>