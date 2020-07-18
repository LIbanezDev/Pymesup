<?php
session_start();
include_once('./conexion.php');

$correoAnterior = $_SESSION['conectado'];
$correoNuevo = $_POST['correoNuevo'];

if($correoNuevo == $correoAnterior){
    die("El correo es el mismo.");
}else{
    $buscarUsuario = "SELECT * FROM usuarios WHERE email = '$correoNuevo' ";

    $result = $conexion->query($buscarUsuario);

    $count = mysqli_num_rows($result);

    if ($count == 1) {
        die("Este email ya se encuentra registrado.");
    }else{
        $actualizacion = "UPDATE usuarios SET usuarios.email = '$correoNuevo' WHERE usuarios.email = '$correoAnterior' ";
        $actualizacion2 = "UPDATE empresas SET empresas.correo_dueno = '$correoNuevo' WHERE empresas.correo_dueno = '$correoAnterior'";
        if ($conexion->query($actualizacion) === TRUE) {
            $conexion->query($actualizacion2); // Lo pongo acá, ya que si un usuario cambia su correo sin tener empresa, no necesariamente TRUE
            header('Location: ./cerrarSesion.php');    
        }else{
            die("Error al cambiar email".$conexion->error); 
        }
    }
}

?>