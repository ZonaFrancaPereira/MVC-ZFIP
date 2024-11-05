<?php
require_once "conexion.php";

class ModeloCodificar{




    static public function mdlIngresarCodificacion($tabla,$datos){

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

    















}

?>