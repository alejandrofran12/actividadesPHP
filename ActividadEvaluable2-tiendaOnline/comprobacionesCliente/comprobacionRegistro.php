<?php
session_start();
include("conexion.php");


$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$usuario = $_POST['fecha_nacimiento'];
$contrasena = hashearContraseña();


if(!isset($_SESSION['errores'])){
    $_SESSION['errores'] = null;
}

if(empty($nombre) && empty($email) && empty($usuario) && empty($contrasena)){
    $_SESSION['errores'] = "Te faltan campos por rellenar";
    header ("Location: registro.php");
    exit;
}elseif(buscarUsuario($usuario, $conn) == true){
    $_SESSION['errores'] = "Este usuario ya existe";
    header ("Location: registro.php");
    exit;
}else{
    try {
        $sql = "INSERT INTO clientes (dni, nombre, apellidos, contrasena, fecha_nacimiento, foto_dni) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$dni, $nombre, $apellidos, $contrasena, $fecha, $archivo]);
        header('Location: ../login.php');
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function hashearContraseña(){
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
    return $contrasena;
}

function buscarUsuario($usuario, $conn){
    $sql = "SELECT usuario FROM clientes WHERE usuario = ?";
    $sentencia = $conn->prepare($sql);
    $sentencia->execute([$usuario]);
    $dniUsuario = $sentencia->fetch();
    
    return $dniUsuario;
}
