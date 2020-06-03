
function listarEmpresas(){

  axios({
    method: 'get',
    url: '../backend/api/empresas.php',
    responseType: 'json'
  }).then(res=>{
    console.log(res.data);
    for(let i=0; i<res.data.length; i++){
      document.getElementById('empresa-viendo').innerHTML +=
      `<option value="${res.data[i].codigoEmpresa}">${res.data[i].nombreEmpresa}</option>`;
    }
    document.getElementById('empresa-viendo').value=null;
  }).catch(error=>{
    console.error(error);
  });

}
listarEmpresas();


function portafolioEmpresa(){
  axios({
    method: 'get',
    url: '../backend/api/empresas.php?id='+document.getElementById('empresa-viendo').value,
    responseType: 'json'
  }).then(res => {
    perfil=res.data;
    document.getElementById('portafolioEmpresa').innerHTML = '';

    document.getElementById('portafolioEmpresa').innerHTML +=
    `
    <!-- IDEA: PARA CUANDO QUERAMOS PONER LA IMAGEN SERA ASI el header -->
        <!-- IDEA: <header class="portafolio bg-dark text-white text-center" style="background-image:url('img/compra-slide2.jpg'); background-size: cover;  background-repeat: no-repeat;"> -->
        <div class="container d-flex align-items-center flex-column">
          <img class="portafolio-imagen mb-5 rounded-circle" src="${perfil.logoEmpresa}" alt="">
          <h1 class="portafolio-nombre text-uppercase mb-0 p-2" style="background: rgba(0,0,0,0.2); border-radius:20px;">${perfil.nombreEmpresa}</h1>
            <!-- IDEA: Division -->
          <div class="divider-custom divider-light">
                  <div class="divider-custom-line"></div>
                  <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                  <div class="divider-custom-line"></div>
          </div>
              <!-- IDEA: Seccion para saber que es, sie s empresa o cliente -->
          <p class="portafolio-tipo font-weight-light mb-0">Empresa</p>
          <div class="col-lg-4 mb-5 mt-4 mb-lg-0">
            <a class="btn btn-outline-light btn-social mx-1"  data-toggle="popover" data-placement="bottom" title="Facebook" data-content="${perfil.redesSocialesEmpresa[0].facebookEmpresa}" onclick="verRedesSociales()" ><i class="fab fa-fw fa-facebook-f" style="color: #1877f2;"></i></a>
            <a class="btn btn-outline-light btn-social mx-1"  data-toggle="popover" data-placement="bottom" title="Twitter" data-content="${perfil.redesSocialesEmpresa[0].twitterEmpresa}" onclick="verRedesSociales()"><i class="fab fa-fw fa-twitter" style="color:  rgba(27, 149, 224, 1);;"></i></a>
            <a class="btn btn-outline-light btn-social mx-1"  data-toggle="popover" data-placement="bottom" title="Instagram" data-content="${perfil.redesSocialesEmpresa[0].instagramEmpresa}" onclick="verRedesSociales()"><i class="fab fa-fw fa-instagram" style="color: #f56040;"></i></a>
          </div>
        </div>

    `;
  }).catch(error => {
    console.error(error);
  });
}



