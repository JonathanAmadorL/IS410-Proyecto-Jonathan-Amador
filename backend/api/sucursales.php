<?php
header("Content-Type: application/json");
include_once("../clases/class-sucursal.php");
sleep(2);

switch ($_SERVER['REQUEST_METHOD']){
  case 'POST': //GUARDAR
    $_POST= json_decode(file_get_contents('php://input'),true);
    //echo "Guardar el usuario:". $_POST['nombre'];
    $sucursal= new Sucursal(
      $_POST["codigoEmpresa"],
      $_POST["nombreEmpresa"],
      $_POST["nombreSucursal"],
      $_POST["longitudSucursal"],
      $_POST["latitudSucursal"],
      $_POST["direccionSucursal"]

    );
    $sucursal-> guardarSucursal();
    $resultado["mensaje"] = "Guardar sucursal, informacion:". json_encode($_POST);
    echo json_encode($resultado);
  break;

  case 'GET':
  if(isset($_GET['id'])){
    Sucursal::obtenerSucursal($_GET['id']);
    //$resultado["mensaje"]= "Retornar el empresa con el id: ".$_GET['id']; //TENDRIAMOS QUE ENVAIR EL ID POR URL
    //echo json_encode($resultado);
  }else{
    Sucursal::obtenerSucursales();
    //$resultado["mensaje"]= "Retornar todos los empresas";
    //echo json_encode($resultado);
  }
  break;

  case 'PUT':
    $_PUT= json_decode(file_get_contents('php://input'),true);

    $sucursal= new Sucursal(
      $_PUT["codigoEmpresa"],
      $_PUT["nombreEmpresa"],
      $_PUT["nombreSucursal"],
      $_PUT["longitudSucursal"],
      $_PUT["latitudSucursal"],
      $_PUT["direccionSucursal"]
    );

    $sucursal -> actualizarSucursal($_GET['id']);

    $resultado["mensaje"]= "Se actualizara la sucursal con el id: ".$_GET['id'].
    ", Informacion a actualizar: ".json_encode($_PUT);
    echo json_encode($resultado);

  break;

  case 'DELETE':
  $resultado["mensaje"]= "Eliminar la sucursal con el id:  ".$_GET['id'];
  echo json_encode($resultado);
  echo ("La sucursal a eliminar es: " );
  Sucursal::eliminarSucursal($_GET['id']);


}

 ?>
