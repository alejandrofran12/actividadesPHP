<?php
session_start();

if(!isset($_SESSION['dni'])){
    header('location: login.php');
    exit;
}

?>
<h1>BIENVENIDO . <?php $_SESSION['nombre'] . ?> </h1>
