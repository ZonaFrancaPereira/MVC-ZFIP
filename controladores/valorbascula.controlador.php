<?php

class ControladorValorPesaje {
    /* =============================================
      MOSTRAR EMPRESA
      ============================================= */

    static public function ctrMostrarValorPesaje($item, $valor) {

      
        $item = null;
        $valor = null;
        $respuesta = ModeloValorPesaje::mdlMostrarValorPesaje($item, $valor);

        return $respuesta;
    }

    
}

