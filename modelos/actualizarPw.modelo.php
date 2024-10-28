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
static public function mdlMostrarPwGeneral($tabla, $valor)
{
    try {
        // Conectar a la base de datos
        $stmt = Conexion::conectar()->prepare("SELECT 
            u1.id, 
            u1.nombre,
            u1.apellidos_usuario,
            u1.correo_usuario,
            u1.perfil,
            u1.foto,
            u1.estado,
            u1.id_cargo_fk,
            u1.id_proceso_fk,
            u1.ultimo_login,
            u1.fecha,
            u1.intentos,
            d.id_detalle_pw,
            d.fecha_pw,
            d.estado_pw,
            d.id_usuario_fk,
            d.id_usuario_ti AS usuario_ti_id,
            d.fecha_verificacion,
            a.id_pw,
            a.nombre_app,
            a.usuario_app,
            a.pw_app,
            a.id_pw_fk,
            u2.id AS usuario_ti_id,
            u2.nombre AS nombre_ti,
            u2.apellidos_usuario AS apellidos_ti,
            u2.correo_usuario AS correo_ti,
            u2.perfil AS perfil_ti,
            u2.foto AS foto_ti,
            u2.estado AS estado_ti,
            u2.id_cargo_fk AS cargo_ti,
            u2.id_proceso_fk AS proceso_ti,
            u2.ultimo_login AS login_ti,
            u2.fecha AS fecha_ti,
            u2.intentos AS intentaos_ti
        FROM detalle_pw d
        INNER JOIN usuarios u1 ON d.id_usuario_fk = u1.id
        INNER JOIN actualizacion_pw a ON d.id_detalle_pw = a.id_pw_fk
        LEFT JOIN usuarios u2 ON d.id_usuario_ti = u2.id
        WHERE d.id_detalle_pw = :valor");

        // Vincular el parámetro de la consulta
        $stmt->bindParam(":valor", $valor, PDO::PARAM_INT);

        // Ejecutar la consulta
        $stmt->execute();

        // Devolver los resultados
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        // Manejo de errores
        die("Error al obtener datos del ACPM: " . $e->getMessage());
    }
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