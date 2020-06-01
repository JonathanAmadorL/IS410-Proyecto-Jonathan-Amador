<?php

class Favorito{
  private $codigoEmpresa;
  private $codigoCliente;

  public function __construct(
    $codigoEmpresa,
    $codigoCliente
  ){
    $this -> codigoEmpresa= $codigoEmpresa;
    $this -> codigoCliente= $codigoCliente;

  }

  public static function guardarFavorito($idCliente, $idEmpresa){
    $contenidoArchivoClientes = file_get_contents('../data/clientes.json');
    $clientes= json_decode($contenidoArchivoClientes,true);

    for($i=0; $i<sizeof($clientes); $i++){
      if($clientes[$i]["codigoCliente"]== $idCliente){
        $clientes[$i]["empresasFavoritas"][] = $idEmpresa;

        $archivoClientes= fopen("../data/clientes.json","w");
        fwrite($archivoClientes,json_encode($clientes));
        fclose($archivoClientes);
      }
    }

    // IDEA: AHORA GUARDAREMOS EN LA EMPRESA SUS SEGUIDORES

    $contenidoArchivoEmpresas = file_get_contents('../data/empresas.json');
    $empresas= json_decode($contenidoArchivoEmpresas,true);

    for($i=0; $i<sizeof($empresas); $i++){
      if($empresas[$i]["codigoEmpresa"] == $idEmpresa){
        $empresas[$i]["seguidores"][] = $idCliente;

          $archivoEmpresas= fopen("../data/empresas.json","w");
          fwrite($archivoEmpresas,json_encode($empresas));
          fclose($archivoEmpresas);

      }
    }

  }


  public static function eliminarFavorito($idCliente, $idEmpresa){
    $contenidoArchivoClientes = file_get_contents('../data/clientes.json');
    $clientes= json_decode($contenidoArchivoClientes,true);

    for($i=0; $i<sizeof($clientes); $i++){
      if($clientes[$i]["codigoCliente"]== $idCliente){
        for($j=0; $j<sizeof($clientes[$i]["empresasFavoritas"]); $j++){
          if($clientes[$i]["empresasFavoritas"][$j] == $idEmpresa){

            array_splice( $clientes[$i]["empresasFavoritas"] , $j , 1);

            $archivoClientes= fopen("../data/clientes.json","w");
            fwrite($archivoClientes,json_encode($clientes));
            fclose($archivoClientes);
          }
        }
      }
    }

    // IDEA: AHORA ELIMINAREMOS DE LOS SEGUIORES DE LA EMPRESA

    $contenidoArchivoEmpresas = file_get_contents('../data/empresas.json');
    $empresas= json_decode($contenidoArchivoEmpresas,true);

    for($i=0; $i<sizeof($empresas); $i++){
      if($empresas[$i]["codigoEmpresa"]== $idEmpresa){
        for($j=0; $j<sizeof($empresas[$i]["seguidores"]); $j++){
          if($empresas[$i]["seguidores"][$j] == $idCliente){

            array_splice( $empresas[$i]["seguidores"] , $j , 1);

            $archivoEmpresas= fopen("../data/empresas.json","w");
            fwrite($archivoEmpresas,json_encode($empresas));
            fclose($archivoEmpresas);
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

}


?>
