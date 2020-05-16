<?php
  class PlanEmpresa{

    private $codigoEmpresa;
    private $nombreEmpresa;
    private $tipoPlan;
    private $precioPlan;
    private $productosRestantes;
    private $unidadesProducto;


  public function __construct(
    $codigoEmpresa,
    $nombreEmpresa,
    $tipoPlan,
    $precioPlan,
    $productosRestantes,
    $unidadesProducto
  ){
     $this -> codigoEmpresa = $codigoEmpresa;
     $this -> nombreEmpresa = $nombreEmpresa;
     $this -> tipoPlan = $tipoPlan;
     $this -> precioPlan = $precioPlan;
     $this -> productosRestantes = $productosRestantes;
     $this -> unidadesProducto = $unidadesProducto;
  }


  public function guardarPlan(){
    // IDEA: LEEMOS EL ARCHIVO PARA PODER AGREGAR UNA NUEVA EMPRESA
    $contenidoArchivoPlanes = file_get_contents('../data/planes.json');
    $planes= json_decode($contenidoArchivoPlanes,true);

    // IDEA: AQUI SE CREA EL OBEJTO EMPRESA CON LOS ATRIBUTOS A GAURDAR

    $planes[]=array(
    "codigoEmpresa" => $this ->codigoEmpresa,
    "nombreEmpresa" => $this ->nombreEmpresa,
    "tipoPlan" => $this ->tipoPlan,
    "precioPlan" => $this ->precioPlan,
    "productosRestantes" => $this ->productosRestantes,
    "unidadesProducto" => $this ->unidadesProducto
    );

      // IDEA: AQUI SOBREEESCRIBIMOS EL ARCHIVO PARA GUARDAR LA EMPRESA

    $archivoPlanes= fopen("../data/planes.json","w");
    fwrite($archivoPlanes,json_encode($planes));
    fclose($archivoPlanes);

    // IDEA: Inmediatamente se lo guardamos a la empresa
    $contenidoArchivoEmpresas = file_get_contents('../data/empresas.json');
    $empresas = json_decode($contenidoArchivoEmpresas,true);

    for ($i=0; $i<sizeof($empresas);$i++){
      if($empresas[$i]["codigoEmpresa"]== $this->codigoEmpresa){
        echo "se encontro la empresa";
        echo (json_encode($empresas[$i]));

        $empresas[$i]["plan"]= array(
          "tipoPlan" => $this ->tipoPlan,
          "precioPlan" => $this ->precioPlan,
          "productosRestantes" => $this ->productosRestantes,
          "unidadesProducto" => $this ->unidadesProducto
        );

        echo (json_encode($empresas[$i]));

        $archivoEmpresas= fopen('../data/empresas.json','w');
        fwrite($archivoEmpresas,json_encode($empresas));
        fclose($archivoEmpresas);
      }
    }
  }

  public static function obtenerPlanes(){
    $contenidoArchivoPlanes=file_get_contents("../data/planes.json");
    echo  $contenidoArchivoPlanes;
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
     * Get the value of Tipo Plan
     *
     * @return mixed
     */
    public function getTipoPlan()
    {
        return $this->tipoPlan;
    }

    /**
     * Set the value of Tipo Plan
     *
     * @param mixed $tipoPlan
     *
     * @return self
     */
    public function setTipoPlan($tipoPlan)
    {
        $this->tipoPlan = $tipoPlan;

        return $this;
    }

    /**
     * Get the value of Precio Plan
     *
     * @return mixed
     */
    public function getPrecioPlan()
    {
        return $this->precioPlan;
    }

    /**
     * Set the value of Precio Plan
     *
     * @param mixed $precioPlan
     *
     * @return self
     */
    public function setPrecioPlan($precioPlan)
    {
        $this->precioPlan = $precioPlan;

        return $this;
    }

    /**
     * Get the value of Productos Restantes
     *
     * @return mixed
     */
    public function getProductosRestantes()
    {
        return $this->productosRestantes;
    }

    /**
     * Set the value of Productos Restantes
     *
     * @param mixed $productosRestantes
     *
     * @return self
     */
    public function setProductosRestantes($productosRestantes)
    {
        $this->productosRestantes = $productosRestantes;

        return $this;
    }

    /**
     * Get the value of Unidades Producto
     *
     * @return mixed
     */
    public function getUnidadesProducto()
    {
        return $this->unidadesProducto;
    }

    /**
     * Set the value of Unidades Producto
     *
     * @param mixed $unidadesProducto
     *
     * @return self
     */
    public function setUnidadesProducto($unidadesProducto)
    {
        $this->unidadesProducto = $unidadesProducto;

        return $this;
    }

}
 ?>
