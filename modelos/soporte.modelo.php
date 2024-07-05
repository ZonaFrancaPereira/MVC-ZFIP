<?php

require_once "conexion.php";

class ModeloSoporte {

    public static function mdlIngresarSoporte($tabla, $datos) {
        
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (
                id_usuario_fk,
                descripcion_soporte

            ) VALUES (
            
                :id_usuario_fk,
                :descripcion_soporte

            )");

            $stmt->bindParam(":id_usuario_fk", $datos["id_usuario_fk"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion_soporte", $datos["descripcion_soporte"], PDO::PARAM_STR);
            
            if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->closeCursor();
		$stmt = null;
	}

    	/*=============================================
	MOSTRAR SOPORTE
	=============================================*/

    static public function mdlMostrarSoporte($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * 
														
														FROM 
														$tabla 
														WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }



        $stmt = null;
    }

}

?>
