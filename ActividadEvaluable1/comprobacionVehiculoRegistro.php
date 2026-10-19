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

if(!isset($_SESSION['errores'])){
    $_SESSION['errores'] = null;
}


    try {
        $sql = "INSERT INTO vehiculos (asientos, clase, color, marca, matricula, modelo, motorizacion, puertas, transmicion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$asientos, $clase, $color, $marca, $matricula, $modelo, $motorizacion, $puertas, $transmision]);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }



?>