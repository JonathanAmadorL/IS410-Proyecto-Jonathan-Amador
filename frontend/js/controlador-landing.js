// IDEA: COMO EL SCRIPT LO PUSIMOS EN EL HEAD HACEMOS ESTO PARA QUE LA PAGINA CARGUE EL SCRIPT AL RECARGARSE

// IDEA: INICIA EL APARTADO PARA EL SLIDER PARA EL JQUERY

$(document).ready(function(){

  //si queremos hacer esto dinamico cada vez que se agregue una imagenes
  var cantidad_imagenes= $('.slider li').length;
  var posicion_imagenes= 1; //porque al recargar la pagina inicia en la primera imagen

   //para que se agregue dinamicamente los puntos(cheese)... para que funcione esto debemos ir agregando o quitando imagenes dentro del slider
  for(let i=1; i<= cantidad_imagenes; i++){
    $('.circulos').append('<li><i class="fas fa-cheese"></i></li>');
  }

  $('.slider li').hide(); //escondemos todos los li
  $('.slider li:first').show(); //hacemos que se meuestre solo el primero
  $('.circulos li:first').css({'color': '#c8a62c'}); //es para que el primero este activa por asi decirlo


  //FUNCION PARA LOS circulos(CHEESE)
  $('.circulos li').click(function(){
    //traigo el valor de la poscion de este elemento cuando de click en los cheese
    //OJO, INICIABA EN 0, SE LE SUMA 1 PARA QUE CONCUERDE CON cantidad_imagenes
    var posicion= $(this).index() + 1;
    console.log(posicion);

    $('.slider li').hide();
    $('.slider li:nth-child('+ posicion + ')').fadeIn();
    // le ponemos este color a todo aquel no activado/seleccionado
    $('.circulos li').css({'color': '#484549'});
    //este a todo aquel que este activado
    $(this).css({'color': '#c8a62c'});

    posicion_imagenes=posicion;   //para que la posicion se mantenga y no aumente
  });


    //FUNCIONES PARA LAS flechas

    $('.prev i').click(function(){
      if(posicion_imagenes <= 1){
        posicion_imagenes = cantidad_imagenes;
      } else{
        posicion_imagenes--;
      }
      $('.slider li').hide();
      $('.slider li:nth-child(' + posicion_imagenes +')').fadeIn();

      $('.circulos li').css({'color': '#484549'});
      $('.circulos li:nth-child('+ posicion_imagenes+')').css({'color': '#c8a62c'});
    });


    $('.next i').click(function(){
      if(posicion_imagenes >= cantidad_imagenes){
        posicion_imagenes = 1;
      } else{
        posicion_imagenes++;
      }

      $('.slider li').hide();
      $('.slider li:nth-child(' + posicion_imagenes +')').fadeIn();

      $('.circulos li').css({'color': '#484549'});
      $('.circulos li:nth-child('+ posicion_imagenes+')').css({'color': '#c8a62c'});
    });


      //HACER EL SLIDER QUE VAYA CON TRANSICIONES

      setInterval(function(){
        if(posicion_imagenes >= cantidad_imagenes){
          posicion_imagenes = 1;
        } else{
          posicion_imagenes++;
        }

        $('.slider li').hide();
        $('.slider li:nth-child(' + posicion_imagenes +')').fadeIn();

        $('.circulos li').css({'color': '#484549'});
        $('.circulos li:nth-child('+ posicion_imagenes+')').css({'color': '#c8a62c'});
      }, 5000);  //es en milisegundos


      //FUNCION PARA QUE CUANDO SE LE DE CLICK AL mostrar-enlaces (VISTA TELEFONO,ETC)
      //EL SLIDE SHOW NO SE QUEDE MOSTRANDO ENCIMA, SINO QUE SE OCULTE
      //ADEMAS, AL CERRAR EL MOSTRAR ENLACES, EL SLIDESHOW TENDRA QUE APARCER DE NUEVO
      $('#chk').click(function(){
        if( $(this).is(':checked')){
          $('.slideshow').hide();
        }else{
          $('.slideshow').show();
        }
      });


      // IDEA: JQUERY PARA EL Login
      $('.login-form .botonAcccion').click(function(){
        var boton= $(this);
        var pasoActual = ('.login-form .login-pasos .paso');
        var indice_PasoActual = pasoActual.index();
        var tituloPaso = $('.login-pasos li').eq(indice_PasoActual);

        pasoActual.removeClass('is-active').next().addClass('is-active');

        tituloPaso.removeClass('is-active').next().addClass('is-active');

        $(".form-wrapper").submit(function(e){
          e.preventDefault();
        });

        if(indice_PasoActual === 2){
          $(document).find('.login-form .paso').first().addClass('is-active');
          $(document).find('.login-pasos li').first().addClass('is-active');
        }

      });

});
