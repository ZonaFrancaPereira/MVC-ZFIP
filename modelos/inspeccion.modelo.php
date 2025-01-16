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
    MOSTRAR INSPECCIONES REALIZADAS CON INNER JOIN
=============================================*/

static public function mdlMostrarInspeccion($tabla, $item = null, $valor = null){

    // Si se recibe un filtro (item y valor)
    if($item != null && $valor != null){
        $stmt = Conexion::conectar()->prepare("SELECT 
                                                    i.*, 
                                                    c.*, 
                                                    cat.*, 
                                                    u.* 
                                                FROM 
                                                    $tabla i
                                                INNER JOIN 
                                                    clientes_zfip c ON i.id_cliente_fk = c.id_cliente
                                                INNER JOIN 
                                                    categoria_op cat ON i.id_categoriaop_fk = cat.id_categoriaop
                                                INNER JOIN 
                                                    usuarios u ON i.id_usuario_fk = u.id
                                                WHERE 
                                                    i.$item = :$item");

        $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(); // Retorna solo el primer resultado (como en tu ejemplo)

    } else {
        // Si no se recibe filtro, trae todas las inspecciones
        $stmt = Conexion::conectar()->prepare("SELECT 
                                                    i.*, 
                                                    c.*, 
                                                    cat.*, 
                                                    u.* 
                                                FROM 
                                                    $tabla i
                                                INNER JOIN 
                                                    clientes_zfip c ON i.id_cliente_fk = c.id_cliente
                                                INNER JOIN 
                                                    categoria_op cat ON i.id_categoriaop_fk = cat.id_categoriaop
                                                INNER JOIN 
                                                    usuarios u ON i.id_usuario_fk = u.id");

        $stmt->execute();
        return $stmt->fetchAll(); // Retorna todos los resultados
    }

    $stmt = null;
}



	
    /*=============================================
	MOSTRAR PDF INSPECCION
	=============================================*/

    public static function mdlMostrarInspeccionpdf($tabla, $item, $valor, $consulta)
    {
        try {
            // Conectar a la base de datos
            $stmt = Conexion::conectar()->prepare("SELECT 
                    a.id_inspeccion,
					a.id_cliente_fk, 
					a.ingreso_salida, 
					a.id_categoriaop_fk, 
					a.otro_operacion, 
					a.transito, 
					a.fmm, 
					a.arin, 
					a.documento, 
					a.fisico, 
					a.estado, 
					a.descripcion_observaciones, 
					a.nombre_firma, 
					a.cc_firma, 
					a.firma_recibido, 
					a.fecha_inspeccion, 
					a.id_usuario_fk,
					j.nombre_categoriaop,
					k.nombre,
					k.apellidos_usuario,
                    k.foto,
					u.nombre_cliente,
					u.email_cliente
                FROM $tabla a
                INNER JOIN clientes_zfip u ON a.id_cliente_fk = u.id_cliente
				INNER JOIN categoria_op j ON a.id_categoriaop_fk = j.id_categoriaop
				INNER JOIN usuarios k ON a.id_usuario_fk = k.id
                WHERE $item = :$item");

            // Vincular el parámetro de la consulta
            $stmt->bindParam(":$item", $valor, PDO::PARAM_INT);

            // Ejecutar la consulta
            $stmt->execute();

            // Devolver los resultados
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            // Manejo de errores
            die("Error al obtener datos del ACPM: " . $e->getMessage());
        }
    }

	
}
