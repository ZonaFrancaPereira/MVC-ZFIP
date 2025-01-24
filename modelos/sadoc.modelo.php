<?php

require_once "conexion.php";

class ModeloSadoc
{

    /*=============================================
REGISTRO DE archivos
=============================================*/
    static public function mdlIngresarArchivo($tabla, $datos)
    {
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();
            // Preparar la consulta de inserción
            $stmt = $pdo->prepare("INSERT INTO $tabla (
            codigo,
            ruta,
            estado,
            id_proceso_fk
        ) VALUES (
            :codigo,
            :ruta,
            :estado,
            :id_proceso_fk
        )");

            // Vincular parámetros
            $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
            $stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
            $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
            $stmt->bindParam(":id_proceso_fk", $datos["id_proceso_fk"], PDO::PARAM_INT);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Cerrar el cursor y liberar recursos
                $stmt->closeCursor();
                $stmt = null;
                // Devolver un array con las rutas
                return [
                    'ruta' => $datos["ruta"]
                ];
            } else {
                // Capturar y mostrar el error SQL
                $error = $stmt->errorInfo();
                return "error: " . $error[2];
            }
        } catch (PDOException $e) {
            // Manejar errores
            return "error: " . $e->getMessage();
        }
    }

    /*=============================================
	MOSTRAR ARCHIVOS POR PROCESO
	=============================================*/

    static public function mdlObtenerArchivosPorProceso($id_proceso_fk)
    {
        try {
            $stmt = Conexion::conectar()->prepare('SELECT * FROM sadoc WHERE id_proceso_fk = :id_proceso_fk AND estado = "activo"');
            $stmt->bindParam(':id_proceso_fk', $id_proceso_fk, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }

    /*=============================================
	MOSTRAR ARCHIVOS POR PROCESO
	=============================================*/

    static public function mdlObtenerCategorias($tabla)
    {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }
    
}
