<?php

class ControladorPlantilla{

	static public function ctrPlantilla(){

		include "vistas/plantilla.php";

	}	

    public function gestion() {
        // Verifica si el parámetro 'id' está presente en la solicitud
        if (isset($_GET['id'])) {
            $id_acpm = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');
            // Procesa el parámetro 'id' según sea necesario
            echo "ID de ACPM: " . $id_acpm;
        } else {
            echo "ID de ACPM no especificado.";
        }
    }



}