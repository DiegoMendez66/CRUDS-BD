<?php
    require_once "conexion.php";

    $id=$_POST['id'];
    $sql="CALL sp_obtener($id)";

	$result=mysqli_query($MySQLiconn,$sql);

	$ver=mysqli_fetch_row($result);

	$datos=array(
			  'id'=>$ver[0],
              'nombre'=>$ver[1],
              'desarrollador'=>$ver[2],
              'genero'=>$ver[3],
              'año'=>$ver[4],
              'precio'=>$ver[5]
					);
	echo json_encode($datos);
?>