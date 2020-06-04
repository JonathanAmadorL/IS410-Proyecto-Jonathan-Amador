<?php

class Compra{
  private $codigoCliente;
  private $codigoEmpresa;
  private $codigoProducto;
  private $precio;
  private $cantidad;

  public function __construct(
    $codigoCliente,
    $codigoEmpresa,
    $codigoProducto,
    $precio,
    $cantidad
  ){

    $this-> codigoCliente = $codigoCliente;
    $this-> codigoEmpresa = $codigoEmpresa;
    $this-> codigoProducto = $codigoProducto;
    $this-> precio = $precio;
    $this-> cantidad = $cantidad;

  }


  public function guardarCompra(){

    $contenidoArchivoClientes = file_get_contents('../data/clientes.json');
    $clientes= json_decode($contenidoArchivoClientes,true);

    for($i=0; $i<sizeof($clientes) ; $i++){
      if($clientes[$i]["codigoCliente"] == $this->codigoCliente){
            $clientes[$i]["productos"]["compras"][] = array(
              "codigoEmpresa" => $this ->codigoEmpresa,
              "codigoProducto" => $this ->codigoProducto,
              "precio" => $this ->precio,
              "cantidad" => $this ->cantidad
            );

      }
    }

    $archivoClientes= fopen("../data/clientes.json","w");
    fwrite($archivoClientes,json_encode($clientes));
    fclose($archivoClientes);
  }


  public static function obtenerCompras($idCliente);

  $contenidoArchivoClientes = file_get_contents('../data/clientes.json');
  $clientes= json_decode($contenidoArchivoClientes,true);

  $compras = null;

  for($i=0; $i<sizeof($clientes); $i++){
    if($clientes[$i]["codigoCliente"]== $idCliente){
      $compras = $clientes[$i]["productos"]["compras"];
    }
  }

  echo json_encode($compras);



    /**
     * Get the value of Codigo Cliente
     *
     * @return mixed
     */
    public function getCodigoCliente()
    {
        return $this->codigoCliente;
    }

    /**
     * Set the value of Codigo Cliente
     *
     * @param mixed $codigoCliente
     *
     * @return self
     */
    public function setCodigoCliente($codigoCliente)
    {
        $this->codigoCliente = $codigoCliente;

        return $this;
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
     * Get the value of Precio
     *
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of Precio
     *
     * @param mixed $precio
     *
     * @return self
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of Cantidad
     *
     * @return mixed
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set the value of Cantidad
     *
     * @param mixed $cantidad
     *
     * @return self
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

}






?>
