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
/*=============================================
MOSTRAR Verificaciones por Inventario y Usuario
=============================================*/
static public function mdlMostrarVerificacionesPorInventario($tablaVerificacion, $tablaActivos, $id_inventario, $id_usuario_fk = null)
{
    // Base query: activos, usuario, cargo, proceso, inventario y usuarios de apertura/cierre
    $sql = "
        SELECT 
            v.*,
            v.estado AS estado_verificacion,
            a.*,
            u.id AS id_usuario,
            u.nombre AS nombre_usuario,
            u.apellidos_usuario,
            u.foto,
            c.id_cargo,
            c.nombre_cargo,
            p.id_proceso,
            p.siglas_proceso,
            p.nombre_proceso,
            
            -- Datos del inventario
            i.id_inventario,
            i.fecha_apertura,
            i.estado_inventario,
            i.fecha_cierre,
            
            -- Usuarios que abren y cierran el inventario
            ua.nombre AS nombre_usuario_apertura,
            ua.apellidos_usuario AS apellidos_usuario_apertura,
            uc.nombre AS nombre_usuario_cierre,
            uc.apellidos_usuario AS apellidos_usuario_cierre

        FROM $tablaVerificacion AS v
        INNER JOIN $tablaActivos AS a ON v.id_activo_fk = a.id_activo
        INNER JOIN usuarios AS u ON v.id_usuario_fk = u.id
        INNER JOIN inventario AS i ON v.id_inventario_fk = i.id_inventario
        LEFT JOIN cargos AS c ON u.id_cargo_fk = c.id_cargo
        LEFT JOIN proceso AS p ON u.id_proceso_fk = p.id_proceso
        
        -- JOIN para usuarios de apertura y cierre
        LEFT JOIN usuarios AS ua ON i.id_usuario_apertura = ua.id
        LEFT JOIN usuarios AS uc ON i.id_usuario_cierre = uc.id

        WHERE v.id_inventario_fk = :id_inventario
    ";

    // Si se pasa un usuario específico, agregamos el filtro
    if (!empty($id_usuario_fk)) {
        $sql .= " AND v.id_usuario_fk = :id_usuario_fk";
    }

    // Preparar la consulta
    $stmt = Conexion::conectar()->prepare($sql);

    // Parámetros
    $stmt->bindParam(":id_inventario", $id_inventario, PDO::PARAM_INT);

    if (!empty($id_usuario_fk)) {
        $stmt->bindParam(":id_usuario_fk", $id_usuario_fk, PDO::PARAM_INT);
    }

    // Ejecutar
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
public static function mdlMostrarActivosNoVerificadosServerSide($request, $tablaVerificaciones, $tablaActivos, $id_inventario, $id_usuario_fk) {
    $searchTerm = '%' . $request['search']['value'] . '%';
    $start = intval($request['start']);
    $length = intval($request['length']);
    
    $columns = [
        0 => 'a.id_activo',
        1 => 'a.nombre_articulo',
        2 => 'a.lugar_articulo'
    ];
    
    $orderColumnIndex = $request['order'][0]['column'];
    $orderColumn = $columns[$orderColumnIndex];
    $orderDir = $request['order'][0]['dir'];

    $stmt = Conexion::conectar()->prepare("
        SELECT a.*
        FROM $tablaActivos a
        LEFT JOIN $tablaVerificaciones v ON a.id_activo = v.id_activo_fk AND v.id_inventario_fk = :id_inventario
        WHERE v.id_activo_fk IS NULL 
        AND a.id_usuario_fk = :id_usuario_fk
        AND (
            a.id_activo LIKE :searchTerm
            OR a.nombre_articulo LIKE :searchTerm
            OR a.lugar_articulo LIKE :searchTerm
        )
        ORDER BY $orderColumn $orderDir
        LIMIT :start, :length
    ");

    $stmt->bindParam(":id_inventario", $id_inventario, PDO::PARAM_INT);
    $stmt->bindParam(":id_usuario_fk", $id_usuario_fk, PDO::PARAM_INT);
    $stmt->bindParam(":searchTerm", $searchTerm, PDO::PARAM_STR);
    $stmt->bindParam(":start", $start, PDO::PARAM_INT);
    $stmt->bindParam(":length", $length, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


/*=============================================
CONTAR ACTIVOS FIJOS NO VERIFICADOS
=============================================*/
public static function mdlContarActivosNoVerificados($tablaVerificacion, $tablaActivos, $id_inventario, $id_usuario_fk) {
        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as contador FROM $tablaVerificacion v 
                                                INNER JOIN $tablaActivos a ON v.id_activo_fk = a.id_activo 
                                                WHERE v.id_inventario_fk = :id_inventario AND v.id_usuario_fk = :id_usuario_fk AND v.id_activo_fk IS NULL");
        $stmt->bindParam(":id_inventario", $id_inventario, PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario_fk", $id_usuario_fk, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    

}
