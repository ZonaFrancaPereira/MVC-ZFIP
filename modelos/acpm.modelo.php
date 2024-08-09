<?php

require_once "conexion.php";

class ModeloAcpm
{

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

}
