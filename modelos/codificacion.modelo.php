<?php
require_once "conexion.php";

class ModeloCodificar
{




    static public function mdlIngresarCodificacion($tabla, $datos)
    {

        try {
            // Obtener la conexión PDO
            $pdo = Conexion::conectar();

            // Preparar la consulta de inserción
            $stmt = $pdo->prepare("INSERT INTO $tabla (
            vigencia, 
            fecha_solicitud_cod, 
            usuario_solicitud_cod, 
            cargo_solicitud_cod, 
            nombre_documento, 
            codigo, 
            descripcion_cambio,
            link_formato_codificacion,
            elabora_nombre, 
            elabora_correo, 
            revisa_nombre, 
            revisa_correo, 
            aprueba_nombre, 
            aprueba_correo, 
            codigo_doc_afectado, 
            nombre_doc_afectado, 
            afecta, 
            todos_colaboradores, 
            solo_lider,
            miembros_proceso, 
            nombre_proceso_cod, 
            colaborador_expecifico, 
            nombre_interna, 
            correo_interna, 
            nombre_externa, 
            correo_externa, 
            enviar_copia

        ) VALUES (
            :vigencia, 
            :fecha_solicitud_cod, 
            :usuario_solicitud_cod, 
            :cargo_solicitud_cod, 
            :nombre_documento, 
            :codigo, 
            :descripcion_cambio,
            :link_formato_codificacion,
            :elabora_nombre, 
            :elabora_correo, 
            :revisa_nombre, 
            :revisa_correo, 
            :aprueba_nombre, 
            :aprueba_correo, 
            :codigo_doc_afectado, 
            :nombre_doc_afectado, 
            :afecta, 
            :todos_colaboradores, 
            :solo_lider,
            :miembros_proceso, 
            :nombre_proceso_cod, 
            :colaborador_expecifico, 
            :nombre_interna, 
            :correo_interna, 
            :nombre_externa, 
            :correo_externa, 
            :enviar_copia
        )");

            $stmt->bindParam(":vigencia", $datos["vigencia"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_solicitud_cod", $datos["fecha_solicitud_cod"], PDO::PARAM_STR);
            $stmt->bindParam(":usuario_solicitud_cod", $datos["usuario_solicitud_cod"], PDO::PARAM_STR);
            $stmt->bindParam(":cargo_solicitud_cod", $datos["cargo_solicitud_cod"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre_documento", $datos["nombre_documento"], PDO::PARAM_STR);
            $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion_cambio", $datos["descripcion_cambio"], PDO::PARAM_STR);
            $stmt->bindParam(":link_formato_codificacion", $datos["link_formato_codificacion"], PDO::PARAM_STR);
            $stmt->bindParam(":elabora_nombre", $datos["elabora_nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":elabora_correo", $datos["elabora_correo"], PDO::PARAM_STR);
            $stmt->bindParam(":revisa_nombre", $datos["revisa_nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":revisa_correo", $datos["revisa_correo"], PDO::PARAM_STR);
            $stmt->bindParam(":aprueba_nombre", $datos["aprueba_nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":aprueba_correo", $datos["aprueba_correo"], PDO::PARAM_STR);
            $stmt->bindParam(":codigo_doc_afectado", $datos["codigo_doc_afectado"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre_doc_afectado", $datos["nombre_doc_afectado"], PDO::PARAM_STR);
            $stmt->bindParam(":afecta", $datos["afecta"], PDO::PARAM_STR);
            $stmt->bindParam(":todos_colaboradores", $datos["todos_colaboradores"], PDO::PARAM_STR);
            $stmt->bindParam(":solo_lider", $datos["solo_lider"], PDO::PARAM_STR);
            $stmt->bindParam(":miembros_proceso", $datos["miembros_proceso"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre_proceso_cod", $datos["nombre_proceso_cod"], PDO::PARAM_STR);
            $stmt->bindParam(":colaborador_expecifico", $datos["colaborador_expecifico"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre_interna", $datos["nombre_interna"], PDO::PARAM_STR);
            $stmt->bindParam(":correo_interna", $datos["correo_interna"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre_externa", $datos["nombre_externa"], PDO::PARAM_STR);
            $stmt->bindParam(":correo_externa", $datos["correo_externa"], PDO::PARAM_STR);
            $stmt->bindParam(":enviar_copia", $datos["enviar_copia"], PDO::PARAM_STR);

            if ($stmt->execute()) {
                // Retornar el último ID y el estado "ok"
                return array("status" => "ok", "id_codificacion_fk" => $pdo->lastInsertId());
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }



    public static function mdlIngresarCorreos($datosCodificar)
    {
        try {
            $pdo = Conexion::conectar();
            $stmt = $pdo->prepare("INSERT INTO detalle_codificacion (
                codigo_doc_afectado, 
                nombre_doc_afectado, 
                afecta, 
                nombre_interna,
                correo_interna, 
                nombre_externa, 
                correo_externa, 
                id_codificacion_fk
        ) VALUES (
                :codigo_doc_afectado, 
                :nombre_doc_afectado, 
                :afecta, 
                :nombre_interna,
                :correo_interna, 
                :nombre_externa, 
                :correo_externa, 
                :id_codificacion_fk
            )");

            $stmt->bindParam(":codigo_doc_afectado", $datosCodificar["codigo_doc_afectado"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre_doc_afectado", $datosCodificar["nombre_doc_afectado"], PDO::PARAM_STR);
            $stmt->bindParam(":afecta", $datosCodificar["afecta"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre_interna", $datosCodificar["nombre_interna"], PDO::PARAM_STR);
            $stmt->bindParam(":correo_interna", $datosCodificar["correo_interna"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre_externa", $datosCodificar["nombre_externa"], PDO::PARAM_STR);
            $stmt->bindParam(":correo_externa", $datosCodificar["correo_externa"], PDO::PARAM_STR);
            $stmt->bindParam(":id_codificacion_fk", $datosCodificar["id_codificacion_fk"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error en ejecución SQL";
            }
        } catch (PDOException $e) {
            return "error en consulta: " . $e->getMessage(); // Muestra mensaje de error
        }
    }


    /*=============================================
	MOSTRAR SOLICITUDES 
	=============================================*/

    public static function mdlMostrarCodificacion($tabla, $item, $valor, $consulta)
    {
        switch ($consulta) {
            case 'cod_responder':
                // Preparar la consulta para seleccionar todas las columnas de la tabla solicitud_codificacion
                $stmt = Conexion::conectar()->prepare("SELECT * FROM solicitud_codificacion");
                $stmt->execute();
                return $stmt->fetchAll();
                $stmt = null;
                break;

            case 'cod_terminadas':
                $stmt = Conexion::conectar()->prepare("SELECT * FROM solicitud_codificacion");
                $stmt->execute();
                return $stmt->fetchAll();
                $stmt = null;
                break;

                case 'cod_realizadas':
                    // Obtener el ID del usuario que inició sesión desde la sesión
                    $id_usuario = $_SESSION["nombre"];
                    
                    // Preparar y ejecutar la consulta
                    $stmt = Conexion::conectar()->prepare("SELECT solicitud_codificacion.*, usuarios.nombre, usuarios.apellidos_usuario
                                                           FROM solicitud_codificacion
                                                           INNER JOIN usuarios ON solicitud_codificacion.usuario_solicitud_cod = usuarios.nombre
                                                           WHERE usuarios.nombre = :id_usuario");
                    // Enlazar el parámetro :id_usuario con el ID del usuario actual
                    $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
                    $stmt->execute();
                    
                    // Retornar todos los resultados
                    return $stmt->fetchAll();
                    $stmt = null;
                    break;
            default:
                // En el caso por defecto, asignar null a las variables
                $consulta = null;
                $item = null;
                $valor = null;
                break;
        }
    }


    /*=============================================
            DAR RESPUESTA A LA SOLICITUD DE CODIFICACION
            =============================================*/
    public static function mdlIngresarRespuestaCodificacion($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET
           estado_sig_codificacion = :estado_sig_codificacion, fecha_sig_codificacion = :fecha_sig_codificacion , responsable_sig_codificacion = :responsable_sig_codificacion, causa_rechazo_codificacion = :causa_rechazo_codificacion, evidencia_difucion = :evidencia_difucion WHERE id_codificacion = :id_codificar");

        $stmt->bindParam(":estado_sig_codificacion", $datos["estado_sig_codificacion"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_sig_codificacion", $datos["fecha_sig_codificacion"], PDO::PARAM_STR);
        $stmt->bindParam(":responsable_sig_codificacion", $datos["responsable_sig_codificacion"], PDO::PARAM_STR);
        $stmt->bindParam(":causa_rechazo_codificacion", $datos["causa_rechazo_codificacion"], PDO::PARAM_STR);
        $stmt->bindParam(":evidencia_difucion", $datos["evidencia_difucion"], PDO::PARAM_STR);
        $stmt->bindParam(":id_codificar", $datos["id_codificar"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }


      /*=============================================
	MOSTRAR PDF ACPM
	=============================================*/

    public static function mdlMostrarCodificacionpdf($tabla, $item, $valor, $consulta)
    {
        try {
            // Conectar a la base de datos
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            // Vincular el parámetro de la consulta
            $stmt->bindParam(":$item", $valor, PDO::PARAM_INT);
            // Ejecutar la consulta
            $stmt->execute();

            // Devolver los resultados
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            // Manejo de errores
            die("Error al obtener datos del ACPM: " . $e->getMessage());
        }
    }

    
    public static function mdlMostrarVersionDocumentos($tablad, $itemd, $valord)
    {
        try {
            // Si $itemd y $valord son null, obtener todos los registros
            if ($itemd == null && $valord == null) {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tablad");
            } else {
                // Si $itemd no es null, usar el parámetro en la consulta
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tablad WHERE $itemd = :valor");
                $stmt->bindParam(":valor", $valord, PDO::PARAM_INT);
            }
    
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            // Si ocurre algún error, mostrar el mensaje
            echo "Error: " . $e->getMessage();
        }
    }
    

}
