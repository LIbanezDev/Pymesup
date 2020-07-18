<?php

session_start();

?>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-brand">
                <img src="../assets/img/pymesupLogo.png" width="40" height="40"> Pymesup
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="about.php">Sobre Nosotros</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                    <?php if(!isset($_SESSION['conectado'])){?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Iniciar sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Registrarse</a>
                        </li>
                    <?php }else{ ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="account.php">Mi cuenta</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="db/cerrarSesion.php">Cerrar sesión</a>
                            </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</header>