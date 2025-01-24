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
                            window.location = ""; // Cambiar según la ruta de redirección
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
    
}
