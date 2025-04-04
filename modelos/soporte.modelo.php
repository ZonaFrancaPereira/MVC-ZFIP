<?php

require_once "conexion.php";



class ModeloSoporte
{

    public static function mdlIngresarSoporte($tabla, $datos)
    {
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();


            // Preparar la consulta de inserción
            $stmt = $pdo->prepare("INSERT INTO $tabla (
                id_usuario_fk,
                descripcion_soporte

            ) VALUES (
            
                :id_usuario_fk,
                :descripcion_soporte

            )");

            $stmt->bindParam(":id_usuario_fk", $datos["id_usuario_fk"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion_soporte", $datos["descripcion_soporte"], PDO::PARAM_STR);

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
            return "error: " . $e->getMessage();
        }
    }
    /*=============================================
	MOSTRAR SOPORTE
	=============================================*/

    public static function mdlMostrarSoporteUsuarios($tabla, $item, $valor)
    {
        try {
            // Preparar la consulta con filtro
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :valor");
            $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $stmt->closeCursor();
            $stmt = null;

            return $result;
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }
    
    public static function mdlMostrarSoporteFinalizadas($tabla, $item, $valor)
    {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_solucion IS NOT NULL AND fecha_solucion != ''");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $stmt->closeCursor();
            $stmt = null;

            return $result;
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }
    public static function mdlMostrarSoporteTi($tabla, $item, $valor)
    {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_solucion IS NULL ");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $stmt->closeCursor();
            $stmt = null;

            return $result;
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }

    /*=============================================
	ASIGNAR URGENCIA
	=============================================*/
    public static function mdlIngresarUrgencia($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET
            urgencia = :urgencia
            WHERE id_soporte = :id_soporte");

        $stmt->bindParam(":urgencia", $datos["urgencia"], PDO::PARAM_STR);
        $stmt->bindParam(":id_soporte", $datos["id_soporte"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
	ASIGNAR SOLUCION SOLICITUD
	=============================================*/
    public static function mdlResponderSolicitud($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET
           solucion_soporte = :solucion_soporte, fecha_solucion = :fecha_solucion , usuario_respuesta = :usuario_respuesta WHERE id_soporte = :id_soporte");

        $stmt->bindParam(":solucion_soporte", $datos["solucion_soporte"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_solucion", $datos["fecha_solucion"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario_respuesta", $datos["usuario_respuesta"], PDO::PARAM_STR);
        $stmt->bindParam(":id_soporte", $datos["id_soporte1"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }
}
