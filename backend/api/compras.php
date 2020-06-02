<?php
header("Content-Type: application/json");
include_once("../clases/class-compra.php");
sleep(1);

switch ($_SERVER['REQUEST_METHOD']){
  case 'POST': //GUARDAR


    break;

  case 'GET':
  if(isset($_GET['id'])){
    Carrito::obtenerCarrito($_GET['id']);
    //$resultado["mensaje"]= "Retornar el empresa con el id: ".$_GET['id']; //TENDRIAMOS QUE ENVAIR EL ID POR URL
    //echo json_encode($resultado);
  }else{
    Compra::obtenerCompras();
    //$resultado["mensaje"]= "Retornar todos los empresas";
    //echo json_encode($resultado);
  }
  break;

  case 'PUT':



  break;

  case 'DELETE':
  break;


}

 ?>
