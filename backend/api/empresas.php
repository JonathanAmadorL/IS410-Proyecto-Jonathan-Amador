<?php
header("Content-Type: application/json");
include_once("../clases/class-empresa.php");
sleep(2);

switch ($_SERVER['REQUEST_METHOD']){
  case 'POST': //GUARDAR
    $_POST= json_decode(file_get_contents('php://input'),true);
    //echo "Guardar el usuario:". $_POST['nombre'];
    $empresa= new Empresa(
      $_POST["nombreEmpresa"],
      $_POST["emailEmpresa"],
      $_POST["passwordEmpresa"],
      $_POST["paisEmpresa"],
      $_POST["longitudEmpresa"],
      $_POST["latitudEmpresa"],
      $_POST["bannerEmpresa"],
      $_POST["logoEmpresa"],
      $_POST["facebookEmpresa"],
      $_POST["twitterEmpresa"],
      $_POST["instagramEmpresa"],
      $_POST["descripcionEmpresa"]

    );
    $empresa->guardarEmpresa();
    $resultado["mensaje"]= "Guardar empresa, informacion: ". json_encode($_POST);
    echo json_encode($resultado);
    break;

  case 'GET':
  if(isset($_GET['id'])){
    Empresa::obtenerEmpresa($_GET['id']);
    //$resultado["mensaje"]= "Retornar el empresa con el id: ".$_GET['id']; //TENDRIAMOS QUE ENVAIR EL ID POR URL
    //echo json_encode($resultado);
  }else{
    Empresa::obtenerEmpresas();
    //$resultado["mensaje"]= "Retornar todos los empresas";
    //echo json_encode($resultado);
  }
  break;

  case 'PUT':
  $_PUT= json_decode(file_get_contents('php://input'),true);

  $empresa= new Empresa(
    $_PUT["nombreEmpresa"],
    $_PUT["emailEmpresa"],
    $_PUT["passwordEmpresa"],
    $_PUT["paisEmpresa"],
    $_PUT["longitudEmpresa"],
    $_PUT["latitudEmpresa"],
    $_PUT["bannerEmpresa"],
    $_PUT["logoEmpresa"],
    $_PUT["facebookEmpresa"],
    $_PUT["twitterEmpresa"],
    $_PUT["instagramEmpresa"],
    $_PUT["descripcionEmpresa"]

  );
  $empresa -> actualizarEmpresa($_GET['id']);

  $resultado["mensaje"]= "Se actualizara la empresa con el id: ".$_GET['id'].
  ", Informacion a actualizar: ".json_encode($_PUT);
  echo json_encode($resultado);


  break;

  case 'DELETE':
  $resultado["mensaje"]= "Eliminar la empresa con el id:  ".$_GET['id'];
  echo json_encode($resultado);
  echo "La empresa a eliminar es: ";
  Empresa::eliminarEmpresa($_GET['id']);
  break;


}

 ?>
