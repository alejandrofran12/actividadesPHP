<?php
session_start();
include("conexion.php");


$matricula = $_POST['matricula'];
$fechaRecogida = $_POST['fechaRecogida'];
$fecha_devolucion = $_POST['fechaDevolucion'];
$precio = $_POST['precioOriginal'];
$descuentoPorDiasExtras = $_POST['descuentoPorDiasExtras'];
$id_Cliente = $_SESSION['dni'];

$sqlComprobacionDisponibilidad = "SELECT matricula_coche FROM reservas WHERE matricula_coche = ?;";
$sentencia = $conn->prepare($sqlComprobacionDisponibilidad);
$sentencia->execute([$matricula]);
$resultado = $sentencia->fetchAll();

if(!empty($resultado)){
    $_SESSION['errores'] = [
        'destino' => 'reservaVehiculo.php',
        'mensaje' => 'Este vehiculo ya ha sido reservado',
    ];
    $_SESSION['fechaRecogida'] = $fechaRecogida;
    $_SESSION['fechaDevolucion'] = $fecha_devolucion;
    header('Location: panel.php');
    exit;
}

try {
    $sql = "INSERT INTO reservas (matricula_coche, fecha_reserva, fecha_devolucion, precio_real, precio_descuento, id_cliente, cancelada)
            VALUES (?, ?, ?, ?, ?, ?, 0)";

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