<?php
    include "../clases/Conexion.php";
    include "../clases/Crud.php";

    $crud = new Crud();

    $id=$_POST['id'];
    $datos = $crud->obtenerDocumento($id);
    echo json_encode($datos);
?>