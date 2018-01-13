<?php

echo "buscar";
session_start();
echo $_SESSION['usuario'];



 $nombre = antiSqlinjection($_POST['nombre']);
// $nombre= "silla";
// echo "Art. buscar: " . $nombre;
function antiSqlinjection($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


//fich configuracion de acceso al servidor
include "config.php";
//Realizar conexion con la Base de datos

//echo "Sesión del usuario" . $_SESSION['usuario'];

$conexion = mysqli_connect($db_server, $db_user, $db_pass, $db_name) or die("Error: " . mysqli_error($conexion));;

//Consulta a realizar
//INSERT INTO `objetos` (`id`, `nombre`, `url`, `precio`) VALUES (NULL, 'prueba', 'pruebita.com', '1');
$query = "SELECT * FROM objetos WHERE nombre = '$nombre' AND usuario= '$suser' ";
//"INSERT INTO objetos (id,nombre,url,precio) VALUES (NULL,'$nombre','$url','$precio')";
//$query ="SELECT * FROM objetos";


//lanzamos la Consulta

if (!$resultado = $conexion->query($query)){
  echo "Lo sentimos, este sitio web está experimentando problemas.";

   // De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
   // cómo obtener información del error
   echo "Error: La ejecución de la consulta falló debido a: \n";
   echo "\nQuery: " . $query . "\n";
   echo "\nErrno: " . $conexion->errno . "\n";
   echo "\nError: " . $conexion->error . "\n";
   exit;
}

//listamos
if ($row = $resultado-> fetch_array()){//mysql_fetch_array($resultado)
   echo "<table border = '1'> \n";
   echo "<tr><td>Nombre</td><td>URL</td><td>Precio</td></tr> \n";
   do {
      echo "<tr><td>".$row["nombre"]."</td><td>".$row["url"]."</td><td>".$row["precio"]."€</td></tr> \n";
   } while ($row = $resultado-> fetch_array());
   echo "</table> \n";
} else {
echo "¡No se ha encontrado ningun registro!";
}

//liberamos el RESULTADO
$resultado->free();

//Cerramos conexion
mysqli_close($conexion);



 ?>
