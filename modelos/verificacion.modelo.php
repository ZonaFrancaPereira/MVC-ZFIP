<?php

require_once "conexion.php";

class ModeloVerificaciones
{
    /*=============================================
    CREAR Verificación
    =============================================*/
    static public function mdlCrearVerificacion($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_inventario_fk, id_activo_fk, id_usuario_fk, estado, observaciones, fecha_verificacion) 
                                              VALUES (:id_inventario_fk, :id_activo_fk, :id_usuario_fk, :estado, :observaciones, :fecha_verificacion)");

        $stmt->bindParam(":id_inventario_fk", $datos["id_inventario_fk"], PDO::PARAM_INT);
        $stmt->bindParam(":id_activo_fk", $datos["id_activo_fk"], PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario_fk", $datos["id_usuario_fk"], PDO::PARAM_INT);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_verificacion", $datos["fecha_verificacion"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /*=============================================
    MOSTRAR Verificaciones por Inventario
    =============================================*/
    static public function mdlMostrarVerificacionesPorInventario($tabla, $id_inventario)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_inventario_fk = :id_inventario");

        $stmt->bindParam(":id_inventario", $id_inventario, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt = null;
    }
}
?>