function listarProductosEnVenta(){
  axios({
    method: 'get',
    url: '../backend/api/empresas.php?id='+document.getElementById('empresa-viendo').value,
    responseType: 'json'
  }).then(res=>{
    console.log(res.data);
    if(res.data.productos){
      productos=res.data.productos;
      document.getElementById('productos-venta').innerHTML=
      `
      <div class="d-flex justify-content-center col-lg-4 col-md-6 col-sm-12 col-xs-12 pb-5">
        <div class="card" data-toggle="modal" data-target="#modalAgregarProducto">
          <div class="card card-agregar bg-secondary d-flex align-items-center justify-content-center h-100 w-100">
            <div class="portfolio-item-caption-content text-center text-white">
              <i class="icono-agregar fas fa-plus fa-3x"></i>
            </div>
          </div>
        </div>
      </div>
      `;
      for (let j = 0; j < productos.length; j++) {
        document.getElementById('productos-venta').innerHTML +=
        `
        <div class="d-flex justify-content-center col-lg-4 col-md-6 col-sm-12 col-xs-12 pb-5">
          <div class="card" onmouseover="desplegar(this)" onmouseout="cerrar(this)">
            <div class="imagen-card">
              <img src="imagendku" alt="PONER IMAGEN">
            </div>
            <div class="contenido-card">
              <div class="titulo">${productos[j].nombreProducto}</div>
              <div class="sub-titulo-precio">L. ${productos[j].precioProducto}</div>
              <div class="botones-card">
                <p>${productos[j].descripcionProducto}</p>
                <button type="button" name="button" class="modal-editar" onclick="modalEditar(),verProducto('${productos[j].codigoProducto}')">Editar</button>
              </div>
            </div>
          </div>
        </div>

        `;
      }

    }else{
      console.log('La empresa no tiene productos aun');
      document.getElementById('productos-venta').innerHTML=
      `
      <div class="d-flex justify-content-center col-lg-4 col-md-6 col-sm-12 col-xs-12 pb-5">
        <div class="card" data-toggle="modal" data-target="#modalAgregarProducto">
          <div class="card card-agregar bg-secondary d-flex align-items-center justify-content-center h-100 w-100">
            <div class="portfolio-item-caption-content text-center text-white">
              <i class="icono-agregar fas fa-plus fa-3x"></i>
            </div>
          </div>
        </div>
      </div>
      `;
    }
  }).catch(error=>{
    console.error(error);
  });
}


function listarSucursales(){
  axios({
    method: 'get',
    url: '../backend/api/empresas.php?id='+document.getElementById('empresa-viendo').value,
    responseType: 'json'
  }).then(res=>{
    console.log(res.data);
    if(res.data.sucursales){
      sucursales=res.data.sucursales;
      document.getElementById('sucursales-seccion').innerHTML =
      `
      <div class="d-flex justify-content-center col-lg-4 col-md-6 col-sm-12 col-xs-12 pb-5">
        <div class="card" data-toggle="modal" data-target="#modalAgregarSucursal">
          <div class="card card-agregar bg-secondary d-flex align-items-center justify-content-center h-100 w-100">
            <div class="portfolio-item-caption-content text-center text-white">
              <i class="icono-agregar fas fa-plus fa-3x"></i>
            </div>
          </div>
        </div>
      </div>
      `;

      document.getElementById('lista-sucursales').innerHTML = '';
      for(let i=0; i<sucursales.length;i++){
        if(sucursales[i].productosSucursal){
          cantidadProductosSucursal= sucursales[i].productosSucursal.length;
        }else{
          cantidadProductosSucursal=0;
        }
        document.getElementById('sucursales-seccion').innerHTML +=
        `
        <div class="d-flex justify-content-center col-lg-4 col-md-6 col-sm-12 col-xs-12 pb-5">
          <div class="card">
            <div class="card card-sucursal bg-success d-flex align-items-center justify-content-center h-100 w-100">
              <div class="portfolio-item-caption-content text-center text-white mb-3">
                <i class="icono-sucursal fas fa-store-alt fa-4x"></i>
              </div>
              <div class="row mt-5 text-center text-white">
                <h3 class="col-12 font-weight-bold">${sucursales[i].nombreSucursal}</h3>
                <div class="col-12 mt-3 d-flex justify-content-around font-italic">
                  <h4>Productos: </h4>
                  <h4>${cantidadProductosSucursal} disponibles</h4>
                </div>
                <h5 class="col-12 mt-3" >Click / Tap para ver más</h5>
              </div>
            </div>
          </div>
        </div>
        `;

        document.getElementById('lista-sucursales').innerHTML +=
        `
        <div class="custom-control custom-checkbox">
          <input type="checkbox"  class="custom-control-input" name="checkboxSucursal" id="${sucursales[i].codigoSucursal}" value="${sucursales[i].codigoSucursal}">
          <label class="custom-control-label" for="${sucursales[i].codigoSucursal}">${sucursales[i].nombreSucursal}</label>
        </div>
        `;
      }
    }else{
      console.log("La empresa no tiene sucursales todavia");
      document.getElementById('sucursales-seccion').innerHTML =
      `
      <div class="d-flex justify-content-center col-lg-4 col-md-6 col-sm-12 col-xs-12 pb-5">
        <div class="card" data-toggle="modal" data-target="#modalAgregarSucursal">
          <div class="card card-agregar bg-secondary d-flex align-items-center justify-content-center h-100 w-100">
            <div class="portfolio-item-caption-content text-center text-white">
              <i class="icono-agregar fas fa-plus fa-3x"></i>
            </div>
          </div>
        </div>
      </div>
      `;
    }
  }).catch(error=>{
    console.error(error);
  });
}



