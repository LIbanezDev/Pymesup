<?php
include_once('./conexion.php');

$nombre = $_POST['nombre'];
$codigo = $_POST['codigo'];
$precio = $_POST['precio'];
$cantidad = $_POST['cantidad'];
$empID = $_POST['empID'];

if($cantidad <= 0 || $precio < 0 || $codigo < 0){
    die("FATAL ERROR");
}else{
    $validarProds = "SELECT * FROM productos WHERE productos.rut_empresa = '$empID' AND productos.codigo = '$codigo' ";
    $result = $conexion->query($validarProds);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        die("Este codigo ya lo has usado, prueba con otro.");
    }else{
    $query = "INSERT INTO productos (rut_empresa, codigo, nombre, precio, stock, valido) VALUES ('$empID', '$codigo', '$nombre', '$precio', '$cantidad', 1)";
    
    if ($conexion->query($query) === TRUE) {
        header('Location: ../inventario.php?empID='.$empID);    
    }else{
        die("Error al añadir producto".$conexion->error); 
    }

    }

}

?>