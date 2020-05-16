<?php
  class Producto{
    private $codigoEmpresa;
    private $nombreEmpresa;
    private $nombreProducto;
    private $precioProducto;
    private $descuentoProducto;
    private $descripcionProducto;
    private $imagenProducto;
    private $cantidadProducto;

    public function __construct(
    $codigoEmpresa,
    $nombreEmpresa,
    $nombreProducto,
    $precioProducto,
    $descuentoProducto,
    $descripcionProducto,
    $imagenProducto,
    $cantidadProducto
    ){

      $this -> codigoEmpresa = $codigoEmpresa;
      $this -> nombreEmpresa = $nombreEmpresa;
      $this -> nombreProducto = $nombreProducto;
      $this -> precioProducto = $precioProducto;
      $this -> descuentoProducto = $descuentoProducto;
      $this -> descripcionProducto = $descripcionProducto;
      $this -> imagenProducto = $imagenProducto;
      $this -> cantidadProducto = $cantidadProducto;


    }

    //CRUD

  public function guardarProducto(){

    // IDEA: LEEMOS EL ARCHIVO PARA PODER AGREGAR UNA NUEVA EMPRESA
    $contenidoArchivoProductos = file_get_contents('../data/productos.json');
    $productos= json_decode($contenidoArchivoProductos,true);

    // IDEA: AQUI SE CREA EL OBEJTO EMPRESA CON LOS ATRIBUTOS A GAURDAR
    $codigoProducto= uniqid('producto_');

    $productos[]=array(

    "codigoProducto" => $codigoProducto,
    "codigoEmpresa" => $this ->codigoEmpresa,
    "nombreEmpresa" => $this ->nombreEmpresa,
    "nombreProducto" => $this ->nombreProducto,
    "precioProducto" => $this ->precioProducto,
    "descuentoProducto" => $this ->descuentoProducto,
    "descripcionProducto" => $this ->descripcionProducto,
    "imagenProducto" => $this ->imagenProducto,
    "cantidadProducto" => $this ->cantidadProducto
    );

      // IDEA: AQUI SOBREEESCRIBIMOS EL ARCHIVO PARA GUARDAR LA EMPRESA

    $archivoProductos= fopen("../data/productos.json","w");
    fwrite($archivoProductos,json_encode($productos));
    fclose($archivoProductos);

    // IDEA: Inmediatamente se lo guardamos a la empresa
    $contenidoArchivoEmpresas = file_get_contents('../data/empresas.json');
    $empresas = json_decode($contenidoArchivoEmpresas,true);

    for ($i=0; $i<sizeof($empresas);$i++){
      if($empresas[$i]["codigoEmpresa"]== $this->codigoEmpresa){
        echo "se encontro la empresa";
        echo (json_encode($empresas[$i]));

        $empresas[$i]["productos"][]= array(
          "codigoProducto" => $codigoProducto,
          "nombreProducto" => $this ->nombreProducto,
          "precioProducto" => $this ->precioProducto,
          "descuentoProducto" => $this ->descuentoProducto,
          "descripcionProducto" => $this ->descripcionProducto,
          "imagenProducto" => $this ->imagenProducto,
          "cantidadProducto" => $this ->cantidadProducto
        );

        echo (json_encode($empresas[$i]));

        $archivoEmpresas= fopen('../data/empresas.json','w');
        fwrite($archivoEmpresas,json_encode($empresas));
        fclose($archivoEmpresas);
      }
    }

  }

  public static function obtenerProductos(){
    $contenidoArchivoProdutos=file_get_contents("../data/productos.json");
    echo  $contenidoArchivoProdutos;
  }


  public static function obtenerProductosEmpresa($idEmpresa){ //para obtenr producto de esa empresa
    $contenidoArchivoEmpresas= file_get_contents('../data/empresas.json');
    $empresas = json_decode($contenidoArchivoEmpresas,true);
    $empresa= null;
    for($i=0; $i<sizeof($empresas);$i++){
      if($empresas[$i]["codigoEmpresa"]== $idEmpresa){
        $empresa = $empresas[$i];
        break;
      }

    }
    echo $empresas["productos"];

  }

  public static function obtenerProducto($idProducto){
    $contenidoArchivoProductos= file_get_contents('../data/productos.json');
    $productos= json_decode($contenidoArchivoProductos,true);

    for($i=0; $i<sizeof($productos); $i++){
      if($productos[$i]["codigoProducto"]== $idProducto){
        echo json_encode($productos[$i]);
      }
    }

  }


  public function actualizarProducto($idProducto){
    $contenidoArchivoProductos = file_get_contents('../data/productos.json');
    $productos= json_decode($contenidoArchivoProductos,true);

    echo "El producto contenía esta informacion: ";


    for($i=0; $i<sizeof($productos); $i++){
      if($productos[$i]["codigoProducto"]== $idProducto){
        //guardo el codigo que tenia el producto antes de actualizar dicha Informacion
        $codigoProductoGuardar = $productos[$i]["codigoProducto"];
        $producto =array(

          "codigoProducto" => $codigoProductoGuardar,
          "codigoEmpresa" => $this ->codigoEmpresa,
          "nombreEmpresa" => $this ->nombreEmpresa,
          "nombreProducto" => $this ->nombreProducto,
          "precioProducto" => $this ->precioProducto,
          "descuentoProducto" => $this ->descuentoProducto,
          "descripcionProducto" => $this ->descripcionProducto,
          "imagenProducto" => $this ->imagenProducto,
          "cantidadProducto" => $this ->cantidadProducto
        );

        $productos[$i]= $producto;

        // IDEA: AQUI SOBREEESCRIBIMOS EL ARCHIVO PARA actualizar el producto
        $archivoProductos= fopen("../data/productos.json","w");
        fwrite($archivoProductos,json_encode($productos));
        fclose($archivoProductos);
      }
    }

      //AHORA toca actualizar los productos dentro del empresas.json
      $contenidoArchivoEmpresas = file_get_contents('../data/empresas.json');
      $empresas = json_decode($contenidoArchivoEmpresas,true);

      for ($i=0; $i<sizeof($empresas);$i++){
        if($empresas[$i]["codigoEmpresa"]== $this->codigoEmpresa){
          echo "se encontro la empresa con la que sera su vieja informacion";
          echo (json_encode($empresas[$i]));

          $productosArrayEmpresa = $empresas[$i]["productos"];

          for ($j=0; $j < sizeof($productosArrayEmpresa) ; $j++) {

            if($productosArrayEmpresa[$j]["codigoProducto"]==$codigoProductoGuardar){

              $empresas[$i]["productos"][$j]= array(
                "codigoProducto" => $codigoProductoGuardar,
                "nombreProducto" => $this ->nombreProducto,
                "precioProducto" => $this ->precioProducto,
                "descuentoProducto" => $this ->descuentoProducto,
                "descripcionProducto" => $this ->descripcionProducto,
                "imagenProducto" => $this ->imagenProducto,
                "cantidadProducto" => $this ->cantidadProducto
              );


              echo "se actualizo la informacion del producto de la empresa <br>";

              $archivoEmpresas= fopen("../data/empresas.json","w");
              fwrite($archivoEmpresas,json_encode($empresas));
              fclose($archivoEmpresas);
            }
          }

        }
      }


  }





  public static function eliminarProducto($idProducto){
    $contenidoArchivoProdutos= file_get_contents('../data/productos.json');
    $productos= json_decode($contenidoArchivoProdutos,true);

    for($i=0; $i<sizeof($productos); $i++){
      if($productos[$i]["codigoProducto"]== $idProducto){
        $productoEliminarse= $productos[$i];
        $indiceProductoEliminarse= $i;
      }
    }



    // IDEA: Eliminaremos Inmediatamente EL PRODUCTO EN SU Empresa
    $contenidoArchivoEmpresas= file_get_contents('../data/empresas.json');
    $empresas = json_decode($contenidoArchivoEmpresas,true);




    for($i=0; $i<sizeof($empresas);$i++){
      if($empresas[$i]["codigoEmpresa"]== $productoEliminarse["codigoEmpresa"]){
        echo "Se encontro el producto";
        echo (json_encode($empresas[$i]));

        if(array_key_exists("productos", $empresas[$i])){

          $productosArrayEmpresa = $empresas[$i]["productos"];

          for ($j=0; $j < sizeof($productosArrayEmpresa) ; $j++) {

            if($productosArrayEmpresa[$j]["codigoProducto"]==$productoEliminarse["codigoProducto"]){

              array_splice($empresas[$i]["productos"], $j ,1);

              echo "se borro el producto de la empresa <br>";

              $archivoEmpresas= fopen("../data/empresas.json","w");
              fwrite($archivoEmpresas,json_encode($empresas));
              fclose($archivoEmpresas);
            }
          }
        }

      }
    }


    //array_splice (array productos, indice producto , elementos a eliminar a partir del indice)
    array_splice($productos,$indiceProductoEliminarse,1);

    $archivoProductos= fopen("../data/productos.json","w");
    fwrite($archivoProductos,json_encode($productos));
    fclose($archivoProductos);
  }




    /**
     * Get the value of Codigo Empresa
     *
     * @return mixed
     */
    public function getCodigoEmpresa()
    {
        return $this->codigoEmpresa;
    }

    /**
     * Set the value of Codigo Empresa
     *
     * @param mixed $codigoEmpresa
     *
     * @return self
     */
    public function setCodigoEmpresa($codigoEmpresa)
    {
        $this->codigoEmpresa = $codigoEmpresa;

        return $this;
    }

    /**
     * Get the value of Nombre Empresa
     *
     * @return mixed
     */
    public function getNombreEmpresa()
    {
        return $this->nombreEmpresa;
    }

    /**
     * Set the value of Nombre Empresa
     *
     * @param mixed $nombreEmpresa
     *
     * @return self
     */
    public function setNombreEmpresa($nombreEmpresa)
    {
        $this->nombreEmpresa = $nombreEmpresa;

        return $this;
    }

    /**
     * Get the value of Nombre Producto
     *
     * @return mixed
     */
    public function getNombreProducto()
    {
        return $this->nombreProducto;
    }

    /**
     * Set the value of Nombre Producto
     *
     * @param mixed $nombreProducto
     *
     * @return self
     */
    public function setNombreProducto($nombreProducto)
    {
        $this->nombreProducto = $nombreProducto;

        return $this;
    }

    /**
     * Get the value of Precio Producto
     *
     * @return mixed
     */
    public function getPrecioProducto()
    {
        return $this->precioProducto;
    }

    /**
     * Set the value of Precio Producto
     *
     * @param mixed $precioProducto
     *
     * @return self
     */
    public function setPrecioProducto($precioProducto)
    {
        $this->precioProducto = $precioProducto;

        return $this;
    }

    /**
     * Get the value of Descuento Producto
     *
     * @return mixed
     */
    public function getDescuentoProducto()
    {
        return $this->descuentoProducto;
    }

    /**
     * Set the value of Descuento Producto
     *
     * @param mixed $descuentoProducto
     *
     * @return self
     */
    public function setDescuentoProducto($descuentoProducto)
    {
        $this->descuentoProducto = $descuentoProducto;

        return $this;
    }

    /**
     * Get the value of Descripcion Producto
     *
     * @return mixed
     */
    public function getDescripcionProducto()
    {
        return $this->descripcionProducto;
    }

    /**
     * Set the value of Descripcion Producto
     *
     * @param mixed $descripcionProducto
     *
     * @return self
     */
    public function setDescripcionProducto($descripcionProducto)
    {
        $this->descripcionProducto = $descripcionProducto;

        return $this;
    }

    /**
     * Get the value of Imagen Producto
     *
     * @return mixed
     */
    public function getImagenProducto()
    {
        return $this->imagenProducto;
    }

    /**
     * Set the value of Imagen Producto
     *
     * @param mixed $imagenProducto
     *
     * @return self
     */
    public function setImagenProducto($imagenProducto)
    {
        $this->imagenProducto = $imagenProducto;

        return $this;
    }

    /**
     * Get the value of Cantidad Producto
     *
     * @return mixed
     */
    public function getCantidadProducto()
    {
        return $this->cantidadProducto;
    }

    /**
     * Set the value of Cantidad Producto
     *
     * @param mixed $cantidadProducto
     *
     * @return self
     */
    public function setCantidadProducto($cantidadProducto)
    {
        $this->cantidadProducto = $cantidadProducto;

        return $this;
    }

}

 ?>
