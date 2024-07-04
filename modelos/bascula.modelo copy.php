<?php

require_once "conexion.php";

class ModeloBascula
{



	/*=============================================
	REGISTRO DE PERFIL
	=============================================*/

	static public function mdlIngresarBascula($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
			placa,
			peso_uno,
			id_cliente_fk
	
		) VALUES (
			:placa,
			:peso_uno,
			:id_cliente_fk

		)");

		$stmt->bindParam(":placa", $datos["placa"], PDO::PARAM_STR);
		$stmt->bindParam(":peso_uno", $datos["peso_uno"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente_fk", $datos["id_cliente_fk"], PDO::PARAM_STR);



		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->closeCursor();
		$stmt = null;
	}




	
}
