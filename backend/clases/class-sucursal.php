<?php

  class Sucursal{
    private $codigoEmpresa;
    private $nombreEmpresa;
    private $nombreSucursal;
    private $longitudSucursal;
    private $latitudSucursal;
    private $direccionSucursal;

  public function __construct(
    $codigoEmpresa,
    $nombreEmpresa,
    $nombreSucursal,
    $longitudSucursal,
    $latitudSucursal,
    $direccionSucursal

  ){
    $this -> codigoEmpresa   = $codigoEmpresa;
    $this -> nombreEmpresa   = $nombreEmpresa;
    $this -> nombreSucursal   = $nombreSucursal;
    $this -> longitudSucursal   = $longitudSucursal;
    $this -> latitudSucursal   = $latitudSucursal;
    $this -> direccionSucursal   = $direccionSucursal;

  }

  public function guardarSucursal(){

    if(file_exists('../data/sucursales.json')){
      //echo('Si existe el archivo sucursales.json');
    }else{
      fopen("../data/sucursales.json","w");
      fclose("../data/sucursales.json");
      //echo "No existia el archivo, por lo tanto ya se creo";
    }


    // IDEA: LEEMOS EL ARCHIVO PARA PODER AGREGAR UNA NUEVA SUCURSAL
    $contenidoArchivoSucursales = file_get_contents('../data/sucursales.json');
    $sucursales= json_decode($contenidoArchivoSucursales,true);

    // IDEA: AQUI SE CREA EL OBJETO SUCURSAL  CON LOS ATRIBUTOS A GAURDAR
    $codigoSucursal= uniqid('sucursal_');

    $sucursales[]=array(

      "codigoSucursal" => $codigoSucursal,
      "codigoEmpresa" => $this ->codigoEmpresa,
      "nombreEmpresa" => $this ->nombreEmpresa,
      "nombreSucursal" => $this ->nombreSucursal,
      "longitudSucursal" => $this ->longitudSucursal,
      "latitudSucursal" => $this ->latitudSucursal,
      "direccionSucursal" => $this ->direccionSucursal
    );

    // IDEA: AQUI SOBREEESCRIBIMOS EL ARCHIVO PARA GUARDAR LA SUCURSAL

  $archivoSucursales= fopen("../data/sucursales.json","w");
  fwrite($archivoSucursales,json_encode($sucursales));
  fclose($archivoSucursales);

  // IDEA: Inmediatamente se lo guardamos a la empresa
  $contenidoArchivoEmpresas = file_get_contents('../data/empresas.json');
  $empresas = json_decode($contenidoArchivoEmpresas,true);

  for ($i=0; $i<sizeof($empresas);$i++){
    if($empresas[$i]["codigoEmpresa"]== $this->codigoEmpresa){
      //echo "se encontro la empresa";
      //echo (json_encode($empresas[$i]));

      $empresas[$i]["sucursales"][]= array(
        "codigoSucursal" => $codigoSucursal,
        "codigoEmpresa" => $this ->codigoEmpresa,
        "nombreEmpresa" => $this ->nombreEmpresa,
        "nombreSucursal" => $this ->nombreSucursal,
        "longitudSucursal" => $this ->longitudSucursal,
        "latitudSucursal" => $this ->latitudSucursal,
        "direccionSucursal" => $this ->direccionSucursal

      );

      //echo (json_encode($empresas[$i]));

      $archivoEmpresas= fopen('../data/empresas.json','w');
      fwrite($archivoEmpresas,json_encode($empresas));
      fclose($archivoEmpresas);
      }
    }
  }



  public static function obtenerSucursales(){
    $contenidoArchivoSucursales=file_get_contents("../data/sucursales.json");
    echo  $contenidoArchivoSucursales;
  }



  public static function obtenerSucursal($idSucursal){
    $contenidoArchivoSucursales= file_get_contents('../data/sucursales.json');
    $sucursales= json_decode($contenidoArchivoSucursales,true);

    for($i=0; $i<sizeof($sucursales); $i++){
      if($sucursales[$i]["codigoSucursal"]== $idSucursal){
        echo json_encode($sucursales[$i]);
      }
    }

  }

  public function actualizarSucursal($idSucursal){
    $contenidoArchivoSucursales = file_get_contents('../data/sucursales.json');
    $sucursales= json_decode($contenidoArchivoSucursales,true);

    echo "La sucursal contenía esta informacion: ";


    for($i=0; $i<sizeof($sucursales); $i++){
      if($sucursales[$i]["codigoSucursal"]== $idSucursal){
        //guardo el codigo que tenia la sucursal antes de actualizar dicha Informacion
        $codigoSucursalGuardar = $sucursales[$i]["codigoSucursal"];

        $sucursales[$i]["codigoSucursal"] = $codigoSucursalGuardar;
        $sucursales[$i]["codigoEmpresa"] = $this ->codigoEmpresa;
        $sucursales[$i]["nombreEmpresa"] = $this ->nombreEmpresa;
        $sucursales[$i]["nombreSucursal"] = $this ->nombreSucursal;
        $sucursales[$i]["longitudSucursal"] = $this ->longitudSucursal;
        $sucursales[$i]["latitudSucursal"] = $this ->latitudSucursal;
        $sucursales[$i]["direccionSucursal"] = $this ->direccionSucursal;


        // IDEA: AQUI SOBREEESCRIBIMOS EL ARCHIVO PARA actualizar la sucursal
        $archivoSucursales= fopen("../data/sucursales.json","w");
        fwrite($archivoSucursales,json_encode($sucursales));
        fclose($archivoSucursales);
      }
    }

    //AHORA toca actualizar los productos dentro del empresas.json
    $contenidoArchivoEmpresas = file_get_contents('../data/empresas.json');
    $empresas = json_decode($contenidoArchivoEmpresas,true);

    for ($i=0; $i<sizeof($empresas);$i++){
      if($empresas[$i]["codigoEmpresa"]== $this->codigoEmpresa){
        echo "se encontro la empresa con la que sera su vieja informacion";
        echo (json_encode($empresas[$i]));

        $sucursalesArrayEmpresa = $empresas[$i]["sucursales"];

        for ($j=0; $j < sizeof($sucursalesArrayEmpresa) ; $j++) {

          if($sucursalesArrayEmpresa[$j]["codigoSucursal"]==$codigoSucursalGuardar){

            $empresas[$i]["sucursales"][$j]["codigoSucursal"] = $codigoSucursalGuardar;
            $empresas[$i]["sucursales"][$j]["codigoEmpresa"] = $this ->codigoEmpresa;
            $empresas[$i]["sucursales"][$j]["nombreEmpresa"] = $this ->nombreEmpresa;
            $empresas[$i]["sucursales"][$j]["nombreSucursal"] = $this ->nombreSucursal;
            $empresas[$i]["sucursales"][$j]["longitudSucursal"] = $this ->longitudSucursal;
            $empresas[$i]["sucursales"][$j]["latitudSucursal"] = $this ->latitudSucursal;
            $empresas[$i]["sucursales"][$j]["direccionSucursal"] = $this ->direccionSucursal;


            echo "se actualizo la informacion de la sucursal de la empresa <br>";

            $archivoEmpresas= fopen("../data/empresas.json","w");
            fwrite($archivoEmpresas,json_encode($empresas));
            fclose($archivoEmpresas);
          }
        }

      }
    }


  }


  public static function eliminarSucursal($idSucursal){
    $contenidoArchivoSucursales= file_get_contents('../data/sucursales.json');
    $sucursales= json_decode($contenidoArchivoSucursales,true);

    for($i=0; $i<sizeof($sucursales); $i++){
      if($sucursales[$i]["codigoSucursal"]== $idSucursal){
        $sucursalEliminarse= $sucursales[$i];
        $indiceSucursalEliminarse= $i;
      }
    }

    // IDEA: Eliminaremos Inmediatamente LA SUCURSAL EN SU Empresa
    $contenidoArchivoEmpresas= file_get_contents('../data/empresas.json');
    $empresas = json_decode($contenidoArchivoEmpresas,true);

    for($i=0; $i<sizeof($empresas);$i++){
      if($empresas[$i]["codigoEmpresa"]== $sucursalEliminarse["codigoEmpresa"]){
        echo "Se encontro la sucursal";
        echo (json_encode($empresas[$i]));

        if(array_key_exists("sucursales", $empresas[$i])){

          $sucursalesArrayEmpresa = $empresas[$i]["sucursales"];

          for ($j=0; $j < sizeof($sucursalesArrayEmpresa) ; $j++) {

            if($sucursalesArrayEmpresa[$j]["codigoSucursal"]==$sucursalEliminarse["codigoSucursal"]){

              array_splice($empresas[$i]["sucursales"], $j ,1);

              echo "se borro la sucursal de la empresa <br>";

              $archivoEmpresas= fopen("../data/empresas.json","w");
              fwrite($archivoEmpresas,json_encode($empresas));
              fclose($archivoEmpresas);
            }
          }
        }

      }
    }

    //array_splice (array productos, indice sucursal , elementos a eliminar a partir del indice)
    array_splice($sucursales,$indiceSucursalEliminarse,1);

    $archivoSucursales= fopen("../data/sucursales.json","w");
    fwrite($archivoSucursales,json_encode($sucursales));
    fclose($archivoSucursales);
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
     * Get the value of Nombre Sucursal
     *
     * @return mixed
     */
    public function getNombreSucursal()
    {
        return $this->nombreSucursal;
    }

    /**
     * Set the value of Nombre Sucursal
     *
     * @param mixed $nombreSucursal
     *
     * @return self
     */
    public function setNombreSucursal($nombreSucursal)
    {
        $this->nombreSucursal = $nombreSucursal;

        return $this;
    }

    /**
     * Get the value of Longitud Sucursal
     *
     * @return mixed
     */
    public function getLongitudSucursal()
    {
        return $this->longitudSucursal;
    }

    /**
     * Set the value of Longitud Sucursal
     *
     * @param mixed $longitudSucursal
     *
     * @return self
     */
    public function setLongitudSucursal($longitudSucursal)
    {
        $this->longitudSucursal = $longitudSucursal;

        return $this;
    }

    /**
     * Get the value of Latitud Sucursal
     *
     * @return mixed
     */
    public function getLatitudSucursal()
    {
        return $this->latitudSucursal;
    }

    /**
     * Set the value of Latitud Sucursal
     *
     * @param mixed $latitudSucursal
     *
     * @return self
     */
    public function setLatitudSucursal($latitudSucursal)
    {
        $this->latitudSucursal = $latitudSucursal;

        return $this;
    }

    /**
     * Get the value of Direccion Sucursal
     *
     * @return mixed
     */
    public function getDireccionSucursal()
    {
        return $this->direccionSucursal;
    }

    /**
     * Set the value of Direccion Sucursal
     *
     * @param mixed $direccionSucursal
     *
     * @return self
     */
    public function setDireccionSucursal($direccionSucursal)
    {
        $this->direccionSucursal = $direccionSucursal;

        return $this;
    }

}


 ?>
