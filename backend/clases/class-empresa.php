<?php
  class Empresa{
    private $nombreEmpresa;
    private $emailEmpresa;
    private $passwordEmpresa;
    private $paisEmpresa;
    private $longitudEmpresa;
    private $latitudEmpresa;
    private $bannerEmpresa;
    private $logoEmpresa;
    private $facebookEmpresa;
    private $twitterEmpresa;
    private $instagramEmpresa;
    private $descripcionEmpresa;

    public function __construct(
    $nombreEmpresa,
    $emailEmpresa,
    $passwordEmpresa,
    $paisEmpresa,
    $longitudEmpresa,
    $latitudEmpresa,
    $bannerEmpresa,
    $logoEmpresa,
    $facebookEmpresa,
    $twitterEmpresa,
    $instagramEmpresa,
    $descripcionEmpresa
    ){

    $this -> nombreEmpresa= $nombreEmpresa;
    $this -> emailEmpresa= $emailEmpresa;
    $this -> passwordEmpresa= $passwordEmpresa;
    $this -> paisEmpresa= $paisEmpresa;
    $this -> longitudEmpresa= $longitudEmpresa;
    $this -> latitudEmpresa= $latitudEmpresa;
    $this -> bannerEmpresa= $bannerEmpresa;
    $this -> logoEmpresa= $logoEmpresa;
    $this -> facebookEmpresa= $facebookEmpresa;
    $this -> twitterEmpresa= $twitterEmpresa;
    $this -> instagramEmpresa= $instagramEmpresa;

    $this -> descripcionEmpresa= $descripcionEmpresa;

    }


    //CRUD

  public function guardarEmpresa(){

    // IDEA: LEEMOS EL ARCHIVO PARA PODER AGREGAR UNA NUEVA EMPRESA
    $contenidoArchivoEmpresas = file_get_contents('../data/empresas.json');
    $empresas= json_decode($contenidoArchivoEmpresas,true);
    $codigoEmpresa=uniqid('empresa_');
    // IDEA: AQUI SE CREA EL OBEJTO EMPRESA CON LOS ATRIBUTOS A GAURDAR
    $empresas[]=array(

    "codigoEmpresa" => $codigoEmpresa,
    "nombreEmpresa" => $this ->nombreEmpresa,
    "emailEmpresa" => $this ->emailEmpresa,
    "passwordEmpresa" => $this ->passwordEmpresa,
    "paisEmpresa" => $this ->paisEmpresa,
    "longitudEmpresa" => $this ->longitudEmpresa,
    "latitudEmpresa" => $this ->latitudEmpresa,
    "bannerEmpresa" => $this ->bannerEmpresa,
    "logoEmpresa" => $this ->logoEmpresa,
    "redesSocialesEmpresa" => array(array("facebookEmpresa" => $this ->facebookEmpresa, "twitterEmpresa" => $this ->twitterEmpresa, "instagramEmpresa" => $this ->instagramEmpresa)),
    "descripcionEmpresa" => $this ->descripcionEmpresa
    );

      // IDEA: AQUI SOBREEESCRIBIMOS EL ARCHIVO PARA GUARDAR LA EMPRESA

    $archivoEmpresas= fopen("../data/empresas.json","w");
    fwrite($archivoEmpresas,json_encode($empresas));
    fclose($archivoEmpresas);

    echo(json_encode());
  }

  public static function obtenerEmpresas(){
    $contenidoArchivoEmpresas=file_get_contents("../data/empresas.json");
    echo  $contenidoArchivoEmpresas;
  }

  public static function obtenerEmpresa($idEmpresa){
    $contenidoArchivoEmpresas= file_get_contents('../data/empresas.json');
    $empresas= json_decode($contenidoArchivoEmpresas,true);

    for($i=0; $i<sizeof($empresas); $i++){
      if($empresas[$i]["codigoEmpresa"]== $idEmpresa){
        echo json_encode($empresas[$i]);
      }
    }

  }


  public function actualizarEmpresa($idEmpresa){
      $contenidoArchivoEmpresas = file_get_contents('../data/empresas.json');
      $empresas = json_decode($contenidoArchivoEmpresas,true);

      echo "La empresa contenia esta informacion: ";

      for($i=0; $i<sizeof($empresas); $i++){
        if($empresas[$i]["codigoEmpresa"]== $idEmpresa){

          //guardo el codigo que tenia la empresa antes de actualizar dicha Informacion
          $codigoEmpresaGuardar = $empresas[$i]["codigoEmpresa"];

          $empresa = array(

            "codigoEmpresa" => $codigoEmpresaGuardar,
            "nombreEmpresa" => $this ->nombreEmpresa,
            "emailEmpresa" => $this ->emailEmpresa,
            "passwordEmpresa" => $this ->passwordEmpresa,
            "paisEmpresa" => $this ->paisEmpresa,
            "longitudEmpresa" => $this ->longitudEmpresa,
            "latitudEmpresa" => $this ->latitudEmpresa,
            "bannerEmpresa" => $this ->bannerEmpresa,
            "logoEmpresa" => $this ->logoEmpresa,
            "redesSocialesEmpresa" => array(array("facebookEmpresa" => $this ->facebookEmpresa, "twitterEmpresa" => $this ->twitterEmpresa, "instragramEmpresa" => $this ->instagramEmpresa)),
            "descripcionEmpresa" => $this ->descripcionEmpresa
          );

          $empresas[$i]= $empresa;

          // IDEA: AQUI SOBREEESCRIBIMOS EL ARCHIVO PARA ACTUALIZAR LA EMPRESA

          $archivoEmpresas= fopen("../data/empresas.json","w");
          fwrite($archivoEmpresas,json_encode($empresas));
          fclose($archivoEmpresas);
        }
      }

  }


  public static function eliminarEmpresa($idEmpresa){
    $contenidoArchivoEmpresas= file_get_contents('../data/empresas.json');
    $empresas=json_decode($contenidoArchivoEmpresas,true);

    for($i=0; $i<sizeof($empresas); $i++){
      if($empresas[$i]["codigoEmpresa"]== $idEmpresa){
        echo "La empresa a eliminar: ";
        echo json_encode($empresas[$i]);

        array_splice($empresas,$i,1);

        $archivoEmpresas= fopen("../data/empresas.json","w");
        fwrite($archivoEmpresas,json_encode($empresas));
        fclose($archivoEmpresas);
      }else{
        echo ("No existe la empresa con el id: ".$idEmpresa);
      }
    }

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
     * Get the value of Email Empresa
     *
     * @return mixed
     */
    public function getEmailEmpresa()
    {
        return $this->emailEmpresa;
    }

    /**
     * Set the value of Email Empresa
     *
     * @param mixed $emailEmpresa
     *
     * @return self
     */
    public function setEmailEmpresa($emailEmpresa)
    {
        $this->emailEmpresa = $emailEmpresa;

        return $this;
    }

    /**
     * Get the value of Password Empresa
     *
     * @return mixed
     */
    public function getPasswordEmpresa()
    {
        return $this->passwordEmpresa;
    }

    /**
     * Set the value of Password Empresa
     *
     * @param mixed $passwordEmpresa
     *
     * @return self
     */
    public function setPasswordEmpresa($passwordEmpresa)
    {
        $this->passwordEmpresa = $passwordEmpresa;

        return $this;
    }

    /**
     * Get the value of Pais Empresa
     *
     * @return mixed
     */
    public function getPaisEmpresa()
    {
        return $this->paisEmpresa;
    }

    /**
     * Set the value of Pais Empresa
     *
     * @param mixed $paisEmpresa
     *
     * @return self
     */
    public function setPaisEmpresa($paisEmpresa)
    {
        $this->paisEmpresa = $paisEmpresa;

        return $this;
    }

    /**
     * Get the value of Longitud Empresa
     *
     * @return mixed
     */
    public function getLongitudEmpresa()
    {
        return $this->longitudEmpresa;
    }

    /**
     * Set the value of Longitud Empresa
     *
     * @param mixed $longitudEmpresa
     *
     * @return self
     */
    public function setLongitudEmpresa($longitudEmpresa)
    {
        $this->longitudEmpresa = $longitudEmpresa;

        return $this;
    }

    /**
     * Get the value of Latitud Empresa
     *
     * @return mixed
     */
    public function getLatitudEmpresa()
    {
        return $this->latitudEmpresa;
    }

    /**
     * Set the value of Latitud Empresa
     *
     * @param mixed $latitudEmpresa
     *
     * @return self
     */
    public function setLatitudEmpresa($latitudEmpresa)
    {
        $this->latitudEmpresa = $latitudEmpresa;

        return $this;
    }

    /**
     * Get the value of Banner Empresa
     *
     * @return mixed
     */
    public function getBannerEmpresa()
    {
        return $this->bannerEmpresa;
    }

    /**
     * Set the value of Banner Empresa
     *
     * @param mixed $bannerEmpresa
     *
     * @return self
     */
    public function setBannerEmpresa($bannerEmpresa)
    {
        $this->bannerEmpresa = $bannerEmpresa;

        return $this;
    }

    /**
     * Get the value of Logo Empresa
     *
     * @return mixed
     */
    public function getLogoEmpresa()
    {
        return $this->logoEmpresa;
    }

    /**
     * Set the value of Logo Empresa
     *
     * @param mixed $logoEmpresa
     *
     * @return self
     */
    public function setLogoEmpresa($logoEmpresa)
    {
        $this->logoEmpresa = $logoEmpresa;

        return $this;
    }

    /**
     * Get the value of Facebook Empresa
     *
     * @return mixed
     */
    public function getFacebookEmpresa()
    {
        return $this->facebookEmpresa;
    }

    /**
     * Set the value of Facebook Empresa
     *
     * @param mixed $facebookEmpresa
     *
     * @return self
     */
    public function setFacebookEmpresa($facebookEmpresa)
    {
        $this->facebookEmpresa = $facebookEmpresa;

        return $this;
    }

    /**
     * Get the value of Twitter Empresa
     *
     * @return mixed
     */
    public function getTwitterEmpresa()
    {
        return $this->twitterEmpresa;
    }

    /**
     * Set the value of Twitter Empresa
     *
     * @param mixed $twitterEmpresa
     *
     * @return self
     */
    public function setTwitterEmpresa($twitterEmpresa)
    {
        $this->twitterEmpresa = $twitterEmpresa;

        return $this;
    }

    /**
     * Get the value of Instagram Empresa
     *
     * @return mixed
     */
    public function getInstagramEmpresa()
    {
        return $this->instagramEmpresa;
    }

    /**
     * Set the value of Instagram Empresa
     *
     * @param mixed $instagramEmpresa
     *
     * @return self
     */
    public function setInstagramEmpresa($instagramEmpresa)
    {
        $this->instagramEmpresa = $instagramEmpresa;

        return $this;
    }

    /**
     * Get the value of Descripcion Empresa
     *
     * @return mixed
     */
    public function getDescripcionEmpresa()
    {
        return $this->descripcionEmpresa;
    }

    /**
     * Set the value of Descripcion Empresa
     *
     * @param mixed $descripcionEmpresa
     *
     * @return self
     */
    public function setDescripcionEmpresa($descripcionEmpresa)
    {
        $this->descripcionEmpresa = $descripcionEmpresa;

        return $this;
    }




}

 ?>
