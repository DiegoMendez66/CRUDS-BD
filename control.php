<?php 
include('bd_mysql/conexion.php');

$username=$_POST['username'];
$password=$_POST['password'];

session_start();
$_SESSION['username']=$username;
$_SESSION['password']=$password;


$consulta=$MySQLiconn->query("SELECT * FROM usuarios where username='$username' and password='$password'");

$filas = mysqli_num_rows($consulta);

if($filas){
    header("location:home.php");
}else{
    ?>
    <?php
    include("index.php");
    ?>
    <!-- <h1 class="bad">ERROR EN LA AUTENTICACIÓN</h2> -->
    <?php
}

mysqli_free_result($consulta);