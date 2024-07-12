<?php

require_once "conexion.php";

class ModeloVerificaciones
{
    /*=============================================
    CREAR Verificación
    =============================================*/
    static public function mdlCrearVerificacion($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_inventario_fk, id_activo_fk, id_usuario_fk, estado, observaciones) VALUES (:id_inventario_fk, :id_activo_fk, :id_usuario_fk, :estado, :observaciones)");

        $stmt->bindParam(":id_inventario_fk", $datos["id_inventario_fk"], PDO::PARAM_INT);
        $stmt->bindParam(":id_activo_fk", $datos["id_activo_fk"], PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario_fk", $datos["id_usuario_fk"], PDO::PARAM_INT);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /*=============================================
    VERIFICAR EXISTENCIA DE Verificación
    =============================================*/
    static public function mdlExisteVerificacion($tabla, $id_activo_fk, $id_inventario_fk)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_activo_fk = :id_activo_fk AND id_inventario_fk = :id_inventario_fk");

        $stmt->bindParam(":id_activo_fk", $id_activo_fk, PDO::PARAM_INT);
        $stmt->bindParam(":id_inventario_fk", $id_inventario_fk, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();

        $stmt = null;
    }

    /*=============================================
    MOSTRAR Verificaciones por Inventario y Usuario
    =============================================*/
    static public function mdlMostrarVerificacionesPorInventario($tablaVerificacion, $tablaActivos, $id_inventario, $id_usuario_fk)
    {
        $stmt = Conexion::conectar()->prepare("
            SELECT v.*, a.*
            FROM $tablaVerificacion AS v
            INNER JOIN $tablaActivos AS a ON v.id_activo_fk = a.id_activo
            WHERE v.id_inventario_fk = :id_inventario
            AND v.id_usuario_fk = :id_usuario_fk
        ");

        $stmt->bindParam(":id_inventario", $id_inventario, PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario_fk", $id_usuario_fk, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
        $stmt = null;
    }





/*=============================================
MOSTRAR ACTIVOS VERIFICADOS (SERVER-SIDE)
=============================================*/
static public function mdlMostrarActivosVerificadosServerSide($request, $id_inventario, $id_usuario_fk)
{
    $stmt = Conexion::conectar()->prepare("
    SELECT v.*, a.*
    FROM verificaciones AS v
    INNER JOIN activos AS a ON v.id_activo_fk = a.id_activo
    WHERE v.id_inventario_fk = :id_inventario
    AND v.id_usuario_fk = :id_usuario_fk
    AND (
        v.id_activo_fk LIKE :searchTerm
        OR v.observaciones LIKE :searchTerm
        OR a.nombre_articulo LIKE :searchTerm
        OR v.estado LIKE :searchTerm
    )
    LIMIT :start, :length
    ");

    $searchTerm = '%' . $request['search']['value'] . '%';
    $start = intval($request['start']);
    $length = intval($request['length']);

    $stmt->bindParam(":id_inventario", $id_inventario, PDO::PARAM_INT);
    $stmt->bindParam(":id_usuario_fk", $id_usuario_fk, PDO::PARAM_INT);
    $stmt->bindParam(":searchTerm", $searchTerm, PDO::PARAM_STR);
    $stmt->bindParam(":start", $start, PDO::PARAM_INT);
    $stmt->bindParam(":length", $length, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetchAll();
}

/*=============================================
CONTAR ACTIVOS VERIFICADOS
=============================================*/
static public function mdlContarActivosVerificados($id_inventario, $id_usuario_fk)
{
    $stmt = Conexion::conectar()->prepare("
    SELECT COUNT(*) as contador 
    FROM verificaciones
    WHERE id_inventario_fk = :id_inventario AND id_usuario_fk = :id_usuario_fk
    ");

    $stmt->bindParam(":id_inventario", $id_inventario, PDO::PARAM_INT);
    $stmt->bindParam(":id_usuario_fk", $id_usuario_fk, PDO::PARAM_INT);

    $stmt->execute();
    return $stmt->fetch();
}

/*=============================================
MOSTRAR ACTIVOS FIJOS NO VERIFICADOS (SERVER-SIDE)
=============================================*/
public static function mdlMostrarActivosNoVerificadosServerSide($request, $tablaVerificaciones, $tablaActivos, $id_inventario) {
    $searchTerm = '%' . $request['search']['value'] . '%';
    $start = intval($request['start']);
    $length = intval($request['length']);

    $stmt = Conexion::conectar()->prepare("
        SELECT a.*
        FROM $tablaActivos a
        LEFT JOIN $tablaVerificaciones v ON a.id_activo = v.id_activo_fk AND v.id_inventario_fk = :id_inventario
        WHERE v.id_activo_fk IS NULL 
        AND (
            a.id_activo LIKE :searchTerm
            OR a.nombre_articulo LIKE :searchTerm
            OR a.lugar_articulo LIKE :searchTerm
        )
        LIMIT :start, :length
    ");

    $stmt->bindParam(":id_inventario", $id_inventario, PDO::PARAM_INT);
    $stmt->bindParam(":searchTerm", $searchTerm, PDO::PARAM_STR);
    $stmt->bindParam(":start", $start, PDO::PARAM_INT);
    $stmt->bindParam(":length", $length, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/*=============================================
CONTAR ACTIVOS FIJOS NO VERIFICADOS
=============================================*/
public static function mdlContarActivosNoVerificados($tablaVerificaciones, $tablaActivos, $id_inventario) {
    $stmt = Conexion::conectar()->prepare("
        SELECT COUNT(*) as contador
        FROM $tablaActivos a
        LEFT JOIN $tablaVerificaciones v ON a.id_activo = v.id_activo_fk AND v.id_inventario_fk = :id_inventario
        WHERE v.id_activo_fk IS NULL
    ");

    $stmt->bindParam(":id_inventario", $id_inventario, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}
