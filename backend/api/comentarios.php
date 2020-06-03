<?php
header("Content-Type: application/json");
include_once("../clases/class-comentario.php");
sleep(1);

switch ($_SERVER['REQUEST_METHOD']){
  case 'POST': //GUARDAR
    $_POST= json_decode(file_get_contents('php://input'),true);
    //echo "Guardar el usuario:". $_POST['nombre'];
    $comentario= new Comentario(
      $_POST["codigoCliente"],
      $_POST["codigoProducto"],
      $_POST["nombreCliente"],
      $_POST["apellidoCliente"],
      $_POST["contenido"],
      $_POST["imagenCliente"]

    );
    $comentario-> guardarComentario();
    $resultado["mensaje"]= "Guardar comentario, informacion: ". json_encode($_POST);
    echo json_encode($resultado);
  break;

  case 'GET':
  if(isset($_GET['id'])){
    Comentario::obtenerComentario($_GET['id']);
    //$resultado["mensaje"]= "Retornar el empresa con el id: ".$_GET['id']; //TENDRIAMOS QUE ENVAIR EL ID POR URL
    //echo json_encode($resultado);
  }else{
    Comentario::obtenerComentarios();
    //$resultado["mensaje"]= "Retornar todos los empresas";
    //echo json_encode($resultado);
  }
  break;

  case 'PUT':
    $_PUT= json_decode(file_get_contents('php://input'),true);

    $comentario= new Comentario(
      $_PUT["codigoCliente"],
      $_PUT["codigoProducto"],
      $_PUT["nombreCliente"],
      $_POST["apellidoCliente"],
      $_PUT["contenido"],
      $_PUT["imagenCliente"]
    );

    $comentario-> actualizarComentario($_GET['id']);

    $resultado["mensaje"]= "Se actualizara el comentario con el id: ".$_GET['id'].
    ", Informacion a actualizar: ".json_encode($_PUT);
    echo json_encode($resultado);
  break;

  case 'DELETE':
  $resultado["mensaje"]= "Eliminar el comentario con el id:  ".$_GET['id'];
  echo json_encode($resultado);
  echo ("El comentario a eliminar es: " );
  Comentario::eliminarComentario($_GET['id']);


}

 ?>
