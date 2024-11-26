<?php

require_once "conexion.php";


class ModeloMantenimiento
{

    public static function mdlIngresarMantenimiento($tabla, $datos)
    {
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();
            // Preparar la consulta de inserción
            $stmt = $pdo->prepare("INSERT INTO $tabla (
                fecha_mantenimiento, 
                id_usuario_fk, 
                marca, 
                modelo, 
                serie,
                usuario_equipo,
                soplar_partes_externas,
                lubricar_puertos,
                limpieza_equipo,
                limpiar_partes_interna,
                verificar_usuario,
                contra,
                formato_asignacion_equipo,
                depurar_temporales,
                liberar_espacio,
                desinstalar_programas,
                actualizar_logos,
                verificar_actualizaciones,
                desfragmentar,
                usuario,
                clave,
                estandar,
                administrador,
                analisis_completo,
                bloqueo_usb,
                dominio_zfip,
                apagar_pantalla,
                estado_suspension,
                firma,
                estado_mantenimiento_equipo

            ) VALUES (
                :fecha_mantenimiento, 
                :id_usuario_fk, 
                :marca, 
                :modelo, 
                :serie,
                :usuario_equipo,
                :soplar_partes_externas,
                :lubricar_puertos,
                :limpieza_equipo,
                :limpiar_partes_interna,
                :verificar_usuario,
                :contra,
                :formato_asignacion_equipo,
                :depurar_temporales,
                :liberar_espacio,
                :desinstalar_programas,
                :actualizar_logos,
                :verificar_actualizaciones,
                :desfragmentar,
                :usuario,
                :clave,
                :estandar,
                :administrador,
                :analisis_completo,
                :bloqueo_usb,
                :dominio_zfip,
                :apagar_pantalla,
                :estado_suspension,
                :firma,
                :estado_mantenimiento_equipo


            )");

            $stmt->bindParam(":fecha_mantenimiento", $datos["fecha_mantenimiento"], PDO::PARAM_STR);
            $stmt->bindParam(":id_usuario_fk", $datos["id_usuario_fk"], PDO::PARAM_INT);
            $stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
            $stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
            $stmt->bindParam(":serie", $datos["serie"], PDO::PARAM_STR);
            $stmt->bindParam(":usuario_equipo", $datos["usuario_equipo"], PDO::PARAM_STR);
            $stmt->bindParam(":soplar_partes_externas", $datos["soplar_partes_externas"], PDO::PARAM_STR);
            $stmt->bindParam(":lubricar_puertos", $datos["lubricar_puertos"], PDO::PARAM_STR);
            $stmt->bindParam(":limpieza_equipo", $datos["limpieza_equipo"], PDO::PARAM_STR);
            $stmt->bindParam(":limpiar_partes_interna", $datos["limpiar_partes_interna"], PDO::PARAM_STR);
            $stmt->bindParam(":verificar_usuario", $datos["verificar_usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":contra", $datos["contra"], PDO::PARAM_STR);
            $stmt->bindParam(":formato_asignacion_equipo", $datos["formato_asignacion_equipo"], PDO::PARAM_STR);
            $stmt->bindParam(":depurar_temporales", $datos["depurar_temporales"], PDO::PARAM_STR);
            $stmt->bindParam(":liberar_espacio", $datos["liberar_espacio"], PDO::PARAM_STR);
            $stmt->bindParam(":desinstalar_programas", $datos["desinstalar_programas"], PDO::PARAM_STR);
            $stmt->bindParam(":actualizar_logos", $datos["actualizar_logos"], PDO::PARAM_STR);
            $stmt->bindParam(":verificar_actualizaciones", $datos["verificar_actualizaciones"], PDO::PARAM_STR);
            $stmt->bindParam(":desfragmentar", $datos["desfragmentar"], PDO::PARAM_STR);
            $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":clave", $datos["clave"], PDO::PARAM_STR);
            $stmt->bindParam(":estandar", $datos["estandar"], PDO::PARAM_STR);
            $stmt->bindParam(":administrador", $datos["administrador"], PDO::PARAM_STR);
            $stmt->bindParam(":analisis_completo", $datos["analisis_completo"], PDO::PARAM_STR);
            $stmt->bindParam(":bloqueo_usb", $datos["bloqueo_usb"], PDO::PARAM_STR);
            $stmt->bindParam(":dominio_zfip", $datos["dominio_zfip"], PDO::PARAM_STR);
            $stmt->bindParam(":apagar_pantalla", $datos["apagar_pantalla"], PDO::PARAM_STR);
            $stmt->bindParam(":estado_suspension", $datos["estado_suspension"], PDO::PARAM_STR);
            $stmt->bindParam(":firma", $datos["firma"], PDO::PARAM_STR);
            $stmt->bindParam(":estado_mantenimiento_equipo", $datos["estado_mantenimiento_equipo"], PDO::PARAM_STR);


            if ($stmt->execute()) {

                return "ok";
            } else {

                return "error";
            }
        } catch (PDOException $e) {
            // Manejar errores
            return "error: " . $e->getMessage();
        }
    }

