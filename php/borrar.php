<?php
session_start();
// DELETE FROM `objetos` WHERE `objetos`.`id` = 9

$suser = $_SESSION['usuario'];
echo $suser;


$nombre = antiSqlinjection($_POST['nombre']);



function antiSqlinjection($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
echo "Art. eliminar: " . $nombre;



//fich configuracion de acceso al servidor
include "config.php";
//Realizar conexion con la Base de datos

//echo "Sesión del usuario" . $_SESSION['usuario'];

$conexion = mysqli_connect($db_server, $db_user, $db_pass, $db_name) or die("Error: " . mysqli_error($conexion));;

//Consulta a realizar
//INSERT INTO `objetos` (`id`, `nombre`, `url`, `precio`) VALUES (NULL, 'prueba', 'pruebita.com', '1');
$query = "DELETE FROM objetos WHERE nombre = '$nombre' AND usuario= '$suser'";
//"INSERT INTO objetos (id,nombre,url,precio) VALUES (NULL,'$nombre','$url','$precio')";
//$query ="SELECT * FROM objetos";


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


//liberamos el RESULTADO
//$resultado->free();
//Cerramos conexion
mysqli_close($conexion);



 ?>
