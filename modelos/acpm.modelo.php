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
            case 'proceso':
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
            case 'cerrada':
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
            case 'rechazada':
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
            case 'aceptar':
                // Consulta sin filtro
                $stmt = Conexion::conectar()->prepare("SELECT acpm.*, usuarios.nombre, usuarios.apellidos_usuario
                            FROM acpm
                            INNER JOIN usuarios ON acpm.id_usuario_fk = usuarios.id
                            WHERE acpm.estado_acpm = 'Proceso';");
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


    /*=============================================
	subir evidencia
	=============================================*/
    public static function mdlIngresarEvidenciaActividad($tabla, $datos)
    {
        try {
            $pdo = Conexion::conectar();
            $stmt = $pdo->prepare("INSERT INTO $tabla (
                fecha_evidencia, 
                evidencia, 
                recursos, 
                id_actividad_fk, 
                id_usuario_e_fk 
            ) VALUES (
                :fecha_evidencia, 
                :evidencia, 
                :recursos, 
                :id_actividad_fk, 
                :id_usuario_e_fk 
            )");
            $stmt->bindParam(":fecha_evidencia", $datos["fecha_evidencia"], PDO::PARAM_STR);
            $stmt->bindParam(":evidencia", $datos["evidencia"], PDO::PARAM_STR);
            $stmt->bindParam(":recursos", $datos["recursos"], PDO::PARAM_STR);
            $stmt->bindParam(":id_actividad_fk", $datos["id_actividad_fk"], PDO::PARAM_INT);
            $stmt->bindParam(":id_usuario_e_fk", $datos["id_usuario_e_fk"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            error_log("Error en la consulta SQL: " . $e->getMessage());
            return "error: " . $e->getMessage();
        }
    }

    /*=============================================
	actualizar estado actividad
	=============================================*/

    public static function mdlActualizarEstadoActividad($id_actividad, $nuevo_estado)
    {
        try {
            $pdo = Conexion::conectar();
            $stmt = $pdo->prepare("UPDATE actividades_acpm SET estado_actividad = :nuevo_estado WHERE id_actividad = :id_actividad");
            $stmt->bindParam(":nuevo_estado", $nuevo_estado, PDO::PARAM_STR);
            $stmt->bindParam(":id_actividad", $id_actividad, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            error_log("Error en la consulta SQL: " . $e->getMessage());
            return "error: " . $e->getMessage();
        }
    }

    /*=============================================
	ELIMINAR ACTIVIDAD
	=============================================*/
    static public function mdlEliminarActividad($idActividad)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM actividades_acpm WHERE id_actividad = :id_actividad");
        $stmt->bindParam(":id_actividad", $idActividad, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null; // Cierra la conexión de la consulta
    }

    /*=============================================
	ACTIVIDADES COMPLETAS
	=============================================*/

    static public function mdlVerificarActividadesCompletas($id_acpm)
    {
        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total 
                                               FROM actividades_acpm 
                                               WHERE id_acpm_fk = :id_acpm AND estado_actividad != 'Completa'");
        $stmt->bindParam(":id_acpm", $id_acpm, PDO::PARAM_INT);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($resultado['total'] == 0); // Retorna true si todas están "Completas"
    }


    /*=============================================
	ACTUALIZAR ESTADO A PROCESO
	=============================================*/
    static public function mdlActualizarEstadoAcpm($id_acpm, $nuevoEstado)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE acpm 
                                               SET estado_acpm = :estado 
                                               WHERE id_consecutivo = :id_acpm");
        $stmt->bindParam(":estado", $nuevoEstado, PDO::PARAM_STR);
        $stmt->bindParam(":id_acpm", $id_acpm, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    static public function mdlActualizarEficacia($tabla, $datos)
{
    try {
        // Actualizar eficacia
        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET 
                riesgo_acpm = :riesgo_acpm, 
                justificacion_riesgo = :justificacion_riesgo,
                cambios_sig = :cambios_sig,
                justificacion_sig = :justificacion_sig,
                conforme_sig = :conforme_sig,
                justificacion_conforme_sig = :justificacion_conforme_sig,
                fecha_estado = :fecha_estado 
            WHERE id_consecutivo = :id_consecutivo"
        );

        $stmt->bindParam(":riesgo_acpm", $datos["riesgo_acpm"], PDO::PARAM_STR);
        $stmt->bindParam(":justificacion_riesgo", $datos["justificacion_riesgo"], PDO::PARAM_STR);
        $stmt->bindParam(":cambios_sig", $datos["cambios_sig"], PDO::PARAM_STR);
        $stmt->bindParam(":justificacion_sig", $datos["justificacion_sig"], PDO::PARAM_STR);
        $stmt->bindParam(":conforme_sig", $datos["conforme_sig"], PDO::PARAM_STR);
        $stmt->bindParam(":justificacion_conforme_sig", $datos["justificacion_conforme_sig"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_estado", $datos["fecha_estado"], PDO::PARAM_STR);
        $stmt->bindParam(":id_consecutivo", $datos["id_consecutivo"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Cambiar el estado_acpm a 'Cerrada'
            $stmt2 = Conexion::conectar()->prepare(
                "UPDATE $tabla SET estado_acpm = 'Cerrada' WHERE id_consecutivo = :id_consecutivo"
            );
            $stmt2->bindParam(":id_consecutivo", $datos["id_consecutivo"], PDO::PARAM_INT);
            $stmt2->execute();
            
            return "ok";
        } else {
            return "error";
        }
    } catch (Exception $e) {
        return "error: " . $e->getMessage();
    }
}



static public function mdlGuardarRechazo($datos)
{
    try {
        // Insertar en acpm_rechazada
        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO acpm_rechazada 
            (fecha_rechazo, descripcion_rechazo, id_consecutivo_fk) 
            VALUES 
            (NOW(), :descripcion_rechazo, :id_consecutivo_fk)"
        );

        $stmt->bindParam(":descripcion_rechazo", $datos["descripcion_rechazo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_consecutivo_fk", $datos["id_consecutivo_fk"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Cambiar el estado_acpm a 'Rechazada'
            $stmt2 = Conexion::conectar()->prepare(
                "UPDATE acpm SET estado_acpm = 'Rechazada' WHERE id_consecutivo = :id_consecutivo"
            );
            $stmt2->bindParam(":id_consecutivo", $datos["id_consecutivo_fk"], PDO::PARAM_INT);
            $stmt2->execute();
            
            return "ok";
        } else {
            return "error";
        }
    } catch (Exception $e) {
        return "error: " . $e->getMessage();
    }
}


  
}
