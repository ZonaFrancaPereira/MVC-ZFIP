<?php
$id_cargo_fk=$_SESSION["id_cargo_fk"];
function obtenerRolPorCargo($id_cargo_fk) {

    $lideres = [1,4,6,7,12,14,15];
    $administrativos = [5,6];
    $contabilidad = [12,13];

    if (in_array($id_cargo_fk, $lideres)) {
        return 'lider';
    }

    if (in_array($id_cargo_fk, $administrativos)) {
        return 'administrativo';
    }

    if (in_array($id_cargo_fk, $contabilidad)) {
        return 'contabilidad';
    }

    if ($id_cargo_fk == 19) {
        return 'gerente';
    }

    return 'sin_permiso';
}

echo $id_cargo_fk;

?>