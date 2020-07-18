<?php
session_start();
include_once('./conexion.php');

if (!empty($_POST['correo']) || !empty($_POST['contrasena'])){
    $username=$_POST['correo'];
    $password=$_POST['contrasena'];
    $result = mysqli_query($conexion, "SELECT email, contrasena FROM usuarios WHERE email = '$username'");
    $fila = mysqli_fetch_assoc($result);
    $hash = $fila['contrasena'];

    if(password_verify($password, $hash)){
        $_SESSION['conectado'] = $username;
        header("Location: ../account.php");
    }else{
        die("Contraseña incorrecta".$conexion->error);
    }

}else{
    die("Ha ocurrido un error al iniciar sesión");
}




?>