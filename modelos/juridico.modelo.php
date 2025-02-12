<?php

require_once "conexion.php";

class ModeloSoporteJuridico
{
    public static function mdlIngresarSoporteJuridico($tabla, $datos)
    {
        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();

            // Preparar la consulta de inserción
            $stmt = $pdo->prepare("INSERT INTO $tabla (
                nombre_solicitante, 
                correo_solicitante, 
                id_cargo_fk1, 
                id_proceso_fk1,
                elaboracion_contrato,
                formulacion_conceptos,
                respuesta_requerimientos,
                descripcion_solicitud_juridico,
                observaciones,
                firma_solicitante,
                estado_legal

            ) VALUES (
            
                :nombre_solicitante, 
                :correo_solicitante, 
                :id_cargo_fk1, 
                :id_proceso_fk1,
                :elaboracion_contrato, 
                :formulacion_conceptos,
                :respuesta_requerimientos,
                :descripcion_solicitud_juridico,
                :observaciones,
                :firma_solicitante,
                :estado_legal
            )");

            // Enlazar parámetros
            $stmt->bindParam(":nombre_solicitante", $datos["nombre_solicitante"], PDO::PARAM_STR);
            $stmt->bindParam(":correo_solicitante", $datos["correo_solicitante"], PDO::PARAM_STR);
            $stmt->bindParam(":id_cargo_fk1", $datos["id_cargo_fk1"], PDO::PARAM_INT);
            $stmt->bindParam(":id_proceso_fk1", $datos["id_proceso_fk1"], PDO::PARAM_INT);
            $stmt->bindParam(":elaboracion_contrato", $datos["elaboracion_contrato"], PDO::PARAM_STR);
            $stmt->bindParam(":formulacion_conceptos", $datos["formulacion_conceptos"], PDO::PARAM_STR);
            $stmt->bindParam(":respuesta_requerimientos", $datos["respuesta_requerimientos"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion_solicitud_juridico", $datos["descripcion_solicitud_juridico"], PDO::PARAM_STR);
            $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
            $stmt->bindParam(":firma_solicitante", $datos["firma_solicitante"], PDO::PARAM_STR);
            $stmt->bindParam(":estado_legal", $datos["estado_legal"], PDO::PARAM_STR);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }

            // Cerrar el cursor
            $stmt->closeCursor();
            $stmt = null;
        } catch (PDOException $e) {
            // Manejar errores
            return "error: " . $e->getMessage();
        }
    }


       /*=============================================
	MOSTRAR SOPORTE Juridico
	=============================================*/

    public static function mdlMostrarSoporteJuridico($tabla, $item, $valor, $consulta)
    {
        switch ($consulta) {
            case 'solicitudjuridicofinalizada':
                // Consultar soportes finalizados (donde existe fecha de solución y el estado legal es 'Rechazado')
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado_legal = 'Rechazado' OR estado_legal = 'Cerrado'");
                $stmt->execute();
                $result = $stmt->fetchAll();
                $stmt = null; // Cerrar la conexión
                return $result;
                break;
            

            case 'solicitudjuridico':
                // Consultar solicitudes sin fecha de solución (soportes pendientes)
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado_legal = 'Abierto' ");
                $stmt->execute();
                return $stmt->fetchAll();
                $stmt = null;
                break;

                case 'solicitudjuridicoaceptar':
                    // Consultar solicitudes sin fecha de solución (soportes pendientes)
                    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado_legal = 'Proceso'");
                    $stmt->execute();
                    return $stmt->fetchAll();
                    $stmt = null;
                    break;

                case 'solicitudjuridicorealizada':
                    // Verificar si se tiene el valor del nombre del usuario en la sesión
                    if (isset($_SESSION['nombre'])) {
                        // Obtener el nombre del usuario desde la sesión
                        $nombreUsuario = $_SESSION['id'];
                
                        // Consulta para obtener las solicitudes realizadas por el usuario logueado (basado en el nombre)
                        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE nombre_solicitante = :nombre_usuario");
                
                        // Vincular el parámetro
                        $stmt->bindParam(":nombre_usuario", $nombreUsuario, PDO::PARAM_STR);
                
                        // Ejecutar la consulta
                        $stmt->execute();
                
                        // Retornar los resultados
                        return $stmt->fetchAll();
                    } else {
                        // Si no hay sesión, devolver un array vacío o lanzar un error
                        return [];
                    }
                    // Limpiar el statement
                    $stmt = null;
                    break;
                

            default:
                // Si no se especifica una consulta válida, devolver null
                return null;
                break;
        }
    }


