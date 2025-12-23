<?php


require_once "../controladores/orden.controlador.php";
require_once "../modelos/orden.modelo.php";



if ($_POST["accion"] == "denegar") {

  ModeloOrden::mdlDenegarOrden(
    $_POST["idOrden"],
    $_POST["descripcion"]
  );

  echo "ok";
}

if (isset($_POST["accion"]) && $_POST["accion"] == "aprobarOrden") {

  $respuesta = ControladorOrden::ctrCambiarEstadoOrden(
    $_POST["idOrden"],
    $_POST["estado"]
  );

  echo json_encode($respuesta);

}