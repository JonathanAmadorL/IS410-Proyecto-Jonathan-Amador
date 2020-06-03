<?php
session_start();
header("Content-Type: application/json");
include_once("../clases/class-cliente.php");
sleep(1);

switch ($_SERVER['REQUEST_METHOD']){
  case 'POST': //GUARDAR
    $_POST= json_decode(file_get_contents('php://input'),true);
    //echo "Guardar el usuario:". $_POST['nombre'];

    $cliente= Cliente::verificarCliente($_POST['emailCliente'], $_POST['passwordCliente']);
    if($cliente){
      //echo '{"codigoResultado":1, "mensaje":"Usuario autenticado"}';
      $resultado = array(
        "codigoResultado" => 1,
        "mensaje" => "Usuario autenticado",
        "token" => sha1(uniqid(rand(),true))
      );
      $_SESSION["token"] = $resultado["token"];
      setcookie("token", $resultado["token"],time()+(60*60*24*7), "/");
      setcookie("codigoCliente", $cliente["codigoCliente"] ,time()+(60*60*24*7), "/");
      echo json_encode($resultado);
    }else{
      setcookie("token","",time()-1, "/");
      setcookie("codigoCliente", "",time()-1, "/");
      echo '{"codigoResultado":0, "mensaje":"Usuario/Password incorrectos"}';
    }

    break;

  }

?>
