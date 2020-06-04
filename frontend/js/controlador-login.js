function loginCliente(){
  axios({
    url: "../backend/api/loginClientes.php",
    method: "post",
    responseType: 'json',
    data: {
      emailCliente: document.getElementById('emailInputCliente').value,
      passwordCliente: document.getElementById('passwordInputCliente').value
    }
  }).then(res=>{
    if(res.data.codigoResultado==1){
      window.location.href = "vistaCliente.html";
    }else{
      console.log("error dku");
    }
    console.log(res);
  }).catch(error=> {
    console.error(error);
  });
}

function loginEmpresa(){
  axios({
    url: "../backend/api/loginEmpresas.php",
    method: "post",
    responseType: 'json',
    data: {
      emailEmpresa: document.getElementById('emailInputEmpresa').value,
      passwordEmpresa: document.getElementById('passwordInputEmpresa').value
    }
  }).then(res=>{
    if(res.data.codigoResultado==1){
      window.location.href = "vistaEmpresa.html";
    }else{
      console.log("error dku");
    }
    console.log(res);
  }).catch(error=> {
    console.error(error);
  });
}
