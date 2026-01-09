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
            recurso_tecnologico,
            id_categoriact_fk
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
            :recurso_tecnologico,
            :id_categoriact_fk
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
        $stmt->bindParam(":id_categoriact_fk", $datos["id_categoriact_fk"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            $arr = $stmt->errorInfo();
            return $arr[2];
        }

        $stmt = null;
    }



    /*=============================================
	CREAR ASIGNACIÓN DE RECURSOS TECNOLÓGICOS
	=============================================*/
    static public function mdlIngresarAsignacion($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (
            fecha_asignacion,
            estado_asignacion,
            id_ti_fk,
            id_usuario_fk
        ) VALUES (
            :fecha_asignacion,
            :estado_asignacion,
            :id_ti_fk,
            :id_usuario_fk
          
        )");


        $stmt->bindParam(":fecha_asignacion", $datos["fecha_asignacion"], PDO::PARAM_STR);
        $stmt->bindParam(":estado_asignacion", $datos["estado_asignacion"], PDO::PARAM_STR);
        $stmt->bindParam(":id_ti_fk", $datos["id_ti_fk"], PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario_fk", $datos["id_usuario_fk"], PDO::PARAM_INT);


        if ($stmt->execute()) {
            return "ok";
        } else {
            $arr = $stmt->errorInfo();
            return $arr[2];
        }

        $stmt = null;
    }

    static public function mdlActualizarEstadoAsignaciones($tabla, $id_usuario_fk)
{
    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado_asignacion = 'Inactiva' WHERE id_usuario_fk = :id_usuario_fk AND estado_asignacion = 'Activa'");

    $stmt->bindParam(":id_usuario_fk", $id_usuario_fk, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return "ok";
    } else {
        return "error";
    }

    $stmt = null;
}

  /*=============================================
	CREAR DETALLES DE EQUIPOS DE COMPUTO
	=============================================*/

    static public function mdlIngresarDetallesEquipo($tabla, $datos)
{
    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (
        msd,
        antivirus,
        visio_pro,
        mac_osx,
        windows,
        autocad,
        office,
        appolo,
        zeus,
        otros,
        procesador,
        disco_duro,
        memoria_ram,
        cd_dvd,
        tarjeta_video,
        tarjeta_red,
        tipo_red,
        tiempo_bloqueo,
        usuario,
        clave,
        zfip,
        privilegios,
        observaciones_equipo,
        backup,
        dia_backup,
        realiza_backup,
        justificacion_backup,
        id_activo_fk
    ) VALUES (
        :msd,
        :antivirus,
        :visio_pro,
        :mac_osx,
        :windows,
        :autocad,
        :office,
        :appolo,
        :zeus,
        :otros,
        :procesador,
        :disco_duro,
        :memoria_ram,
        :cd_dvd,
        :tarjeta_video,
        :tarjeta_red,
        :tipo_red,
        :tiempo_bloqueo,
        :usuario,
        :clave,
        :zfip,
        :privilegios,
        :observaciones_equipo,
        :backup,
        :dia_backup,
        :realiza_backup,
        :justificacion_backup,
        :id_activo_fk
    )");

    $stmt->bindParam(":msd", $datos["msd"], PDO::PARAM_STR);
    $stmt->bindParam(":antivirus", $datos["antivirus"], PDO::PARAM_STR);
    $stmt->bindParam(":visio_pro", $datos["visio_pro"], PDO::PARAM_STR);
    $stmt->bindParam(":mac_osx", $datos["mac_osx"], PDO::PARAM_STR);
    $stmt->bindParam(":windows", $datos["windows"], PDO::PARAM_STR);
    $stmt->bindParam(":autocad", $datos["autocad"], PDO::PARAM_STR);
    $stmt->bindParam(":office", $datos["office"], PDO::PARAM_STR);
    $stmt->bindParam(":appolo", $datos["appolo"], PDO::PARAM_STR);
    $stmt->bindParam(":zeus", $datos["zeus"], PDO::PARAM_STR);
    $stmt->bindParam(":otros", $datos["otros"], PDO::PARAM_STR);
    $stmt->bindParam(":procesador", $datos["procesador"], PDO::PARAM_STR);
    $stmt->bindParam(":disco_duro", $datos["disco_duro"], PDO::PARAM_STR);
    $stmt->bindParam(":memoria_ram", $datos["memoria_ram"], PDO::PARAM_STR);
    $stmt->bindParam(":cd_dvd", $datos["cd_dvd"], PDO::PARAM_STR);
    $stmt->bindParam(":tarjeta_video", $datos["tarjeta_video"], PDO::PARAM_STR);
    $stmt->bindParam(":tarjeta_red", $datos["tarjeta_red"], PDO::PARAM_STR);
    $stmt->bindParam(":tipo_red", $datos["tipo_red"], PDO::PARAM_STR);
    $stmt->bindParam(":tiempo_bloqueo", $datos["tiempo_bloqueo"], PDO::PARAM_STR);
    $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":clave", $datos["clave"], PDO::PARAM_STR);
    $stmt->bindParam(":zfip", $datos["zfip"], PDO::PARAM_STR);
    $stmt->bindParam(":privilegios", $datos["privilegios"], PDO::PARAM_STR);
    $stmt->bindParam(":observaciones_equipo", $datos["observaciones_equipo"], PDO::PARAM_STR);
    $stmt->bindParam(":backup", $datos["backup"], PDO::PARAM_STR);
    $stmt->bindParam(":dia_backup", $datos["dia_backup"], PDO::PARAM_STR);
    $stmt->bindParam(":realiza_backup", $datos["realiza_backup"], PDO::PARAM_STR);
    $stmt->bindParam(":justificacion_backup", $datos["justificacion_backup"], PDO::PARAM_STR);
    $stmt->bindParam(":id_activo_fk", $datos["id_activo_fk"], PDO::PARAM_INT);

    if ($stmt->execute()) {
        return "ok";
    } else {
        $arr = $stmt->errorInfo();
        return $arr[2]; // Retorna el error SQL si ocurre
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

        $stmt = Conexion::conectar()->prepare("SELECT a.*,p.id_proveedor, p.nombre_proveedor 
            FROM $tabla a
            INNER JOIN proveedor_compras p ON a.id_proveedor_fk = p.id_proveedor
            WHERE a.$item = :valor
        ");

        $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();

    } else {

        $stmt = Conexion::conectar()->prepare("SELECT a.*, p.id_proveedor,p.nombre_proveedor 
            FROM $tabla a
            INNER JOIN proveedor_compras p ON a.id_proveedor_fk = p.id_proveedor
        ");

        $stmt->execute();
        return $stmt->fetchAll();
    }
}


    /*=============================================
	MOSTRAR ACTIVOS TECNOLOGICOS DIFERENTES A EQUIPOS DE COMPUTO
	=============================================*/
    static public function mdlMostrarActivosTI($tabla, $item, $valor)
    {

        // Verifica si se proporcionaron parámetros
        if ($item != null && $valor != null) {
            $stmt = Conexion::conectar()->prepare("SELECT a.*, c.nombre_categoriact
            FROM activos a
            INNER JOIN categorias_activos c ON a.id_categoriact_fk = c.id_categoriact
            WHERE a.$item = :valor 
            AND a.recurso_tecnologico = 'Si' 
            AND a.id_categoriact_fk NOT IN (1, 2, 12,14)
            AND a.estado_activo != 'Inactivo'");
            $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    /*=============================================
	MOSTRAR ACTIVOS TECNOLOGICOS SOLO EQUIPOS DE COMPUTO
	=============================================*/

    static public function mdlMostrarEquipos($tabla, $item, $valor)
    {
        if ($item != null && $valor != null) {
            $stmt = Conexion::conectar()->prepare("SELECT a.*, 
                                                          c.nombre_categoriact, 
                                                          u.nombre, 
                                                          u.apellidos_usuario 
                                                   FROM $tabla a
                                                   INNER JOIN categorias_activos c ON a.id_categoriact_fk = c.id_categoriact
                                                   LEFT JOIN detalles_equipos d ON a.id_activo = d.id_activo_fk
                                                   LEFT JOIN usuarios u ON a.id_usuario_fk = u.id
                                                   WHERE a.$item = :valor 
                                                   AND a.recurso_tecnologico = 'Si' 
                                                   AND a.id_categoriact_fk IN (1, 2, 12) 
                                                   AND a.estado_activo != 'Inactivo'
                                                   ");
            $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT a.*, 
                                                          c.nombre_categoriact, 
                                                          u.nombre, 
                                                          u.apellidos_usuario 
                                                   FROM $tabla a
                                                   INNER JOIN categorias_activos c ON a.id_categoriact_fk = c.id_categoriact
                                                   LEFT JOIN detalles_equipos d ON a.id_activo = d.id_activo_fk
                                                   LEFT JOIN usuarios u ON a.id_usuario_fk = u.id
                                                   WHERE a.recurso_tecnologico = 'Si' 
                                                   AND a.id_categoriact_fk IN (1, 2, 12) 
                                                   AND a.estado_activo != 'Inactivo'
                                                   AND d.id_detalle IS NULL");
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }



    /*=============================================
	MOSTRAR ASIGNACION DE EQUIPOS
	=============================================*/
    static public function mdlMostrarAsignaciones($tabla_asignacion, $item_asignacion, $valor_asignacion)
    {
        $pdo = Conexion::conectar();

        if ($item_asignacion != null && $valor_asignacion != null) {
            // Consulta cuando se envían parámetros específicos
            $stmt = $pdo->prepare("SELECT u.*, p.nombre_proceso, c.nombre_cargo, a.*
                FROM usuarios u
                INNER JOIN proceso p ON u.id_proceso_fk = p.id_proceso
                INNER JOIN cargos c ON u.id_cargo_fk = c.id_cargo
                INNER JOIN $tabla_asignacion a ON a.id_usuario_fk = u.id
                WHERE a.$item_asignacion = :valor
            ");
            $stmt->bindParam(":valor", $valor_asignacion, PDO::PARAM_STR);
        } else {
            // Consulta cuando no se envían parámetros (usuarios sin asignación)
            $stmt = $pdo->prepare("SELECT u.*, p.nombre_proceso, c.nombre_cargo
                FROM usuarios u
                INNER JOIN proceso p ON u.id_proceso_fk = p.id_proceso
                INNER JOIN cargos c ON u.id_cargo_fk = c.id_cargo
                LEFT JOIN $tabla_asignacion a ON u.id = a.id_usuario_fk
                WHERE a.id_usuario_fk IS NULL
                AND u.estado = '1'
            ");
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }

    
    
   /*=============================================
	MOSTRAR ACTIVOS TECNOLOGICOS DIFERENTES A EQUIPOS DE COMPUTO
	=============================================*/
    static public function mdlMostrarDetallesEquipos($tabla_detalles, $item_detalles, $valor_detalles)
    {
        $conexion = Conexion::conectar();
        
        $stmt = $conexion->prepare("SELECT a.*, d.*, u.*

                                    FROM activos a
                                    LEFT JOIN detalles_equipos d ON a.id_activo = d.id_activo_fk
                                    LEFT JOIN usuarios u ON a.id_usuario_fk = u.id
                                    WHERE a.id_usuario_fk = :valor
                                    AND a.id_categoriact_fk IN (1, 2, 12) 
                                    AND a.recurso_tecnologico = 'Si' 
                                    AND a.estado_activo != 'Inactivo'");
        
        $stmt->bindParam(":valor", $valor_detalles, PDO::PARAM_INT);
        
        $stmt->execute();
        return $stmt->fetchAll();
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
    public static function mdlMostrarActivosNoVerificados($tablaActivos, $tablaVerificaciones, $id_inventario)
    {
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
    public static function mdlMostrarCategoriarActivos($tablaCategorias)
    {
        $stmt = Conexion::conectar()->prepare("SELECT *
            FROM $tablaCategorias  ");

        $stmt->execute();
        return $stmt->fetchAll();
        $stmt = null;
    }
    
    public static function mdlMostrarActasPorEstado($tabla, $item, $valor, $estado)
{
    if ($item != null) {

        $stmt = Conexion::conectar()->prepare("SELECT 
                a.id_acta,
                a.fecha_acta,
                a.tipo_acta,
                a.observaciones_acta,
                a.estado_aprobacion,
                a.fecha_aprobacion,

                -- Datos usuario origen
                CONCAT(uo.nombre, ' ', uo.apellidos_usuario) AS usuario_origen,
                uo.foto AS firma_origen,
                vo.cedula_administrativa AS cedula_origen,
                po.id_proceso AS id_proceso_origen,
                po.siglas_proceso AS siglas_proceso_origen,
                po.nombre_proceso AS nombre_proceso_origen,
                po.centro_costos AS centro_costos_origen,

                -- Datos usuario destino
                CONCAT(ud.nombre, ' ', ud.apellidos_usuario) AS usuario_destino,
                ud.foto AS firma_destino,
                vd.cedula_administrativa AS cedula_destino,
                pd.id_proceso AS id_proceso_destino,
                pd.siglas_proceso AS siglas_proceso_destino,
                pd.nombre_proceso AS nombre_proceso_destino,
                pd.centro_costos AS centro_costos_destino

            FROM {$tabla} a
            LEFT JOIN usuarios uo ON a.usuario_origen = uo.id
            LEFT JOIN usuarios ud ON a.usuario_destino = ud.id

            -- Relación con procesos
            LEFT JOIN proceso po ON uo.id_proceso_fk = po.id_proceso
            LEFT JOIN proceso pd ON ud.id_proceso_fk = pd.id_proceso

            -- Relación con vacaciones (para obtener la cédula)
            LEFT JOIN vacaciones vo ON vo.nombre_administrativa = uo.id
            LEFT JOIN vacaciones vd ON vd.nombre_administrativa = ud.id
            WHERE a.$item = :valor
            AND a.estado_aprobacion = :estado
            ORDER BY a.fecha_acta DESC
        ");
    

        $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);

    } 

    $stmt->execute();
    return $stmt->fetchAll();
    $stmt = null;
}

public static function mdlAprobarActa($tabla, $datos)
{
    $stmt = Conexion::conectar()->prepare("UPDATE $tabla 
        SET 
            estado_aprobacion = :estado_aprobacion,
            fecha_aprobacion = :fecha_aprobacion
        WHERE id_acta = :id_acta
    ");

    $stmt->bindParam(":estado_aprobacion", $datos["estado_aprobacion"], PDO::PARAM_STR);
    $stmt->bindParam(":fecha_aprobacion", $datos["fecha_aprobacion"], PDO::PARAM_STR);
    $stmt->bindParam(":id_acta", $datos["id_acta"], PDO::PARAM_INT);

    if ($stmt->execute()) {
        return "ok";
    } else {
        return "error";
    }

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


public static function mdlCrearActa($datos) {
    try {
        $pdo = Conexion::conectar();

        $stmt = $pdo->prepare("
            INSERT INTO acta_activos (tipo_acta, usuario_origen, usuario_destino, observaciones_acta)
            VALUES (:tipo_acta, :usuario_origen, :usuario_destino, :observaciones)
        ");

        $stmt->bindParam(":tipo_acta", $datos["tipo_acta"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario_origen", $datos["usuario_origen"], PDO::PARAM_INT);
        $stmt->bindParam(":usuario_destino", $datos["usuario_destino"], PDO::PARAM_INT);
        $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            // ✅ Devolvemos el ID insertado
            return $pdo->lastInsertId();
        } else {
            $error = $stmt->errorInfo();
            return false;
        }
    } catch (Exception $e) {
        return false;
    } finally {
        $stmt = null;
        $pdo = null;
    }
}

    /*=============================================
	MOSTRAR Activos
	=============================================*/
static public function mdlMostrarActa($tabla, $item, $valor)
{
    try {
        $db = Conexion::conectar();

        // Query base: trae acta + datos completos de usuario origen/destino, procesos y cédulas desde vacaciones
        $baseSelect = "
            SELECT 
                a.id_acta,
                a.fecha_acta,
                a.tipo_acta,
                a.observaciones_acta,
                a.estado_aprobacion,
                a.fecha_aprobacion,

                -- Datos usuario origen
                CONCAT(uo.nombre, ' ', uo.apellidos_usuario) AS usuario_origen,
                uo.foto AS firma_origen,
                vo.cedula_administrativa AS cedula_origen,
                po.id_proceso AS id_proceso_origen,
                po.siglas_proceso AS siglas_proceso_origen,
                po.nombre_proceso AS nombre_proceso_origen,
                po.centro_costos AS centro_costos_origen,

                -- Datos usuario destino
                CONCAT(ud.nombre, ' ', ud.apellidos_usuario) AS usuario_destino,
                ud.foto AS firma_destino,
                vd.cedula_administrativa AS cedula_destino,
                pd.id_proceso AS id_proceso_destino,
                pd.siglas_proceso AS siglas_proceso_destino,
                pd.nombre_proceso AS nombre_proceso_destino,
                pd.centro_costos AS centro_costos_destino

            FROM {$tabla} a
            LEFT JOIN usuarios uo ON a.usuario_origen = uo.id
            LEFT JOIN usuarios ud ON a.usuario_destino = ud.id

            -- Relación con procesos
            LEFT JOIN proceso po ON uo.id_proceso_fk = po.id_proceso
            LEFT JOIN proceso pd ON ud.id_proceso_fk = pd.id_proceso

            -- Relación con vacaciones (para obtener la cédula)
            LEFT JOIN vacaciones vo ON vo.nombre_administrativa = uo.id
            LEFT JOIN vacaciones vd ON vd.nombre_administrativa = ud.id
        ";

        // Si nos pasan filtro
        if ($item != null && $valor != null) {

            // Caso específico: buscar actas donde el usuario es origen o destino
            if ($item === "id_usuario_fk") {
                $sql = $baseSelect . "
                    WHERE a.usuario_origen = :valor OR a.usuario_destino = :valor
                    ORDER BY a.fecha_acta DESC";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(":valor", $valor, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

            // Caso genérico: filtrar por la columna que nos pasan
            $sql = $baseSelect . "
                WHERE a.{$item} = :valor
                ORDER BY a.fecha_acta DESC";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(":valor", $valor, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Si no hay filtro, devolver todas las actas
        $sql = $baseSelect . " ORDER BY a.fecha_acta DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        // Loguear error y devolver array vacío
        error_log("mdlMostrarActa error: " . $e->getMessage());
        return [];
    } finally {
        // Liberar recursos
        if (isset($stmt)) { $stmt = null; }
        if (isset($db)) { $db = null; }
    }
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
        INSERT INTO historial_transferencias (id_activo_fk, id_acta_fk)
        VALUES (:id_activo, :id_acta_fk)
    ");

    $stmt->bindParam(":id_activo", $datos["id_activo"], PDO::PARAM_INT);
    $stmt->bindParam(":id_acta_fk", $datos["id_acta_fk"], PDO::PARAM_INT);

    if ($stmt->execute()) {
        return "ok";
    } else {
        return "error";
    }

    $stmt = null;
}

public static function mdlObtenerActivosPorActa($id_acta)
    {
        $stmt = Conexion::conectar()->prepare("
            SELECT 
                a.id_activo,
                a.cod_renta,
                a.nombre_articulo,
                a.marca_articulo,
                a.modelo_articulo,
                a.referencia_articulo,
                ht.id_activo_fk,
                ht.id_acta_fk
            FROM historial_transferencias ht
            INNER JOIN activos a ON ht.id_activo_fk = a.id_activo
            WHERE ht.id_acta_fk = :id_acta
        ");
        
        $stmt->bindParam(":id_acta", $id_acta, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /*=============================================
    ACTUALIZAR USUARIO DEL ACTIVO
    =============================================*/
    public static function mdlActualizarUsuarioActivo($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE activos
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

    public static function mdlActualizarEstadoActivo($datos) {
    $stmt = Conexion::conectar()->prepare("UPDATE activos SET estado_activo = :estado WHERE id_activo = :id_activo");
    $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
    $stmt->bindParam(":id_activo", $datos["id_activo"], PDO::PARAM_INT);
    return $stmt->execute();
}

    /*=============================================
    CONTAR ACTIVOS VERIFICADOS
    =============================================*/
    public static function contarActivosVerificados()
    {
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
    public static function contarTotalActivos()
    {
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


    // Contar activos por usuario
    public static function contarActivosPorUsuario($idUsuario)
    {
        // Obtener la conexión a la base de datos
        $db = Conexion::conectar();
        $stmt = "SELECT COUNT(id_activo) AS total_activos
                 FROM activos
                 WHERE id_usuario_fk = :idUsuario 
                   AND (estado_activo = 'Activo' OR estado_activo = 'Rentado')";
        // Preparar la consulta
        $stmt = $db->prepare($stmt);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado como un array asociativo
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_activos'];
    }

    // Contar activos inactivos por usuario
    public static function contarActivosInactivosPorUsuario($idUsuario)
    {
        // Obtener la conexión a la base de datos
        $db = Conexion::conectar();
        $stmt = "SELECT COUNT(id_activo) AS total_inactivos
                 FROM activos
                 WHERE id_usuario_fk = :idUsuario 
                   AND estado_activo = 'Inactivo'";
        // Preparar la consulta
        $stmt = $db->prepare($stmt);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado como un array asociativo
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_inactivos'];
    }

    public static function mdlContarActivosPorCategoria()
    {
        $stmt = Conexion::conectar()->prepare("SELECT c.nombre_categoriact AS categoria, COUNT(a.id_activo) AS total
            FROM activos a
            INNER JOIN categorias_activos c ON a.id_categoriact_fk = c.id_categoriact
            WHERE a.id_categoriact_fk IN (1, 2,3,4,5,6,7,8,9,10,11,12,13,15,16)
            AND (a.estado_activo = 'Activo' OR a.estado_activo = 'Rentado' OR a.estado_activo = 'En Almacenamiento')
            GROUP BY a.id_categoriact_fk
        ");
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
