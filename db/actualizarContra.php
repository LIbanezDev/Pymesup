<?php
session_start();
include_once('./conexion.php');

$correo = $_SESSION['conectado'];
$contraNueva = $_POST['contrasenaNueva'];
$contraNuevaVal = $_POST['contrasena2Nueva'];

if($contraNueva != $contraNuevaVal){
    die("Las contraseñas no coinciden.");
}else{
    $hash = password_hash($contraNueva, PASSWORD_BCRYPT);
    $actualizacion = "UPDATE usuarios SET contrasena = '$hash' WHERE email = '$correo' ";
    if ($conexion->query($actualizacion) === TRUE) {
        header('Location: ./cerrarSesion.php');    
    }else{
        die("Error al cambiar contraseña".$conexion->error); 
    }
}


?>