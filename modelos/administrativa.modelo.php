<?php
require_once "conexion.php";

class ModeloAdministrativa
{
    // Guardar usuario
    static public function mdlGuardarUsuario($tabla, $datos)
    {
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();
            // Preparar la consulta de inserción
            $stmt = $pdo->prepare("INSERT INTO $tabla (
                nombre_administrativa,  
                cedula_administrativa, 
                fecha_ingreso_administrativa,
                estado_usuario_administrativa) 
                VALUES (
                :nombre_administrativa, 
                :cedula_administrativa, 
                :fecha_ingreso_administrativa,
                :estado_usuario_administrativa)");

            $stmt->bindParam(":nombre_administrativa", $datos["nombre_administrativa"], PDO::PARAM_STR);
            $stmt->bindParam(":cedula_administrativa", $datos["cedula_administrativa"], PDO::PARAM_INT);
            $stmt->bindParam(":fecha_ingreso_administrativa", $datos["fecha_ingreso_administrativa"], PDO::PARAM_STR);
            $stmt->bindParam(":estado_usuario_administrativa", $datos["estado_usuario_administrativa"], PDO::PARAM_STR);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }

    static public function mdlMostrarUsuariosAdministrativa($tabla, $item, $valor)
    {
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();
            // Preparar la consulta de selección
            if ($item != null) {
                $stmt = $pdo->prepare("SELECT * FROM $tabla ");
                $stmt->bindParam(":$item", $valor, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $stmt = $pdo->prepare("SELECT * FROM $tabla");
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }

    static public function mdlGuardarDiasVacaciones($tabla, $datos)
    {
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();
            // Preparar la consulta de inserción
            $stmt = $pdo->prepare("INSERT INTO $tabla (
                periodo_inicio, 
                periodo_fin, 
                disfrutadas, 
                pendientes_periodo, 
                observaciones_vacaciones, 
                id_vacaciones_fk, 
                id_usuario_fk) 
                VALUES (
                :periodo_inicio,
                :periodo_fin,  
                :disfrutadas, 
                :pendientes_periodo, 
                :observaciones_vacaciones, 
                :id_vacaciones_fk, 
                :id_usuario_fk)");

            $stmt->bindParam(":periodo_inicio", $datos["periodo_inicio"], PDO::PARAM_STR);
            $stmt->bindParam(":periodo_fin", $datos["periodo_fin"], PDO::PARAM_STR);
            $stmt->bindParam(":disfrutadas", $datos["disfrutadas"], PDO::PARAM_INT);
            $stmt->bindParam(":pendientes_periodo", $datos["pendientes_periodo"], PDO::PARAM_INT);
            $stmt->bindParam(":observaciones_vacaciones", $datos["observaciones_vacaciones"], PDO::PARAM_STR);
            $stmt->bindParam(":id_vacaciones_fk", $datos["id_vacaciones_fk"], PDO::PARAM_INT);
            $stmt->bindParam(":id_usuario_fk", $datos["id_usuario_fk"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }

    public static function mdlEditarUsuario($tabla, $datos)
    {
        try {
            $pdo = Conexion::conectar();

            // Preparar la consulta de actualización
            $stmt = $pdo->prepare("UPDATE $tabla SET 
            nombre_administrativa = :nombre_administrativa,
            cedula_administrativa = :cedula_administrativa,
            fecha_ingreso_administrativa = :fecha_ingreso_administrativa,
            estado_usuario_administrativa = :estado_usuario_administrativa
        WHERE id = :id");

            $stmt->bindParam(":nombre_administrativa", $datos["nombre_administrativa"], PDO::PARAM_STR);
            $stmt->bindParam(":cedula_administrativa", $datos["cedula_administrativa"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_ingreso_administrativa", $datos["fecha_ingreso_administrativa"], PDO::PARAM_STR);
            $stmt->bindParam(":estado_usuario_administrativa", $datos["estado_usuario_administrativa"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);


            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }

    public static function mdlActualizarVacaciones($tabla, $datos)
    {
        try {
            $pdo = Conexion::conectar();

            // Preparar la consulta de actualización
            $stmt = $pdo->prepare("UPDATE $tabla SET 
            disfrutadas = :disfrutadas,
            pendientes_periodo = :pendientes_periodo,
            observaciones_vacaciones = :observaciones_vacaciones
        WHERE id_detalle_vacaciones = :id_detalle_vacaciones");

            $stmt->bindParam(":disfrutadas", $datos["disfrutadas"], PDO::PARAM_INT);
            $stmt->bindParam(":pendientes_periodo", $datos["pendientes_periodo"], PDO::PARAM_INT);
            $stmt->bindParam(":observaciones_vacaciones", $datos["observaciones_vacaciones"], PDO::PARAM_STR);
            $stmt->bindParam(":id_detalle_vacaciones", $datos["id_detalle_vacaciones"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }

    public static function mdlEnviarVacaciones($tabla, $datos)
    {
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();
            // Preparar la consulta de inserción
            $stmt = $pdo->prepare("INSERT INTO $tabla (
            id_detalle_vacaciones_fk,
            id_usuario_fk,
            id_vacaciones_fk,
            correo_aprobador,
            descripcion_solicitud,
            estado_solicitud)
            VALUES (
            :id_detalle_vacaciones_fk,
            :id_usuario_fk,
            :id_vacaciones_fk,
            :correo_aprobador,
            :descripcion_solicitud,
            :estado_solicitud)");

            $stmt->bindParam(":id_detalle_vacaciones_fk", $datos["id_detalle_vacaciones_fk"], PDO::PARAM_INT);
            $stmt->bindParam(":id_usuario_fk", $datos["id_usuario_fk"], PDO::PARAM_INT);
            $stmt->bindParam(":id_vacaciones_fk", $datos["id_vacaciones_fk"], PDO::PARAM_INT);
            $stmt->bindParam(":correo_aprobador", $datos["correo_aprobador"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion_solicitud", $datos["descripcion_solicitud"], PDO::PARAM_STR);
            $stmt->bindParam(":estado_solicitud", $datos["estado_solicitud"], PDO::PARAM_STR);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }

    public static function mdlMostrarSolicitudesVacaciones($tabla, $item, $valor)
    {
        try {
            $pdo = Conexion::conectar();

            // Validar el nombre del campo para evitar inyección SQL
            $camposPermitidos = ['correo_aprobador']; // agrega más campos si es necesario
            if ($item != null && in_array($item, $camposPermitidos)) {
                $stmt = $pdo->prepare("SELECT * FROM $tabla WHERE $item = :valor AND estado_solicitud = 'pendiente'");
                $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $stmt = $pdo->prepare("SELECT * FROM $tabla WHERE estado_solicitud = 'pendiente'");
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }

    public static function mdlMotrarVacacionesAprobadas($tabla)
    {
        try {
            $pdo = Conexion::conectar();

            $stmt = $pdo->prepare("SELECT * FROM $tabla WHERE estado_solicitud = 'proceso'");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }


    public static function mdlAprobarSolicitud($tabla, $datos)
    {
        try {
            $pdo = Conexion::conectar();

            // Preparar la consulta de actualización
            $stmt = $pdo->prepare("UPDATE $tabla SET 
            estado_solicitud = :estado_solicitud,
            firma_aprobador = :firma_aprobador
        WHERE id_solicitud = :id_solicitud");

            $stmt->bindParam(":estado_solicitud", $datos["estado_solicitud"], PDO::PARAM_STR);
            $stmt->bindParam(":firma_aprobador", $datos["firma_aprobador"], PDO::PARAM_STR);
            $stmt->bindParam(":id_solicitud", $datos["id_solicitud"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }

    public static function mdlRechazarSolicitud($tabla, $datos)
    {
        try {
            $pdo = Conexion::conectar();

            // Preparar la consulta de actualización
            $stmt = $pdo->prepare("UPDATE $tabla SET 
            estado_solicitud = :estado_solicitud,
            observaciones_solicitud = :observaciones_solicitud
        WHERE id_solicitud = :id_solicitud");

            $stmt->bindParam(":estado_solicitud", $datos["estado_solicitud"], PDO::PARAM_STR);
            $stmt->bindParam(":observaciones_solicitud", $datos["observaciones_solicitud"], PDO::PARAM_STR);
            $stmt->bindParam(":id_solicitud", $datos["id_solicitud"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }

    public static function mdlMostrarVacacionespdf($tabla, $item, $valor)
    {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT 
                    u.nombre,
                    u.apellidos_usuario,
                    u.id_proceso_fk,
                    p.nombre_proceso,
                    
                    a.nombre_administrativa,
                    a.cedula_administrativa,
                    a.fecha_ingreso_administrativa,
                    a.estado_usuario_administrativa,
                    
                    o.periodo_inicio,
                    o.periodo_fin,
                    o.disfrutadas,
                    o.pendientes_periodo,
                    o.observaciones_vacaciones,
                    
                    s.fecha_solicitud,
                    s.descripcion_solicitud,
                    s.estado_solicitud,
                    s.observaciones_solicitud,
                    s.correo_aprobador,
                    s.firma_aprobador

                FROM vacaciones_solicitudes s
                INNER JOIN detalle_vacaciones o ON s.id_detalle_vacaciones_fk = o.id_detalle_vacaciones
                INNER JOIN vacaciones a ON o.id_vacaciones_fk = a.id
                INNER JOIN usuarios u ON a.nombre_administrativa = u.id
                INNER JOIN proceso p ON u.id_proceso_fk = p.id_proceso
                WHERE s.$item = :$item
            ");

            $stmt->bindParam(":$item", $valor, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            die("Error al obtener datos de vacaciones: " . $e->getMessage());
        }
    }

    public static function mdlMostrarVacacionesUsuarios($tabla, $item, $valor)
    {
        try {
            $pdo = Conexion::conectar();
            if ($item != null && $valor != null) {
                $stmt = $pdo->prepare("SELECT * FROM $tabla WHERE $item = :$item");
                $stmt->bindParam(":$item", $valor, PDO::PARAM_INT);
            } else {
                $stmt = $pdo->prepare("SELECT * FROM $tabla");
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }
    
    public static function mdlDescontarDias($tabla, $datos)
    {
        try {
            $pdo = Conexion::conectar();

            // 1. Obtener valores actuales
            $stmtSelect = $pdo->prepare("SELECT disfrutadas, pendientes_periodo FROM $tabla WHERE id_detalle_vacaciones = :id_detalle_vacaciones");
            $stmtSelect->bindParam(":id_detalle_vacaciones", $datos["id_detalle_vacaciones"], PDO::PARAM_INT);
            $stmtSelect->execute();

            $resultado = $stmtSelect->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                // 2. Calcular nuevos valores
                $nuevasDisfrutadas = $resultado["disfrutadas"] + $datos["dias_descuento"];
                $nuevosPendientes = $resultado["pendientes_periodo"] - $datos["dias_descuento"];

                // Validación: prevenir negativos
                if ($nuevosPendientes < 0) {
                    return "error: los días a descontar superan los días pendientes";
                }

                // 3. Actualizar disfrutadas y pendientes_periodo en detalle_vacaciones
                $stmtUpdate = $pdo->prepare("UPDATE $tabla SET 
                    disfrutadas = :disfrutadas,
                    pendientes_periodo = :pendientes_periodo
                    WHERE id_detalle_vacaciones = :id_detalle_vacaciones");

                $stmtUpdate->bindParam(":disfrutadas", $nuevasDisfrutadas, PDO::PARAM_INT);
                $stmtUpdate->bindParam(":pendientes_periodo", $nuevosPendientes, PDO::PARAM_INT);
                $stmtUpdate->bindParam(":id_detalle_vacaciones", $datos["id_detalle_vacaciones"], PDO::PARAM_INT);

                if ($stmtUpdate->execute()) {
                    // 4. Actualizar estado_solicitud en vacaciones_solicitudes
                    $stmtEstado = $pdo->prepare("UPDATE vacaciones_solicitudes 
                                                SET estado_solicitud = :estado_solicitud 
                                                WHERE id_detalle_vacaciones_fk = :id_detalle_vacaciones_fk");

                    $stmtEstado->bindParam(":estado_solicitud", $datos["estado_solicitud"], PDO::PARAM_STR);
                    $stmtEstado->bindParam(":id_detalle_vacaciones_fk", $datos["id_detalle_vacaciones"], PDO::PARAM_INT);

                    if ($stmtEstado->execute()) {
                        return "ok";
                    } else {
                        $errorInfo = $stmtEstado->errorInfo();
                        return "error SQL estado: " . $errorInfo[2];
                    }

                } else {
                    $errorInfo = $stmtUpdate->errorInfo();
                    return "error SQL detalle: " . $errorInfo[2];
                }

            } else {
                return "no encontrado";
            }

        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }

    static public function mdlEliminarUsuario($tabla, $id)
    {
        try {
            $pdo = Conexion::conectar();

            // Preparar la consulta de eliminación
            $stmt = $pdo->prepare("DELETE FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }



}
