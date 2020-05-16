<?php
header("Content-Type: application/json");
include_once("../clases/class-planEmpresa.php");
sleep(2);

switch ($_SERVER['REQUEST_METHOD']){
  case 'POST': //GUARDAR
    $_POST= json_decode(file_get_contents('php://input'),true);
    //echo "Guardar el usuario:". $_POST['nombre'];
    $plan= new PlanEmpresa(
      $_POST["codigoEmpresa"],
      $_POST["nombreEmpresa"],
      $_POST["tipoPlan"],
      $_POST["precioPlan"],
      $_POST["productosRestantes"],
      $_POST["unidadesProducto"]

    );
    $plan-> guardarPlan();
    $resultado["mensaje"]= "Guardar plan, informacion: ". json_encode($_POST);
    echo json_encode($resultado);
  break;

  case 'GET':
  if(isset($_GET['id'])){
    PlanEmpresa::obtenerPlanes($_GET['id']);
    //$resultado["mensaje"]= "Retornar el empresa con el id: ".$_GET['id']; //TENDRIAMOS QUE ENVAIR EL ID POR URL
    //echo json_encode($resultado);
  }else{
    PlanEmpresa::obtenerPlanes();
    //$resultado["mensaje"]= "Retornar todos los empresas";
    //echo json_encode($resultado);
  }
  break;


}

 ?>
