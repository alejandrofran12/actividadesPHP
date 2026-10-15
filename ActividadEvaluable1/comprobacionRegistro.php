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
$contrasena = hashearContraseña();

$ruta = "permisos/";
$rutaYarchivo = $ruta . basename($_FILES['archivoUsuario']['name']);
$extension = strtolower(pathinfo($_FILES['archivoUsuario']["name"], PATHINFO_EXTENSION));
fotoDNI($rutaYarchivo);
$archivo = $ruta . $_FILES['archivoUsuario']['name']; 

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

function fotoDNI($rutaArchivo){
    move_uploaded_file($_FILES['archivoUsuario']['tmp_name'], $rutaArchivo);
}

function hashearContraseña(){
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
    return $contrasena;
}
?>

