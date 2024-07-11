<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";
session_start();
          
if(!$_SESSION["iniciarSesion"]){
	return;
}
class TablaClientes{

 	/*=============================================
 	 MOSTRAR LA TABLA DE CLIENTE
  	=============================================*/ 

	public function mostrarTablaClientes(){

		$item = null;
    	$valor = null;
    	$orden = "documento";


    	$request=$_REQUEST;


	$renglones = ModeloClientes::mdlMostrarNumRegistros($request);
    	$totalRenglones=$renglones["contador"];


    
    	
  		$clientes = ModeloClientes::mdlMostrarClientesDTServerSide($request);	

  		if(count($clientes) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{

		"draw": '.intval($request["draw"]).',
		"recordsTotal":'.intval($totalRenglones).',
		"recordsFiltered": '.intval($totalRenglones).',
		
		  "data": [';

		  for($i = 0; $i < count($clientes); $i++){


       

                $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarCliente' idCliente='" . $clientes[$i]["documento"] . "' data-toggle='modal' data-target='#modalEditarCliente'><i class='fas fa-edit'></i></button><button class='btn btn-danger btnEliminarCliente' idCliente='" . $clientes[$i]["documento"] . "'><i class='fa fa-times'></i></button></div>";
          

		  	$datosJson .='[
					"'.$clientes[$i]["documento"].'",
						"'.$clientes[$i]["nombre"].'",
						"'.$clientes[$i]["email"].'",
						"'.$clientes[$i]["telefono"].'",
						"'.$clientes[$i]["direccion"].'",
						"'.$clientes[$i]["compras"].'",
						"'.$clientes[$i]["ultima_compra"].'",
						"'.$clientes[$i]["fecha"].'",
						"'.$botones.'"

			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE CLIENTES
=============================================*/ 
$activarBitacora= new TablaClientes();
$activarBitacora -> mostrarTablaClientes();

