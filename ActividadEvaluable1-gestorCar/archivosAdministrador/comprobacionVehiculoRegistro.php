<?php
session_start();
include("conexion.php");

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header ("Location: registro.php");
    exit;
}

$matricula = $_POST['matricula'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$color = $_POST['color'];
$puertas = $_POST['puertas'];
$asientos = $_POST['asientos'];
$transmision = $_POST['transmision'];
$motorizacion = $_POST['motorizacion'];
$clase = $_POST['clase'];
$precio = $_POST['precio'];

if(!isset($_SESSION['errores'])){
    $_SESSION['errores'] = null;
}

if(empty($matricula) || empty($marca)|| empty($modelo) || empty($color) || empty($puertas) || empty($transmision) || empty($motorizacion) ||
empty($clase) || empty($precio) || empty($asientos)){
    $_SESSION['errores'] = [
        'destino' => 'comprobacionVehiculoRegistro.php',
        'mensaje' => 'campos vacios',
    ];
    header('Location: panelAdmin.php');
    exit;
}
    try {
        $sql = "INSERT INTO vehiculos (asientos, clase, color, marca, matricula, modelo, motorizacion, puertas, transmicion, precio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$asientos, $clase, $color, $marca, $matricula, $modelo, $motorizacion, $puertas, $transmision, $precio]);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage(); 
    }

