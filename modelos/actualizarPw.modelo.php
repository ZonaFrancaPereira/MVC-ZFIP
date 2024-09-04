<?php

require_once "conexion.php";

class ModeloPw
{



	/*=============================================
	REGISTRO DE DETALLES DEL CAMBIO DE PW
	=============================================*/
static public function mdlDetallePw($tabla, $datos) {
    try {
        // Obtener la conexión PDO
        $pdo = Conexion::conectar();

        // Preparar la consulta de inserción
        $stmt = $pdo->prepare("INSERT INTO $tabla (
            estado_pw,
            id_usuario_fk
        ) VALUES (
            :estado_pw,
            :id_usuario_fk
        )");

        // Vincular parámetros
        $stmt->bindParam(":estado_pw", $datos["estado_pw"], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario_fk", $datos["id_usuario_fk"], PDO::PARAM_INT);

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

static public function mdlCambioPw($tabla_pw, $datos) {
    try {
        // Obtener la conexión PDO
        $pdo = Conexion::conectar();

        // Preparar la consulta de inserción
        $stmt = $pdo->prepare("INSERT INTO $tabla_pw (
            nombre_app,
            usuario_app,
            pw_app,
            id_pw_fk
        ) VALUES (
            :nombre_app,
            :usuario_app,
            :pw_app,
            :id_pw_fk
        )");

        // Vincular parámetros
        $stmt->bindParam(":nombre_app", $datos["nombre_app"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario_app", $datos["usuario_app"], PDO::PARAM_STR);
        $stmt->bindParam(":pw_app", $datos["pw_app"], PDO::PARAM_STR);
        $stmt->bindParam(":id_pw_fk", $datos["id_pw_fk"], PDO::PARAM_INT);

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
MOSTRAR PW TRAER TODOS LOS DATOS
=============================================*/
static public function mdlMostrarPwGeneral($tabla1, $tabla2, $item, $valor)
{

    if($item != null){

        $stmt = Conexion::conectar()->prepare("SELECT d.*, a.* 
            FROM detalle_pw AS d
            INNER JOIN actualizacion_pw AS a ON d.id_detalle_pw = a.id_pw_fk
            WHERE d.id_usuario_fk = :valor ");

         // Asignación del parámetro correctamente
         $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();

    }else{

        $stmt = Conexion::conectar()->prepare("SELECT d.*, a.* 
            FROM detalle_pw AS d
            INNER JOIN actualizacion_pw AS a ON d.id_detalle_pw = a.id_pw_fk");

        $stmt -> execute();

        return $stmt -> fetchAll();

    }
    $stmt = null;

}

static public function mdlMostrarPwIndividual($tabla, $item, $valor)
{

    if($item != null){

        $stmt = Conexion::conectar()->prepare("SELECT * 
            FROM $tabla
            
            WHERE id_usuario_fk = :valor ");

         // Asignación del parámetro correctamente
         $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();

    }else{

        $stmt = Conexion::conectar()->prepare("SELECT * 
            FROM $tabla 
            ");

        $stmt -> execute();

        return $stmt -> fetchAll();

    }
    $stmt = null;

}

    
    
}