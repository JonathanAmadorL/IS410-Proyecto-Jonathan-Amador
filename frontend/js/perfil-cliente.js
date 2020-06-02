
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
}
listarClientes();

function infoCliente(){
  axios({
    method: 'get',
    url: '../backend/api/clientes.php?id='+document.getElementById('cliente-viendo').value,
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
      color: rgba(255, 255, 255, 0.75);"> Editar Información</button>
    `;

  }).catch(error => {
    console.error(error);
  });
}


function verRedesSociales(){
  $(function () {
    $('[data-toggle="popover"]').popover()
  });
}


function mostrarComentarios(){
  document.getElementById('seccionComentarios').innerHTML =
  `
  <h2 class="mb-5">Comentarios</h2>
  `;
  axios({
    method: 'get',
    url: '../backend/api/clientes.php?id='+document.getElementById('cliente-viendo').value,
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
        <div class="flex-shrink-0"><span class="text-primary" style="cursor: pointer">Ver Producto</span></div>
        </div>
        `;
      }

    }
    }).catch(error=> {
      console.error(error);
    });


}

function mostrarCompras(){
  document.getElementById('seccionCompras').innerHTML =
  `
  <h2 class="mb-5">Compras</h2>
  `;
  axios({
    method: 'get',
    url: '../backend/api/clientes.php?id='+document.getElementById('cliente-viendo').value,
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
        <div class="flex-shrink-0"><span class="text-primary" style="cursor: pointer">Ver Producto</span></div>
        </div>
        `;
      }
    }

  }).catch(error=> {
    console.error(error);
  });
}

function mostrarCarrito(){
  document.getElementById('seccionCarrito').innerHTML =
  `
  <h2 class="mb-5">Carrito</h2>
  `;
  axios({
    method: 'get',
    url: '../backend/api/carritos.php?id='+document.getElementById('cliente-viendo').value,
    responseType: 'json'
  }).then(res=>{
    let carrito = res.data;
    console.log(carrito);

    if(res.data.length === 0 || res.data === undefined){
      document.getElementById('seccionCarrito').innerHTML +=
      `
      <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
      <div class="flex-grow-1">
          <h3 class="mb-5">No hay productos agregados al carrito</h3>
      </div>
      </div>
      `;
    }else{
      for(let i=0; i<carrito.length ; i++){
        document.getElementById('seccionCarrito').innerHTML +=
        `
        <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
        <div class="flex-grow-1">
        <h3 class="mb-0">Carrito Agregado No. ${i+1}</h3>
        <div class="subheading mb-3">Precio Unitario: ${carrito[i].precio}</div>
        <p class="text-justify">Cantidad: ${carrito[i].cantidad}</p>
        </div>
        <div class="flex-shrink-0"><span class="text-primary" style="cursor: pointer">Ver Producto</span></div>
        </div>
        `;
        }
      }
    }).catch(error=> {
      console.error(error);
    });

}


function mostrarFavoritos(){
  document.getElementById('seccionFavoritos').innerHTML =
  `
  <h2 class="mb-5">Favoritos</h2>
  `;
  axios({
    method: 'get',
    url: '../backend/api/clientes.php?id='+document.getElementById('cliente-viendo').value,
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
