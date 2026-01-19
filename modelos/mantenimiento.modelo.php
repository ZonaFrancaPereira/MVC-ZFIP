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
                id_activos_fk,
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
                cableada,
                wifi,
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
                :id_activos_fk,
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
                :cableada,
                :wifi,
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
            $stmt->bindParam(":id_activos_fk", $datos["id_activos_fk"], PDO::PARAM_INT);
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
            $stmt->bindParam(":cableada", $datos["cableada"], PDO::PARAM_STR);
            $stmt->bindParam(":wifi", $datos["wifi"], PDO::PARAM_STR);
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
                                case 'ti-impresora':
                                    $stmt = Conexion::conectar()->prepare("SELECT b.*, a.nombre, a.apellidos_usuario
                                    FROM mantenimiento_impresora b 
                                    INNER JOIN usuarios a ON b.id_usuario_fk2 = a.id");
                                    $stmt->execute();
                                    return $stmt->fetchAll();
                                    $stmt = null;
                                    break;
                                    case 'ti-general':
                                        $stmt = Conexion::conectar()->prepare("SELECT b.*, a.nombre, a.apellidos_usuario
                                        FROM mantenimiento_general b 
                                        INNER JOIN usuarios a ON b.id_usuario_fk3 = a.id");
                                        $stmt->execute();
                                        return $stmt->fetchAll();
                                        $stmt = null;
                                        break;

            default:
                $consulta = null;
                $item = null;
                $valor = null;
                break;
        }
    }

    public static function mdlMostrarMantenimientoEquipo($tabla, $item, $valor)
    {
        try {
            $id_usuario_mantenimiento = $_SESSION["id"];
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario_fk = :id_usuario");
            $stmt->bindParam(':id_usuario', $id_usuario_mantenimiento, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    public static function mdlMostrarMantenimientoGeneral($tabla, $item, $valor)
    {
        try {
            $id_usuario_mantenimiento = $_SESSION["id"];

            $stmt =  Conexion::conectar()->prepare("SELECT * FROM mantenimiento_general WHERE id_usuario_fk3 = :id_usuario");
            $stmt->bindParam(':id_usuario', $id_usuario_mantenimiento, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }


    public static function mdlMostrarMantenimientoImpresora($tabla, $item, $valor)
    {
        try {
            $id_usuario_mantenimiento = $_SESSION["id"];

            $stmt = Conexion::conectar()->prepare("SELECT * FROM mantenimiento_impresora WHERE id_usuario_fk2 = :id_usuario");
            $stmt->bindParam(':id_usuario', $id_usuario_mantenimiento, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    public static function mdlMostrarMantenimientoTi($tabla, $item, $valor)
    {
        try {
            // Preparar la consulta para seleccionar todos los datos de la tabla con LEFT JOIN
            $stmt = Conexion::conectar()->prepare("SELECT b.*, a.nombre, a.apellidos_usuario 
                                                   FROM $tabla b 
                                                   LEFT JOIN usuarios a ON b.id_usuario_fk = a.id");
            
            // Ejecutar la consulta
            $stmt->execute();
            
            // Retornar todos los resultados como un array asociativo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejar errores y retornar un array vacío
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }
    
    public static function mdlMostrarMantenimientoImpresoraTi($tabla, $item, $valor)
    {
        try {
            // Preparar la consulta para seleccionar todos los datos de la tabla con LEFT JOIN
            $stmt = Conexion::conectar()->prepare("SELECT b.*, a.nombre, a.apellidos_usuario 
                                                   FROM $tabla b 
                                                   LEFT JOIN usuarios a ON b.id_usuario_fk2 = a.id");
            
            // Ejecutar la consulta
            $stmt->execute();
            
            // Retornar todos los resultados como un array asociativo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejar errores y retornar un array vacío
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    public static function mdlMostrarMantenimientoGeneralTi($tabla, $item, $valor)
    {
        try {
            // Preparar la consulta para seleccionar todos los datos de la tabla con LEFT JOIN
            $stmt = Conexion::conectar()->prepare("SELECT b.*, a.nombre, a.apellidos_usuario 
                                                   FROM $tabla b 
                                                   LEFT JOIN usuarios a ON b.id_usuario_fk3 = a.id");
            
            // Ejecutar la consulta
            $stmt->execute();
            
            // Retornar todos los resultados como un array asociativo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejar errores y retornar un array vacío
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }


    public static function mdlMostrarMantenimientopdf($tabla, $item, $valor, $consulta)
    {
        switch ($consulta) {
            case 'mantenimientos':
                // Consulta con filtro
                $stmt = Conexion::conectar()->prepare("SELECT m.*, p.nombre_proceso, u.*, c.nombre_cargo, f.*,j.*
                FROM usuarios m
                INNER JOIN proceso p ON m.id_proceso_fk = p.id_proceso
                LEFT JOIN mantenimientos u ON m.id = u.id_usuario_fk
                LEFT JOIN activos f ON m.id = f.id_usuario_fk
                LEFT JOIN detalles_equipos j ON u.id_activos_fk = j.id_activo_fk
                LEFT JOIN cargos c ON m.id_cargo_fk = c.id_cargo WHERE $item = :valor");
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


   public static function mdlMostrarMantenimientoGeneralpdf($tabla, $item, $valor, $consulta)
{
    switch ($consulta) {
        case 'mantenimiento_general':
            $stmt = Conexion::conectar()->prepare("SELECT m.*, p.nombre_proceso, u.*, c.nombre_cargo
                FROM usuarios m
                INNER JOIN proceso p ON m.id_proceso_fk = p.id_proceso
                INNER JOIN mantenimiento_general u ON m.id = u.id_usuario_fk3
                INNER JOIN cargos c ON m.id_cargo_fk = c.id_cargo
                WHERE u.$item = :valor");
            $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $stmt = null;
            return $result;
            break;

        default:
            return null;
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

    public static function mdlFirmarMantenimientoGeneral($tabla, $datos)
    {
        // Crear la consulta SQL de actualización
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla 
            SET 
                firma_general = :firma_general, 
                estado_general = :estado_general 
            WHERE id_general = :id_general"); // Usamos id_general
    
        // Vincular los parámetros a la consulta
        $stmt->bindParam(":firma_general", $datos["firma_general"], PDO::PARAM_STR);
        $stmt->bindParam(":estado_general", $datos["estado_general"], PDO::PARAM_STR);
        $stmt->bindParam(":id_general", $datos["id_general"], PDO::PARAM_INT); // Usamos id_general
    
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

    public static function mdlFirmarMantenimientoImpresora($tabla, $datos)
    {
        // Crear la consulta SQL de actualización
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla 
            SET 
                firma_impresora = :firma_impresora, 
                estado_mantenimiento_impresora = :estado_mantenimiento_impresora 
            WHERE id_impresora = :id_impresora"); // Usamos id_impresora
    
        // Vincular los parámetros a la consulta
        $stmt->bindParam(":firma_impresora", $datos["firma_impresora"], PDO::PARAM_STR);
        $stmt->bindParam(":estado_mantenimiento_impresora", $datos["estado_mantenimiento_impresora"], PDO::PARAM_STR);
        $stmt->bindParam(":id_impresora", $datos["id_impresora"], PDO::PARAM_INT); // Usamos id_impresora
    
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

    public static function mdlMostrarEquiposAsignados($tabla, $item, $valor)
    {
        try {
            // Conectar a la base de datos
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_categoriact_fk IN (1, 2)");

            // Ejecutar la consulta
            $stmt->execute();

            // Retornar todos los resultados
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve un array asociativo de todos los consumibles

        } catch (PDOException $e) {
            // Manejo de errores
            echo 'Error: ' . $e->getMessage();
            return [];
        }

    }

    public static function mdlMostrarEquiposGenerales($tabla, $item, $valor)
    {
        try {
            // Conectar a la base de datos
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_categoriact_fk IN (3, 4, 6, 7, 8, 9, 11, 12, 13, 15, 16)");

            // Ejecutar la consulta
            $stmt->execute();

            // Retornar todos los resultados
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve un array asociativo de todos los consumibles

        } catch (PDOException $e) {
            // Manejo de errores
            echo 'Error: ' . $e->getMessage();
            return [];
        }

    }

    public static function mdlMostrarEquiposImpresoras($tabla, $item, $valor)
    {
        try {
            // Conectar a la base de datos
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_categoriact_fk = '5'");

            // Ejecutar la consulta
            $stmt->execute();

            // Retornar todos los resultados
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve un array asociativo de todos los consumibles

        } catch (PDOException $e) {
            // Manejo de errores
            echo 'Error: ' . $e->getMessage();
            return [];
        }

    }
    
    
}
