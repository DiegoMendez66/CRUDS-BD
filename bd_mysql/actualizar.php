<?php
    require_once "conexion.php";
    
	$id=$_POST['id'];
	$nombre=$_POST['nombre'];
	$desarrollador=$_POST['desarrollador'];
	$genero=$_POST['genero'];
    $año=$_POST['año'];
    $precio=$_POST['precio'];

	$sql="CALL sp_actualizar('$nombre',
							'$desarrollador',
							'$genero',
							'$año',
                            '$precio',
                            '$id')";
									
	echo mysqli_query($MySQLiconn,$sql);
?>


