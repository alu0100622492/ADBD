<?php
session_start();

$suser = $_SESSION['usuario'];
echo $suser;




$nombre = antiSqlinjection($_POST['nombre']);
$url = antiSqlinjection($_POST['url']);
$precio = antiSqlinjection($_POST['precio']);

// echo "NOMBRE: " . $nombre . "URL: " . $url . "PRECIO: " .  $precio;
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
$query = "INSERT INTO objetos (id,nombre,url,precio,usuario) VALUES (NULL,'$nombre','$url','$precio','$suser')";
//$query ="SELECT * FROM objetos";




//lanzamos la Consulta
 $conexion->query($query);
 $todo ="SELECT * FROM objetos WHERE usuario = '$suser'";
$resultado =  $conexion->query($todo);
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


//Cerramos conexion
mysqli_close($conexion);


?>
