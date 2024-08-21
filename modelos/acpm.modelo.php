<?php

require_once "conexion.php";

class ModeloAcpm
{

        
    /*=============================================
	INGRESAR ACPM
	=============================================*/
    public static function mdlIngresarAcpm($tabla, $datos)
    {
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();
            // Preparar la consulta de inserción
            $stmt = $pdo->prepare("INSERT INTO $tabla (

                origen_acpm, 
                fuente_acpm, 
                descripcion_fuente, 
                tipo_acpm, 
                descripcion_acpm, 
                causa_acpm, 
                nc_similar, 
                descripcion_nsc, 
                correccion_acpm, 
                fecha_correccion, 
                estado_acpm, 
                riesgo_acpm, 
                justificacion_riesgo, 
                fecha_finalizacion, 
                id_usuario_fk

            ) VALUES (
                :origen_acpm, 
                :fuente_acpm, 
                :descripcion_fuente, 
                :tipo_acpm, 
                :descripcion_acpm, 
                :causa_acpm, 
                :nc_similar, 
                :descripcion_nsc, 
                :correccion_acpm, 
                :fecha_correccion, 
                :estado_acpm, 
                :riesgo_acpm, 
                :justificacion_riesgo, 
                :fecha_finalizacion, 
                :id_usuario_fk

            )");

            $stmt->bindParam(":origen_acpm", $datos["origen_acpm"], PDO::PARAM_STR);
            $stmt->bindParam(":fuente_acpm", $datos["fuente_acpm"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion_fuente", $datos["descripcion_fuente"], PDO::PARAM_STR);
            $stmt->bindParam(":tipo_acpm", $datos["tipo_acpm"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion_acpm", $datos["descripcion_acpm"], PDO::PARAM_STR);
            $stmt->bindParam(":causa_acpm", $datos["causa_acpm"], PDO::PARAM_STR);
            $stmt->bindParam(":nc_similar", $datos["nc_similar"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion_nsc", $datos["descripcion_nsc"], PDO::PARAM_STR);
            $stmt->bindParam(":correccion_acpm", $datos["correccion_acpm"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_correccion", $datos["fecha_correccion"], PDO::PARAM_STR);
            $stmt->bindParam(":estado_acpm", $datos["estado_acpm"], PDO::PARAM_STR);
            $stmt->bindParam(":riesgo_acpm", $datos["riesgo_acpm"], PDO::PARAM_STR);
            $stmt->bindParam(":justificacion_riesgo", $datos["justificacion_riesgo"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_finalizacion", $datos["fecha_finalizacion"], PDO::PARAM_STR);
            $stmt->bindParam(":id_usuario_fk", $datos["id_usuario_fk"], PDO::PARAM_INT);
            


            if ($stmt->execute()) {

                return "ok";
            } else {

                return "error";
            }
        } catch (PDOException $e) {
            // Manejar errores
            return "error: " . $e->getMessage();
        }
    }

    
    /*=============================================
	MOSTRAR ACPM
	=============================================*/

    public static function mdlMostrarAcpm($tabla, $item, $valor, $consulta)
    {
        switch ($consulta) {
            case 'acpm':
                // Consulta con filtro
                $stmt = Conexion::conectar()->prepare("SELECT $tabla.*, usuarios.nombre, usuarios.apellidos_usuario
                                           FROM $tabla
                                           INNER JOIN usuarios ON $tabla.id_usuario_fk = usuarios.id
                                           WHERE $tabla.$item = :valor");
                $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
                $stmt = null;
                break;

                case 'aprobar':
                    // Consulta con filtro
                    $stmt = Conexion::conectar()->prepare("SELECT $tabla.*, usuarios.nombre, usuarios.apellidos_usuario
                                               FROM $tabla
                                               INNER JOIN usuarios ON $tabla.id_usuario_fk = usuarios.id
                                               WHERE $tabla.$item = :valor");
                    $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
                    $stmt->execute();
                    return $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
                    $stmt = null;
                    break;

                case 'abierta':
                        // Consulta con filtro
                        $stmt = Conexion::conectar()->prepare("SELECT $tabla.*, usuarios.nombre, usuarios.apellidos_usuario
                                                   FROM $tabla
                                                   INNER JOIN usuarios ON $tabla.id_usuario_fk = usuarios.id
                                                   WHERE $tabla.$item = :valor");
                        $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
                        $stmt->execute();
                        return $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
                        $stmt = null;
                        break;

                case 'actividades':
                    // Consulta con filtro
                    $stmt = Conexion::conectar()->prepare("SELECT $tabla.*,actividades_acpm.*
                                                FROM $tabla
                                                INNER JOIN usuarios ON $tabla.id_usuario_fk = usuarios.id
                                                LEFT JOIN actividades_acpm ON $tabla.id_consecutivo = actividades_acpm.id_acpm_fk
                                                WHERE $tabla.$item = :valor");
                    $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
                    $stmt->execute();
                    return $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
                    $stmt = null;
                    break;

            default:
                $consulta = null;
                $item = null;
                $valor = null;
                break;
        }
    }

      
    /*=============================================
	INGRESAR ACTIVIDA
	=============================================*/

    public static function mdlIngresarActividad($tabla, $datos)
    {
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();
            // Preparar la consulta de inserción
            $stmt = $pdo->prepare("INSERT INTO $tabla (
                
                fecha_actividad, 
                descripcion_actividad, 
                tipo_actividad, 
                estado_actividad, 
                id_usuario_fk, 
                id_acpm_fk
                
            ) VALUES (
                :fecha_actividad, 
                :descripcion_actividad, 
                :tipo_actividad, 
                :estado_actividad, 
                :id_usuario_fk, 
                :id_acpm_fk
            )");
    
            $stmt->bindParam(":fecha_actividad", $datos["fecha_actividad"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion_actividad", $datos["descripcion_actividad"], PDO::PARAM_STR);
            $stmt->bindParam(":tipo_actividad", $datos["tipo_actividad"], PDO::PARAM_STR);
            $stmt->bindParam(":estado_actividad", $datos["estado_actividad"], PDO::PARAM_STR);
            $stmt->bindParam(":id_usuario_fk", $datos["id_usuario_fk"], PDO::PARAM_INT);
            $stmt->bindParam(":id_acpm_fk", $datos["id_acpm_fk"], PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            // Manejar errores
            return "error: " . $e->getMessage();
        }
    }

    /*=============================================
	MOSTRAR PDF ACPM
	=============================================*/

    public static function mdlMostrarAcpmpdf($tabla, $item, $valor, $consulta)
    {
        if ($consulta == 'acpm') {
            // Consulta con filtro
            $stmt = Conexion::conectar()->prepare(
                "SELECT a.*, u.*, p.*, c.*, b.* 
                FROM acpm a
                INNER JOIN usuarios u ON a.id_usuario_fk = u.id
                INNER JOIN proceso p ON p.id_proceso = u.id_proceso_fk
                INNER JOIN cargos c ON c.id_cargo = u.id_cargo_fk
                INNER JOIN actividades_acpm b ON b.id_usuario_fk = u.id
                WHERE $item = :valor"
            );

            // Vinculamos el parámetro con el valor correspondiente
            $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

            // Ejecutamos la consulta
            $stmt->execute();

            // Obtenemos todos los resultados
            $result = $stmt->fetchAll();

            // Liberamos la consulta
            $stmt = null;

            // Devolvemos los resultados
            return $result;
        } else {
            return null;
        }
    }


    public static function mdlAprobarAcpm($tabla, $datos) 

    {

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET
                        estado_acpm = :estado_acpm
                        WHERE id_consecutivo = :id_consecutivo");

                    $stmt->bindParam(":estado_acpm", $datos["estado_acpm"], PDO::PARAM_STR);
                    $stmt->bindParam(":id_consecutivo", $datos["id_consecutivo"], PDO::PARAM_INT);

                    if ($stmt->execute()) {
                        return "ok";
                    } else {
                        return "error";
                    }

                    $stmt->closeCursor();
                    $stmt = null;

    }

    public static function mdlRechazarAcpm($tabla, $datosRechazo)
    {

            try {
                // Obtener la conexión PDO
                $pdo = Conexion::conectar();
                // Preparar la consulta de inserción
                $stmt = $pdo->prepare("INSERT INTO $tabla (
                    
                    descripcion_rechazo, 
                    id_consecutivo_fk 
                
                    
                ) VALUES (
                    :descripcion_rechazo, 
                    :id_consecutivo_fk

                )");
                
            $stmt->bindParam(":descripcion_rechazo", $datosRechazo["descripcion_rechazo"], PDO::PARAM_STR);
            $stmt->bindParam(":id_consecutivo_fk", $datosRechazo["id_consecutivo_fk"], PDO::PARAM_INT);
        
            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            // Manejar errores
            return "error: " . $e->getMessage();
        }
    }

}