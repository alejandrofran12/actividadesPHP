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
    //cliente
    $sql1 = "SELECT nombre, contrasena, dni FROM clientes WHERE dni = ?";
    $resultadoCliente = $conn->prepare($sql1);
    $resultadoCliente->execute([$dni]);
    $usuarioCliente = $resultadoCliente->fetch();
    
    //admin
    $sql2 = "SELECT nombre, contrasena, dni FROM administradores WHERE dni = ?";
    $resultadoAdmin = $conn->prepare($sql2);
    $resultadoAdmin->execute([$dni]);
    $usuarioAdmin = $resultadoAdmin->fetch();

    if(password_verify($contra, $usuarioCliente['contrasena'])){
        $_SESSION['dni'] = $usuarioCliente['dni'];
        $_SESSION['nombre'] = $usuarioCliente['nombre'];
        header('Location: panel.php'); 
    }elseif($contra === $usuarioAdmin['contrasena']){
        $_SESSION['nombre'] = $usuarioAdmin['nombre'];
        $_SESSION['dniAdmin'] = $usuarioAdmin['dni'];
        header('Location: panelAdmin.php');
    }else{
        $_SESSION['errores'] = "Credenciales incorrectas";
        header('Location: login.php');
    }
}catch(PDOException $e){
    echo "". $e->getMessage();
}

