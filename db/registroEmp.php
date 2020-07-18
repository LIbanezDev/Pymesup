<?php
session_start();
include_once('./conexion.php');

$correo = $_SESSION['conectado'];
$form_nombre = $_POST['nombre_emp'];
$form_rubro = $_POST['rubro'];
$form_rut_emp = $_POST['rut_emp'];

if($form_rubro != "tecnologia" && $form_rubro != "cocina" && $form_rubro != "otro" && $form_rubro && "logistica" && $form_rubro != "abastecimiento"){
    die("El rubro ingresado no es válido");
}else{
    $buscarEmpresas = "SELECT * FROM empresas WHERE rut_empresa = '$form_rut_emp' ";
    $result = $conexion->query($buscarEmpresas);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        die("Ya existe una empresa con estos atributos.");
    }else{
        
        $query = "INSERT INTO empresas (correo_dueno, rut_empresa) VALUES ('$correo', '$form_rut_emp')";
        $query2 = "INSERT INTO empresas_info (rut_empresa, nombre_emp, rubro) VALUES ('$form_rut_emp', '$form_nombre', '$form_rubro')";

        if ($conexion->query($query) === TRUE && $conexion->query($query2) === TRUE) {
            header('Location: ../account.php');    
        }else{
            die("Error al generar empresa".$conexion->error); 
        }
    }
    mysqli_close($conexion);
}
?>