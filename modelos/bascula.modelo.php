<?php

require_once "conexion.php";

class ModeloBascula
{



	/*=============================================
	REGISTRO DE PERFIL
	=============================================*/

	static public function mdlIngresarBascula($tabla, $datos) {
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();

            // Preparar la consulta de inserción
            $stmt = $pdo->prepare("INSERT INTO $tabla (
                placa,
                peso_uno,
                id_cliente_fk
            ) VALUES (
                :placa,
                :peso_uno,
                :id_cliente_fk
            )");

            // Vincular parámetros
            $stmt->bindParam(":placa", $datos["placa"], PDO::PARAM_STR);
            $stmt->bindParam(":peso_uno", $datos["peso_uno"], PDO::PARAM_STR);
            $stmt->bindParam(":id_cliente_fk", $datos["id_cliente_fk"], PDO::PARAM_STR);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Obtener el último ID insertado
                $lastInsertId = $pdo->lastInsertId();

                // Cerrar el cursor y liberar recursos
                $stmt->closeCursor();
                $stmt = null;

                // Devolver el último ID insertado
                return $lastInsertId;
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            // Manejar errores
            return "error: " . $e->getMessage();
        }
    }




	
}
