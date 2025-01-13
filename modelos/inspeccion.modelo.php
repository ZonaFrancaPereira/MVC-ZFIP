<?php

require_once "conexion.php";

class ModeloInspeccion
{



	/*=============================================
	REGISTRO DE INSPECCION 
	=============================================*/

    public static function mdlGuardarInspeccion($datos) {

        $stmt = Conexion::conectar()->prepare("INSERT INTO inspeccion_op 
            (id_cliente_fk, ingreso_salida, id_categoriaop_fk, otro_operacion, transito, fmm, arin, documento, fisico, estado, descripcion_observaciones, nombre_firma, cc_firma,firma_recibido,id_usuario_fk)
            VALUES (:id_cliente_fk, :ingreso_salida, :id_categoriaop_fk,:otro, :transito, :fmm, :arin, :documento, :fisico, :estado, :descripcion_observaciones, :nombre_firma, :cc_firma,:firma_recibido,:id_usuario_fk)");

        $stmt->bindParam(":id_cliente_fk", $datos["id_cliente_fk"], PDO::PARAM_INT);
        $stmt->bindParam(":ingreso_salida", $datos["ingreso_salida"], PDO::PARAM_STR);
        $stmt->bindParam(":id_categoriaop_fk", $datos["id_categoriaop_fk"], PDO::PARAM_INT);
        $stmt->bindParam(":otro", $datos["otro"], PDO::PARAM_STR);
        $stmt->bindParam(":transito", $datos["transito"], PDO::PARAM_STR);
        $stmt->bindParam(":fmm", $datos["fmm"], PDO::PARAM_STR);
        $stmt->bindParam(":arin", $datos["arin"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":fisico", $datos["fisico"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion_observaciones", $datos["descripcion_observaciones"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_firma", $datos["nombre_firma"], PDO::PARAM_STR);
        $stmt->bindParam(":cc_firma", $datos["cc_firma"], PDO::PARAM_STR);
        $stmt->bindParam(":firma_recibido", $datos["firma_recibido"], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario_fk", $datos["id_usuario_fk"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    
    /*=============================================
	MOSTRAR CATEGORIAS OPERACIONES INSPECCION
	=============================================*/

	static public function mdlMostrarCategoriaOp($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * 
														
														FROM 
														$tabla 
														WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		$stmt = null;

	}

        /*=============================================
	MOSTRAR   INSPECCIONES REALIZADAS
	=============================================*/

	static public function mdlMostrarInspeccion($tabla, $item, $valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * 
														FROM 
														$tabla 
														WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		$stmt = null;

	}
	
}
