<?php
session_start();
$suser = $_SESSION['usuario'];
echo $suser;

$nombre_viejo = antiSqlinjection($_POST['nombre_viejo']);
$url_viejo = antiSqlinjection($_POST['url_viejo']);
$precio_viejo = antiSqlinjection($_POST['precio_viejo']);

$nombre_nuevo = antiSqlinjection($_POST['nombre_nuevo']);
$url_nuevo = antiSqlinjection($_POST['url_nuevo']);
$precio_nuevo = antiSqlinjection($_POST['precio_nuevo']);



function antiSqlinjection($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// $nombre_viejo = "lampara";
// $url_viejo = "caasanova.es";
// $precio_viejo = "21";
//
// $nombre_nuevo = "lampara flexo";
// $url_nuevo = "";
// $precio_nuevo = "66";

//echo "VIEJO NOMBRE: " . $nombre_viejo . "URL: " . $url_viejo . "PRECIO: " .  $precio_viejo;
//echo "NUEVO NOMBRE: " . $nombre_nuevo . "URL: " . $url_nuevo . "PRECIO: " .  $precio_nuevo;



//fich configuracion de acceso al servidor
include "config.php";
//Realizar conexion con la Base de datos

//echo "Sesión del usuario" . $_SESSION['usuario'];

$conexion = mysqli_connect($db_server, $db_user, $db_pass, $db_name) or die("Error: " . mysqli_error($conexion));;

//Consulta a realizar
//INSERT INTO `objetos` (`id`, `nombre`, `url`, `precio`) VALUES (NULL, 'prueba', 'pruebita.com', '1');
 $query = "UPDATE  objetos  SET nombre = '$nombre_nuevo',
                                 url = '$url_nuevo',
                                 precio = '$precio_nuevo'
                          WHERE nombre ='$nombre_viejo' AND
                                 url = '$url_viejo' AND
                                precio = '$precio_viejo' AND usuario = '$suser'";

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
 //listamos
 // if ($row = $resultado-> fetch_array()){//mysql_fetch_array($resultado)
 //    echo "<table border = '1'> \n";
 //    echo "<tr><td>Nombre</td><td>URL</td><td>Precio</td></tr> \n";
 //    do {
 //       echo "<tr><td>".$row["nombre"]."</td><td>".$row["url"]."</td><td>".$row["precio"]."€</td></tr> \n";
 //    } while ($row = $resultado-> fetch_array());
 //    echo "</table> \n";
 // } else {
 // echo "¡No se ha encontrado ningun registro!";
 // }

 //liberamos el RESULTADO
 //$resultado->free();
 // update alumnos set mail='$_REQUEST[mailnuevo]' where mail='$_REQUEST[mailviejo]
 //"INSERT INTO objetos (id,nombre,url,precio) VALUES (NULL,'$nombre','$url','$precio')";
// //$query ="SELECT * FROM objetos";
//
//
//
//
// //lanzamos la Consulta
//  $conexion->query($query);
//  $todo ="SELECT * FROM objetos";
// $resultado =  $conexion->query($todo);
// //listamos
// if ($row = $resultado-> fetch_array()){//mysql_fetch_array($resultado)
//    echo "<table border = '1'> \n";
//    echo "<tr><td>Nombre</td><td>URL</td><td>Precio</td></tr> \n";
//    do {
//       echo "<tr><td>".$row["nombre"]."</td><td>".$row["url"]."</td><td>".$row["precio"]."€</td></tr> \n";
//    } while ($row = $resultado-> fetch_array());
//    echo "</table> \n";
// } else {
// echo "¡No se ha encontrado ningun registro!";
// }


//Cerramos conexion
mysqli_close($conexion);


 ?>
