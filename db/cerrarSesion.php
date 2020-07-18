<?php
session_start();
$_SESSION['conectado'] = NULL;
session_destroy();
header('Location: ../index.php');
?>