<?php

require_once "conexion.php";

class ModeloValorPesaje{

	/*=============================================
	MOSTRAR EMPRESA
	=============================================*/

	static public function mdlMostrarValorPesaje(){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM valor_pesaje");

			$stmt -> execute();

			return $stmt -> fetchAll();
		$stmt = null;

	}


	

}