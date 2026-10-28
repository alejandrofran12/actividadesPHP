<?php
session_start();
include("conexion.php");

$matricula = $_POST['matricula'];
$fechaRecogida = $_POST['fechaRecogida'];
$fecha_devolucion = $_POST['fechaDevolucion'];
$precio = $_POST['precioOriginal'];
$descuentoPorDiasExtras = $_POST['descuentoPorDiasExtras'];
$id_Cliente = $_SESSION['dni'];

try {
    $sql = "INSERT INTO reservas (matricula_coche, fecha_reserva, fecha_devolucion, precio_real, precio_descuento, id_cliente)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $matricula,
        $fechaRecogida,
        $fecha_devolucion,
        $precio,
        $descuentoPorDiasExtras,
        $id_Cliente
    ]);
    header('Location: principal.php');
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}