<?php
session_start();
include_once('./conexion.php');

//PARA BORRAR UN PRODUCTO JUNTO A SUS VERIFICACIONES
if(isset($_GET['del']) && isset($_GET['empID']) && isset($_SESSION['conectado'])){
    //VERIFICAR SI EL NUEVO CODIGO EXISTE
    $delCode = $_GET['del'];
    $delEmp = $_GET['empID'];
    $correo = $_SESSION['conectado'];
    $validarDel = "SELECT * FROM empresas WHERE empresas.correo_dueno = '$correo' AND empresas.rut_empresa = (SELECT productos.rut_empresa FROM productos WHERE productos.codigo = '$delCode') ";
    $resultDel = $conexion->query($validarDel);
    $countDel = mysqli_num_rows($resultDel);

    if ($countDel == 1) {
        $delete = "UPDATE productos SET productos.valido = 0 WHERE productos.codigo = '$delCode' AND productos.rut_empresa = '$delEmp'";
        if ($conexion->query($delete) === TRUE) {
            header('Location: ../inventario.php?empID='.$delEmp);    
        }else{
            die("Error al eliminar producto".$conexion->error); 
        }
    }else{
        die("No tiene los permisos para realizar esta operación.");        
    }
}else{

    $empID = $_POST['empID'];
    $codProd = $_POST['prod']; //ORIGINAL
    $codigo = $_POST['codigo']; //MODIFICADO
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['cantidad'];

    if($stock < 0 || $precio < 0 || $codigo < 0){
        //ESTADO DE PRODUCTO NO VALIDO
        die("DATOS NO VALIDOS");
    }else{
        //VERIFICAR SI EL NUEVO CODIGO EXISTE
        $validarProds = "SELECT * FROM productos WHERE productos.rut_empresa = '$empID' AND productos.codigo = '$codigo' ";
        $result = $conexion->query($validarProds);
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            die("Este codigo ya lo has usado, prueba con otro.");
        }else{
            //ACTUALIZANDO LOS DATOS
            $actualizacion = "UPDATE productos SET productos.codigo = '$codigo', productos.nombre = '$nombre', productos.precio = '$precio', productos.stock = '$stock' WHERE productos.codigo = '$codProd' AND productos.rut_empresa = '$empID'";
            
            if ($conexion->query($actualizacion) === TRUE) {
                header('Location: ../inventario.php?empID='.$empID);    
            }else{
                die("Error al actualizar producto".$conexion->error); 
            }

        }

    }
}



?>