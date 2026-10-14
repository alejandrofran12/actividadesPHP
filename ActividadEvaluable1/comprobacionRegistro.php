<?php
session_start();
include("conexion.php");

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header ("Location: registro.php");
    exit;
}

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$dni = $_POST['dni'];
$fecha = $_POST['fecha_nacimiento'];
$contrasena = $_POST['contrasena'];
$archivo = file_get_contents($_FILES['archivoUsuario']['tmp_name']);

if(!isset($_SESSION['errores'])){
    $_SESSION['errores'] = null;
}

if(empty($nombre ) && empty($apellidos) && empty($dni) && empty($fecha) && empty($contrasena) && empty($archivo)){
    $_SESSION['errores'] = "Debes rellenar todos los campos";
    header ("Location: registro.php");
}else{
    try {
        $sql = "INSERT INTO clientes (dni, nombre, apellidos, contrasena, fecha_nacimiento, foto_dni) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$dni, $nombre, $apellidos, $contrasena, $fecha, $archivo]);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


?>
