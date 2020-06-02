<?php
header("Content-Type: application/json");
include_once("../clases/class-cliente.php");
sleep(1);

switch ($_SERVER['REQUEST_METHOD']){
  case 'POST': //GUARDAR
    $_POST= json_decode(file_get_contents('php://input'),true);
    //echo "Guardar el usuario:". $_POST['nombre'];
    $cliente= new Cliente(
      $_POST["nombreCliente"],
      $_POST["apellidoCliente"],
      $_POST["emailCliente"],
      $_POST["passwordCliente"],
      $_POST["paisCliente"],
      $_POST["imagenCliente"],
      $_POST["fechaNacimientoCliente"],
      $_POST["aboutCliente"],
      $_POST["facebookCliente"],
      $_POST["twitterCliente"],
      $_POST["instagramCliente"]

    );
    $cliente->guardarCliente();
    $resultado["mensaje"]= "Guardar empresa, informacion: ". json_encode($_POST);
    echo json_encode($resultado);
    break;

  case 'GET':
  if(isset($_GET['id'])){
    Cliente::obtenerCliente($_GET['id']);

  }else{
    Cliente:: obtenerClientes();

  }
  break;

  case 'PUT':
  $_PUT= json_decode(file_get_contents('php://input'),true);

  $cliente= new Cliente(
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
  $resultado["mensaje"]= "Eliminar el cliente con el id:  ".$_GET['id'];
  echo json_encode($resultado);
  echo "La empresa a eliminar es: ";
  Cliente::eliminarCliente($_GET['id']);
  break;


}

?>
