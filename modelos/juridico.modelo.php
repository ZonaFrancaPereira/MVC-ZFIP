<?php

require_once "conexion.php";

class ModeloSoporteJuridico
{
    public static function mdlIngresarSoporteJuridico($tabla, $datos)
    {
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();

            // Preparar la consulta de inserción
            $stmt = $pdo->prepare("INSERT INTO $tabla (
                nombre_solicitante, 
                correo_solicitante, 
                id_cargo_fk1, 
                id_proceso_fk1,
                tipo_solicitud, 
                descripcion_solicitud_juridico,
                estado_legal

            ) VALUES (
            
                :nombre_solicitante, 
                :correo_solicitante, 
                :id_cargo_fk1, 
                :id_proceso_fk1,
                :tipo_solicitud, 
                :descripcion_solicitud_juridico,
                :estado_legal
            )");

            // Enlazar parámetros
            $stmt->bindParam(":nombre_solicitante", $datos["nombre_solicitante"], PDO::PARAM_STR);
            $stmt->bindParam(":correo_solicitante", $datos["correo_solicitante"], PDO::PARAM_STR);
            $stmt->bindParam(":id_cargo_fk1", $datos["id_cargo_fk1"], PDO::PARAM_INT);
            $stmt->bindParam(":id_proceso_fk1", $datos["id_proceso_fk1"], PDO::PARAM_INT);
            $stmt->bindParam(":tipo_solicitud", $datos["tipo_solicitud"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion_solicitud_juridico", $datos["descripcion_solicitud_juridico"], PDO::PARAM_STR);
            $stmt->bindParam(":estado_legal", $datos["estado_legal"], PDO::PARAM_STR);

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
	MOSTRAR SOPORTE Juridico
	=============================================*/

    public static function mdlMostrarSoporteJuridico($tabla, $item, $valor, $consulta)
    {
        switch ($consulta) {
            case 'solicitudjuridicofinalizada':
                // Consultar soportes finalizados (donde existe fecha de solución y el estado legal es 'Rechazado')
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado_legal = 'Rechazado' OR estado_legal = 'Cerrado'");
                $stmt->execute();
                $result = $stmt->fetchAll();
                $stmt = null; // Cerrar la conexión
                return $result;
                break;
            

            case 'solicitudjuridico':
                // Consultar solicitudes sin fecha de solución (soportes pendientes)
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado_legal = 'Abierto' ");
                $stmt->execute();
                return $stmt->fetchAll();
                $stmt = null;
                break;

                case 'solicitudjuridicoaceptar':
                    // Consultar solicitudes sin fecha de solución (soportes pendientes)
                    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado_legal = 'Proceso'");
                    $stmt->execute();
                    return $stmt->fetchAll();
                    $stmt = null;
                    break;

                case 'solicitudjuridicorealizada':
                    // Verificar si se tiene el valor del nombre del usuario en la sesión
                    if (isset($_SESSION['nombre'])) {
                        // Obtener el nombre del usuario desde la sesión
                        $nombreUsuario = $_SESSION['nombre'];
                
                        // Consulta para obtener las solicitudes realizadas por el usuario logueado (basado en el nombre)
                        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE nombre_solicitante = :nombre_usuario");
                
                        // Vincular el parámetro
                        $stmt->bindParam(":nombre_usuario", $nombreUsuario, PDO::PARAM_STR);
                
                        // Ejecutar la consulta
                        $stmt->execute();
                
                        // Retornar los resultados
                        return $stmt->fetchAll();
                    } else {
                        // Si no hay sesión, devolver un array vacío o lanzar un error
                        return [];
                    }
                    // Limpiar el statement
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
    public static function mdlResponderSolicitudJuridico($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET
           fecha_solucion_juridico = :fecha_solucion_juridico, nombre_solucion = :nombre_solucion , solucion_juridico = :solucion_juridico , estado_legal = :estado_legal WHERE id_soporte_juridico = :id_soporte_juridico");

        $stmt->bindParam(":fecha_solucion_juridico", $datos["fecha_solucion_juridico"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_solucion", $datos["nombre_solucion"], PDO::PARAM_STR);
        $stmt->bindParam(":solucion_juridico", $datos["solucion_juridico"], PDO::PARAM_STR);
        $stmt->bindParam(":estado_legal", $datos["estado_legal"], PDO::PARAM_STR);
        $stmt->bindParam(":id_soporte_juridico", $datos["id_soporte_juridico"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

      /*=============================================
	ASIGNAR ESTADO
	=============================================*/
    public static function mdlAsignarEstadoJuridico($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado_legal = :estado_legal WHERE id_soporte_juridico = :id_soporte_juridico");
    
        $stmt->bindParam(":estado_legal", $datos["estado_legal"], PDO::PARAM_STR);
        $stmt->bindParam(":id_soporte_juridico", $datos["id_soporte_juridico"], PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    
        $stmt->closeCursor();
        $stmt = null;
    }
    

}

