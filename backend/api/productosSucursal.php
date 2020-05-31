<?php
header("Content-Type: application/json");
include_once("../clases/class-productoSucursal.php");
sleep(1);

switch ($_SERVER['REQUEST_METHOD']){
  case 'POST': //GUARDAR
    $_POST= json_decode(file_get_contents('php://input'),true);
    //echo "Guardar el usuario:". $_POST['nombre'];
    $productoSucursal= new ProductoSucursal(
      $_POST["codigoSucursal"],
      $_POST["codigoEmpresa"],
      $_POST["codigoProducto"],
      $_POST["nombreProducto"],
      $_POST["precioProducto"],
      $_POST["cantidadProducto"]

    );
    $productoSucursal-> guardarProductoSucursal();
    $resultado["mensaje"]= "Guardar producto, informacion: ". json_encode($_POST);
    echo json_encode($resultado);
  break;

  case 'GET':
  if(isset($_GET['id'])){
    ProductoSucursal::obtenerProducto($_GET['id']);
    //$resultado["mensaje"]= "Retornar el empresa con el id: ".$_GET['id']; //TENDRIAMOS QUE ENVAIR EL ID POR URL
    //echo json_encode($resultado);
  }else{
    ProductoSucursal::obtenerProductos();
    //$resultado["mensaje"]= "Retornar todos los empresas";
    //echo json_encode($resultado);
  }
  break;

  case 'PUT':
    $_PUT= json_decode(file_get_contents('php://input'),true);

    $productoSucursal= new ProductoSucursal(
      $_PUT["codigoSucursal"],
      $_PUT["codigoEmpresa"],
      $_PUT["codigoProducto"],
      $_PUT["nombreProducto"],
      $_PUT["precioProducto"],
      $_PUT["cantidadProducto"]

    );

    $productoSucursal -> actualizarProductoSucursal($_GET['id']);

    $resultado["mensaje"]= "Se actualizara el producto con el id: ".$_GET['id'].
    ", Informacion a actualizar: ".json_encode($_PUT);
    echo json_encode($resultado);

  break;

  case 'DELETE':
  $resultado["mensaje"]= "Eliminar el producto con el id:  ".$_GET['id'];
  echo json_encode($resultado);
  echo ("El producto a eliminar es: " );
  ProductoSucursal::eliminarProducto($_GET['id']);


}

 ?>
