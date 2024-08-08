<?php

require_once "conexion.php";

class ModeloSadoc
{



	/*=============================================
	MOSTRAR ARCHIVOS POR PROCESO
	=============================================*/

	static public function mdlObtenerArchivosPorProceso($id_proceso_fk) {
        try {
            $stmt = Conexion::conectar()->prepare('SELECT * FROM sadoc WHERE id_proceso_fk = :id_proceso_fk AND estado = "activo"');
            $stmt->bindParam(':id_proceso_fk', $id_proceso_fk, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }




	
}