    public static function mdlIngresarMantenimientoImpresora($tabla, $datos)
    {
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();
            // Preparar la consulta de inserción
            $stmt = $pdo->prepare("INSERT INTO $tabla (
                fecha_mantenimiento_impresora, 
                id_usuario_fk2, 
                nombre_impresora, 
                marca_impresora, 
                modelo_impresora, 
                serial_impresora, 
                soplar_exterior, 
                isopropilico, 
                toner, 
                alinear, 
                verificar_cableado, 
                rodillos, 
                reemplazar, 
                limpiar, 
                imprimir, 
                verificar, 
                estado_mantenimiento_impresora, 
                firma_impresora
                

            ) VALUES (
                :fecha_mantenimiento_impresora,
                :id_usuario_fk2,
                :nombre_impresora,
                :marca_impresora, 
                :modelo_impresora, 
                :serial_impresora, 
                :soplar_exterior, 
                :isopropilico, 
                :toner, 
                :alinear, 
                :verificar_cableado, 
                :rodillos, 
                :reemplazar, 
                :limpiar, 
                :imprimir, 
                :verificar, 
                :estado_mantenimiento_impresora, 
                :firma_impresora 
                


            )");

            $stmt->bindParam(":fecha_mantenimiento_impresora", $datos["fecha_mantenimiento_impresora"], PDO::PARAM_STR);
            $stmt->bindParam(":id_usuario_fk2", $datos["id_usuario_fk2"], PDO::PARAM_INT);
            $stmt->bindParam(":nombre_impresora", $datos["nombre_impresora"], PDO::PARAM_STR);
            $stmt->bindParam(":marca_impresora", $datos["marca_impresora"], PDO::PARAM_STR);
            $stmt->bindParam(":modelo_impresora", $datos["modelo_impresora"], PDO::PARAM_STR);
            $stmt->bindParam(":serial_impresora", $datos["serial_impresora"], PDO::PARAM_STR);
            $stmt->bindParam(":soplar_exterior", $datos["soplar_exterior"], PDO::PARAM_STR);
            $stmt->bindParam(":isopropilico", $datos["isopropilico"], PDO::PARAM_STR);
            $stmt->bindParam(":toner", $datos["toner"], PDO::PARAM_STR);
            $stmt->bindParam(":alinear", $datos["alinear"], PDO::PARAM_STR);
            $stmt->bindParam(":verificar_cableado", $datos["verificar_cableado"], PDO::PARAM_STR);
            $stmt->bindParam(":rodillos", $datos["rodillos"], PDO::PARAM_STR);
            $stmt->bindParam(":reemplazar", $datos["reemplazar"], PDO::PARAM_STR);
            $stmt->bindParam(":limpiar", $datos["limpiar"], PDO::PARAM_STR);
            $stmt->bindParam(":imprimir", $datos["imprimir"], PDO::PARAM_STR);
            $stmt->bindParam(":verificar", $datos["verificar"], PDO::PARAM_STR);
            $stmt->bindParam(":estado_mantenimiento_impresora", $datos["estado_mantenimiento_impresora"], PDO::PARAM_STR);
            $stmt->bindParam(":firma_impresora", $datos["firma_impresora"], PDO::PARAM_STR);

            if ($stmt->execute()) {

                return "ok";
            } else {

                return "error";
            }
        } catch (PDOException $e) {
            // Manejar errores
            return "error: " . $e->getMessage();
        }
    }

    public static function mdlIngresarMantenimientoGeneral($tabla, $datos)
    {
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();
            // Preparar la consulta de inserción
            $stmt = $pdo->prepare("INSERT INTO $tabla (
                fecha_mantenimiento3, 
                id_usuario_fk3, 
                articulo, 
                marca_general, 
                modelo_general, 
                serial_general, 
                partes_externas, 
                condiciones_fisicas, 
                cableado_verificar, 
                dispositivo, 
                estado_general, 
                firma_general
                

            ) VALUES (
                :fecha_mantenimiento3, 
                :id_usuario_fk3, 
                :articulo, 
                :marca_general, 
                :modelo_general, 
                :serial_general, 
                :partes_externas, 
                :condiciones_fisicas, 
                :cableado_verificar, 
                :dispositivo, 
                :estado_general, 
                :firma_general 
                
            )");

            $stmt->bindParam(":fecha_mantenimiento3", $datos["fecha_mantenimiento3"], PDO::PARAM_STR);
            $stmt->bindParam(":id_usuario_fk3", $datos["id_usuario_fk3"], PDO::PARAM_INT);
            $stmt->bindParam(":articulo", $datos["articulo"], PDO::PARAM_STR);
            $stmt->bindParam(":marca_general", $datos["marca_general"], PDO::PARAM_STR);
            $stmt->bindParam(":modelo_general", $datos["modelo_general"], PDO::PARAM_STR);
            $stmt->bindParam(":serial_general", $datos["serial_general"], PDO::PARAM_STR);
            $stmt->bindParam(":partes_externas", $datos["partes_externas"], PDO::PARAM_STR);
            $stmt->bindParam(":condiciones_fisicas", $datos["condiciones_fisicas"], PDO::PARAM_STR);
            $stmt->bindParam(":cableado_verificar", $datos["cableado_verificar"], PDO::PARAM_STR);
            $stmt->bindParam(":dispositivo", $datos["dispositivo"], PDO::PARAM_STR);
            $stmt->bindParam(":estado_general", $datos["estado_general"], PDO::PARAM_STR);
            $stmt->bindParam(":firma_general", $datos["firma_general"], PDO::PARAM_STR);




            if ($stmt->execute()) {

                return "ok";
            } else {

                return "error";
            }
        } catch (PDOException $e) {
            // Manejar errores
            return "error: " . $e->getMessage();
        }
    }

    /*=============================================
	MOSTRAR Mantenimientos
	=============================================*/

    public static function mdlMostrarMantenimiento($tabla, $item, $valor, $consulta)
    {
        switch ($consulta) {
            case 'equipo':
                // Consulta con filtro
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
                $stmt->execute();
                return $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
                $stmt = null;
                break;

            default:
                $consulta = null;
                $item = null;
                $valor = null;
                break;
        }
    }
    public static function mdlMostrarMantenimientopdf($tabla, $item, $valor, $consulta)
    {
        switch ($consulta) {
            case 'mantenimientos':
                // Consulta con filtro
                $stmt = Conexion::conectar()->prepare("SELECT m.*, p.nombre_proceso, u.*, c.nombre_cargo
                FROM usuarios m
                INNER JOIN proceso p ON m.id_proceso_fk = p.id_proceso
                INNER JOIN mantenimientos u ON m.id = u.id_usuario_fk
                INNER JOIN cargos c ON m.id_cargo_fk = c.id_cargo WHERE $item = :valor");
                $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
                $stmt = null;
                break;

            default:
                $consulta = null;
                $item = null;
                $valor = null;
                break;
        }
    }


    public static function mdlMostrarMantenimientoImpresora($tabla, $item, $valor, $consulta)
    {
        switch ($consulta) {
            case 'mantenimiento_impresora':
                // Consulta con filtro
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :valor");
                $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
                $stmt = null;
                break;

            default:
                $consulta = null;
                $item = null;
                $valor = null;
                break;
        }
    }

    public static function mdlMostrarMantenimientoImpresorapdf($tabla, $item, $valor, $consulta)
    {
        switch ($consulta) {
            case 'mantenimiento_impresora':
                // Consulta con filtro
                $stmt = Conexion::conectar()->prepare("SELECT m.*, p.nombre_proceso, u.*, c.nombre_cargo
                FROM usuarios m
                INNER JOIN proceso p ON m.id_proceso_fk = p.id_proceso
                INNER JOIN mantenimiento_impresora u ON m.id = u.id_usuario_fk2
                INNER JOIN cargos c ON m.id_cargo_fk = c.id_cargo WHERE $item = :valor");
                $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
                $stmt = null;
                break;

            default:
                $consulta = null;
                $item = null;
                $valor = null;
                break;
        }
    }
    public static function mdlMostrarMantenimientoGeneral($tabla, $item, $valor, $consulta)
    {
        switch ($consulta) {
            case 'mantenimiento_general':
                // Consulta con filtro
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :valor");
                $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
                $stmt = null;
                break;

            default:
                $consulta = null;
                $item = null;
                $valor = null;
                break;
        }
    }

    public static function mdlMostrarMantenimientoGeneralpdf($tabla, $item, $valor, $consulta)
    {
        switch ($consulta) {
            case 'mantenimiento_general':
                // Consulta con filtro
                $stmt = Conexion::conectar()->prepare("SELECT m.*, p.nombre_proceso, u.*, c.nombre_cargo
                FROM usuarios m
                INNER JOIN proceso p ON m.id_proceso_fk = p.id_proceso
                INNER JOIN mantenimiento_general u ON m.id = u.id_usuario_fk3
                INNER JOIN cargos c ON m.id_cargo_fk = c.id_cargo WHERE $item = :valor");
                $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
                $stmt = null;
                break;

            default:
                $consulta = null;
                $item = null;
                $valor = null;
                break;
        }
    }


    public static function mdlFirmarMantenimiento($tabla, $datos)
    {
        // Crear la consulta SQL de actualización
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla 
            SET 
                firma = :firma, 
                estado_mantenimiento_equipo = :estado_mantenimiento_equipo 
            WHERE id_mantenimiento = :id_mantenimiento"); // Usamos id_mantenimiento
    
        // Vincular los parámetros a la consulta
        $stmt->bindParam(":firma", $datos["firma"], PDO::PARAM_STR);
        $stmt->bindParam(":estado_mantenimiento_equipo", $datos["estado_mantenimiento_equipo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_mantenimiento", $datos["id_mantenimiento"], PDO::PARAM_INT); // Usamos id_mantenimiento
    
        // Ejecutar la consulta
        if ($stmt->execute()) {
            return "ok"; // Si la actualización es exitosa
        } else {
            return "error"; // Si ocurre un error
        }
    
        // Cerrar la conexión
        $stmt->close();
        $stmt = null;
    }
    
    
}
