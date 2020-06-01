<<?php

class Cliente{

  private $nombreCliente;
  private $apellidoCliente;
  private $emailCliente;
  private $passwordCliente;
  private $paisCliente;
  private $imagenCliente;
  private $fechaNacimientoCliente;
  private $aboutCliente;
  private $facebookCliente;
  private $twitterCliente;
  private $instagramCliente;

  public function __construct(
    $nombreCliente,
    $apellidoCliente,
    $emailCliente,
    $passwordCliente,
    $paisCliente,
    $imagenCliente,
    $fechaNacimientoCliente,
    $aboutCliente,
    $facebookCliente,
    $twitterCliente,
    $instagramCliente
  ){
    $this -> nombreCliente = $nombreCliente;
    $this -> apellidoCliente = $apellidoCliente;
    $this -> emailCliente = $emailCliente;
    $this -> passwordCliente = $passwordCliente;
    $this -> paisCliente = $paisCliente;
    $this -> imagenCliente = $imagenCliente;
    $this -> fechaNacimientoCliente = $fechaNacimientoCliente;
    $this -> aboutCliente = $aboutCliente;
    $this -> facebookCliente = $facebookCliente;
    $this -> twitterCliente = $twitterCliente;
    $this -> instagramCliente = $instagramCliente;
  }

  //CRUD

  public function guardarCliente(){

    if(file_exists('../data/clientes.json')){
      //echo('Si existe el archivo clientes.json');
    }else{
      fopen("../data/clientes.json","w");
      fclose("../data/clientes.json");
      //echo "No existia el archivo, por lo tanto ya se creo";
    }



    // IDEA: LEEMOS EL ARCHIVO PARA PODER AGREGAR UN NUEVO CLIENTE
    $contenidoArchivoClientes = file_get_contents('../data/clientes.json');
    $clientes= json_decode($contenidoArchivoClientes,true);
    $codigoCliente=uniqid('cliente_');
    // IDEA: AQUI SE CREA EL OBEJTO CLIENTE CON LOS ATRIBUTOS A GAURDAR
    $clientes[]=array(

    "codigoCliente" => $codigoCliente,
    "nombreCliente" => $this ->nombreCliente,
    "apellidoCliente" => $this ->apellidoCliente,
    "emailCliente" => $this ->emailCliente,
    "passwordCliente" => $this ->passwordCliente,
    "paisCliente" => $this ->paisCliente,
    "imagenCliente" => $this ->imagenCliente,
    "fechaNacimientoCliente" => $this ->fechaNacimientoCliente,
    "aboutCliente" => $this ->aboutCliente,
    "redesSocialesCliente" => array(array("facebookCliente" => $this ->facebookCliente, "twitterCliente" => $this ->twitterCliente, "instagramCliente" => $this ->instagramCliente)),
    );

      // IDEA: AQUI SOBREEESCRIBIMOS EL ARCHIVO PARA GUARDAR EL CLIENTE

    $archivoClientes= fopen("../data/clientes.json","w");
    fwrite($archivoClientes,json_encode($clientes));
    fclose($archivoClientes);


  }


  public static function obtenerClientes(){
    $contenidoArchivoClientes=file_get_contents("../data/clientes.json");
    echo ($contenidoArchivoClientes);
  }

  public static function obtenerCliente($idCliente){
    $contenidoArchivoClientes= file_get_contents('../data/clientes.json');
    $clientes= json_decode($contenidoArchivoClientes,true);

    for($i=0; $i<sizeof($clientes); $i++){
      if($clientes[$i]["codigoCliente"]== $idCliente){
        echo (json_encode($clientes[$i]));
      }
    }

  }



  public function actualizarCliente($idCliente){
      $contenidoArchivoClientes = file_get_contents('../data/clientes.json');
      $clientes = json_decode($contenidoArchivoClientes,true);


      for($i=0; $i<sizeof($clientes); $i++){
        if($clientes[$i]["codigoCliente"]== $idCliente){

          //guardo el codigo que tenia la empresa antes de actualizar dicha Informacion
          $codigoClienteGuardar = $clientes[$i]["codigoCliente"];

          $clientes[$i]["codigoCliente"] = $codigoClienteGuardar;
          $clientes[$i]["nombreCliente"] = $this ->nombreCliente;
          $clientes[$i]["apellidoCliente"] = $this ->apellidoCliente;
          $clientes[$i]["emailCliente"] = $this ->emailCliente;
          $clientes[$i]["passwordCliente"] = $this ->passwordCliente;
          $clientes[$i]["paisCliente"] = $this ->paisCliente;
          $clientes[$i]["imagenCliente"] = $this ->imagenCliente;
          $clientes[$i]["fechaNacimientoCliente"] = $this ->fechaNacimientoCliente;
          $clientes[$i]["aboutCliente"] = $this ->aboutCliente;
          $clientes[$i]["redesSocialesCliente"] = array(array("facebookCliente" => $this ->facebookCliente, "twitterCliente" => $this ->twitterCliente, "instagramCliente" => $this ->instagramCliente));

          // IDEA: AQUI SOBREEESCRIBIMOS EL ARCHIVO PARA ACTUALIZAR LA EMPRESA

          $archivoClientes= fopen("../data/clientes.json","w");
          fwrite($archivoClientes,json_encode($clientes));
          fclose($archivoClientes);
        }
      }

  }



