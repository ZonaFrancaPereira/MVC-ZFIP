<?php

class ControladorInventario
{
    /*=============================================
    ABRIR Inventario
    =============================================*/
    public function ctrAbrirInventario()
    {
        if (isset($_POST["fecha_apertura"])) {

            $datos = array(
                "fecha_apertura" => $_POST["fecha_apertura"],
                "estado_inventario" => "Abierto",
                "id_usuario_apertura" => $_SESSION['id']
            );

            $respuesta = ModeloInventario::mdlCrearInventario("inventario", $datos);

            if (is_numeric($respuesta)) {
                echo '
                <script>
							Swal.fire(
							"Buen Trabajo!",
							"El inventario '.$respuesta.' ha sido registrado con éxito.",
							"success"
							).then(function() {
							$("#nuevo_inventario").hide();
							
							});
						</script>
              
					';
            } else {
                echo '<script>
						Swal.fire({
							type: "error",
							title: "¡No se registro el inventario con éxito!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){
							if(result.value){
								$("#nuevo_inventario").show();
							}
						});
					</script>
				';
            }
        }
    }

    /*=============================================
    CERRAR Inventario
    =============================================*/
    public function ctrCerrarInventario()
    {
        if (isset($_POST["id_inventario"]) && isset($_POST["fecha_cierre"]) && isset($_POST["id_usuario_cierre"])) {

            $datos = array(
                "id_inventario" => $_POST["id_inventario"],
                "fecha_cierre" => $_POST["fecha_cierre"],
                "id_usuario_cierre" => $_POST["id_usuario_cierre"]
            );

            $respuesta = ModeloInventario::mdlCerrarInventario("inventario", $datos);

            if ($respuesta === "ok") {
                echo json_encode(array("status" => "success"));
            } else {
                echo json_encode(array("status" => "error", "msg" => "Error al cerrar el inventario"));
            }
        }
    }

    /*=============================================
    VERIFICAR Inventario Abierto
    =============================================*/
    static public function ctrVerificarInventarioAbierto()
    {
        $respuesta = ModeloInventario::mdlVerificarInventarioAbierto("inventario");

        if ($respuesta) {
            return $respuesta;
        } else {
            return null;
        }
    }
    
    static public function ctrMostrarInventario(){
        $tabla = "inventario";

		$respuesta = ModeloInventario::mdlMostrarInventario($tabla, $item, $valor);

		return $respuesta;
    }
    

}
?>