function verProducto(idProductoViendo) {
  document.getElementById('produtoCard').innerHTML = '';
  axios({
    method: 'get',
    url: '../backend/api/empresas.php?id='+document.getElementById('empresa-viendo').value,
    responseType: 'json'
  }).then(res => {
    productos=res.data.productos;
    for(let i=0; i<productos.length; i++){
      if(productos[i].codigoProducto == idProductoViendo){
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
          <h2 id="nombreProducto">${productos[i].nombreProducto}</h2>
          <h4>Categoria del produto</h4>
          <h1>L. ${productos[i].precioProducto}</h1>
          <p>${productos[i].descripcionProducto}</p>
          <button type="button" name="button" id="editar"  data-toggle="modal" data-target="#modalFormularioEditar" onclick="verEditarProducto('${productos[i].codigoProducto}')">Editar</button>
          <button type="button" name="button" id="comentarios" class="btn-comentarios" onclick="modalComentarios(),verComentariosProducto('${productos[i].codigoProducto}')"><i class="fas fa-comments"></i></button>
        </div>
        `;
      }
    }
  }).catch(error => {
    console.error(error);
  });
}

function verEditarProducto(idProductoViendo){
  document.getElementById('formularioEditar').innerHTML='';
  axios({
    method: 'get',
    url: '../backend/api/empresas.php?id='+document.getElementById('empresa-viendo').value,
    responseType: 'json'
  }).then(res=>{
    productos=res.data.productos;
    for(let i=0; i<productos.length; i++){
      if(productos[i].codigoProducto == idProductoViendo){
        document.getElementById('formularioEditar').innerHTML +=
        `
        <form class="" action="index.html" method="post">
          <label for="editarNombreProducto">Nombre Producto:</label>
          <input class="form-control" type="text" id="editarNombreProducto" value="${productos[i].nombreProducto}">

          <label for="editarPrecioProducto" class="my-2">Precio Producto:</label>
          <input class="form-control" type="number" id="editarPrecioProducto" value="${productos[i].precioProducto}">

          <label for="editarPctDescProducto" class="my-2">% Descuento</label>
          <select class="form-control" name="" id="editarPctDescProducto">
            <option value="0"></option>
            <option value="0.20">20%</option>
            <option value="0.30">30%</option>
            <option value="0.40">40%</option>
            <option value="0.50">50%</option>
            <option value="0.70">70%</option>
          </select>

          <h5 class="my-2" id="editarDescuentoProducto">Descuento Producto: L. 800 (tiene que ser funcion para encontrarlo)</h5>

          <label for="editarDescripcionProducto" class="my-2">Descripción Producto</label>
          <textarea class="form-control" id="editarDescripcionProducto">${productos[i].descripcionProducto}</textarea>

          <label for="editarImagenProducto" class="my-2">Imagen produto</label>
          <input class="form-control" type="text"  value="Valor Anterior" id="editarImagenProducto">

          <label for="editarCantidadProducto" class="my-2">Cantidad Producto</label>
          <input class="form-control" type="number" value="${productos[i].cantidadProducto}" id="editarCantidadProducto">

          <h5 class="my-2">Elige las sucursales para tu producto</h5>


          <div class="custom-control custom-checkbox">
             <input type="checkbox" class="custom-control-input" id="sucursal1">
            <label class="custom-control-label" for="sucursal1">Sucursal 1</label>
          </div>

          <div class="custom-control custom-checkbox">
             <input type="checkbox" class="custom-control-input" id="sucursal2">
            <label class="custom-control-label" for="sucursal2">Sucursal 2</label>
          </div>

          <div class="custom-control custom-checkbox">
             <input type="checkbox" class="custom-control-input" id="sucursal3">
            <label class="custom-control-label" for="sucursal3">Sucursal 3</label>
          </div>
        </form>
        `;
      }
    }
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
    url: '../backend/api/empresas.php?id='+document.getElementById('empresa-viendo').value,
    responseType: 'json'
  }).then(res=>{
    productos=res.data.productos;
    for(let i=0; i<productos.length; i++){
      if(productos[i].codigoProducto == idProductoViendo){
        if(productos[i].comentarios){
          comentarios=productos[i].comentarios;
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
          <input  style="width: 95%; border-radius:5px;"type="text" placeholder="Escribe un comentario sobre el producto...">
          <div class="input-group-append" style="width:5%">
          <span class="input-group-text"><i class="fas fa-check-circle fa-2x"></i></span>
          </div>
          </div>
          `;
        }else{
          console.log("no hay comentarios todavia");
          document.getElementById('comentariosSeccion').innerHTML +=
          `
          <div class="input-group contenedor-comentario pt-5" style="margin-bottom: 10px;">
          <h4>Agrega un comentario</h4>
          <input  style="width: 95%; border-radius:5px;"type="text" placeholder="Escribe un comentario sobre el producto...">
          <div class="input-group-append" style="width:5%">
          <span class="input-group-text"><i class="fas fa-check-circle fa-2x"></i></span>
          </div>
          </div>
          `;
        }

      }
    }

  }).catch(error=>{
    console.error(error);
  });
}

