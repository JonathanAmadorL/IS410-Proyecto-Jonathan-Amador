
function readCookie(name) {

  var nameEQ = name + "=";
  var ca = document.cookie.split(';');

  for(var i=0;i < ca.length;i++) {

    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) {
      return decodeURIComponent( c.substring(nameEQ.length,c.length) );
    }

  }

  return null;
}


function listarClientes(){
  axios({
    method: 'get',
    url: '../backend/api/clientes.php',
    responseType: 'json'
  }).then(res=>{
    console.log(res.data);
    for(let i=0; i<res.data.length; i++){
      document.getElementById('cliente-viendo').innerHTML +=
      `<option value="${res.data[i].codigoCliente}">${res.data[i].nombreCliente} ${res.data[i].apellidoCliente}</option>`;
    }
    document.getElementById('cliente-viendo').value=null;
  }).catch(error=>{
    console.error(error);
  });


  alert(x);
}


function infoCliente(){
  var cliente= readCookie("codigoCliente");
  axios({
    method: 'get',
    url: '../backend/api/clientes.php?id='+cliente,
    responseType: 'json'
  }).then(res => {
    document.getElementById('infoCliente').innerHTML = '';

    document.getElementById('infoCliente').innerHTML +=
    `
    <h1 class="mb-0">${res.data.nombreCliente} <span class="text-primary">${res.data.apellidoCliente}</span></h1>
    <div class="subheading mb-5">${res.data.paisCliente}· <a style="color: #b3762b">${res.data.emailCliente}</a></div>
    <p class="lead mb-5" class="text-justify">${res.data.aboutCliente}</p>
    <div class="social-icons">
      <a class="social-icon" style="cursor: pointer" data-toggle="popover" data-placement="bottom" data-content="${res.data.redesSocialesCliente[0].facebookCliente}" onclick="verRedesSociales()" ><i class="fab fa-fw fa-facebook-f"></i></a>
      <a class="social-icon" style="cursor: pointer" data-toggle="popover" data-placement="bottom" data-content="${res.data.redesSocialesCliente[0].twitterCliente}" onclick="verRedesSociales()" ><i class="fab fa-fw fa-twitter"></i></a>
      <a class="social-icon" style="cursor: pointer" data-toggle="popover" data-placement="bottom" data-content="${res.data.redesSocialesCliente[0].instagramCliente}" onclick="verRedesSociales()" ><i class="fab fa-fw fa-instagram"></i></a>
    </div>
    <button id="btn-editarPerfil" type="button" name="button" class="lead mt-5 p-2" style="cursor: pointer;   border: none;
      border-radius: 5px;
      background: #b3762b;
      color: rgba(255, 255, 255, 0.75);" data-toggle="modal" data-target="#modalInfoClienteEditar" onclick="VereditarInfoCliente('${res.data.codigoCliente}')"> Editar Información</button>
    `;

  }).catch(error => {
    console.error(error);
  });
}

infoCliente();



function verRedesSociales(){
  $(function () {
    $('[data-toggle="popover"]').popover()
  });
}

