<?php
header("Content-Type: application/json");
include_once("../clases/class-favorito.php");
sleep(1);

switch ($_SERVER['REQUEST_METHOD']){
  case 'POST': //GUARDAR
    $_POST= json_decode(file_get_contents('php://input'),true);
    //echo "Guardar el usuario:". $_POST['nombre'];

    Favorito::guardarFavorito($_GET['id1'], $_GET['id2']);

    break;

  case 'GET':
  if(isset($_GET['id'])){
    Favorito::obtenerCliente($_GET['id']);
    //$resultado["mensaje"]= "Retornar el empresa con el id: ".$_GET['id']; //TENDRIAMOS QUE ENVAIR EL ID POR URL
    //echo json_encode($resultado);
  }else{
    Favorito::obtenerClientes();
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
  $resultado["mensaje"]= "Eliminar la empresa con el id:  ".$_GET['id2']." del cliente con id: ".$_GET['id1'];
  echo json_encode($resultado);
  Favorito::eliminarFavorito($_GET['id1'], $_GET['id2']);
  break;


}

 ?>
