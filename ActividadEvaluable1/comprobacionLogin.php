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
    $sql = "SELECT nombre, contrasena, dni FROM clientes WHERE dni = ?";
    $resultado = $conn->prepare($sql);
    $resultado->execute([$dni]);
    $usuario = $resultado->fetch();
    
    if($usuario && password_verify($contra, $usuario['contrasena'])){
        $_SESSION['dni'] = $usuario['dni'];
        $_SESSION['contrasena'] = $usuario['contrasena'];
        $_SESSION['nombre'] = $usuario['nombre'];
        header('Location: panel.php'); 
    }else{
        $_SESSION['errores'] = "Credenciales incorrectas";
        header('Location: login.php');
    }
}catch(PDOException $e){
    echo "". $e->getMessage();
}

