<?php

session_start();
//recoger la informacion enviada

  //Crear variables de Session para el cookie
$adios = $_SESSION['usuario']
echo "\nNombre de sesion usuario :" . $_SESSION['usuario'];

//cerramos session
session_destroy();

if(!$_SESSION['usuario']){
  return false;
}else{
  return true;
}

?>
