<?php

class Compra{

  public function __construct(){

  }


  public static function obtenerCompras($idCliente);

  $contenidoArchivoClientes = file_get_contents('../data/clientes.json');
  $clientes= json_decode($contenidoArchivoClientes,true);

  $compras = null;

  for($i=0; $i<sizeof($clientes); $i++){
    if($clientes[$i]["codigoCliente"]== $idCliente){
      $compras = $clientes[$i]["productos"]["compras"];
    }
  }

  echo json_encode($compras);
}






?>
