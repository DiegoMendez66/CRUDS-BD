<?php
require_once "conexion.php";

$nombre=$_POST['nombre'];
$desarrollador=$_POST['desarrollador'];
$genero=$_POST['genero'];
$año=$_POST['año'];
$precio=$_POST['precio'];

$sql="CALL sp_insertar('$nombre','$desarrollador','$genero','$año','$precio')";

echo mysqli_query($MySQLiconn,$sql);

?>

