<?php

require_once "conexion.php";

class ModeloSoporteTecnico
{
    public static function mdlIngresarSoporteTecnico($tabla, $datos)
    {
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();

            // Preparar la consulta de inserción
            $stmt = $pdo->prepare("INSERT INTO $tabla (
                id_usuario_fk1,
                correo_soporte,
                descripcion_soporte_tecnico,
                proceso_fk1
            ) VALUES (
                :id_usuario_fk1,
                :correo_soporte,
                :descripcion_soporte_tecnico,
                :proceso_fk1
            )");

            // Enlazar parámetros
            $stmt->bindParam(":id_usuario_fk1", $datos["id_usuario_fk1"], PDO::PARAM_INT);
            $stmt->bindParam(":correo_soporte", $datos["correo_soporte"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion_soporte_tecnico", $datos["descripcion_soporte_tecnico"], PDO::PARAM_STR);
            $stmt->bindParam(":proceso_fk1", $datos["proceso_fk1"], PDO::PARAM_INT);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }

            // Cerrar el cursor
            $stmt->closeCursor();
            $stmt = null;
        } catch (PDOException $e) {
            // Manejar errores
            return "error: " . $e->getMessage();
        }
    }

     /*=============================================
	MOSTRAR SOPORTE
	=============================================*/

    public static function mdlMostrarSoporteTecnico($tabla, $item, $valor, $consulta)
{
    switch ($consulta) {
        case 'finalizadatecnico':
            // Consultar soportes finalizados (donde existe fecha de solución)
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_solucion_soporte IS NOT NULL AND fecha_solucion_soporte != ''");
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt = null;
            break;

        case 'solicitudes':
            // Consultar solicitudes sin fecha de solución (soportes pendientes)
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_solucion_soporte IS NULL");
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt = null;
            break;

        case 'realizadas':
            // Verificar si se tiene el valor del id del usuario en la sesión
            if (isset($_SESSION['id'])) {
                // Obtener el ID del usuario desde la sesión
                $idUsuario = $_SESSION['id'];

                // Consulta para obtener las solicitudes realizadas por el usuario logueado
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario_fk1 = :id_usuario");

                // Vincular el parámetro
                $stmt->bindParam(":id_usuario", $idUsuario, PDO::PARAM_INT);

                // Ejecutar la consulta
                $stmt->execute();

                // Retornar los resultados
                return $stmt->fetchAll();
            } else {
                // Si no hay sesión, devolver un array vacío o lanzar un error
                return [];
            }
            $stmt = null;
            break;

        default:
            // Si no se especifica una consulta válida, devolver null
            return null;
            break;
    }
}

    
     /*=============================================
	ASIGNAR SOLUCION SOLICITUD
	=============================================*/
    public static function mdlResponderSolicitudTecnico($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET
           solucion_soporte_tecnico = :solucion_soporte_tecnico, fecha_solucion_soporte = :fecha_solucion_soporte , usuario_respuesta = :usuario_respuesta WHERE id_soporte_tecnico = :id_soporte_tecnico");

        $stmt->bindParam(":solucion_soporte_tecnico", $datos["solucion_soporte_tecnico"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_solucion_soporte", $datos["fecha_solucion_soporte"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario_respuesta", $datos["usuario_respuesta"], PDO::PARAM_STR);
        $stmt->bindParam(":id_soporte_tecnico", $datos["id_soporte_tecnico"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }
}

