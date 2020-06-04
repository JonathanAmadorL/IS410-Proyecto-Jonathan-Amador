<?php
session_start();
header("Content-Type: application/json");
include_once("../clases/class-empresa.php");
sleep(1);

switch ($_SERVER['REQUEST_METHOD']){
  case 'POST': //GUARDAR
    $_POST= json_decode(file_get_contents('php://input'),true);
    //echo "Guardar el usuario:". $_POST['nombre'];

    $empresa= Empresa::verificarCliente($_POST['emailEmpresa'], $_POST['passwordEmpresa']);
    if($empresa){
      //echo '{"codigoResultado":1, "mensaje":"Usuario autenticado"}';
      $resultado = array(
        "codigoResultado" => 1,
        "mensaje" => "Usuario autenticado",
        "token" => sha1(uniqid(rand(),true))
      );
      $_SESSION["token"] = $resultado["token"];
      setcookie("token", $resultado["token"],time()+(60*60*24*7), "/");
      setcookie("codigoEmpresa", $empresa["codigoEmpresa"] ,time()+(60*60*24*7), "/");
      echo json_encode($resultado);
    }else{
      setcookie("token","",time()-1, "/");
      setcookie("codigoEmpresa", "",time()-1, "/");
      echo '{"codigoResultado":0, "mensaje":"Usuario/Password incorrectos"}';
    }

    break;

  }

?>
