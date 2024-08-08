<?php

require_once "conexion.php";

class ModeloActivos
{


    /*=============================================
	CREAR Activos
	=============================================*/
    static public function mdlIngresarActivos($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (
            cod_renta,
            nombre_articulo,
            descripcion_articulo,
            modelo_articulo,
            referencia_articulo,
            marca_articulo,
            tipo_articulo,
            lugar_articulo,
            observaciones_articulo,
            numero_factura,
            fecha_garantia,
            valor_articulo,
            condicion_articulo,
            id_proveedor_fk,
            descripcion_proveedor,
            id_usuario_fk,
            estado_activo,
            recurso_tecnologico
        ) VALUES (
            :cod_renta,
            :nombre_articulo,
            :descripcion_articulo,
            :modelo_articulo,
            :referencia_articulo,
            :marca_articulo,
            :tipo_articulo,
            :lugar_articulo,
            :observaciones_articulo,
            :numero_factura,
            :fecha_garantia,
            :valor_articulo,
            :condicion_articulo,
            :id_proveedor_fk,
            :descripcion_proveedor,
            :id_usuario_fk,
            :estado_activo,
            :recurso_tecnologico
        )");


        $stmt->bindParam(":cod_renta", $datos["cod_renta"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_articulo", $datos["nombre_articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion_articulo", $datos["descripcion_articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":modelo_articulo", $datos["modelo_articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":referencia_articulo", $datos["referencia_articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":marca_articulo", $datos["marca_articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_articulo", $datos["tipo_articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":lugar_articulo", $datos["lugar_articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones_articulo", $datos["observaciones_articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":numero_factura", $datos["numero_factura"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_garantia", $datos["fecha_garantia"], PDO::PARAM_STR);
        $stmt->bindParam(":valor_articulo", $datos["valor_articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":condicion_articulo", $datos["condicion_articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_proveedor_fk", $datos["id_proveedor_fk"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion_proveedor", $datos["descripcion_proveedor"], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario_fk", $datos["id_usuario_fk"], PDO::PARAM_STR);
        $stmt->bindParam(":estado_activo", $datos["estado_activo"], PDO::PARAM_STR);
        $stmt->bindParam(":recurso_tecnologico", $datos["recurso_tecnologico"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            $arr = $stmt->errorInfo();
            return $arr[2];
        }

        $stmt = null;
    }
    /*=============================================
	MOSTRAR Activos
	=============================================*/
    static public function mdlMostrarActivos($tabla, $item, $valor)
    {

       // Verifica si se proporcionaron parámetros
       if ($item != null && $valor != null) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :valor");
        $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
        }else{
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt->execute();
        return $stmt->fetchAll();
        }

       
    }
    /*=============================================
	MOSTRAR Activos AJAX
	=============================================*/
    static public function mdlMostrarActivosAjax()
    {

        $stmt = Conexion::conectar()->prepare("SELECT id_activo 
													,nombre_articulo as text	
													 FROM activos
                                            ");

        $stmt->execute();

        $arr = $stmt->errorInfo();

        if ($arr[0] > 0) {
            $arr[3] = "ERROR";
            return $arr;
        } else {

            return $stmt->fetchAll();
        }

        $stmt = null;
    }
    /*=============================================
	MOSTRAR Activos
	=============================================*/
    static public function mdlMostrarActivosDTServerSide($valor)
    {

        //LIMITE DE REGISTROS
        $limit = "LIMIT " . $valor['start'] . "  ," . $valor['length'];


        //BUSQUEDA
        if (isset($valor['search'])) {
            $buscar = $valor['search']['value'];
            $busquedaGeneral = "and  ( 

                                                    id_activo
                                                    like '%" . $buscar . "%'	

                                                    or

                                                    cod_renta
                                                    like '%" . $buscar . "%'
                                                    or

                                                    nombre_articulo
                                                    like '%" . $buscar . "%'
                                                    or

                                                    id_proveedor
                                                    like '%" . $buscar . "%'
                                                    or

                                                    estado_activo
                                                    like '%" . $buscar . "%'
							)

									";
        } else {
            $busquedaGeneral = "";
        }


        //COMO VA SER ORDENADO
        $col = array(
            0   =>  '1',
            1   =>  '5',
            2   =>  '3',
            3   =>  '4',
            4   =>  '2',
            5   =>  '6',
            6   =>  '8',
            7   =>  '10',
            8   =>  '1',
        );

        $orderBy = " ORDER BY " . $col[$valor['order'][0]['column']] . "   " . $valor['order'][0]['dir'];

        $stmt = Conexion::conectar()->prepare("SELECT * 
                                                FROM activos
                                                where 1=1
                                                $busquedaGeneral
                                                $orderBy   
                                                $limit
											");

        $stmt->execute();

        return $stmt->fetchAll();



        $stmt = null;
    }
    /*=============================================
	MOSTRAR PRODUCTOS NUMERO DE REGISTROS
	=============================================*/
    static public function mdlMostrarNumRegistros($valor)
    {

        $stmt = Conexion::conectar()->prepare("SELECT count(id_activo) as contador FROM activos ");

        $stmt->execute();

        return $stmt->fetch();

        $stmt = null;
    }
     /*=============================================
	MOSTRAR ACTIVOS FIJOS NO VERIFICADOS
	=============================================*/
    public static function mdlMostrarActivosNoVerificados($tablaActivos, $tablaVerificaciones, $id_inventario) {
        $stmt = Conexion::conectar()->prepare("
            SELECT a.*
            FROM $tablaActivos a
            LEFT JOIN $tablaVerificaciones v ON a.id_activo = v.id_activo_fk AND v.id_inventario_fk = :id_inventario
            WHERE v.id_activo_fk IS NULL
        ");
        $stmt->bindParam(":id_inventario", $id_inventario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt = null;
    }
    /*=============================================
	EDITAR Activos
	=============================================*/
    static public function mdlEditarActivos($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
            cod_renta = :cod_renta,
            fecha_asignacion = :fecha_asignacion,
            nombre_articulo = :nombre_articulo,
            descripcion_articulo = :descripcion_articulo,
            modelo_articulo = :modelo_articulo,
            referencia_articulo = :referencia_articulo,
            marca_articulo = :marca_articulo,
            tipo_articulo = :tipo_articulo,
            ip = :ip,
            windows = :windows,
            office = :office,
            factura_office = :factura_office,
            lugar_articulo = :lugar_articulo,
            observaciones_articulo = :observaciones_articulo,
            numero_factura = :numero_factura,
            fecha_garantia = :fecha_garantia,
            valor_articulo = :valor_articulo,
            condicion_articulo = :condicion_articulo,
            id_proveedor_fk = :id_proveedor_fk,
            descripcion_proveedor = :descripcion_proveedor,
            id_usuario_fk = :id_usuario_fk,
            estado_activo = :estado_activo,
            recurso_tecnologico = :recurso_tecnologico
        WHERE id_activo = :id_activo");

        $stmt->bindParam(":id_activo", $datos["id_activo"], PDO::PARAM_INT);
        $stmt->bindParam(":cod_renta", $datos["cod_renta"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_asignacion", $datos["fecha_asignacion"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_articulo", $datos["nombre_articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion_articulo", $datos["descripcion_articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":modelo_articulo", $datos["modelo_articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":referencia_articulo", $datos["referencia_articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":marca_articulo", $datos["marca_articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_articulo", $datos["tipo_articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":ip", $datos["ip"], PDO::PARAM_STR);
        $stmt->bindParam(":windows", $datos["windows"], PDO::PARAM_STR);
        $stmt->bindParam(":office", $datos["office"], PDO::PARAM_STR);
        $stmt->bindParam(":factura_office", $datos["factura_office"], PDO::PARAM_STR);
        $stmt->bindParam(":lugar_articulo", $datos["lugar_articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones_articulo", $datos["observaciones_articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":numero_factura", $datos["numero_factura"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_garantia", $datos["fecha_garantia"], PDO::PARAM_STR);
        $stmt->bindParam(":valor_articulo", $datos["valor_articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":condicion_articulo", $datos["condicion_articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_proveedor_fk", $datos["id_proveedor_fk"], PDO::PARAM_INT);
        $stmt->bindParam(":descripcion_proveedor", $datos["descripcion_proveedor"], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario_fk", $datos["id_usuario_fk"], PDO::PARAM_INT);
        $stmt->bindParam(":estado_activo", $datos["estado_activo"], PDO::PARAM_STR);
        $stmt->bindParam(":recurso_tecnologico", $datos["recurso_tecnologico"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }
    /*=============================================
	ELIMINAR Activos
	=============================================*/

    static public function mdlEliminarActivos($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_activo = :id_activo");
        $stmt->bindParam(":id_activo", $datos, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }

        $stmt = null;
    }
    /*=============================================
	ACTUALIZAR Activos
	=============================================*/

    static public function mdlActualizarActivos($tabla, $item1, $valor1, $valor)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id_activo = :id_activo");

        $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":id_activo", $valor, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }

        $stmt = null;
    }
    
  /*=============================================
    REGISTRAR TRANSFERENCIA DE ACTIVO
    =============================================*/
    public static function mdlRegistrarTransferencia($datos) {
        $stmt = Conexion::conectar()->prepare("
            INSERT INTO historial_transferencias (id_activo, id_usuario_origen, id_usuario_destino, fecha_transferencia, observaciones)
            VALUES (:id_activo, :id_usuario_origen, :id_usuario_destino, NOW(), :observaciones)
        ");

        $id_activo = $datos["id_activo"];
        $id_usuario_origen = $datos["usuario_origen"];
        $id_usuario_destino = $datos["usuario_destino"];
        $observaciones = $datos["observaciones"];

        $stmt->bindParam(":id_activo", $id_activo, PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario_origen", $id_usuario_origen, PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario_destino", $id_usuario_destino, PDO::PARAM_INT);
        $stmt->bindParam(":observaciones", $observaciones, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            $arr = $stmt->errorInfo();
            return $arr[2];
        }

        $stmt = null;
    }

    /*=============================================
    ACTUALIZAR USUARIO DEL ACTIVO
    =============================================*/
    public static function mdlActualizarUsuarioActivo($datos) {
        $stmt = Conexion::conectar()->prepare("
            UPDATE activos
            SET id_usuario_fk = :id_usuario_destino
            WHERE id_activo = :id_activo
        ");

        $id_activo = $datos["id_activo"];
        $id_usuario_destino = $datos["usuario_destino"];

        $stmt->bindParam(":id_activo", $id_activo, PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario_destino", $id_usuario_destino, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            $arr = $stmt->errorInfo();
            return $arr[2];
        }

        $stmt = null;
    }

    /*=============================================
    CONTAR ACTIVOS VERIFICADOS
    =============================================*/
    public static function contarActivosVerificados() {
        // Obtener la conexión a la base de datos
        $db = Conexion::conectar();
    
        // Consulta SQL para contar los activos verificados en el inventario abierto
        $sql = "SELECT COUNT(id_verificacion) AS verificados
                FROM verificaciones
                WHERE id_inventario_fk = (SELECT id_inventario FROM inventario WHERE estado_inventario = 'Abierto')";
    
        // Preparar la consulta
        $stmt = $db->prepare($sql);
    
        // Ejecutar la consulta
        $stmt->execute();
    
        // Obtener el resultado como un array asociativo
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Retornar el número de verificaciones encontradas
        return $row['verificados'];
    }
     /*=============================================
    CONTAR TODOS LOS ACTIVOS
    =============================================*/
    public static function contarTotalActivos() {
         // Obtener la conexión a la base de datos
         $db = Conexion::conectar();
        $stmt = "SELECT COUNT(id_activo) AS total_activos
                FROM activos
                WHERE estado_activo='Activo' OR estado_activo='Rentado'";
        // Preparar la consulta
        $stmt = $db->prepare($stmt);
        // Ejecutar la consulta
        $stmt->execute();
        // Obtener el resultado como un array asociativo
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_activos'];
    }

}
