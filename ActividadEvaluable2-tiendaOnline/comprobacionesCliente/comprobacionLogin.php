<?php
session_start();
require("../conexion/conexion.php");

$usuario = $_POST['usuario'];
$contra = $_POST['contrasena'];

try{
    //cliente
    $sql1 = "SELECT usuario, contrasena, nombre FROM clientes WHERE usuario = ?";
    $resultadoCliente = $conn->prepare($sql1);
    $resultadoCliente->execute([$usuario]);
    $cliente = $resultadoCliente->fetch();

    if($cliente && password_verify($contra, $cliente['contrasena'])){
        $_SESSION['nombre'] = $cliente['nombre'];
        header('Location: ../index.php'); 
        exit;
    }else{
        $_SESSION['errores'] = "Credenciales incorrectas";
        header('Location: ../paginasCliente/iniciarSesion.php');
        exit;
    }
}catch(PDOException $e){
    echo "". $e->getMessage();
}