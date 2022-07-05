<?php
    include "../clases/Conexion.php";
    include "../clases/Crud.php";
 
    $Crud = new Crud();
 
    $id = $_POST['id'];
    $datos = array(
        "nombre" => $_POST['nombre'],
        "apellido" => $_POST['apellido'],
        "edad" => $_POST['edad'],
        "email" => $_POST['email'],
        "celular" => $_POST['celular']
    );
 
    $respuesta = $Crud->actualizar($id, $datos);
 
    if ($respuesta->getModifiedCount() > 0 || $respuesta->getMatchedCount() > 0) {
        header("location:../empleados/index.php");
    } else {
        print_r($respuesta);
    }
								
?>