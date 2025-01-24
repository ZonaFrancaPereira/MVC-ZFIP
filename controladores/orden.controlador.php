<?php

class ControladorOrden{

    public static function ctrMostrarProvedor($item, $valor){
        $tabla = "proveedor_compras";
        $respuesta = ModeloOrden::mdlMostrarProvedor($tabla, $item, $valor);
        return $respuesta;
    }

    public static function ctrObtenerNombreCargo($id_cargo) {
        $cargo = ModeloOrden::mdlObtenerNombreCargo($id_cargo);
        return $cargo ? $cargo["nombre_cargo"] : "Cargo no encontrado";
    }

    /* =============================================
    Crear una nueva orden de compra
    ============================================= */
    public static function ctrCrearOrden() {
        if (isset($_POST["id_cotizante"])) {
           
                $tabla = "orden_compra"; 
              
                $estado_orden = "Analisis de Cotizacion";
                $analisis_cotizacion = "Si";
                $datos = array(
                    "id_cotizante" => $_POST["id_cotizante"],
                    "fecha_orden" => $_POST["fecha_orden"],
                    "id_proveedor_fk" => $_POST["id_proveedor_fk"],
                    "proveedor_recurrente" => $_POST["proveedor_recurrente"],
                    "forma_pago" => $_POST["forma_pago"],
                    "tiempo_pago" => $_POST["tiempo_pago"],
                    "porcentaje_anticipo" => $_POST["porcentaje_anticipo"],
                    "condiciones_negociacion" => $_POST["condiciones_negociacion"],
                    "comentario_orden" => $_POST["comentario_orden"],
                    "tiempo_entrega" => $_POST["tiempo_entrega"],
                    "total_orden" => $_POST['total_orden'],
                    "estado_orden" => $estado_orden,
                    "analisis_cotizacion" => $analisis_cotizacion

                );

                // Llamar al modelo
                $respuesta = ModeloOrden::mdlCrearOrden($tabla, $datos);

                if (is_array($respuesta) && $respuesta["status"] === "ok") {
                    // Usar el último ID insertado
                    $id_orden_fk = $respuesta["id_orden_fk"];


                   
                } else {
                    echo '<script>
                        Swal.fire({
                            type: "error",
                            title: "¡La orden no pudo ser Guardada!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
    
                        }).then(function(result){
                            if(result.value){
                                $("#").addClass("active");
                            }
                        });
                    </script>
                ';
                }
        }
    }
    





}