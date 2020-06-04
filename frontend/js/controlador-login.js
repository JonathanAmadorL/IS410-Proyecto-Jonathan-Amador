function login(){
  axios({
    url: "../backend/api/loginClientes.php",
    method: "post",
    responseType: 'json',
    data: {
      emailCliente: document.getElementById('emailInput').value,
      passwordCliente: document.getElementById('passwordInput').value
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
      emailEmpresa: document.getElementById('emailInput').value,
      passwordEmpresa: document.getElementById('passwordInput').value
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
