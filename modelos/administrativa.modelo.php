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
            dias_pendientes = :dias_pendientes,
            observaciones_vacaciones = :observaciones_vacaciones
        WHERE id_detalle_vacaciones = :id_detalle_vacaciones");

            $stmt->bindParam(":disfrutadas", $datos["disfrutadas"], PDO::PARAM_INT);
            $stmt->bindParam(":pendientes_periodo", $datos["pendientes_periodo"], PDO::PARAM_INT);
            $stmt->bindParam(":dias_pendientes", $datos["dias_pendientes"], PDO::PARAM_INT);
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







}