function VereditarInfoCliente(idCliente) {
  document.getElementById('formularioEditarInfoCliente').innerHTML = '';
  axios({
    method: 'get',
    url: '../backend/api/clientes.php?id='+idCliente,
    responseType: 'json'
  }).then(res=>{
      cliente=res.data;
        document.getElementById('formularioEditarInfoCliente').innerHTML +=
        `
        <form>
          <div class="row">
            <div class="col-6">
              <label for="editarNombreCliente">Nombre: </label>
              <input class="form-control" type="text" id="editarNombreCliente" value="${cliente.nombreCliente}">
            </div>
            <div class="col-6">
              <label for="editarApellidoCliente">Apellido: </label>
              <input class="form-control" type="text" id="editarApellidoCliente" value="${cliente.apellidoCliente}">
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <label for="editarEmailCliente" class="my-2">Email:</label>
              <input class="form-control" type="email" id="editarEmailCliente" value="$${cliente.emailCliente}">
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <label for="editarPasswordCliente" class="my-2">Contraseña:</label>
              <input class="form-control" type="password" id="editarPasswordCliente" value="${cliente.passwordCliente}">

            </div>
            <div class="col-6">
              <label for="editarRePasswordCliente" class="my-2">Repetir Contraseña:</label>
              <input class="form-control" type="password" id="editarRePasswordCliente">
            </div>
          </div>


          <div class="row">
            <div class="col-6">

              <label for="editarPaisCliente" class="my-2">Pais; </label>
              <select class="form-control" name="" id="editarPaisCliente">
                <option value="Honduras">Honduras</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Panama">Panama</option>
              </select>

            </div>
            <div class="col-6">
              <label for="formularioImagen" class="my-2">Imagen: </label>
              <form action="post" id="formularioImagen" enctype="multipart/form-data">
                <input type="file" accept="img/*" class="form-control" id="editarImagenCliente" value="${cliente.imagenCliente}">
              </form>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <label for="editarFechaCliente" class="my-2">Fecha Nacimiento</label>
              <input class="form-control" type="date"  value="${cliente.fechaNacimientoCliente}" id="editarFechaCliente">
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <label for="editarAboutCliente" class="my-2">Acerca de ti: </label>
              <textarea class="form-control" id="editarAboutCliente">${cliente.aboutCliente}</textarea>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <label for="editarFacebookCliente" class="my-2">Facebook: </label>
              <input class="form-control" type="text" value="${cliente.redesSocialesCliente[0].facebookCliente}" id="editarFacebookCliente">
            </div>

            <div class="col-6">
              <label for="editarTwitterCliente" class="my-2">Twitter: </label>
              <input class="form-control" type="text" value="${cliente.redesSocialesCliente[0].twitterCliente}" id="editarTwitterCliente">
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <label for="editarInstagramCliente" class="my-2">Instagram: </label>
              <input class="form-control" type="text" value="${cliente.redesSocialesCliente[0].instagramCliente}" id="editarInstagramCliente">
            </div>
          </div>
        </form>
        `;

  }).catch(error => {
    console.error(error);
  });
}

function mostrarComentarios(){
  var cliente= readCookie("codigoCliente");
  document.getElementById('seccionComentarios').innerHTML =
  `
  <h2 class="mb-5">Comentarios</h2>
  `;
  axios({
    method: 'get',
    url: '../backend/api/clientes.php?id='+cliente,
    responseType: 'json'
  }).then(res=>{
    let comentarios = res.data.comentarios;

    if(res.data.length === 0 || res.data === undefined){
      document.getElementById('seccionCompras').innerHTML +=
      `
      <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
      <div class="flex-grow-1">
          <h3 class="mb-5">No hay compras realizadas</h3>
      </div>
      </div>
      `;
    }else{
      for(let i=0; i<comentarios.length ; i++){
        document.getElementById('seccionComentarios').innerHTML +=
        `
        <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
        <div class="flex-grow-1">
        <div class="subheading mb-3">likes y dislikes</div>
        <p class="text-justify">${comentarios[i].contenido}</p>
        </div>
        <div class="flex-shrink-0"><span class="text-primary" onclick="modalEditar(),verProducto('${comentarios[i].codigoProducto}')" style="cursor: pointer">Ver Producto</span></div>
        </div>
        `;
      }

    }
    }).catch(error=> {
      console.error(error);
    });


}

