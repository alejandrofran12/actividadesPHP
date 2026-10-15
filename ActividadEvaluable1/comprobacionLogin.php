<?php
session_start();
include("conexion.php");

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header ("Location: registro.php");
    exit;
}

$dni = $_POST['dni'];
$contra = $_POST['contrasena'];

try{
    $sql = "SELECT nombre, contrasena, nombre FROM clientes WHERE dni = ?";
    $resultado = $conn->prepare($sql);
    $resultado->execute([$dni]);
    $usuario = $dsdsdresultado->fetch();
    if($dni == $usuario['dni'] && $contra == $usuario['contrasena']){
        $_SESSION['dni'] = $usuario['dni'];
        $_SESSION['contrasena'] = $usuario['contrasena'];
        $_SESSION['nombre'] = $usuario['nombre'];
        echo "sesion iniciada"; 
    }else{
        header('Location: login.php');
    }
}catch(PDOException $e){

}

