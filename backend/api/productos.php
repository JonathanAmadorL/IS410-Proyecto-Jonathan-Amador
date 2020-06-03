<?php
header("Content-Type: application/json");
include_once("../clases/class-producto.php");
sleep(1);

switch ($_SERVER['REQUEST_METHOD']){
  case 'POST': //GUARDAR
    $_POST= json_decode(file_get_contents('php://input'),true);
    //echo "Guardar el usuario:". $_POST['nombre'];
    $producto= new Producto(
      $_POST["codigoEmpresa"],
      $_POST["nombreEmpresa"],
      $_POST["nombreProducto"],
      $_POST["precioProducto"],
      $_POST["descuentoProducto"],
      $_POST["descripcionProducto"],
      $_POST["imagenProducto"],
      $_POST["cantidadProducto"]

    );
    $producto-> guardarProducto();
    echo json_encode($_POST);
  break;

  case 'GET':
  if(isset($_GET['id'])){
    Producto::obtenerProducto($_GET['id']);
    //$resultado["mensaje"]= "Retornar el empresa con el id: ".$_GET['id']; //TENDRIAMOS QUE ENVAIR EL ID POR URL
    //echo json_encode($resultado);
  }else{
    Producto::obtenerProductos();
    //$resultado["mensaje"]= "Retornar todos los empresas";
    //echo json_encode($resultado);
  }
  break;

  case 'PUT':
    $_PUT= json_decode(file_get_contents('php://input'),true);

    $producto= new Producto(
      $_PUT["codigoEmpresa"],
      $_PUT["nombreEmpresa"],
      $_PUT["nombreProducto"],
      $_PUT["precioProducto"],
      $_PUT["descuentoProducto"],
      $_PUT["descripcionProducto"],
      $_PUT["imagenProducto"],
      $_PUT["cantidadProducto"]

    );

    $producto -> actualizarProducto($_GET['id']);

    $resultado["mensaje"]= "Se actualizara el producto con el id: ".$_GET['id'].
    ", Informacion a actualizar: ".json_encode($_PUT);
    echo json_encode($resultado);

  break;

  case 'DELETE':
  $resultado["mensaje"]= "Eliminar el producto con el id:  ".$_GET['id'];
  echo json_encode($resultado);
  echo ("El producto a eliminar es: " );
  Producto::eliminarProducto($_GET['id']);


}

 ?>