    /*=============================================
	ASIGNAR SOLUCION SOLICITUD
	=============================================*/
    public static function mdlResponderSolicitudJuridico($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET
           fecha_solucion_juridico = :fecha_solucion_juridico, nombre_solucion = :nombre_solucion , solucion_juridico = :solucion_juridico , firma_juridica = :firma_juridica , estado_legal = :estado_legal WHERE id_soporte_juridico = :id_soporte_juridico");

        $stmt->bindParam(":fecha_solucion_juridico", $datos["fecha_solucion_juridico"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_solucion", $datos["nombre_solucion"], PDO::PARAM_STR);
        $stmt->bindParam(":solucion_juridico", $datos["solucion_juridico"], PDO::PARAM_STR);
        $stmt->bindParam(":estado_legal", $datos["estado_legal"], PDO::PARAM_STR);
        $stmt->bindParam(":firma_juridica", $datos["firma_juridica"], PDO::PARAM_STR);
        $stmt->bindParam(":id_soporte_juridico", $datos["id_soporte_juridico"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

      /*=============================================
	ASIGNAR ESTADO
	=============================================*/
    public static function mdlAsignarEstadoJuridico($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado_legal = :estado_legal WHERE id_soporte_juridico = :id_soporte_juridico");
    
        $stmt->bindParam(":estado_legal", $datos["estado_legal"], PDO::PARAM_STR);
        $stmt->bindParam(":id_soporte_juridico", $datos["id_soporte_juridico"], PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    
        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    MOSTRAR ELABORACION CONTRATO
    =============================================*/
    public static function mdlMostrarElaboracionContrato($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt = null;
    }

    /*=============================================
    MOSTRAR FORMULACION DE CONCEPTOS E INFORMES
    =============================================*/
    public static function mdlMostrarFormulacionConceptos($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt = null;
    }
    
        /*=============================================
    MOSTRAR FORMULACION DE CONCEPTOS E INFORMES
    =============================================*/
    public static function mdlMostrarRespuestaRequerimientos($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt = null;
    }

    /*=============================================
    MOSTRAR SOLICITUD LABORAL
    =============================================*/
  public static function mdlMostrarSolicitudLaboral($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE elaboracion_contrato = 'Laboral' AND formulacion_conceptos = 'Laboral'");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt = null;
    }


    public static function mdlMostrarSoporteJuridicopdf($tabla, $item, $valor, $consulta)
    {
        switch ($consulta) {
            case 'soporte_juridico':
                // Consulta con filtro
                $stmt = Conexion::conectar()->prepare("SELECT m.*, p.nombre_proceso, u.*, c.nombre_cargo
                FROM usuarios m
                INNER JOIN proceso p ON m.id_proceso_fk = p.id_proceso
                INNER JOIN soporte_juridico u ON m.id = u.nombre_solicitante
                INNER JOIN cargos c ON m.id_cargo_fk = c.id_cargo WHERE $item = :valor");
                $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
                $stmt = null;
                break;

            default:
                return null;
                break;
        }
    }

    
    /*=============================================
    MOSTRAR TODOS LOS PROCESOS
    =============================================*/
    public static function mdlMostrarProcesos($tablaProcesos, $itemProcesos, $valorProcesos)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaProcesos ");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt = null;
    }

    public static function mdlMostrarUsuarioPorId($idUsuario) {
        $stmt = Conexion::conectar()->prepare("SELECT id, nombre, apellidos_usuario, correo_usuario, id_cargo_fk, id_proceso_fk, foto FROM usuarios WHERE id = :id");
        $stmt->bindParam(":id", $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function mdlFirmaGerente($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET firma_solicitante = :firma_solicitante, estado_legal = :estado_legal WHERE id_soporte_juridico = :id_soporte_juridico");

        $stmt->bindParam(":firma_solicitante", $datos["firma_solicitante"], PDO::PARAM_STR);
        $stmt->bindParam(":estado_legal", $datos["estado_legal"], PDO::PARAM_STR);
        $stmt->bindParam(":id_soporte_juridico", $datos["id_soporte_juridico"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }


}

