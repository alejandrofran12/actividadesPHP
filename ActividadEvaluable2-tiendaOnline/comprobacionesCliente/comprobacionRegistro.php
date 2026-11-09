<?php
session_start();
include("../conexion/conexion.php");


$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

if(empty($nombre) || empty($email) || empty($usuario) || empty($contrasena)){
    $_SESSION['errores'] = "Te faltan campos por rellenar";
    header ("Location: registro.php");
    exit;
}elseif(buscarUsuario($usuario, $conn) === true){
    $_SESSION['errores'] = "Este usuario ya existe";
    header ("Location: registro.php");
    exit;
}else{
    try {
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);

        $sql = "INSERT INTO clientes (nombre, telefono, email, usuario, contrasena) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nombre, $telefono, $email, $usuario, $hash]);
        $_SESSION['informacion'] = "Usuario registado!";
        header('Location: ../paginasCliente/iniciarSesion.php');
        exit;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function buscarUsuario( string $usuario, PDO $conn): bool {
    $sql = "SELECT usuario FROM clientes WHERE usuario = ?";
    $sentencia = $conn->prepare($sql);
    $sentencia->execute([$usuario]);
    $dniUsuario = $sentencia->fetch();
    
    return $dniUsuario;
}
