const formulario_empresa = document.getElementById('formulario_empresa');
const url= '../backend/api/empresas.php';

formulario_empresa.addEventListener('submit',(e) => {
  e.preventDefault();
  e.stopPropagation();

  validar_Info_Empresa();
});



function guardarEmpresas(){
  if (validar_Info_Empresa()){
    let empresa= {
      nombreEmpresa: document.getElementById('usuario-empresa').value,
      emailEmpresa: document.getElementById('email-empresa').value,
      passwordEmpresa: document.getElementById('password-empresa').value,
      paisEmpresa: document.getElementById('pais-empresa').value,
      longitudEmpresa: document.getElementById('longitud-empresa').value,
      latitudEmpresa: document.getElementById('latitud-empresa').value,
      bannerEmpresa: document.getElementById('banner-empresa').value,
      logoEmpresa: document.getElementById('logotipo-empresa').value,
      facebookEmpresa: document.getElementById('facebook-empresa').value,
      twitterEmpresa: document.getElementById('twitter-empresa').value,
      instagramEmpresa: document.getElementById('instagram-empresa').value,
      descripcionEmpresa: document.getElementById('descripcion-empresa').value
    };
    document.getElementById('registrarse-btn-empresa').disabled=true;
    document.getElementById('registrarse-btn-empresa').innerHTML="Registrando...";
    console.log('Empresa a guardar: ' + JSON.stringify(empresa));

    axios({
      method:'POST',
      url: url ,
      responseType:'json',
      data: empresa
    }).then(res=>{
      console.log(res.data);
      limpiar_form_empresa();
        document.getElementById('registrarse-btn-empresa').disabled= false;
        document.getElementById('registrarse-btn-empresa').innerHTML="Registrarse";
    }).catch(error=>{
      console.error(error);
    });


  }
}




function limpiar_form_empresa(){
  document.getElementById('usuario-empresa').value=null;
  document.getElementById('email-empresa').value=null;
  document.getElementById('password-empresa').value=null;
  document.getElementById('pais-empresa').value=null;
  document.getElementById('longitud-empresa').value=null;
  document.getElementById('latitud-empresa').value=null;
  document.getElementById('banner-empresa').value=null;
  document.getElementById('logotipo-empresa').value=null;
  document.getElementById('facebook-empresa').value=null;
  document.getElementById('twitter-empresa').value=null;
  document.getElementById('instagram-empresa').value=null;
  document.getElementById('descripcion-empresa').value=null;
}


