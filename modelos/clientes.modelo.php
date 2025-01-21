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
	MOSTRAR CLIENTES AJAX
	=============================================*/

	static public function mdlMostrarClientesAjax(){



		$stmt = Conexion::conectar()->prepare("SELECT id_cliente 
													,nombre_cliente as text	
													 FROM clientes_zfip");

		$stmt -> execute();

		$arr = $stmt ->errorInfo();


		if ($arr[0]>0){
				$arr[3]="ERROR";
				return $arr;
			}
			else{

			return $stmt -> fetchAll();
		}

		

		$stmt -> close();

		$stmt = null;

	}

	
	


	

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function mdlEditarCliente($tabla, $datos) {

		// Preparamos la consulta SQL para actualizar los datos del cliente
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
			nombre_cliente = :nombre_cliente, 
			email_cliente = :email_cliente, 
			telefono_cliente = :telefono_cliente, 
			direccion_cliente = :direccion_cliente, 
			tipo_zf = :tipo_zf 
			WHERE id_cliente = :id_cliente");
	
		// Enlazamos los parámetros con los valores del array $datos
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre_cliente", $datos["nombre_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":email_cliente", $datos["email_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono_cliente", $datos["telefono_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion_cliente", $datos["direccion_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_zf", $datos["tipo_zf"], PDO::PARAM_STR);
	
		// Ejecutamos la consulta
		if ($stmt->execute()) {
			return "ok"; // Si la consulta se ejecutó correctamente
		} else {
			return "error"; // Si ocurrió algún error al ejecutar la consulta
		}
	
		// Cerramos la conexión
		$stmt = null;
	}
	

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function mdlEliminarCliente($tabla, $datos){

		  // Comprobar si hay registros en inspeccion_op
    $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM inspeccion_op WHERE id_cliente_fk = :id");
    $stmt->bindParam(":id", $datos, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        return "error";// Cliente tiene registros relacionados
    }else{
		 // Eliminar al cliente si no hay registros relacionados
		 $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_cliente = :id");
		 $stmt->bindParam(":id", $datos, PDO::PARAM_INT);
	 
		 if ($stmt->execute()) {
			 return "ok";
		 } else {
			 return "error";
		 }
	 
		
		 }
		$stmt = null;
	}

   

}