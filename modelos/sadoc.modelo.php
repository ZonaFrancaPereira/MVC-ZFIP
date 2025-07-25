<?php

require_once "conexion.php";

class ModeloSadoc
{
    /*=============================================
    REGISTRO DE archivos
    =============================================*/
    static public function mdlIngresarArchivo($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO sadoc (codigo,nombre_sadoc,ruta, fecha_subida, estado, id_cs_fk) VALUES (:codigo,:nombre_sadoc, :ruta, :fecha, :estado, :id_cs_fk)");

        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_sadoc", $datos["nombre_sadoc"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":id_cs_fk", $datos["id_cs_fk"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            echo "<pre>Error SQL: " . print_r($stmt->errorInfo(), true) . "</pre>";
            return "error";
        }

        $stmt = null;
    }
    static public function mdlActualizarArchivo($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla 
             SET codigo = :codigo, 
                 nombre_sadoc = :nombre_sadoc, 
                 ruta = :ruta, 
                 fecha_subida = :fecha 
             WHERE id_sadoc = :id"
        );

        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_sadoc", $datos["nombre_sadoc"], PDO::PARAM_STR);
        $stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        return $stmt->execute() ? "ok" : "error";
    }

    static public function mdlObtenerArchivoPorId($tabla, $id)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_sadoc = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }
    /*=============================================
ELIMINAR ARCHIVO
=============================================*/
    static public function mdlEliminarArchivo($tabla, $id)
    {
        // Primero obtenemos la ruta del archivo para eliminarlo del sistema
        $stmt = Conexion::conectar()->prepare("SELECT ruta FROM $tabla WHERE id_sadoc = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $archivo = $stmt->fetch();

        if ($archivo && file_exists($archivo["ruta"])) {
            unlink($archivo["ruta"]); // Elimina el archivo físico
        }

        // Luego eliminamos el registro en la base de datos
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_sadoc = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute() ? "ok" : "error";
    }

    /*=============================================
    ASIGNAR CATEGORIAS A LOS ARCHIVOS
    =============================================*/

    static public function mdlAsignarCategorias($tabla, $datos)
    {
        try {
            // Conectar a la base de datos
            $pdo = Conexion::conectar();

            // Consulta SQL para insertar cada proceso con su categoría
            $stmt = $pdo->prepare("INSERT INTO $tabla (
                id_categoria_fk,
                id_proceso_fk,
                estado_detalle
            ) VALUES (
                :id_categoria_fk,
                :id_proceso_fk,
                :estado_detalle
            )");

            // Vinculamos los parámetros
            $stmt->bindParam(":id_categoria_fk", $datos["id_categoria_fk"], PDO::PARAM_INT);
            $stmt->bindParam(":id_proceso_fk", $datos["id_proceso"], PDO::PARAM_INT);
            $stmt->bindParam(":estado_detalle", $datos["estado_detalle"], PDO::PARAM_STR);

            // Ejecutamos la consulta
            if ($stmt->execute()) {
                // Cerrar la consulta y liberar recursos
                $stmt->closeCursor();
                return "ok";
            } else {
                $error = $stmt->errorInfo();
                return "error: " . $error[2]; // Devuelve el error SQL
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage(); // Captura y muestra cualquier error de PDO
        }
    }


    /*=============================================
	MOSTRAR ARCHIVOS POR PROCESO
	=============================================*/
    static public function mdlObtenerArchivosPorProceso($id_proceso_fk)
    {
        try {
            if ($id_proceso_fk == 0) {
                // Traer todos los archivos activos sin filtrar por proceso
                $stmt = Conexion::conectar()->prepare('
                SELECT s.*
                FROM sadoc s
                INNER JOIN categoria_sadoc_detalle c ON s.id_cs_fk = c.id_cs_detalle
                WHERE s.estado = "activo"
            ');
            } else {
                // Filtrar por proceso específico
                $stmt = Conexion::conectar()->prepare('
                SELECT s.*
                FROM sadoc s
                INNER JOIN categoria_sadoc_detalle c ON s.id_cs_fk = c.id_cs_detalle
                WHERE c.id_proceso_fk = :id_proceso_fk AND s.estado = "activo"
            ');
                $stmt->bindParam(':id_proceso_fk', $id_proceso_fk, PDO::PARAM_INT);
            }

            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }
    /*=============================================
	MOSTRAR ARCHIVOS POR PROCESO Y CATEGORIA
	=============================================*/

    static public function mdlObtenerArchivosPorCategoria($id_proceso_fk, $idCategoria)
    {
        try {
            $stmt = Conexion::conectar()->prepare('
            SELECT s.*
            FROM sadoc s
            INNER JOIN categoria_sadoc_detalle c ON s.id_cs_fk = c.id_cs_detalle
            WHERE c.id_proceso_fk = :id_proceso_fk 
              AND c.id_categoria_fk = :id_categoria_fk
              AND s.estado = "Activo"
        ');
            $stmt->bindParam(':id_proceso_fk', $id_proceso_fk, PDO::PARAM_INT);
            $stmt->bindParam(':id_categoria_fk', $idCategoria, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }
    /*=============================================
	MOSTRAR ARCHIVOS POR PROCESO
	=============================================*/

    static public function mdlObtenerCategorias($tabla)
    {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }
    /*=============================================
	DE AQUI EN ADELANTE DE CREARAN LOS MODELOS DE CATEGORIAS SADOC
	=============================================*/
    static public function mdlIngresarCategoria($tabla, $datos)
    {
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();
            // Preparar la consulta de inserción
            $stmt = $pdo->prepare("INSERT INTO $tabla (
            nombre_categoria,
            descripcion_categoria,
            estado_categoria
        ) VALUES (
            :nombre_categoria,
            :descripcion_categoria,
            :estado_categoria
        )");

            // Vincular parámetros
            $stmt->bindParam(":nombre_categoria", $datos["nombre_categoria"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion_categoria", $datos["descripcion_categoria"], PDO::PARAM_STR);
            $stmt->bindParam(":estado_categoria", $datos["estado_categoria"], PDO::PARAM_STR);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Cerrar el cursor y liberar recursos
                $stmt->closeCursor();
                $stmt = null;
                // Devolver un array con el nombre de la categoría
                return "ok";
            } else {
                // Capturar y mostrar el error SQL
                $error = $stmt->errorInfo();
                return "error: " . $error[2];
            }
        } catch (PDOException $e) {
            // Manejar errores
            return "error: " . $e->getMessage();
        }
    }
    /*=============================================
	EDITAR CATEGORÍA
	=============================================*/
    static public function mdlEditarCategoria($tabla, $datos)
    {
        try {
            $pdo = Conexion::conectar();
            $stmt = $pdo->prepare("UPDATE $tabla SET nombre_categoria = :nombre_categoria, descripcion_categoria = :descripcion_categoria WHERE id_categoria = :id_categoria");

            $stmt->bindParam(":nombre_categoria", $datos["nombre_categoria"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion_categoria", $datos["descripcion_categoria"], PDO::PARAM_STR);
            $stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                $stmt->closeCursor();
                $stmt = null;
                return "ok";
            } else {
                $error = $stmt->errorInfo();
                return "error: " . $error[2];
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }
    /*=============================================
	MOSTRAR CATEGORIAS POR PROCESO
	=============================================*/
    static public function mdlObtenerDetalleCategorias($tabla, $id_proceso_fk)
    {
        if ($id_proceso_fk != null) {
            try {
                $stmt = Conexion::conectar()->prepare("SELECT d.id_cs_detalle, d.id_categoria_fk, d.id_proceso_fk, d.estado_detalle,
                       cat.nombre_categoria
                FROM $tabla AS d
                INNER JOIN categoria_sadoc AS cat ON d.id_categoria_fk = cat.id_categoria
                WHERE d.id_proceso_fk = :id_proceso_fk 
                  AND d.estado_detalle = 'Activo'
                ORDER BY cat.nombre_categoria ASC");
                $stmt->bindParam(':id_proceso_fk', $id_proceso_fk, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
            } catch (PDOException $e) {
                return [];
            }
        } else {

            try {
                $stmt = Conexion::conectar()->prepare("SELECT d.id_cs_detalle, d.id_categoria_fk, d.id_proceso_fk, d.estado_detalle,
                       cat.nombre_categoria,
                       p.nombre_proceso,
                       p.siglas_proceso
                FROM $tabla AS d
                INNER JOIN categoria_sadoc AS cat ON d.id_categoria_fk = cat.id_categoria
                INNER JOIN proceso AS p ON d.id_proceso_fk = p.id_proceso
                WHERE d.estado_detalle = 'Activo'
                ORDER BY cat.nombre_categoria ASC");

                $stmt->execute();
                return $stmt->fetchAll();
            } catch (PDOException $e) {
                return [];
            }
        }
    }
}
