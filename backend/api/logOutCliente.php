<?php
session_start();
session_destroy();
setcookie("token","",time()-1, "/");
setcookie("codigoCliente", "",time()-1, "/");

header("Location: ../../frontend/landing.html");

 ?>
