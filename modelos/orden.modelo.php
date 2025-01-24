<?php

require_once "conexion.php";

class ModeloOrden{

   public static function mdlMostrarProvedor($tabla, $item, $valor){
       $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
       $stmt->execute();
       return $stmt->fetchAll();
       $stmt->close();
       $stmt = null;
   }

   public static function mdlObtenerNombreCargo($id_cargo) {
    try {
        $stmt = Conexion::conectar()->prepare("SELECT nombre_cargo FROM cargos WHERE id_cargo = :id_cargo");
        $stmt->bindParam(":id_cargo", $id_cargo, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve el resultado como un array asociativo
    } catch (PDOException $e) {
        return null; // Retorna null si ocurre un error
    }
    }

    /* =============================================
    Crear una nueva orden de compra
    ============================================= */
    public static function mdlCrearOrden($tabla, $datos) {
        try {
           // Obtener la conexión PDO
           $pdo = Conexion::conectar();

           // Preparar la consulta de inserción
           $stmt = $pdo->prepare("INSERT INTO $tabla (
                    fecha_orden, 
                    proveedor_recurrente, 
                    forma_pago, 
                    id_cotizante, 

                ) VALUES (
                    :fecha_orden, 
                    :proveedor_recurrente, 
                    :forma_pago, 
                    :id_cotizante, 

                )"
            );

            // Vincular los parámetros
            $stmt->bindParam(":fecha_orden", $datos["fecha_orden"], PDO::PARAM_STR);
            $stmt->bindParam(":proveedor_recurrente", $datos["proveedor_recurrente"], PDO::PARAM_STR);
            $stmt->bindParam(":forma_pago", $datos["forma_pago"], PDO::PARAM_STR);
            $stmt->bindParam(":id_cotizante", $datos["id_cotizante"], PDO::PARAM_INT);
            
            
           
           
           
           
           
           

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }

        $stmt = null;
    }
}