const formularioAgregarProducto= document.getElementById('formularioAgregarProducto');

formularioAgregarProducto.addEventListener('submit',(e) => {
  e.preventDefault();
  e.stopPropagation();

});


function agregarProducto(){

  if(validar_info_producto()){
    empresaSeleccionada = document.getElementById('empresa-viendo');
    nombreEmpresaSeleccionada = empresaSeleccionada.options[empresaSeleccionada.selectedIndex].text;
    let producto= {
      codigoEmpresa : document.getElementById('empresa-viendo').value,
  	  nombreEmpresa : nombreEmpresaSeleccionada,
  	 nombreProducto : document.getElementById('agregarNombreProducto').value,
  	 precioProducto : document.getElementById('agregarPrecioProducto').value,
  	 descuentoProducto : document.getElementById('agregarPctDescProducto').value,
  	 descripcionProducto : document.getElementById('agregarDescripcionProducto').value,
  	 imagenProducto : document.getElementById('agregarImagenProducto').value,
  	 cantidadProducto : document.getElementById('agregarCantidadProducto').value
    };
    document.getElementById('btn-agregarProducto').disabled= false;
    document.getElementById('btn-agregarProducto').innerHTML="Agregando...";
    console.log('Producto a guardar: '+JSON.stringify(producto));

    axios({
      method:'POST',
      url:  '../backend/api/productos.php',
      responseType:'json',
      data: producto
    }).then(res=>{
      console.log(res.data);
    /*  var array=[];
      $(":checkbox[name=checkboxSucursal]").each(function() {
        if(this.checked){
          array.push($(this).val());
        }
      });

      for(let i=0; i<array.length; i++){
        axios({
          method: 'get',
          url: '../backend/api/productosSucursal.php',
          responseType: 'json',
          data: {
            codigoSucursal: array[i],
            codigoEmpresa: empresaSeleccionada,
            codigoProducto: ,
            nombreProducto: "Caribe producto sucursal",
            precioProducto: 15600,
            cantidadProducto: 23
          }
        }).then(res=>{
          console.log(res.data);
        }).catch(error=>{
          console.error(error);
        });
      }*/

      limpiar_form_agregarProducto();
      document.getElementById('btn-agregarProducto').disabled= false;
      document.getElementById('btn-agregarProducto').innerHTML="Agregar";
      listarProductosEnVenta();
    }).catch(error=>{
      console.error(error);
    });

  }

}

