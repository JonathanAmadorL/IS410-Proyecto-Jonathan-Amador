<?php
header("Content-Type: application/json");
include_once("../clases/class-carrito.php");
sleep(1);

switch ($_SERVER['REQUEST_METHOD']){
  case 'POST': //GUARDAR
    $_POST= json_decode(file_get_contents('php://input'),true);
    //echo "Guardar el usuario:". $_POST['nombre'];

    $carrito= new Carrito(
      $_POST["codigoCliente"],
      $_POST["codigoEmpresa"],
      $_POST["codigoProducto"],
      $_POST["precio"],
      $_POST["cantidad"],
    );

    $carrito->guardarCarrito();

    break;

  case 'GET':
  if(isset($_GET['id'])){
    Carrito::obtenerCarrito($_GET['id']);
    //$resultado["mensaje"]= "Retornar el empresa con el id: ".$_GET['id']; //TENDRIAMOS QUE ENVAIR EL ID POR URL
    //echo json_encode($resultado);
  }else{
    Carrito::obtenerClientes();
    //$resultado["mensaje"]= "Retornar todos los empresas";
    //echo json_encode($resultado);
  }
  break;

  case 'PUT':
  $_PUT= json_decode(file_get_contents('php://input'),true);

  $cliente= new Favorito(
    $_PUT["nombreCliente"],
    $_PUT["apellidoCliente"],
    $_PUT["emailCliente"],
    $_PUT["passwordCliente"],
    $_PUT["paisCliente"],
    $_PUT["imagenCliente"],
    $_PUT["fechaNacimientoCliente"],
    $_PUT["aboutCliente"],
    $_PUT["facebookCliente"],
    $_PUT["twitterCliente"],
    $_PUT["instagramCliente"]

  );
  $cliente -> actualizarCliente($_GET['id']);

  $resultado["mensaje"]= "Se actualizara el cliente con el id: ".$_GET['id'].
  ", Informacion a actualizar: ".json_encode($_PUT);
  echo json_encode($resultado);


  break;

  case 'DELETE':
  Carrito::eliminarCarrito($_GET['id']);
  break;


}

 ?>
