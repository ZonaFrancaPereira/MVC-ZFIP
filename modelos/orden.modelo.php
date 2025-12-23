<?php

require_once "conexion.php";

class ModeloOrden
{

    public static function mdlMostrarProvedor($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    public static function mdlObtenerNombreCargo($id_cargo)
    {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT nombre_cargo FROM cargos WHERE id_cargo = :id_cargo");
            $stmt->bindParam(":id_cargo", $id_cargo, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve el resultado como un array asociativo
        } catch (PDOException $e) {
            return null; // Retorna null si ocurre un error
        }
    }

    /* =============================================
   CREAR NUEVA ORDEN DE COMPRA
    ============================================= */
    public static function mdlCrearOrden($tabla, $datos)
    {
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();

            // Preparar la consulta de inserción
            $stmt = $pdo->prepare(
                "INSERT INTO $tabla (
                    presupuestado,
                    proveedor_recurrente,
                    forma_pago,
                    tiempo_pago,
                    porcentaje_anticipo,
                    condiciones_negociacion,
                    comentario_orden,
                    tiempo_entrega,
                    total_orden,
                    analisis_cotizacion,
                    estado_orden,
                    descripcion_declinado,
                    fecha_aprobacion,
                    id_cotizante,
                    id_proveedor_fk
                ) VALUES (
                    :presupuestado,
                    :proveedor_recurrente,
                    :forma_pago,
                    :tiempo_pago,
                    :porcentaje_anticipo,
                    :condiciones_negociacion,
                    :comentario_orden,
                    :tiempo_entrega,
                    :total_orden,
                    :analisis_cotizacion,
                    :estado_orden,
                    :descripcion_declinado,
                    :fecha_aprobacion,
                    :id_cotizante,
                    :id_proveedor_fk
                )"
            );

            // Vincular los parámetros
   $stmt->bindParam(":presupuestado", $datos["presupuestado"], PDO::PARAM_STR);
            $stmt->bindParam(":proveedor_recurrente", $datos["proveedor_recurrente"], PDO::PARAM_STR);
            $stmt->bindParam(":forma_pago", $datos["forma_pago"], PDO::PARAM_STR);
            $stmt->bindParam(":tiempo_pago", $datos["tiempo_pago"], PDO::PARAM_INT);
            $stmt->bindParam(":porcentaje_anticipo", $datos["porcentaje_anticipo"], PDO::PARAM_STR);
            $stmt->bindParam(":condiciones_negociacion", $datos["condiciones_negociacion"], PDO::PARAM_STR);
            $stmt->bindParam(":comentario_orden", $datos["comentario_orden"], PDO::PARAM_STR);
            $stmt->bindParam(":tiempo_entrega", $datos["tiempo_entrega"], PDO::PARAM_INT);
            $stmt->bindParam(":total_orden", $datos["total_orden"], PDO::PARAM_STR);
            $stmt->bindParam(":analisis_cotizacion", $datos["analisis_cotizacion"], PDO::PARAM_STR);
            $stmt->bindParam(":estado_orden", $datos["estado_orden"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion_declinado", $datos["descripcion_declinado"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_aprobacion", $datos["fecha_aprobacion"], PDO::PARAM_STR);
            $stmt->bindParam(":id_cotizante", $datos["id_cotizante"], PDO::PARAM_INT);
            $stmt->bindParam(":id_proveedor_fk", $datos["id_proveedor_fk"], PDO::PARAM_INT);


            if ($stmt->execute()) {
                return array("status" => "ok", "id_orden_compra" => $pdo->lastInsertId());
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }

        $stmt = null;
    }

    /* =============================================
   CREAR DETALLE ORDEN DE COMPRA
    ============================================= */

    public static function mdlCrearDetalleOrden($datosOrden)
    {
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();

            // Preparar la consulta de inserción
            $stmt = $pdo->prepare(
                "INSERT INTO detalle_orden(
                    articulo_compra,
                    cantidad_orden,
                    valor_neto,
                    valor_iva,
                    valor_total,
                    observaciones_articulo,
                    id_orden_compra
                ) VALUES (
                    :articulo_compra,
                    :cantidad_orden,
                    :valor_neto,
                    :valor_iva,
                    :valor_total,
                    :observaciones_articulo,
                    :id_orden_compra
                )"
            );

            // Vincular los parámetros
            $stmt->bindParam(":articulo_compra", $datosOrden["articulo_compra"], PDO::PARAM_STR);
            $stmt->bindParam(":cantidad_orden", $datosOrden["cantidad_orden"], PDO::PARAM_STR);
            $stmt->bindParam(":valor_neto", $datosOrden["valor_neto"], PDO::PARAM_STR);
            $stmt->bindParam(":valor_iva", $datosOrden["valor_iva"], PDO::PARAM_STR);
            $stmt->bindParam(":valor_total", $datosOrden["valor_total"], PDO::PARAM_STR);
            $stmt->bindParam(":observaciones_articulo", $datosOrden["observaciones_articulo"], PDO::PARAM_STR);
            $stmt->bindParam(":id_orden_compra", $datosOrden["id_orden_compra"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }

        $stmt = null;
    }
    /* =============================================
   MOSTRAR ORDENES A CADA LIDER
============================================= */
    public static function mdlMostrarOrdenesLideres($idUsuario)
    {
        try {

            $stmt = Conexion::conectar()->prepare("SELECT 
                oc.id_orden,
                oc.fecha_orden,
                oc.forma_pago,
                oc.total_orden,
                oc.estado_orden,

                p.id_proveedor AS nit_proveedor,
                p.nombre_proveedor

            FROM orden_compra oc
            INNER JOIN proveedor_compras p 
                ON oc.id_proveedor_fk = p.id_proveedor
            WHERE oc.id_cotizante = :idUsuario
            ORDER BY oc.fecha_orden DESC
        ");

            $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    /* =============================================
   MOSTRAR ORDENES POR CARGO
============================================= */
    public static function mdlMostrarOrdenesPorEstado($estado)
    {
        try {

            $stmt = Conexion::conectar()->prepare("SELECT 
    oc.id_orden,
    oc.fecha_orden,
    oc.forma_pago,
    oc.total_orden,
    oc.estado_orden,

    -- Datos del proveedor
    p.id_proveedor AS nit_proveedor,
    p.nombre_proveedor,

    -- Datos del usuario
    u.id AS id_usuario,
    u.nombre,
    u.apellidos_usuario,
    u.correo_usuario,
    u.id_cargo_fk

FROM orden_compra oc

INNER JOIN proveedor_compras p 
    ON oc.id_proveedor_fk = p.id_proveedor

INNER JOIN usuarios u
    ON oc.id_cotizante = u.id

WHERE oc.estado_orden = :estado 
ORDER BY oc.fecha_orden DESC;

        ");

            $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    /* =============================================
   MOSTRAR ORDENES EJECUTADAS
============================================= */
    public static function mdlMostrarOrdenesEjecutadas($estado)
    {
        try {

            $stmt = Conexion::conectar()->prepare("SELECT 
    oc.id_orden,
    oc.fecha_orden,
    oc.forma_pago,
    oc.total_orden,
    oc.estado_orden,

    -- Datos del proveedor
    p.id_proveedor AS nit_proveedor,
    p.nombre_proveedor,

    -- Datos del usuario
    u.id AS id_usuario,
    u.nombre,
    u.apellidos_usuario,
    u.correo_usuario,
    u.id_cargo_fk

FROM orden_compra oc

INNER JOIN proveedor_compras p 
    ON oc.id_proveedor_fk = p.id_proveedor

INNER JOIN usuarios u
    ON oc.id_cotizante = u.id

WHERE oc.estado_orden = :estado OR oc.estado_orden ='Denegada'
ORDER BY oc.fecha_orden DESC;

        ");

            $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }


  /* ==============================
     CAMBIAR ESTADO DE ORDEN
  ============================== */
  static public function mdlCambiarEstadoOrden($tabla, $idOrden, $estado) {

    $stmt = Conexion::conectar()->prepare(
      "UPDATE $tabla 
       SET estado_orden = :estado 
       WHERE id_orden = :id"
    );

    $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
    $stmt->bindParam(":id", $idOrden, PDO::PARAM_INT);

    if ($stmt->execute()) {
      return "ok";
    } else {
      return "error";
    }

    $stmt = null;
  }
    /* ==============================
         CAMBIAR ESTADO DE ORDEN GERENCIA
        ============================== */
    static public function mdlCambiarEstadoOrdenGR($tabla, $idOrden, $estado, $fechaAprobacion, $id_gerente) {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla 
       SET estado_orden = :estado,
           fecha_aprobacion = :fecha_aprobacion,
           id_gerente = :id_gerente
       WHERE id_orden = :id"
        );

        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_aprobacion", $fechaAprobacion, PDO::PARAM_STR);
        $stmt->bindParam(":id_gerente", $id_gerente, PDO::PARAM_INT);
        $stmt->bindParam(":id", $idOrden, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

public static function mdlDenegarOrden($idOrden, $descripcion)
{
  $stmt = Conexion::conectar()->prepare("
    UPDATE orden_compra 
    SET estado_orden = 'Denegada',
        descripcion_declinado = :descripcion
    WHERE id_orden = :id
  ");

  $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
  $stmt->bindParam(":id", $idOrden, PDO::PARAM_INT);

  return $stmt->execute();
}


    /* =============================================
    CONTAR ORDEN POR USUARIO
    ============================================= */
    public static function contarOrdenPorUsuario($idUsuario)
    {
        // Obtener la conexión a la base de datos
        $db = Conexion::conectar();
        $stmt = "SELECT COUNT(id_orden) AS total_orden
                 FROM orden_compra
                 WHERE id_cotizante = :idUsuario 
                   AND (estado_orden = 'Proceso')";
        // Preparar la consulta
        $stmt = $db->prepare($stmt);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado como un array asociativo
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_orden'];
    }
}
