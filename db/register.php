<?php
include_once('./conexion.php');

$form_pass = $_POST['contrasena'];
$form_email = $_POST['correo'];
$ver_pass = $_POST['contrasena2'];

if($form_pass != $ver_pass){
    die("Las contraseñas no coinciden.");
}else{
    $buscarUsuario = "SELECT * FROM usuarios WHERE email = '$form_email' ";

    $result = $conexion->query($buscarUsuario);

    $count = mysqli_num_rows($result);

    if ($count == 1) {
        die("El email ya se encuentra registrado.");
    }else{
        $hash = password_hash($form_pass, PASSWORD_BCRYPT);

        $query = "INSERT INTO usuarios (email, contrasena) VALUES ('$form_email', '$hash')";

        if ($conexion->query($query) === TRUE) {
            header('Location: ../login.php');    
        }else{
            die("Error al crear cuenta".$conexion->error); 
        }
    }
}
mysqli_close($conexion);
?>