function validar_info_producto(){
  var agregar_NombreProducto =document.getElementById('agregarNombreProducto').value;
  var agregar_PrecioProducto =document.getElementById('agregarPrecioProducto').value;
  var agregar_PctDescProducto =document.getElementById('agregarPctDescProducto').value;
  var agregar_DescripcionProducto =document.getElementById('agregarDescripcionProducto').value;
  var agregar_ImagenProducto =document.getElementById('agregarImagenProducto').value;
  var agregar_CantidadProducto =document.getElementById('agregarCantidadProducto').value;

  if(agregar_NombreProducto=="" || agregar_NombreProducto==null){
    alert("EL nombre del producto es obligatorio");
    return false;
  }

  if(agregar_PrecioProducto=="" || agregar_PrecioProducto==null){
    alert("EL precio del producto es obligatorio");
    return false;
  }

  if(agregar_DescripcionProducto=="" || agregar_DescripcionProducto==null){
    alert("La descripcion del productol es obligatorio");
    return false;
  }

  if(agregar_ImagenProducto=="" || agregar_ImagenProducto==null){
    alert("La imagen del producto es obligatorio");
    return false;
  }
  if(agregar_CantidadProducto=="" || agregar_CantidadProducto==null){
    alert("La cantidad del producto es obligatorio");
    return false;
  }

  /*var array=[];
  $(":checkbox[name=checkboxSucursal]").each(function() {
    if(this.checked){
      array.push($(this).val());
    }
  });

for(let i=0; i<array.length ; i++){
  console.log(array[i]);
}

  for(let i=0; i<array.length; i++){
    axios({
      method: 'get',
      url: '../backend/api/sucursales.php?id='+array[i],
      responseType: 'json'
    }).then(res=>{
      console.log(res.data);
    }).catch(error=>{
      console.error(error);
    });
  }*/

  return true;
  agregarProducto();

}

const formulario_sucursal= document.getElementById('formulario_sucursal');

formulario_sucursal.addEventListener('submit',(e) => {
  e.preventDefault();
  e.stopPropagation();

});

function agregarSucursal(){

  if(validar_info_sucursal()){
    empresaSeleccionada = document.getElementById('empresa-viendo');
    nombreEmpresaSeleccionada = empresaSeleccionada.options[empresaSeleccionada.selectedIndex].text;
    let sucursal= {
      codigoEmpresa: document.getElementById('empresa-viendo').value,
      nombreEmpresa: nombreEmpresaSeleccionada,
      nombreSucursal: document.getElementById('nombreSucursal').value,
      longitudSucursal: document.getElementById('longitudSucursal').value,
      latitudSucursal: document.getElementById('latitudSucursal').value,
      direccionSucursal: document.getElementById('direccionSucursal').value
    };
    document.getElementById('agregar-btn-sucursal').disabled= false;
    document.getElementById('agregar-btn-sucursal').innerHTML="Agregando...";
    console.log('Sucursal a guardar: '+JSON.stringify(sucursal));

    axios({
      method:'POST',
      url:  '../backend/api/sucursales.php',
      responseType:'json',
      data: sucursal
    }).then(res=>{
      console.log(res.data);
      limpiar_form_sucursal();
        document.getElementById('agregar-btn-sucursal').disabled= false;
        document.getElementById('agregar-btn-sucursal').innerHTML="Agregar";
        listarSucursales();
    }).catch(error=>{
      console.error(error);
    });

  }
}

function verRedesSociales(){
  $(function () {
    $('[data-toggle="popover"]').popover()
  });
}


function validar_info_sucursal(){
  var nombre_Sucursal =document.getElementById('nombreSucursal').value;
  var longitud_Sucursal =document.getElementById('longitudSucursal').value;
  var latitud_Sucursal =document.getElementById('latitudSucursal').value;
  var direccion_Sucursal =document.getElementById('direccionSucursal').value;

  // IDEA: INICIA LA VALIDACION

  if(nombre_Sucursal=="" || nombre_Sucursal==null){
    alert("EL nombre de la sucursal es obligatorio");
    return false;
  }

  if( (longitud_Sucursal=="" && latitud_Sucursal=="") || direccion_Sucursal=="" ){
    alert("debe elegir una de las dos opciones especificadas para detallar la ubicación");
    return false;
  }

  if( (longitud_Sucursal=="" || latitud_Sucursal=="") || direccion_Sucursal=="" ){
    alert("debe elegir una de las dos opciones especificadas para detallar la ubicación");
    return false;
  }

  return true;
  guardarSucursal();

}

function limpiar_form_sucursal() {
  document.getElementById('nombreSucursal').value=null;
  document.getElementById('longitudSucursal').value=null;
  document.getElementById('latitudSucursal').value=null;
  document.getElementById('direccionSucursal').value=null;
}

function limpiar_form_agregarProducto(){
    document.getElementById('agregarNombreProducto').value= null;
    document.getElementById('agregarPrecioProducto').value= null;
    document.getElementById('agregarPctDescProducto').value= null;
    document.getElementById('agregarDescripcionProducto').value= null;
    document.getElementById('agregarImagenProducto').value= null;
    document.getElementById('agregarCantidadProducto').value= null;
}
