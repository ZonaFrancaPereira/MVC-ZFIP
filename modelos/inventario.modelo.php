<?php

require_once "conexion.php";

class ModeloInventario
{
    /*=============================================
    CREAR Inventario
    =============================================*/
    static public function mdlCrearInventario($tabla, $datos)
    {
      
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();

            // Preparar la consulta de inserción
            $stmt = $pdo->prepare("INSERT INTO $tabla (
                fecha_apertura,estado_inventario, id_usuario_apertura
            ) VALUES (
                :fecha_apertura,
                :estado_inventario,
                 :id_usuario_apertura
            )");

            // Vincular parámetros
            
        $stmt->bindParam(":fecha_apertura", $datos["fecha_apertura"], PDO::PARAM_STR);
        $stmt->bindParam(":estado_inventario", $datos["estado_inventario"], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario_apertura", $datos["id_usuario_apertura"], PDO::PARAM_INT);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Obtener el último ID insertado
                $lastInsertId = $pdo->lastInsertId();

                // Cerrar el cursor y liberar recursos
                $stmt->closeCursor();
                $stmt = null;

                // Devolver el último ID insertado
                return $lastInsertId;
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            // Manejar errores
            return "error: " . $e->getMessage();
        }
    }
    /*=============================================
    CERRAR Inventario
    =============================================*/
    static public function mdlCerrarInventario($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado,fecha_cierre = :fecha_cierre, id_usuario_cierre = :id_usuario_cierre WHERE id_inventario = :id_inventario");

        $stmt->bindParam(":fecha_cierre", $datos["fecha_cierre"], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario_cierre", $datos["id_usuario_cierre"], PDO::PARAM_INT);
        $stmt->bindParam(":id_inventario", $datos["id_inventario"], PDO::PARAM_INT);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /*=============================================
    VERIFICAR Inventario Abierto
    =============================================*/
    static public function mdlVerificarInventarioAbierto($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_cierre IS NULL ");

        $stmt->execute();

        return $stmt->fetch();

        $stmt = null;
    }
    
	/*=============================================
	MOSTRAR INVENTARIO
	=============================================*/

	static public function mdlMostrarInventario($tabla, $item, $valor)
	{

    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

    }
   
}
?>
