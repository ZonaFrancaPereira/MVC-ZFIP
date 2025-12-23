<?php

class ControladorOrden
{

    public static function ctrMostrarProvedor($item, $valor)
    {
        $tabla = "proveedor_compras";
        $respuesta = ModeloOrden::mdlMostrarProvedor($tabla, $item, $valor);
        return $respuesta;
    }

    public static function ctrObtenerNombreCargo($id_cargo)
    {
        $cargo = ModeloOrden::mdlObtenerNombreCargo($id_cargo);
        return $cargo ? $cargo["nombre_cargo"] : "Cargo no encontrado";
    }


    /* =============================================
    Crear una nueva orden de compra
    ============================================= */
    public static function ctrCrearOrden()
    {
        if (isset($_POST["id_cotizante"])) {
            // Tabla principal de orden de compra
            $tabla = "orden_compra";

            // Valores predeterminados
            $estado_orden = "Analisis de Cotizacion";
            $analisis_cotizacion = "Si";

            // Capturar datos del formulario
            $datos = array(
                "id_cotizante" => $_POST["id_cotizante"],

                "id_proveedor_fk" => $_POST["id_proveedor_fk"],
                "proveedor_recurrente" => $_POST["proveedor_recurrente"],
                "presupuestado" => $_POST["presupuestado"],
                "forma_pago" => $_POST["forma_pago"],
                "tiempo_pago" => !empty($_POST["tiempo_pago"]) ? $_POST["tiempo_pago"] : null,
                "porcentaje_anticipo" => !empty($_POST["porcentaje_anticipo"]) ? $_POST["porcentaje_anticipo"] : null,
                "condiciones_negociacion" => $_POST["condiciones_negociacion"],
                "comentario_orden" => $_POST["comentario_orden"],
                "tiempo_entrega" => $_POST["tiempo_entrega"],
                "total_orden" => $_POST["total_orden"],
                "estado_orden" => $estado_orden,
                "analisis_cotizacion" => $analisis_cotizacion
            );

            // Llamar al modelo para insertar la orden
            $respuesta = ModeloOrden::mdlCrearOrden($tabla, $datos);

            if (is_array($respuesta) && $respuesta["status"] === "ok") {
                // Usar el último ID insertado
                $id_orden_compra = $respuesta["id_orden_compra"];

                // Capturar datos de los artículos desde los arrays enviados
                $articulos = $_POST["articulo_compra"];
                $cantidades = $_POST["cantidad_orden"];
                $valoresNetos = $_POST["valor_neto"];
                $valoresIva = $_POST["valor_iva"];
                $valoresTotales = $_POST["valor_total"];
                $observaciones = $_POST["observaciones_articulo"];

                // Asegurarse de que todos los arrays tengan el mismo número de elementos
                $totalItems = count($articulos);

                for ($i = 0; $i < $totalItems; $i++) {
                    // Capturar datos de cada fila
                    $datosOrden = array(
                        "articulo_compra" => $articulos[$i],
                        "cantidad_orden" => $cantidades[$i],
                        "valor_neto" => $valoresNetos[$i],
                        "valor_iva" => $valoresIva[$i],
                        "valor_total" => $valoresTotales[$i],
                        "observaciones_articulo" => $observaciones[$i],
                        "id_orden_compra" => $id_orden_compra,
                    );

                    // Llamar al modelo para insertar los detalles de cada artículo
                    $respuestaDetalle = ModeloOrden::mdlCrearDetalleOrden($datosOrden);

                    if ($respuestaDetalle !== "ok") {
                        echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "Error al insertar el artículo: ' . htmlspecialchars($articulos[$i]) . '",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            });
                        </script>';
                        return;
                    }
                }

                // Si todo se insertó correctamente
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Orden creada con éxito",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.isConfirmed) {

                            var datosCorreo = {
                                modulo: "OrdenCompra",
                                id_consulta: "' . $id_orden_compra . '",
                                destinatario: "cbustamante@zonafrancadepereira.com"
                            };

                            // Enviar correo por AJAX
                            $.ajax({
                                url: "ajax/enviarCorreo.php",
                                method: "POST",
                                data: JSON.stringify(datosCorreo),
                                cache: false,
                                contentType: "application/json",
                                processData: false,
                                success: function(respuesta) {
                                    console.log("Correo OC:", respuesta);
                                }
                            });

                            window.location = "";
                        }
                    });
                </script>';
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Error al crear la orden",
                        text: "Por favor, revisa los datos ingresados",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    });
                </script>';
            }
        }
    }

    // Método para contar activos por usuario
    public static function ctrContarOrdenPorUsuario($idUsuario)
    {
        return ModeloOrden::contarOrdenPorUsuario($idUsuario);
    }
    /* =============================================
    MOSTRAR ORDENES DE COMPRA LIDERES
    ============================================= */
    static public function ctrMostrarOrdenesLideres()
    {
        $idUsuario = $_SESSION["id"];
        return ModeloOrden::mdlMostrarOrdenesLideres($idUsuario);
    }
    /* =============================================
    MOSTRAR ORDENES DE COMPRA POR CARGO
    ============================================= */
    static public function ctrBandejaOrdenes()
    {
        $cargo = $_SESSION["id_cargo_fk"];

        // GH / Administrativo
        if (in_array($cargo, [5, 6])) {
            return ModeloOrden::mdlMostrarOrdenesPorEstado("Analisis de Cotizacion");
        }

        // Gerencia
        if (in_array($cargo, [19, 1])) {
            return ModeloOrden::mdlMostrarOrdenesPorEstado("Proceso");
        }

        // Contabilidad
        if (in_array($cargo, [12, 13])) {
            return ModeloOrden::mdlMostrarOrdenesPorEstado("Aprobada");
        }
    }

    /* =============================================
    MOSTRAR ORDENES DE COMPRA LEJECUTADAS
    ============================================= */
    static public function ctrMostrarOrdenesEjecutadas()
    {

        return ModeloOrden::mdlMostrarOrdenesEjecutadas("Ejecutada");
    }
    /* ==============================
     CAMBIAR ESTADO DE ORDEN
  ============================== */
    static public function ctrCambiarEstadoOrden($idOrden, $estado)
    {

        $tabla = "orden_compra";
        if ($estado == "Aprobada") {
            session_start();
            $fechaAprobacion = date("Y-m-d H:i:s");
            $id_gerente = $_SESSION["id"];

            $respuesta = ModeloOrden::mdlCambiarEstadoOrdenGR(
                $tabla,
                $idOrden,
                $estado,
                $fechaAprobacion,
                $id_gerente
            );
            return $respuesta;
        } else {

            $respuesta = ModeloOrden::mdlCambiarEstadoOrden(
                $tabla,
                $idOrden,
                $estado,

            );

            return $respuesta;
        }
    }
}