function mostrarCompras(){
  var cliente= readCookie("codigoCliente");
  document.getElementById('seccionCompras').innerHTML =
  `
  <h2 class="mb-5">Compras</h2>
  `;
  axios({
    method: 'get',
    url: '../backend/api/clientes.php?id='+cliente,
    responseType: 'json'
  }).then(res=>{
    let compras = res.data.productos.compras;
    console.log(compras);

    if(res.data.length === 0 || res.data === undefined){
      document.getElementById('seccionCompras').innerHTML +=
      `
      <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
      <div class="flex-grow-1">
          <h3 class="mb-5">No hay compras realizadas</h3>
      </div>
      </div>
      `;
    }else{
      for(let i=0; i<compras.length ; i++){
        document.getElementById('seccionCompras').innerHTML +=
        `
        <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
        <div class="flex-grow-1">
        <h3 class="mb-0">Compra Realizada No. ${i+1}</h3>
        <div class="subheading mb-3">Precio Unitario: ${compras[i].precio}</div>
        <p class="text-justify">Cantidad: ${compras[i].cantidad}</p>
        </div>
        <div class="flex-shrink-0" onclick="modalEditar(),verProducto('${compras[i].codigoProducto}')"><span class="text-primary" style="cursor: pointer">Ver Producto</span></div>
        </div>
        `;
      }
    }

  }).catch(error=> {
    console.error(error);
  });
}

function mostrarCarrito(){
  var cliente= readCookie("codigoCliente");
  document.getElementById('seccionCarrito').innerHTML =
  `
  <h2 class="mb-5">Carrito</h2>
  `;
  axios({
    method: 'get',
    url: '../backend/api/carritos.php?id='+ cliente ,
    responseType: 'json'
  }).then(res=>{
    let carrito = res.data;
    console.log(carrito);

    if(res.data.length === 0 || res.data === undefined){
      document.getElementById('seccionCarrito').innerHTML +=
      `
      <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
      <div class="flex-grow-1">
          <h3 class="mb-2">No hay productos agregados al carrito</h3>
      </div>
      </div>
      `;
    }else{
      document.getElementById('seccionCarrito').innerHTML +=
      `
      <button id="btn-vaciarCarrito" onclick="vaciarCarrito('${cliente}')" type="button" name="button" class="lead mb-3 p-2" style="cursor: pointer;   border: none;
      border-radius: 5px;
      background: #b3762b;
      color: rgba(255, 255, 255, 0.75);"> Comprar Todo</button>

      `;
      for(let i=0; i<carrito.length ; i++){
        document.getElementById('seccionCarrito').innerHTML +=
        `
        <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
        <div class="flex-grow-1">
        <h3 class="mb-0">Carrito Agregado No. ${i+1}</h3>
        <div class="subheading mb-3">Precio Unitario: ${carrito[i].precio}</div>
        <p class="text-justify">Cantidad: ${carrito[i].cantidad}</p>
        </div>
        <div class="flex-shrink-0"><span class="text-primary" onclick="modalEditar(),verProducto('${carrito[i].codigoProducto}')" style="cursor: pointer">Ver Producto</span></div>
        </div>
        `;
        }
      }
    }).catch(error=> {
      console.error(error);
    });

}


function mostrarFavoritos(){
  var cliente= readCookie("codigoCliente");
  document.getElementById('seccionFavoritos').innerHTML =
  `
  <h2 class="mb-5">Favoritos</h2>
  `;
  axios({
    method: 'get',
    url: '../backend/api/clientes.php?id='+cliente,
    responseType: 'json'
  }).then(res=>{
    let favoritos = res.data.empresasFavoritas;
    console.log(favoritos);

    if(res.data.length === 0 || res.data === undefined){
      document.getElementById('seccionFavoritos').innerHTML +=
      `
      <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
      <div class="flex-grow-1">
          <h3 class="mb-5">No hay favoritos agregados</h3>
      </div>
      </div>
      `;
    }else{
      for(let i=0; i<favoritos.length ; i++){
        document.getElementById('seccionFavoritos').innerHTML +=
        `
        <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
        <div class="flex-grow-1">
        <h3 class="mb-0">Favorito Agregado No. ${i+1}</h3>
        <div class="subheading mb-3">Empresa</div>
        </div>
        <div class="flex-shrink-0"><span class="text-primary" style="cursor: pointer">Ver Empresa</span></div>
        </div>
        `;
        }
      }
    }).catch(error=> {
      console.error(error);
    });
}

