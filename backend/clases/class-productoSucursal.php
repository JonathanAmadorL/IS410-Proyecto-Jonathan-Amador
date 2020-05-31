<?php

class ProductoSucursal{

  private $codigoSucursal;
  private $codigoEmpresa;
  private $codigoProducto;
  private $nombreProducto;
  private $precioProducto;
  private $cantidadProducto;

  public function __construct(
  $codigoSucursal,
  $codigoEmpresa,
  $codigoProducto,
  $nombreProducto,
  $precioProducto,
  $cantidadProducto
  ){

    $this -> codigoSucursal = $codigoSucursal;
    $this -> codigoEmpresa = $codigoEmpresa;
    $this -> codigoProducto = $codigoProducto;
    $this -> nombreProducto = $nombreProducto;
    $this -> precioProducto = $precioProducto;
    $this -> cantidadProducto = $cantidadProducto;


  }

    //CRUD

  public function guardarProductoSucursal(){
    $contenidoArchivoSucursales = file_get_contents('../data/sucursales.json');
    $sucursales= json_decode($contenidoArchivoSucursales,true);

    for ($i=0; $i<sizeof($sucursales);$i++){
      if($sucursales[$i]["codigoSucursal"]== $this->codigoSucursal){
        echo "se encontro la sucursal";

        $sucursales[$i]["productosSucursal"][]= array(
          "codigoProducto" => $this->codigoProducto,
          "nombreProducto" => $this ->nombreProducto,
          "precioProducto" => $this ->precioProducto,
          "cantidadProducto" => $this ->cantidadProducto
        );

        echo json_encode($sucursales[$i]);

        $archivoSucursales= fopen("../data/sucursales.json","w");
        fwrite($archivoSucursales,json_encode($sucursales));
        fclose($archivoSucursales);
      }
    }


    $contenidoArchivoEmpresas = file_get_contents('../data/empresas.json');
    $empresas = json_decode($contenidoArchivoEmpresas,true);

    for ($i=0; $i<sizeof($empresas);$i++){
      if($empresas[$i]["codigoEmpresa"]== $this->codigoEmpresa){
        echo "se encontro la empresa";

            if(array_key_exists("sucursales",$empresas[$i])){
              for($j=0 ; $j<sizeof($empresas[$i]["sucursales"]) ; $j++){
                if($empresas[$i]["sucursales"][$j]["codigoSucursal"]==$this->codigoSucursal){
                  echo ("se encontro la sucursal en la empresa");

                  $empresas[$i]["sucursales"][$j]["productosSucursal"][]= array(
                    "codigoProducto" => $this->codigoProducto,
                    "nombreProducto" => $this ->nombreProducto,
                    "precioProducto" => $this ->precioProducto,
                    "cantidadProducto" => $this ->cantidadProducto
                  );

                }
              }
            }

        echo (json_encode($empresas[$i]));

        $archivoEmpresas= fopen('../data/empresas.json','w');
        fwrite($archivoEmpresas,json_encode($empresas));
        fclose($archivoEmpresas);
      }
    }

  }



public function actualizarProductoSucursal($codigoProducto){
  $contenidoArchivoSucursales = file_get_contents('../data/sucursales.json');
  $sucursales= json_decode($contenidoArchivoSucursales,true);

  for ($i=0; $i<sizeof($sucursales);$i++){
    if($sucursales[$i]["codigoSucursal"]== $this->codigoSucursal){
      echo "se encontro la sucursal";

      for($j=0; $j<sizeof($sucursales[$i]["productosSucursal"]); $j++){
        if($sucursales[$i]["productosSucursal"][$j]["codigoProducto"]== $codigoProducto){

          $sucursales[$i]["productosSucursal"][$j]["codigoProducto"] = $this->codigoProducto;
          $sucursales[$i]["productosSucursal"][$j]["nombreProducto"] = $this ->nombreProducto;
          $sucursales[$i]["productosSucursal"][$j]["precioProducto"] = $this ->precioProducto;
          $sucursales[$i]["productosSucursal"][$j]["cantidadProducto"] = $this ->cantidadProducto;

          echo json_encode($sucursales[$i]);

          $archivoSucursales= fopen("../data/sucursales.json","w");
          fwrite($archivoSucursales,json_encode($sucursales));
          fclose($archivoSucursales);
            }
          }

        }
      }


  $contenidoArchivoEmpresas = file_get_contents('../data/empresas.json');
  $empresas = json_decode($contenidoArchivoEmpresas,true);

  for ($i=0; $i<sizeof($empresas);$i++){
    if($empresas[$i]["codigoEmpresa"]== $this->codigoEmpresa){
      echo "se encontro la empresa";

          if(array_key_exists("sucursales",$empresas[$i])){
            for($j=0 ; $j<sizeof($empresas[$i]["sucursales"]); $j++){
              if($empresas[$i]["sucursales"][$j]["codigoSucursal"]==$this->codigoSucursal){
                echo ("se encontro la sucursal en la empresa");
                for($k=0; $k<sizeof($empresas[$i]["sucursales"][$j]["productosSucursal"]); $k++){
                  if($empresas[$i]["sucursales"][$j]["productosSucursal"][$k]["codigoProducto"]== $codigoProducto){

                    $empresas[$i]["sucursales"][$j]["productosSucursal"][$k]["codigoProducto"] = $this->codigoProducto;
                    $empresas[$i]["sucursales"][$j]["productosSucursal"][$k]["nombreProducto"] = $this ->nombreProducto;
                    $empresas[$i]["sucursales"][$j]["productosSucursal"][$k]["precioProducto"] = $this ->precioProducto;
                    $empresas[$i]["sucursales"][$j]["productosSucursal"][$k]["cantidadProducto"] = $this ->cantidadProducto;

                    echo json_encode($empresas[$i]);

                    $archivoEmpresas= fopen('../data/empresas.json','w');
                    fwrite($archivoEmpresas,json_encode($empresas));
                    fclose($archivoEmpresas);

                      }
                    }


                  }
                }
              }

        }
      }
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
     * Get the value of Codigo Producto
     *
     * @return mixed
     */
    public function getCodigoProducto()
    {
        return $this->codigoProducto;
    }

    /**
     * Set the value of Codigo Producto
     *
     * @param mixed $codigoProducto
     *
     * @return self
     */
    public function setCodigoProducto($codigoProducto)
    {
        $this->codigoProducto = $codigoProducto;

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


    /**
     * Get the value of Codigo Sucursal
     *
     * @return mixed
     */
    public function getCodigoSucursal()
    {
        return $this->codigoSucursal;
    }

    /**
     * Set the value of Codigo Sucursal
     *
     * @param mixed $codigoSucursal
     *
     * @return self
     */
    public function setCodigoSucursal($codigoSucursal)
    {
        $this->codigoSucursal = $codigoSucursal;

        return $this;
    }

}


 ?>
