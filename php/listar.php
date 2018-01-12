<?php

session_start();
echo $_SESSION['usuario'];

//fich configuracion de acceso al servidor
include "config.php";
//Realizar conexion con la Base de datos

//echo "Sesión del usuario" . $_SESSION['usuario'];

$conexion = mysqli_connect($db_server, $db_user, $db_pass, $db_name) or die("Error: " . mysqli_error($conexion));;

//Consulta a realizar
$query ="SELECT * FROM objetos";
// $query = "SELECT nombre FROM alumnos WHERE id=1";
// "SELECT * FROM alumnos WHERE usuario = '$usuario' AND contrasena = '$contrasena'";



//lanzamos la Consulta
$resultado = $conexion->query($query);

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
