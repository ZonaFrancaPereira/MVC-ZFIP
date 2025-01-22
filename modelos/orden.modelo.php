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
}