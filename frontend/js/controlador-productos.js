function listarPromociones(){

  axios({
    method: 'get',
    url: '../backend/api/productos.php',
    responseType: 'json'
  }).then(res=>{
    console.log(res.data);
    productos=res.data;
    if(productos){
      for(let i=0; i<productos.length; i++){
        document.getElementById('productosSeccion').innerHTML +=
        `
        <div class="d-flex justify-content-center col-lg-4 col-md-6 col-sm-12 col-xs-12 pb-5">
          <div class="card" onmouseover="desplegar(this)" onmouseout="cerrar(this)">
            <div class="imagen-card">
              <img src="imagendku" alt="PONER IMAGEN">
            </div>
            <div class="contenido-card">
              <div class="titulo">${productos[i].nombreProducto}</div>
              <div class="sub-titulo-precio">L. ${productos[i].precioProducto}</div>
              <div class="botones-card">
                <p>${productos[i].descripcionProducto}</p>
                <button type="button" name="button" class="modal-editar" onclick="modalComprar(),verProducto('${productos[i].codigoProducto}')">Comprar</button>
              </div>
            </div>
          </div>
        </div>

        `;
      }

    }else{
      console.log('La empresa no tiene productos aun');
      document.getElementById('productosSeccion').innerHTML=
      `
      <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
      <div class="flex-grow-1">
          <h3 class="mb-2">No hay productos</h3>
      </div>
      </div>
      `;
    }
  }).catch(error=>{
    console.error(error);
  });

}

listarPromociones();

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
            <i class="fas fa-arrow-left" id="flecha-regresar" onclick="cerrarModalComprar()">  Regresar</i>
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
                <a> <h5 class="nombre-cliente text-info font-weight-bold">${comentarios[j].nombreCliente} ${comentarios[j].apellidoCliente}</h5> </a>
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