function verProducto(idProductoViendo) {
  document.getElementById('produtoCard').innerHTML = '';
  axios({
    method: 'get',
    url: '../backend/api/productos.php?id='+ idProductoViendo,
    responseType: 'json'
  }).then(res => {
    console.log(res.data);
    producto=res.data;
        document.getElementById('produtoCard').innerHTML +=
        `
        <nav>
            <i class="fas fa-arrow-left" id="flecha-regresar" onclick="cerrarModalEditar()">  Regresar</i>
            <ul class="valoracion-estrellas-productos mb-2 mr-2">
              <li class="fas fa-star text-warning"></li>
              <li class="fas fa-star text-warning"></li>
              <li class="fas fa-star text-warning"></li>
              <li class="fas fa-star text-warning"></li>
              <li class="fas fa-star text-secondary"></li>
            </ul>
        </nav>
        <div class="producto-foto">
          <img src="img/raton-avatar2.png" alt="">
        </div>
        <div class="producto-descripcion">
          <h2 id="nombreProducto">${producto.nombreProducto}</h2>
          <h4>Categoria del produto</h4>
          <h1>L. ${producto.precioProducto}</h1>
          <p>${producto.descripcionProducto}</p>
          <button type="button" name="button" id="comprar"  data-toggle="modal" data-target="#modalFormularioComprar">Comprar</button>
          <button type="button" name="button" id="comentarios" class="btn-comentarios" onclick="modalComentarios(),verComentariosProducto('${producto.codigoProducto}')"><i class="fas fa-comments"></i></button>
          <button type="button" name="button" id="carrito" data-toggle="modal" data-target="#modalFormularioCarrito" onclick="btnEnviarCarrito('${producto.codigoProducto}', '${producto.codigoEmpresa}', ${producto.precioProducto})"><i class="fas fa-cart-plus"></i></button>

        </div>
        `;

  }).catch(error => {
    console.error(error);
  });
}

function verComentariosProducto(idProductoViendo){
  document.getElementById('comentariosSeccion').innerHTML =
  `
  <i class="fas fa-times" id="cerrar-modal-comentarios" onclick="cerrarModalComentarios()"></i>

  <h3 class="font-weight-bold text-center mb-5">
    Comentarios
  </h3>

  `;
  axios({
    method: 'get',
    url: '../backend/api/productos.php?id='+idProductoViendo,
    responseType: 'json'
  }).then(res=>{
    producto=res.data;
        if(producto.comentarios){
          comentarios=producto.comentarios;
          console.log(comentarios);
          for(let j=0; j<comentarios.length; j++){
            document.getElementById('comentariosSeccion').innerHTML +=
            `
            <div class="media mb-3 pb-5 border-bottom shadow">
              <img class="img-circle rounded-circle z-depth-1-half d-flex mr-3" id="cliente-imagen" src="https://mdbootstrap.com/img/Photos/Avatars/img (8).jpg" alt="">
              <div class="media-body">
                <a href="#"> <h5 class="nombre-cliente text-info font-weight-bold">${comentarios[j].nombreCliente} ${comentarios[j].apellidoCliente}</h5> </a>
                <ul class="likes-comentario mb-2 list-inline">
                  <li class="far fa-thumbs-up text-primary list-inline-item" id="like-btn"></li>
                  <li class="text-secondary list-unstyled list-inline-item">25 likes</li>
                  <li class="far fa-thumbs-down text-danger list-inline-item" id="dislike-btn"></li>
                  <li class="text-secondary list-unstyled list-inline-item">5 dislikes</li>
                </ul>


                <div class="card-fecha">
                  <ul class="list-unstyled mb-1">
                     <li class="comment-date font-small text-muted">
                       <i class="far fa-clock"></i> 05/10/2015</li>
                   </ul>
                </div>

                <p class="text-dark text-justify"> ${comentarios[j].contenido}</p>
              </div>
            </div>
            `;

          }
          document.getElementById('comentariosSeccion').innerHTML +=
          `
          <div class="input-group contenedor-comentario pt-5" style="margin-bottom: 10px;">
          <h4>Agrega un comentario</h4>
          <input  style="width: 95%; border-radius:5px;"type="text" id="input-comentario" placeholder="Escribe un comentario sobre el producto...">
          <div class="input-group-append" style="width:5%">
          <span class="input-group-text" onclick="agregarComentario('${idProductoViendo}')" style="cursor: pointer" ><i class="fas fa-check-circle fa-2x" id="icono-enviar-comentario"></i></span>
          </div>
          </div>
          `;
        }else{
          console.log("no hay comentarios todavia");
          document.getElementById('comentariosSeccion').innerHTML +=
          `
          <div class="input-group contenedor-comentario pt-5" style="margin-bottom: 10px;">
          <h4>Agrega un comentario</h4>
          <input  style="width: 95%; border-radius:5px;"type="text" id="input-comentario" placeholder="Escribe un comentario sobre el producto...">
          <div class="input-group-append" style="width:5%">
          <span class="input-group-text" onclick="agregarComentario('${idProductoViendo}')" style="cursor: pointer" id="icono-enviar-comentario"><i class="fas fa-check-circle fa-2x"></i></span>
          </div>
          </div>
          `;
        }


  }).catch(error=>{
    console.error(error);
  });
}

