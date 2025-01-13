<?php

require_once "conexion.php";

class ModeloClientes{

	/*=============================================
	CREAR CLIENTE
	=============================================*/

static public function mdlIngresarCliente($tabla, $datos)
{
	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_cliente,
															nombre_cliente, 
															email_cliente,
															telefono_cliente,
															direccion_cliente,
															tipo_zf) 
										   VALUES (	:id_cliente, 
													:nombre_cliente, 
													:email_cliente,
													:telefono_cliente, 
													:direccion_cliente,
													:tipo_zf)");

	$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
	$stmt->bindParam(":nombre_cliente", $datos["nombre_cliente"], PDO::PARAM_STR);
	$stmt->bindParam(":email_cliente", $datos["email_cliente"], PDO::PARAM_STR);
	$stmt->bindParam(":telefono_cliente", $datos["telefono_cliente"], PDO::PARAM_STR);
	$stmt->bindParam(":direccion_cliente", $datos["direccion_cliente"], PDO::PARAM_STR);
	$stmt->bindParam(":tipo_zf", $datos["tipo_zf"], PDO::PARAM_STR);
	

	if ($stmt->execute()) {
		return "ok";
	} else {
		$arr = $stmt->errorInfo();
		return $arr[2];
	}

	$stmt = null;
}


	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function mdlMostrarClientes($tabla, $item, $valor){

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



		$stmt = null;

	}

		/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function mdlEditarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_cliente = :nombre, email_cliente = :email, telefono_cliente = :telefono, direccion_cliente = :direccion WHERE id_cliente = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_INT);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
	

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt = null;

	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function mdlEliminarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_cliente = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		

		$stmt = null;

	}

}