    public static function eliminarCliente($idCliente){
      $contenidoArchivoClientes= file_get_contents('../data/clientes.json');
      $clientes=json_decode($contenidoArchivoClientes,true);

      for($i=0; $i<sizeof($clientes); $i++){
        if($clientes[$i]["codigoCliente"] == $idCliente){
          echo "el cliente a eliminar: ";
          echo json_encode($clientes[$i]);

          array_splice($clientes,$i,1);

          $archivoClientes= fopen("../data/clientes.json","w");
          fwrite($archivoClientes,json_encode($clientes));
          fclose($archivoClientes);

          break;
        }
    }

    }


    /**
     * Get the value of Nombre Cliente
     *
     * @return mixed
     */
    public function getNombreCliente()
    {
        return $this->nombreCliente;
    }

    /**
     * Set the value of Nombre Cliente
     *
     * @param mixed $nombreCliente
     *
     * @return self
     */
    public function setNombreCliente($nombreCliente)
    {
        $this->nombreCliente = $nombreCliente;

        return $this;
    }

    /**
     * Get the value of Apellido Cliente
     *
     * @return mixed
     */
    public function getApellidoCliente()
    {
        return $this->apellidoCliente;
    }

    /**
     * Set the value of Apellido Cliente
     *
     * @param mixed $apellidoCliente
     *
     * @return self
     */
    public function setApellidoCliente($apellidoCliente)
    {
        $this->apellidoCliente = $apellidoCliente;

        return $this;
    }

    /**
     * Get the value of Email Cliente
     *
     * @return mixed
     */
    public function getEmailCliente()
    {
        return $this->emailCliente;
    }

    /**
     * Set the value of Email Cliente
     *
     * @param mixed $emailCliente
     *
     * @return self
     */
    public function setEmailCliente($emailCliente)
    {
        $this->emailCliente = $emailCliente;

        return $this;
    }

    /**
     * Get the value of Password Cliente
     *
     * @return mixed
     */
    public function getPasswordCliente()
    {
        return $this->passwordCliente;
    }

    /**
     * Set the value of Password Cliente
     *
     * @param mixed $passwordCliente
     *
     * @return self
     */
    public function setPasswordCliente($passwordCliente)
    {
        $this->passwordCliente = $passwordCliente;

        return $this;
    }

    /**
     * Get the value of Pais Cliente
     *
     * @return mixed
     */
    public function getPaisCliente()
    {
        return $this->paisCliente;
    }

    /**
     * Set the value of Pais Cliente
     *
     * @param mixed $paisCliente
     *
     * @return self
     */
    public function setPaisCliente($paisCliente)
    {
        $this->paisCliente = $paisCliente;

        return $this;
    }

    /**
     * Get the value of Imagen Cliente
     *
     * @return mixed
     */
    public function getImagenCliente()
    {
        return $this->imagenCliente;
    }

    /**
     * Set the value of Imagen Cliente
     *
     * @param mixed $imagenCliente
     *
     * @return self
     */
    public function setImagenCliente($imagenCliente)
    {
        $this->imagenCliente = $imagenCliente;

        return $this;
    }

    /**
     * Get the value of Fecha Nacimiento Cliente
     *
     * @return mixed
     */
    public function getFechaNacimientoCliente()
    {
        return $this->fechaNacimientoCliente;
    }

    /**
     * Set the value of Fecha Nacimiento Cliente
     *
     * @param mixed $fechaNacimientoCliente
     *
     * @return self
     */
    public function setFechaNacimientoCliente($fechaNacimientoCliente)
    {
        $this->fechaNacimientoCliente = $fechaNacimientoCliente;

        return $this;
    }

    /**
     * Get the value of About Cliente
     *
     * @return mixed
     */
    public function getAboutCliente()
    {
        return $this->aboutCliente;
    }

    /**
     * Set the value of About Cliente
     *
     * @param mixed $aboutCliente
     *
     * @return self
     */
    public function setAboutCliente($aboutCliente)
    {
        $this->aboutCliente = $aboutCliente;

        return $this;
    }

    /**
     * Get the value of Facebook Cliente
     *
     * @return mixed
     */
    public function getFacebookCliente()
    {
        return $this->facebookCliente;
    }

    /**
     * Set the value of Facebook Cliente
     *
     * @param mixed $facebookCliente
     *
     * @return self
     */
    public function setFacebookCliente($facebookCliente)
    {
        $this->facebookCliente = $facebookCliente;

        return $this;
    }

    /**
     * Get the value of Twitter Cliente
     *
     * @return mixed
     */
    public function getTwitterCliente()
    {
        return $this->twitterCliente;
    }

    /**
     * Set the value of Twitter Cliente
     *
     * @param mixed $twitterCliente
     *
     * @return self
     */
    public function setTwitterCliente($twitterCliente)
    {
        $this->twitterCliente = $twitterCliente;

        return $this;
    }

    /**
     * Get the value of Instagram Cliente
     *
     * @return mixed
     */
    public function getInstagramCliente()
    {
        return $this->instagramCliente;
    }

    /**
     * Set the value of Instagram Cliente
     *
     * @param mixed $instagramCliente
     *
     * @return self
     */
    public function setInstagramCliente($instagramCliente)
    {
        $this->instagramCliente = $instagramCliente;

        return $this;
    }

}




 ?>