function agregarComentario(idProductoViendo){
var cliente= readCookie("codigoCliente");
 conseguirInfoCliente().then(res=> {
   console.log(res.nombreCliente);
   axios({
     method: 'post',
     url: '../backend/api/comentarios.php',
     responseType: 'json',
     data: {
       codigoCliente: cliente,
       codigoProducto: idProductoViendo,
       nombreCliente: res.nombreCliente,
       apellidoCliente: res.apellidoCliente,
       contenido: document.getElementById('input-comentario').value,
       imagenCliente: res.imagenCliente
     }
   }).then(res=> {
     console.log(res.data);

     verComentariosProducto(idProductoViendo);

   }).catch(error => {
     console.error(error)
   });

 }).catch(error=>{
   console.error(error);
 });


}



async function conseguirInfoCliente(){
var cliente= readCookie("codigoCliente");
  return axios({
    method: 'get',
    url: '../backend/api/clientes.php?id='+cliente,
    responseType: 'json'
  }).then(res=> res.data).catch(error => {
    console.error(error)
  });

}

function btnEnviarCarrito(idProductoViendo, idEmpresa, precioProducto){
  document.getElementById('botonesAgregarCarrito').innerHTML =
  `
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
  <button type="button" class="btn btn-success" onclick="agregarCarrito('${idProductoViendo}', '${idEmpresa}', ${precioProducto})">Agregar Carrito</button>
  `;
}

function agregarCarrito(idProductoViendo, idEmpresa, precioProducto){
var cliente= readCookie("codigoCliente");
    axios({
      method: 'post',
      url: '../backend/api/carritos.php',
      responseType: 'json',
      data: {
        codigoCliente: cliente,
        codigoEmpresa: idEmpresa,
        codigoProducto: idProductoViendo,
        precio: precioProducto,
        cantidad: document.getElementById('cantidadProducto').value,
      }
    }).then(res=> {
      console.log(res.data);


    }).catch(error => {
      console.error(error)
    });
}

function vaciarCarrito(idCliente) {
  axios({
    method: 'delete',
    url: '../backend/api/carritos.php?id='+ idCliente,
    responseType: 'json',
  }).then(res=> {
    console.log(res.data);

    mostrarCarrito();

  }).catch(error => {
    console.error(error)
  });

}
