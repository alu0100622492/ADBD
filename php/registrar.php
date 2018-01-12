<?php

//Iniciar sesion para el cookie
session_start();
//recoger la informacion enviada
// $usuario = antiSqlinjection($_POST['usuario']);
// $contrasena = antiSqlinjection($_POST['contrasena']);
$usuario = "";
$contrasena = "";


echo "Usuario en php: " . $usuario;
echo "Contraseña en php: " . $contrasena;

// $consulta = $_POST['consulta'];
//$consulta = addslashes($_POST['consulta']);
// htmlspecialchars($_POST['nombre'])


function antiSqlinjection($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


//




//fich configuracion de acceso al servidor
include "config.php";
//Realizar conexion con la Base de datos
if($usuario!='' && $contrasena!=''){
$conexion = mysqli_connect($db_server, $db_user, $db_pass, $db_name) or die("Error al conectar la BBDD: " . mysqli_error($conexion));

//Consulta a realizar
$query ="INSERT INTO usuarios (id_usuario,nombre,password) VALUES (NULL,'$usuario','$contrasena')";
// "SELECT * FROM usuarios WHERE nombre = '$usuario'";

// INSERT INTO `usuarios` (`id_usuario`, `nombre`, `password`) VALUES (NULL, 'joaquin', 'joaquin');
// $query = "SELECT nombre FROM alumnos WHERE id=1";
// "SELECT * FROM alumnos WHERE usuario = '$usuario' AND contrasena = '$contrasena'";


//
// echo "QUERY". $query;
//lanzamos la Consulta
//$resultado = $conexion->query($query);
if (!$resultado = $conexion->query($query)){
  echo "Lo sentimos, este sitio web está experimentando problemas.";

   // De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
   // cómo obtener información del error
   echo "Error: La ejecución de la consulta falló debido a: \n";
   echo "Query: " . $query . "\n";
   echo "Errno: " . $conexion->errno . "\n";
   echo "Error: " . $conexion->error . "\n";
   exit;
}
//echo "RESULTADO" . $resultado;
//listamos
$fila=$resultado->fetch_array();

// if($fila==null){
//  echo "no hay nadie";
// }else{
// echo "Hemos encontrado al usuario" . $fila['nombre'];
// }
 //Comprobamos el resultado
if( mysqli_num_rows($resultado) > 0 ){//filas
  //login correcto
  echo mysqli_num_rows($resultado);
  //Crear variables de Session para el cookie
  $_SESSION['usuario'] = $usuario;
  //$_SESSION['contrasena'] = $contrasena;

  //Devolvemos cierto
  echo true;
}else{
  //usuario no existe
  echo false;
}

// echo "\nNombre de sesion :" . $_SESSION['usuario'];



//liberamos el RESULTADO
$resultado->free();
//Cerramos conexion
 mysqli_close($conexion);


}else{
  return null;
}





 ?>
