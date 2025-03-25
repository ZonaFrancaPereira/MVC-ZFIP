<?php

require_once "conexion.php";

class ModeloProcesos
{
    /*=============================================
    OBTENER TODOS LOS PROCESOS
    =============================================*/
    static public function mdlMostrarProcesos($tabla)
    {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    /*=============================================
    AGREGAR PROCESO
    =============================================*/
    static public function mdlAgregarProceso($tabla, $datos)
    {
        try {
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, descripcion) VALUES (:nombre, :descripcion)");
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return "error";
        }
    }

    /*=============================================
    ACTUALIZAR PROCESO
    =============================================*/
    static public function mdlActualizarProceso($tabla, $datos)
    {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, descripcion = :descripcion WHERE id = :id");
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return "error";
        }
    }

    /*=============================================
    ELIMINAR PROCESO
    =============================================*/
    static public function mdlEliminarProceso($tabla, $id)
    {
        try {
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return "error";
        }
    }
}
