<?php

class ControladorSadoc
{


	/*=============================================
	REGISTRO DE PERFILES
	=============================================*/

	 static public function mostrarArchivosPorProceso($id_proceso_fk) {
        $respuesta = ModeloSadoc::mdlObtenerArchivosPorProceso($id_proceso_fk);

		return $respuesta;
    }
}
