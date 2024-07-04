<?php

require_once "conexion.php";

class ModeloSoporte {

    public static function mdlIngresarSoporte($tabla, $datos) {
        
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (
                correo_soporte,
                id_usuario_fk,
                usuario_soporte,
                proceso_soporte,
                descripcion_soporte

            ) VALUES (
                :correo_soporte,
                :id_usuario_fk,
                :usuario_soporte,
                :proceso_soporte,
                :descripcion_soporte

            )");

            $stmt->bindParam(":correo_soporte", $datos["correo_soporte"], PDO::PARAM_STR);
            $stmt->bindParam(":id_usuario_fk", $datos["id_usuario_fk"], PDO::PARAM_INT);
            $stmt->bindParam(":usuario_soporte", $datos["usuario_soporte"], PDO::PARAM_STR);
            $stmt->bindParam(":proceso_soporte", $datos["proceso_soporte"], PDO::PARAM_INT);
            $stmt->bindParam(":descripcion_soporte", $datos["descripcion_soporte"], PDO::PARAM_STR);
            
            if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->closeCursor();
		$stmt = null;
	}

}

?>
