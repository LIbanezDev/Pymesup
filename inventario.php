<?php
session_start();
if(!isset($_GET['empID']) || !isset($_SESSION['conectado'])){
    header('Location: account.php');
}else{

    include_once('db/conexion.php');
    $correo = $_SESSION['conectado'];
    $rutEmpresa = $_GET['empID'];
    $verificador = "SELECT correo_dueno FROM empresas WHERE rut_empresa = '$rutEmpresa'";
    $result = $conexion->query($verificador);
    $query= mysqli_fetch_array($result);
    if($correo === $query[0]){
        //PARA SEGUIR CODEANDO ACÁ, HACERLO EN ESTE IF, IDK PROBLEMA DE CONDICIONAL.
        //EMPRESA-INFO
        $info = "SELECT * FROM empresas_info WHERE rut_empresa = '$rutEmpresa'";
        $busqueda = $conexion->query($info);
        $fila= mysqli_fetch_array($busqueda);

        //INVENTARIO
        $inventario = "SELECT * FROM productos WHERE productos.rut_empresa = '$rutEmpresa' AND productos.valido = 1";
        $algo = $conexion->query($inventario);
        $totalProds = mysqli_num_rows($algo);
        $lista = Array();
        while($row = mysqli_fetch_array($algo)){
            $lista[] = array($row['codigo'],$row['nombre'], $row['precio'], $row['stock']); 
        }
        
    }else{       
        die("Alto ahí cerebrito!");       
    }
}
?>

<!DOCTYPE html>
<html>

    <?php include_once('core/head.php');?>

    <body>

        <?php include_once('core/header.php');?>

        <main>
            <div class="container">
                <center><h1> <?php echo $fila['nombre_emp'];?>: </h1>
                <h5>Rut asociado al SII: <?php echo $rutEmpresa; ?></h5>
                <h5>Fecha de creación: <?php echo $fila['fecha_creacion'];?> </h5></center>
                <div class="container">                    
                    <a class="btn btn-primary" href="registroProducto.php?empID=<?php echo $rutEmpresa; ?>" role="button">Añadir un producto al inventario</a>
                    <h3>Productos en inventario: <?php echo $totalProds; ?></h3>
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Codigo</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for($i = 0; $i <= $totalProds-1; $i++){ ?>
                            <tr>
                                <th scope="row"><?php echo $lista[$i][0]; ?></th>
                                <td><?php echo $lista[$i][1]; ?></td>
                                <td><?php echo $lista[$i][2]; ?></td>
                                <td><?php echo $lista[$i][3]; ?></td>
                                <td><a href="producto.php?empID=<?php echo $rutEmpresa; ?>&prod=<?php echo $lista[$i][0]; ?>"><img src="assets/img/editar.svg"></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <div>
            </div>                  
        </main>

        <?php include_once('core/footer.php');?>
        
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>

</html>