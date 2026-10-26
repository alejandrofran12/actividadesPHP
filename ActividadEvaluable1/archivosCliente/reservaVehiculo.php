<?php
session_start();
include("conexion.php");

$matricula = $_POST['matricula'];
$fechaRecogida = $_POST['fechaRecoida'];
$fecha_devolucion = $_POST['fechaDevolucion'];
$precio = $_POST['precio'];
$descuentoPorDiasExtras = $_POST['descuentoPorDiasExtras'];

try {
    $sql = "INSERT INTO reservas (matricula_coche, fecha_reserva, fecha_devolucion, precio_real, precio_descuento)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $matricula,
        $fechaRecogida,
        $fechaDevolucion,
        $precio,
        $descuentoPorDiasExtras
    ]);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}