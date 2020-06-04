<?php
session_start();
session_destroy();
setcookie("token","",time()-1, "/");
setcookie("codigoEmpresa", "",time()-1, "/");
setcookie("nombreEmpresa", "",time()-1, "/");


header("Location: ../../frontend/landing.html");

 ?>