function validar_Info_Empresa(){
  var usuario_Empresa, email_Empresa, password_Empresa, repassword_Empresa, pais_Empresa, longitud_Empresa, banner_Empresa, logotipo_Empresa, facebook_Empresa, twitter_Empresa, instagram_Empresa, descripcion_Empresa;
  usuario_Empresa= document.getElementById('usuario-empresa').value;
  email_Empresa= document.getElementById('email-empresa').value;
  password_Empresa= document.getElementById('password-empresa').value;
  repassword_Empresa= document.getElementById('repassword-empresa').value;
  pais_Empresa= document.getElementById('pais-empresa').value;
  longitud_Empresa= document.getElementById('longitud-empresa').value;
  latitud_Empresa= document.getElementById('latitud-empresa').value;
  banner_Empresa= document.getElementById('banner-empresa').value;
  logotipo_Empresa= document.getElementById('logotipo-empresa').value;
  facebook_Empresa= document.getElementById('facebook-empresa').value;
  twitter_Empresa= document.getElementById('twitter-empresa').value;
  instagram_Empresa= document.getElementById('instagram-empresa').value;
  descripcion_Empresa= document.getElementById('descripcion-empresa').value;


  var checkbox_empresa= document.getElementById('acepto_terminos_empresa').checked;


  expresion_regular= /\w+@\w+\.+[a-z]/;  //para la forma correo152@yahoo.es  por ejemplo

  //VERIFICAMOS SI LOS CAMPOS OBLIGATORIOS ESTAN VACIOS
  if(usuario_Empresa=="" && email_Empresa=="" && password_Empresa=="" && repassword_Empresa=="" && pais_Empresa=="" && longitud_Empresa=="" && latitud_Empresa=="" && logotipo_Empresa=="" && descripcion_Empresa==""){
    let campos_obligatorios=document.getElementsByName('campo-obligatorio');
    for (let i = 0; i < campos_obligatorios.length; i++) {
      campos_obligatorios[i].classList.add("is-invalid");
    }

    let mensajes_errores=document.getElementsByClassName('mensaje-error');

    for(let j=0; j<mensajes_errores.length;j++){
      mensajes_errores[j].style.color="#dc3545";
    }

    return false;
  }


  if(usuario_Empresa == "" || usuario_Empresa==null){
    document.getElementById('usuario-empresa').classList.add("is-invalid");
    document.getElementById('mensaje-usuario').style.color="#dc3545";
    return false;
  }else{
    document.getElementById('usuario-empresa').classList.remove("is-invalid");
    document.getElementById('usuario-empresa').classList.add("is-valid");
    document.getElementById('mensaje-usuario').style.color="#28a745";
  }

  if(email_Empresa == ""){
    document.getElementById('email-empresa').classList.add("is-invalid");
    document.getElementById('mensaje-email').style.color="#dc3545";
    return false;
  }

  if (!expresion_regular.test(email_Empresa)) {
   document.getElementById('email-empresa').classList.add("is-invalid");
   alert("El correo no es válido segun el formato correo123@yahoo.es");
   return false;
 }else{
    document.getElementById('email-empresa').classList.remove("is-invalid");
    document.getElementById('email-empresa').classList.add("is-valid");
    document.getElementById('mensaje-email').style.color="#28a745";
  }

  if(password_Empresa== ""){
    document.getElementById('password-empresa').classList.add("is-invalid");
    document.getElementById('mensaje-password').style.color="#dc3545";
    return false;
  }
  if (password_Empresa.length<8) {
    alert("La contraseña debe tener minimo 8 caracteres");
    return false;
  }
  else{
    document.getElementById('password-empresa').classList.remove("is-invalid");
    document.getElementById('password-empresa').classList.add("is-valid");
    document.getElementById('mensaje-password').style.color="#28a745";
  }


  if(repassword_Empresa==""){
    document.getElementById('repassword-empresa').classList.add("is-invalid");
    document.getElementById('mensaje-repassword').style.color="#dc3545";
    return false;
  }else
  if (repassword_Empresa !== password_Empresa) {
   alert("Las contraseñas no coinciden")
   document.getElementById('password-empresa').classList.add("is-invalid");
   document.getElementById('mensaje-password').style.color="#dc3545";
   document.getElementById('repassword-empresa').classList.add("is-invalid");
   document.getElementById('mensaje-repassword').style.color="#dc3545";
   return false;
 }else{
   document.getElementById('password-empresa').classList.remove("is-invalid");
    document.getElementById('password-empresa').classList.add("is-valid");
    document.getElementById('mensaje-password').style.color="#28a745";
   document.getElementById('repassword-empresa').classList.remove("is-invalid");
    document.getElementById('repassword-empresa').classList.add("is-valid");
    document.getElementById('mensaje-repassword').style.color="#28a745";
  }

  if(pais_Empresa==""){
    document.getElementById('pais-empresa').classList.add("is-invalid");
    document.getElementById('mensaje-pais').style.color="#dc3545";
    return false;
  }else{
    document.getElementById('pais-empresa').classList.remove("is-invalid");
    document.getElementById('pais-empresa').classList.add("is-valid");
    document.getElementById('mensaje-pais').style.color="#28a745";
  }

  if(longitud_Empresa==""){
    document.getElementById('longitud-empresa').classList.add("is-invalid");
    document.getElementById('mensaje-longitud').style.color="#dc3545";
    return false;
  }else{
    document.getElementById('longitud-empresa').classList.remove("is-invalid");
    document.getElementById('longitud-empresa').classList.add("is-valid");
    document.getElementById('mensaje-longitud').style.color="#28a745";
  }

  if(latitud_Empresa==""){
    document.getElementById('latitud-empresa').classList.add("is-invalid");
    document.getElementById('mensaje-latitud').style.color="#dc3545";
    return false;
  }else{
    document.getElementById('latitud-empresa').classList.remove("is-invalid");
    document.getElementById('latitud-empresa').classList.add("is-valid");
    document.getElementById('mensaje-latitud').style.color="#28a745";
  }

  if(logotipo_Empresa==""){
    document.getElementById('logotipo-empresa').classList.add("is-invalid");
    document.getElementById('mensaje-logo').style.color="#dc3545";
    return false;
  }else{
    document.getElementById('logotipo-empresa').classList.remove("is-invalid");
    document.getElementById('logotipo-empresa').classList.add("is-valid");
    document.getElementById('mensaje-logo').style.color="#28a745";
  }

  if(facebook_Empresa==""){
    document.getElementById('facebook-empresa').classList.add("is-invalid");
    document.getElementById('mensaje-logo').style.color="#dc3545";
    return false;
  }else{
    document.getElementById('facebook-empresa').classList.remove("is-invalid");
    document.getElementById('facebook-empresa').classList.add("is-valid");
    document.getElementById('mensaje-logo').style.color="#28a745";
  }

  if(descripcion_Empresa==""){
    document.getElementById('descripcion-empresa').classList.add("is-invalid");
    document.getElementById('mensaje-descripcion').style.color="#dc3545";
    return false;
  }else{
    document.getElementById('descripcion-empresa').classList.remove("is-invalid");
    document.getElementById('descripcion-empresa').classList.add("is-valid");
    document.getElementById('mensaje-descripcion').style.color="#28a745";
  }


 if (checkbox_empresa==false) {
    alert("Debe aceptar los terminos y condiciones para registrarse");
    return false;
  }

  return (true);
  guardarEmpresas();
}



