<?php
  class Comentario{
    private $codigoCliente;
    private $codigoProducto;
    private $nombreCliente;
    private $contenido;
    private $imagenCliente;

    public function __construct(
      $codigoCliente,
      $codigoProducto,
      $nombreCliente,
      $contenido,
      $imagenCliente
    ){

      $this -> codigoCliente = $codigoCliente;
      $this -> codigoProducto = $codigoProducto;
      $this -> nombreCliente = $nombreCliente;
      $this -> contenido = $contenido;
      $this -> imagenCliente = $imagenCliente;

    }


    public function guardarComentario(){

      $contenidoArchivoComentarios = file_get_contents('../data/comentarios.json');
      $comentarios = json_decode($contenidoArchivoComentarios,true);

      $codigoComentario= uniqid('comentario_');

      $comentarios[]= array(
        "codigoComentario" => $codigoComentario,
        "codigoCliente" => $this ->codigoCliente,
        "codigoProducto" => $this ->codigoProducto,
        "nombreCliente" => $this ->nombreCliente,
        "contenido" => $this ->contenido,
        "imagenCliente" => $this ->imagenCliente

      );

      $archivoComentarios= fopen("../data/comentarios.json","w");
      fwrite($archivoComentarios,json_encode($comentarios));
      fclose($archivoComentarios);


      // IDEA: GUARDAREMOS Inmediatamente EL COMENTARIO EN DICHO PRODUCTO
      $contenidoArchivoProductos= file_get_contents('../data/productos.json');
      $productos = json_decode($contenidoArchivoProductos,true);


      for($i=0; $i<sizeof($productos);$i++){
        if($productos[$i]["codigoProducto"]== $this->codigoProducto){
          echo "Se encontro el producto";
          echo (json_encode($productos[$i]));

          $productos[$i]["comentarios"][]=array(
            "codigoComentario" => $codigoComentario,
            "codigoCliente" => $this ->codigoCliente,
            "nombreCliente" => $this ->nombreCliente,
            "contenido" => $this ->contenido,
            "imagenCliente" => $this ->imagenCliente
          );

          echo "se agrego el comentario <br>";
          echo (json_encode($productos[$i]));

          $archivoProductos= fopen('../data/productos.json','w');
          fwrite($archivoProductos,json_encode($productos));
          fclose($archivoProductos);

        }
      }


      // IDEA: Ocupamos guardarlo en el json de empresas tambien.... no se si es lo ideal
      $contenidoArchivoEmpresas = file_get_contents('../data/empresas.json');
      $empresas = json_decode($contenidoArchivoEmpresas,true);

      //PRIMERO Recorreros cada empresa del empresas.json

      for ($i=0; $i<sizeof($empresas);$i++){

          //Ahora verificamos si en la empresa en interacion existe la clave/atributo llamado "productos"
          if(array_key_exists("productos", $empresas[$i])){

            //En caso de que exista guardamos el array de productos en una variable (por comodidad)
            $productosArrayEmpresa = $empresas[$i]["productos"];

            //recorremos ese arreglo
            for($j=0; $j<sizeof($productosArrayEmpresa);$j++){
              //verificamos si el codigoProducto de el producto en iteracion es igual al enviado en el comentario
              if($productosArrayEmpresa[$j]["codigoProducto"]==$this->codigoProducto){

                //en caso de serlo guardamos el comentario en la siguiente posicion:
                //cabe destacar que $j es el indice del producto en el arreglo "productos"
                //a ese producto con indice $j creamos el atributo "comentarios" que sera un array
                //los indices del arreglo comentarios se asignan automaticamen por el []
                $empresas[$i]["productos"][$j]["comentarios"][]= array(
                  "codigoComentario" => $codigoComentario,
                  "codigoCliente" => $this ->codigoCliente,
                  "nombreCliente" => $this ->nombreCliente,
                  "contenido" => $this ->contenido,
                  "imagenCliente" => $this ->imagenCliente
                );

                echo "JSON de empresa con los comentarios de su respectivo producto <br>";

                echo (json_encode($empresas[$i]));

                //modificamos el archivo empresa...pero solamente modificara la empresa que paso por los for
                $archivoEmpresas= fopen('../data/empresas.json','w');
                fwrite($archivoEmpresas,json_encode($empresas));
                fclose($archivoEmpresas);
              }
            }
          }


      }

    }


    public static function obtenerComentarios(){
      $contenidoArchivoComentarios= file_get_contents('../data/comentarios.json');
      echo $contenidoArchivoComentarios;
    }

    public static function obtenerComentario($idComentario){
      $contenidoArchivoComentarios= file_get_contents('../data/comentarios.json');
      $comentarios= json_decode($contenidoArchivoComentarios,true);

      for($i=0; $i<sizeof($comentarios); $i++){
        if($comentarios[$i]["codigoComentario"]== $idComentario){
          echo json_encode($comentarios[$i]);
        }
      }

    }




    public function actualizarComentario($idComentario){
      $contenidoArchivoComentarios = file_get_contents('../data/comentarios.json');
      $comentarios = json_decode($contenidoArchivoComentarios,true);

      echo "El comentario contenía esta informacion: ";

      for($i=0; $i<sizeof($comentarios); $i++){
        if($comentarios[$i]["codigoComentario"]== $idComentario){
          echo json_encode($comentarios[$i]);
          //guardo el codigo que tenia el comentario antes de actualizar dicha Informacion
          $codigoComentarioGuardar = $comentarios[$i]["codigoComentario"];

          $comentario= array(
            "codigoComentario" => $codigoComentarioGuardar,
            "codigoCliente" => $this ->codigoCliente,
            "codigoProducto" => $this ->codigoProducto,
            "nombreCliente" => $this ->nombreCliente,
            "contenido" => $this ->contenido,
            "imagenCliente" => $this ->imagenCliente
          );

          $comentarios[$i]= $comentario;

          // IDEA: AQUI SOBREEESCRIBIMOS EL ARCHIVO PARA actualizar el comentario
          $archivoComentarios= fopen("../data/comentarios.json","w");
          fwrite($archivoComentarios,json_encode($comentarios));
          fclose($archivoComentarios);

        }
      }


      //AHORA toca actualizar los comentarios dentro del productos.json
      $contenidoArchivoProdutos = file_get_contents('../data/productos.json');
      $productos = json_decode($contenidoArchivoProdutos,true);

      for ($i=0; $i <sizeof($productos) ; $i++) {
        if($productos[$i]["codigoProducto"]== $this ->codigoProducto){
            echo "se encontro el producto con la que sera su vieja informacion";
            echo (json_encode($productos[$i]));

            if(array_key_exists("comentarios", $productos[$i])){

            $comentariosArrayProducto = $productos[$i]["comentarios"];

            for ($j=0; $j <sizeof($comentariosArrayProducto) ; $j++) {
              if($comentariosArrayProducto[$j]["codigoComentario"]== $codigoComentarioGuardar){

                $productos[$i]["comentarios"][$j] = array(
                  "codigoComentario" => $codigoComentarioGuardar,
                  "codigoCliente" => $this ->codigoCliente,
                  "nombreCliente" => $this ->nombreCliente,
                  "contenido" => $this ->contenido,
                  "imagenCliente" => $this ->imagenCliente
                );

                echo "se actualizo la informacion del comentario del producto <br>";

                $archivoProductos= fopen('../data/productos.json','w');
                fwrite($archivoProductos,json_encode($productos));
                fclose($archivoProductos);

              }
            }
          }
        }
      }


      //AHORA toca actualizar los comentarios dentro del los productos en empresas.json
      $contenidoArchivoEmpresas = file_get_contents('../data/empresas.json');
      $empresas = json_decode($contenidoArchivoEmpresas,true);

      for ($i=0; $i <sizeof($empresas); $i++) {
        if(array_key_exists("productos",$empresas[$i])){
          $productosArrayEmpresa = $empresas[$i]["productos"];

          for ($j=0; $j<sizeof($productosArrayEmpresa); $j++) {
            if($productosArrayEmpresa[$j]["codigoProducto"] == $this->codigoProducto){
                if(array_key_exists("comentarios",$productosArrayEmpresa[$j])){
                $comentariosArrayProducto = $productosArrayEmpresa[$j]["comentarios"];

                for ($k=0; $k <sizeof($comentariosArrayProducto); $k++) {
                  if($comentariosArrayProducto[$k]["codigoComentario"]== $codigoComentarioGuardar){
                    echo "Se encontro el comentario dentro del producto en la empresa";

                    $empresas[$i]["productos"][$j]["comentarios"][$k] = array(
                      "codigoComentario" => $codigoComentarioGuardar,
                      "codigoCliente" => $this ->codigoCliente,
                      "nombreCliente" => $this ->nombreCliente,
                      "contenido" => $this ->contenido,
                      "imagenCliente" => $this ->imagenCliente
                    );

                    echo "se actualizo la informacion del comentario del producto en la empresa <br>";

                    $archivoEmpresas= fopen("../data/empresas.json","w");
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

    public static function eliminarComentario($idComentario){
      $contenidoArchivoComentarios= file_get_contents('../data/comentarios.json');
      $comentarios= json_decode($contenidoArchivoComentarios,true);

      for($i=0; $i<sizeof($comentarios); $i++){
        if($comentarios[$i]["codigoComentario"]== $idComentario){
          echo json_encode($comentarios[$i]);
          $comentarioEliminarse= $comentarios[$i];
          $indiceComentarioEliminarse= $i;
        }
      }

      // IDEA: Eliminaremos Inmediatamente EL COMENTARIO EN DICHO PRODUCTO
      $contenidoArchivoProductos= file_get_contents('../data/productos.json');
      $productos = json_decode($contenidoArchivoProductos,true);


      for($i=0; $i<sizeof($productos);$i++){
        if($productos[$i]["codigoProducto"]== $comentarioEliminarse["codigoProducto"]){
          echo "Se encontro el producto";
          echo (json_encode($productos[$i]));

          if(array_key_exists("comentarios", $productos[$i])){

            $comentariosArrayProducto = $productos[$i]["comentarios"];

            for ($j=0; $j < sizeof($comentariosArrayProducto) ; $j++) {

              if($comentariosArrayProducto[$j]["codigoComentario"]==$comentarioEliminarse["codigoComentario"]){

                array_splice($productos[$i]["comentarios"], $j ,1);

                echo "se borro el comentario del producto <br>";

                $archivoProductos= fopen("../data/productos.json","w");
                fwrite($archivoProductos,json_encode($productos));
                fclose($archivoProductos);
              }
            }
          }



        }
      }


        // IDEA: BORRAR EL COMENTARIO DEL PRODUCTO PERO GUARDADO EN LA EMPRESA
        $contenidoArchivoEmpresas= file_get_contents('../data/empresas.json');
        $empresas= json_decode($contenidoArchivoEmpresas,true);

        for ($i=0; $i <sizeof($empresas); $i++) {
          if(array_key_exists("productos",$empresas[$i])){
            $productosArrayEmpresa = $empresas[$i]["productos"];

            for ($j=0; $j <sizeof($productosArrayEmpresa) ; $j++) {
              if($productosArrayEmpresa[$j]["codigoProducto"]==$comentarioEliminarse["codigoProducto"] ){
                echo "Se encontro el producto en la empresa";
                echo (json_encode($productosArrayEmpresa[$j]));

                if(array_key_exists("comentarios",$productosArrayEmpresa[$j])){
                    $comentariosArrayProducto = $productosArrayEmpresa[$j]["comentarios"];

                    for ($k=0; $k < sizeof($comentariosArrayProducto) ; $k++) {
                      if($comentariosArrayProducto[$k]["codigoComentario"]==$comentarioEliminarse["codigoComentario"]){
                        echo "Se encontro el comentario del producto en array empresa";

                        array_splice($empresas[$i]["productos"][$j]["comentarios"], $k ,1);

                        echo "se borro el comentario del producto en array empresa <br>";

                        $archivoEmpresas= fopen("../data/empresas.json","w");
                        fwrite($archivoEmpresas,json_encode($empresas));
                        fclose($archivoEmpresas);
                      }
                    }
                }


              }
            }
          }
        }


        // IDEA: AQUI ELIMINAREMOS EL COMENTARIO DE SU RESPECTIVO JSON
       array_splice($comentarios,$indiceComentarioEliminarse,1);

       $archivoComentarios= fopen("../data/comentarios.json","w");
       fwrite($archivoComentarios,json_encode($comentarios));
       fclose($archivoComentarios);



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
     * Get the value of Contenido
     *
     * @return mixed
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set the value of Contenido
     *
     * @param mixed $contenido
     *
     * @return self
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

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

}

 ?>
