// IDEA: FUNCIONALIDAD PARA CARDS

function desplegar(seleccionado){
  $(seleccionado).addClass("activar");
  $('.botones-card',seleccionado).stop().slideDown();
}

function cerrar(seleccionado){

  $('.botones-card',seleccionado).stop().slideUp();
  $(seleccionado).removeClass("activar");
}

$('.card').hover(function(){
  if ($(this).hasClass("activar")){
    $('.botones-card',this).slideUp(function(){
      $('.card').removeClass("activar");
    });
  }else{
    $(this).addClass("activar");
    $('.botones-card',this).stop().slideDown();
  }

});

var modal_comprar = document.querySelector('.modal-comprar');
var modal_background_compra = document.querySelector('.modal-background-compra');
var flecha_regresar = document.querySelector('#flecha-regresar');

modal_comprar.addEventListener('click',function(){
  modal_background_compra.classList.add('modal-activado');
});

flecha_regresar.addEventListener('click',function(){
  modal_background_compra.classList.remove('modal-activado');
});



function modalEditar(){
  $('.modal-background-editar').css("visibility", "visible");
  $('.modal-background-editar').css("opacity", "1");
}

function cerrarModalEditar() {
  $('.modal-background-editar').css("visibility", "hidden");
  $('.modal-background-editar').css("opacity", "0");
}


function modalComentarios(){
  $('.modal-background-comentarios').css("visibility", "visible");
  $('.modal-background-comentarios').css("opacity", "1");
  $('.modal-background-comentarios').css("transition" , "visibility 0s", "opacity 0.7s");
}

function cerrarModalComentarios(){
  $('.modal-background-comentarios').css("visibility", "hidden");
  $('.modal-background-comentarios').css("opacity", "0");
  $('.modal-background-comentarios').css("transition" , "visibility 0.0s", "opacity 0.0s");
}




/*var btn_comentarios = document.querySelector('.btn-comentarios');
var modal_background_comentarios = document.querySelector('.modal-background-comentarios');
var cerrar_modal_comentarios = document.querySelector('#cerrar-modal-comentarios');

btn_comentarios.addEventListener('click',function(){
  modal_background_comentarios.classList.add('modal-comentarios-activado');
});

cerrar_modal_comentarios.addEventListener('click',function(){
  modal_background_comentarios.classList.remove('modal-comentarios-activado');
});*/



/*
EL coidgo inical era este, pero al hacer hover sobre una carta todas hacian el efecto

$('.card').hover(function(){
  if ($(this).hasClass("activar")){
    $('.card .botones-card').slideUp(function(){ //el problema estaba aca, que esta .card en vez de un ",this"
      $('.card').removeClass("activar");
    });
  }else{
  $('.card .botones-card').stop().slideDown(); //igual aca el problema estaba aca, que esta .card en vez de un ",this"
    $(this).addClass("activar");
  }

});
*/
