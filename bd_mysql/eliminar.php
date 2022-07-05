<?php

    require_once "conexion.php";
    $id=$_POST['id'];
    $sql="CALL sp_eliminar('$id')";
    
    echo mysqli_query($MySQLiconn,$sql);
?>


