<?php
    include "../clases/Conexion.php";
    include "../clases/Crud.php";

    $Crud = new Crud();

    $datos = array(
        "nombre" => $_POST['nombre'],
        "apellido" => $_POST['apellido'],
        "edad" => $_POST['edad'],
        "email" => $_POST['email'],
        "celular" => $_POST['celular'],
    );

    $respuesta = $Crud->insertarDatos($datos);

    if($respuesta->getInsertedId() > 0){
        header("location:../empleados/modal.php");
    } else {
        print_r($respuesta);
    }
?>

