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
                    // Conexión a la base de datos
                    $conexion = Conexion::conectar();
                
                    // Actualizar el estado a 'Abierta Vencida' para las ACPM que cumplan con la condición
                    $updateStmt = $conexion->prepare("UPDATE $tabla 
                        SET estado_acpm = 'Abierta Vencida' 
                        WHERE estado_acpm = 'Abierta' 
                          AND fecha_finalizacion IS NOT NULL 
                          AND fecha_finalizacion < CURDATE()
                    ");
                    $updateStmt->execute();
                
                    // Consulta con filtro para mostrar las ACPM abiertas y no vencidas
                    $stmt = $conexion->prepare("SELECT $tabla.*, usuarios.nombre, usuarios.apellidos_usuario
                        FROM $tabla
                        INNER JOIN usuarios ON $tabla.id_usuario_fk = usuarios.id
                        WHERE $tabla.$item = :valor
                          AND ($tabla.estado_acpm = 'Abierta' OR $tabla.estado_acpm = 'Abierta Vencida')
                          AND ($tabla.fecha_finalizacion IS NULL OR $tabla.fecha_finalizacion >= CURDATE())
                    ");
                
                    $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
                    $stmt->execute();
                    $resultados = $stmt->fetchAll(); // Obtener todos los resultados
                
                    // Cerrar la conexión
                    $stmt = null;
                    $updateStmt = null;
                
                    // Retornar los resultados obtenidos
                    return $resultados;
                    break;
                
            case 'vencida':
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
            case 'tecnica':
                // Consulta sin filtro
                $stmt = Conexion::conectar()->prepare("SELECT acpm.*, usuarios.nombre, usuarios.apellidos_usuario
                FROM acpm
                INNER JOIN usuarios ON acpm.id_usuario_fk = usuarios.id");
                $stmt->execute();
                return $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
                $stmt = null;
                break;
            case 'sig':
                // Consulta sin filtro
                $stmt = Conexion::conectar()->prepare("SELECT acpm.*, usuarios.nombre, usuarios.apellidos_usuario
                    FROM acpm
                    INNER JOIN usuarios ON acpm.id_usuario_fk = usuarios.id");
                $stmt->execute();
                return $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
                $stmt = null;
                break;
            case 'administrativa':
                // Consulta sin filtro
                $stmt = Conexion::conectar()->prepare("SELECT acpm.*, usuarios.nombre, usuarios.apellidos_usuario
                        FROM acpm
                        INNER JOIN usuarios ON acpm.id_usuario_fk = usuarios.id");
                $stmt->execute();
                return $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
                $stmt = null;
                break;
            case 'contable':
                // Consulta sin filtro
                $stmt = Conexion::conectar()->prepare("SELECT acpm.*, usuarios.nombre, usuarios.apellidos_usuario
                            FROM acpm
                            INNER JOIN usuarios ON acpm.id_usuario_fk = usuarios.id");
                $stmt->execute();
                return $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
                $stmt = null;
                break;
            case 'juridica':
                // Consulta sin filtro
                $stmt = Conexion::conectar()->prepare("SELECT acpm.*, usuarios.nombre, usuarios.apellidos_usuario
                                FROM acpm
                                INNER JOIN usuarios ON acpm.id_usuario_fk = usuarios.id");
                $stmt->execute();
                return $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
                $stmt = null;
                break;
            case 'informatica':
                // Consulta sin filtro
                $stmt = Conexion::conectar()->prepare("SELECT acpm.*, usuarios.nombre, usuarios.apellidos_usuario
                                    FROM acpm
                                    INNER JOIN usuarios ON acpm.id_usuario_fk = usuarios.id");
                $stmt->execute();
                return $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
                $stmt = null;
                break;
            case 'operaciones':
                // Consulta sin filtro
                $stmt = Conexion::conectar()->prepare("SELECT acpm.*, usuarios.nombre, usuarios.apellidos_usuario
                                        FROM acpm
                                        INNER JOIN usuarios ON acpm.id_usuario_fk = usuarios.id");
                $stmt->execute();
                return $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
                $stmt = null;
                break;
            case 'gerencia':
                // Consulta sin filtro
                $stmt = Conexion::conectar()->prepare("SELECT acpm.*, usuarios.nombre, usuarios.apellidos_usuario
                FROM acpm
                INNER JOIN usuarios ON acpm.id_usuario_fk = usuarios.id");
                $stmt->execute();
                return $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
                $stmt = null;
                break;
            case 'seguridad':
                // Consulta sin filtro
                $stmt = Conexion::conectar()->prepare("SELECT acpm.*, usuarios.nombre, usuarios.apellidos_usuario
                    FROM acpm
                    INNER JOIN usuarios ON acpm.id_usuario_fk = usuarios.id");
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
        try {
            // Conectar a la base de datos
            $stmt = Conexion::conectar()->prepare("SELECT 
                    a.id_consecutivo,
                    u.nombre,
                    u.apellidos_usuario,
                    a.fecha_acpm,
                    p.nombre_proceso,
                    c.nombre_cargo,
                    a.origen_acpm,
                    a.fuente_acpm,
                    a.descripcion_fuente,
                    a.tipo_acpm,
                    a.causa_acpm,
                    a.nc_similar,
                    a.descripcion_nsc,
                    a.estado_acpm,
                    a.riesgo_acpm,
                    a.justificacion_riesgo,
                    a.cambios_sig,
                    a.justificacion_sig,
                    a.conforme_sig,
                    a.justificacion_conforme_sig,
                    a.fecha_estado,
                    a.fecha_finalizacion
                FROM $tabla a
                INNER JOIN usuarios u ON a.id_usuario_fk = u.id
                INNER JOIN proceso p ON u.id_proceso_fk = p.id_proceso
                INNER JOIN cargos c ON u.id_cargo_fk = c.id_cargo
                WHERE $item = :$item");

            // Vincular el parámetro de la consulta
            $stmt->bindParam(":$item", $valor, PDO::PARAM_INT);

            // Ejecutar la consulta
            $stmt->execute();

            // Devolver los resultados
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            // Manejo de errores
            die("Error al obtener datos del ACPM: " . $e->getMessage());
        }
    }

    /*=============================================
	APROBAR ACPM
	=============================================*/

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

    /*=============================================
	RECHAZAR ACPM POR ACTIVIDADES
	=============================================*/

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

    /*=============================================
	INSERTAR EFICACIA   
	=============================================*/
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

    /*=============================================
	GUARDAR RECHAZO ACPM FINAL
	=============================================*/
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

    /*=============================================
    ACTUALIZAR FECHA DE FINALIZACIÓN DE ACPM
    =============================================*/
    static public function mdlActualizarFechaAcpm($datos)
    {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE acpm 
        SET fecha_finalizacion = :fecha_finalizacion 
        WHERE id_consecutivo = :id_acpm");

            $stmt->bindParam(":fecha_finalizacion", $datos["fecha_finalizacion"], PDO::PARAM_STR);
            $stmt->bindParam(":id_acpm", $datos["id_acpm"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        } finally {
            $stmt = null;
        }
    }

    /*=============================================
    ACTUALIZAR FECHA DE FINALIZACIÓN DE ACPM SIG
    =============================================*/
    static public function mdlActualizarFechaSig($datos)
    {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE acpm 
        SET fecha_finalizacion = :fecha_finalizacion 
        WHERE id_consecutivo = :id_acpm");

            $stmt->bindParam(":fecha_finalizacion", $datos["fecha_finalizacion"], PDO::PARAM_STR);
            $stmt->bindParam(":id_acpm", $datos["id_acpm"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        } finally {
            $stmt = null;
        }
    }

    /*=============================================
    ACTUALIZAR FECHA DE FINALIZACIÓN DE ACPM ADMINISTRATIVA
    =============================================*/
    static public function mdlActualizarFechaAdministrativa($datos)
    {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE acpm 
        SET fecha_finalizacion = :fecha_finalizacion 
        WHERE id_consecutivo = :id_acpm");

            $stmt->bindParam(":fecha_finalizacion", $datos["fecha_finalizacion"], PDO::PARAM_STR);
            $stmt->bindParam(":id_acpm", $datos["id_acpm"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        } finally {
            $stmt = null;
        }
    }

    /*=============================================
    ACTUALIZAR FECHA DE FINALIZACIÓN DE ACPM CONTABLE
    =============================================*/
    static public function mdlActualizarFechaContable($datos)
    {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE acpm 
        SET fecha_finalizacion = :fecha_finalizacion 
        WHERE id_consecutivo = :id_acpm");

            $stmt->bindParam(":fecha_finalizacion", $datos["fecha_finalizacion"], PDO::PARAM_STR);
            $stmt->bindParam(":id_acpm", $datos["id_acpm"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        } finally {
            $stmt = null;
        }
    }

    /*=============================================
    ACTUALIZAR FECHA DE FINALIZACIÓN DE ACPM JURIDICA
    =============================================*/
    static public function mdlActualizarFechaJuridica($datos)
    {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE acpm 
        SET fecha_finalizacion = :fecha_finalizacion 
        WHERE id_consecutivo = :id_acpm");

            $stmt->bindParam(":fecha_finalizacion", $datos["fecha_finalizacion"], PDO::PARAM_STR);
            $stmt->bindParam(":id_acpm", $datos["id_acpm"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        } finally {
            $stmt = null;
        }
    }

    /*=============================================
    ACTUALIZAR FECHA DE FINALIZACIÓN DE ACPM INFORMATICA
    =============================================*/
    static public function mdlActualizarFechaInformatica($datos)
    {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE acpm 
        SET fecha_finalizacion = :fecha_finalizacion 
        WHERE id_consecutivo = :id_acpm");

            $stmt->bindParam(":fecha_finalizacion", $datos["fecha_finalizacion"], PDO::PARAM_STR);
            $stmt->bindParam(":id_acpm", $datos["id_acpm"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        } finally {
            $stmt = null;
        }
    }

    /*=============================================
    ACTUALIZAR FECHA DE FINALIZACIÓN DE ACPM OPERACIONES
    =============================================*/
    static public function mdlActualizarFechaOperaciones($datos)
    {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE acpm 
        SET fecha_finalizacion = :fecha_finalizacion 
        WHERE id_consecutivo = :id_acpm");

            $stmt->bindParam(":fecha_finalizacion", $datos["fecha_finalizacion"], PDO::PARAM_STR);
            $stmt->bindParam(":id_acpm", $datos["id_acpm"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        } finally {
            $stmt = null;
        }
    }


    /*=============================================
    ACTUALIZAR FECHA DE FINALIZACIÓN DE ACPM GERENCIA
    =============================================*/
    static public function mdlActualizarFechaGerencia($datos)
    {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE acpm 
        SET fecha_finalizacion = :fecha_finalizacion 
        WHERE id_consecutivo = :id_acpm");

            $stmt->bindParam(":fecha_finalizacion", $datos["fecha_finalizacion"], PDO::PARAM_STR);
            $stmt->bindParam(":id_acpm", $datos["id_acpm"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        } finally {
            $stmt = null;
        }
    }

    /*=============================================
    ACTUALIZAR FECHA DE FINALIZACIÓN DE ACPM seguridad
    =============================================*/
    static public function mdlActualizarFechaSeguridad($datos)
    {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE acpm 
        SET fecha_finalizacion = :fecha_finalizacion 
        WHERE id_consecutivo = :id_acpm");

            $stmt->bindParam(":fecha_finalizacion", $datos["fecha_finalizacion"], PDO::PARAM_STR);
            $stmt->bindParam(":id_acpm", $datos["id_acpm"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        } finally {
            $stmt = null;
        }
    }

    // Contar ACPM Abiertas
    public static function contarAcpmAbiertas($id_usuario_fk,)
    {
        $db = Conexion::conectar();
        $sql = "SELECT COUNT(id_consecutivo) AS abiertas
            FROM acpm
            WHERE estado_acpm = 'Abierta' AND id_usuario_fk = :id_usuario_fk";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id_usuario_fk', $id_usuario_fk, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['abiertas'];
    }

    // Contar ACPM Cerradas
    public static function contarAcpmCerradas($id_usuario_fk)
    {
        $db = Conexion::conectar();
        $sql = "SELECT COUNT(id_consecutivo) AS cerradas
            FROM acpm
            WHERE estado_acpm = 'Cerrada' AND id_usuario_fk = :id_usuario_fk";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id_usuario_fk', $id_usuario_fk, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['cerradas'];
    }

    // Contar ACPM en Verificación
    public static function contarAcpmVerificacion($id_usuario_fk)
    {
        $db = Conexion::conectar();
        $sql = "SELECT COUNT(id_consecutivo) AS verificacion
            FROM acpm
            WHERE estado_acpm = 'Verificación' AND id_usuario_fk = :id_usuario_fk";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id_usuario_fk', $id_usuario_fk, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['verificacion'];
    }

    // Contar ACPM en Proceso
    public static function contarAcpmProceso($id_usuario_fk)
    {
        $db = Conexion::conectar();
        $sql = "SELECT COUNT(id_consecutivo) AS proceso
            FROM acpm
            WHERE estado_acpm = 'Proceso' AND id_usuario_fk = :id_usuario_fk";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id_usuario_fk', $id_usuario_fk, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['proceso'];
    }

    // Contar ACPM de mejora abiertas
    public static function contarAcpmMejoraAbierta($id_usuario_fk)
    {
        $db = Conexion::conectar();
        $sql = "SELECT COUNT(id_consecutivo) AS total
            FROM acpm
            WHERE tipo_acpm = 'AM' AND estado_acpm = 'Abierta' AND id_usuario_fk = :id_usuario_fk";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id_usuario_fk', $id_usuario_fk, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    // Contar ACPM de mejora cerradas
    public static function contarAcpmMejoraCerrada($id_usuario_fk)
    {
        $db = Conexion::conectar();
        $sql = "SELECT COUNT(id_consecutivo) AS total
            FROM acpm
            WHERE tipo_acpm = 'AM' AND estado_acpm = 'Cerrada' AND id_usuario_fk = :id_usuario_fk";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id_usuario_fk', $id_usuario_fk, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    // Contar ACPM preventiva abiertas
    public static function contarAcpmPreventivaAbierta($id_usuario_fk)
    {
        $db = Conexion::conectar();
        $sql = "SELECT COUNT(id_consecutivo) AS total
            FROM acpm
            WHERE tipo_acpm = 'AP' AND estado_acpm = 'Abierta' AND id_usuario_fk = :id_usuario_fk";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id_usuario_fk', $id_usuario_fk, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    // Contar ACPM preventiva cerradas
    public static function contarAcpmPreventivaCerrada($id_usuario_fk)
    {
        $db = Conexion::conectar();
        $sql = "SELECT COUNT(id_consecutivo) AS total
            FROM acpm
            WHERE tipo_acpm = 'AP' AND estado_acpm = 'Cerrada' AND id_usuario_fk = :id_usuario_fk";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id_usuario_fk', $id_usuario_fk, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }


    /*=============================================
    CONTAR ACPM ABIERTAS EN GENERAL
    =============================================*/
    public static function contarAcpmAbiertasGeneral($tabla)
    {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) AS total FROM $tabla WHERE estado_acpm = 'Abierta'");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (Exception $e) {
            return 0;
        }
    }

    /*=============================================
    CONTAR ACPM CERRADAS EN GENERAL
    =============================================*/
    public static function contarAcpmCerradasGeneral($tabla)
    {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) AS total FROM $tabla WHERE estado_acpm = 'Cerrada'");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (Exception $e) {
            return 0;
        }
    }

    /*=============================================
    CONTAR ACPM EN VERIFICACION EN GENERAL
    =============================================*/
    public static function contarAcpmVerificacionGeneral($tabla)
    {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) AS total FROM $tabla WHERE estado_acpm = 'Verificacion'");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (Exception $e) {
            return 0;
        }
    }

    /*=============================================
    CONTAR ACPM EN PROCESO EN GENERAL
    =============================================*/
    public static function contarAcpmProcesoGeneral($tabla)
    {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) AS total FROM $tabla WHERE estado_acpm = 'Proceso'");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (Exception $e) {
            return 0;
        }
    }

    /*=============================================
    CONTAR ACPM EN PROCESO EN GENERAL
    =============================================*/
    public static function contarAcpmVencidaGeneral($tabla)
    {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) AS total FROM $tabla WHERE estado_acpm = 'Abierta Vencida'");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (Exception $e) {
            return 0;
        }
    }

    /*=============================================
    CONTAR ACCIONES DE MEJORA ABIERTAS EN GENERAL
    =============================================*/
    public static function contarAcpmMejoraAbiertaGeneral($tabla)
    {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) AS total FROM $tabla WHERE tipo_acpm = 'AM' AND estado_acpm = 'Abierta'");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (Exception $e) {
            return 0;
        }
    }

    /*=============================================
    CONTAR ACCIONES DE MEJORA CERRADAS EN GENERAL
    =============================================*/
    public static function contarAcpmMejoraCerradaGeneral($tabla)
    {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) AS total FROM $tabla WHERE tipo_acpm = 'AM' AND estado_acpm = 'Cerrada'");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (Exception $e) {
            return 0;
        }
    }

    /*=============================================
    CONTAR ACCIONES PREVENTIVAS ABIERTAS EN GENERAL
    =============================================*/
    public static function contarAcpmPreventivaAbiertaGeneral($tabla)
    {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) AS total FROM $tabla WHERE tipo_acpm = 'AP' AND estado_acpm = 'Abierta'");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (Exception $e) {
            return 0;
        }
    }

    /*=============================================
    CONTAR ACCIONES PREVENTIVAS CERRADAS EN GENERAL
    =============================================*/
    public static function contarAcpmPreventivaCerradaGeneral($tabla)
    {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) AS total FROM $tabla WHERE tipo_acpm = 'AP' AND estado_acpm = 'Cerrada'");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (Exception $e) {
            return 0;
        }
    }

 

}