// IDEA: VAMOS A DARLE LOS EVENTOS A LOS BOTONES
// IDEA: creamos una funcion que contendra un toogle
const toggleModal_Cliente = () => {
  //seleccionamos a este selector modal_cliente y a todas sus clases CSS (classList)
  document.querySelector('.modal_cliente_background').classList.toggle('modal-oculto-cliente');
};
// mostramos el modal si le damos click al boton
document.querySelector('#mostrar_modal_cliente').addEventListener('click', toggleModal_Cliente);
//cerramos el modal si nos registramos
//document.querySelector('#registrarse-btn-cliente').addEventListener('click' , toggleModal_Cliente);
//cerramos el modal si le damos click al icono de la 'X'
document.querySelector('#cerrar-modal-cliente').addEventListener('click',toggleModal_Cliente);


const formulario_cliente = document.getElementById('formulario_cliente');

formulario_cliente.addEventListener('submit',(e) => {
  e.preventDefault();
  e.stopPropagation();

  validar_Info_Cliente();
});

function guardarClientes(){
  if(validar_Info_Cliente()){
    let cliente={
        usuario_Cliente: document.getElementById('usuario-cliente').value,
        apellidoCliente: "",
        email_Cliente: document.getElementById('email-cliente').value,
        password_Cliente: document.getElementById('password-cliente').value,
        paisCliente: "Honduras"
    };

    axios({
      method:'POST',
      url: '../backend/api/clientes.php',
      responseType:'json',
      data: cliente
    }).then(res=>{
      console.log(res.data);
      limpiar_form_empresa();
        document.getElementById('registrarse-btn-empresa').disabled= false;
        document.getElementById('registrarse-btn-empresa').innerHTML="Registrarse";
    }).catch(error=>{
      console.error(error);
    });


    limpiar_form_cliente();
  }
}


function validar_Info_Cliente(){
  var usuario_Cliente, email_Cliente, password_Cliente, repassword_Cliente;
  usuario_Cliente=document.getElementById('usuario-cliente').value;
  email_Cliente=document.getElementById('email-cliente').value;
  password_Cliente=document.getElementById('password-cliente').value;
  repassword_Cliente=document.getElementById('repassword-cliente').value;

  var checkbox_cliente= document.getElementById('acepto_terminos_cliente').checked;


  expresion_regular= /\w+@\w+\.+[a-z]/;  //para la forma correo152@yahoo.es  por ejemplo

  //VERIFICAMOS SI LOS CAMPOS OBLIGATORIOS ESTAN VACIOS
  if(usuario_Cliente == " " || email_Cliente == " " || password_Cliente== "" || repassword_Cliente==""  ){
    alert("Debe rellenar los campos correspondientes");
    return false;
  }

  else if (password_Cliente.length<8) {
    alert("La contraseña debe tener minimo 8 caracteres");
    return false;
  }

  else if (repassword_Cliente !== password_Cliente) {
    alert("Las contraseñas no coinciden")
    return false;
  }

  else if (!expresion_regular.test(email_Cliente)) {
    alert("El correo no es válido segun el formato correo123@yahoo.es");
    return false;
  }
  else if (checkbox_cliente==false) {
    alert("Debe aceptar los terminos y condiciones para registrarse");
    return false;
  }

  return (true);
  guardarClientes();

}
