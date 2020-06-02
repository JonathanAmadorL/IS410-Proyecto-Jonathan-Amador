<?php
header("Content-Type: application/json");
include_once("../clases/class-cliente.php");
sleep(1);


switch ($_SERVER['REQUEST_METHOD']){
  case 'POST': //GUARDAR
    $_POST= json_decode(file_get_contents('php://input'),true);
    //echo "Guardar el usuario:". $_POST['nombre'];

    $cliente= Cliente::verificarCliente($_POST['emailCliente'], $_POST['passwordCliente']);
    if($cliente){
      echo '{"codigoResultado":1, "mensaje":"Usuario autenticado"}';
    }else{
        echo '{"codigoResultado":0, "mensaje":"Usuario/Password incorrectos"}';
    }

    break;

  }

?>
