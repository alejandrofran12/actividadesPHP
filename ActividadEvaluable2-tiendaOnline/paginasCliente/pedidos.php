<?php
session_start();
require "../conexion/conexion.php";

$sql = "SELECT p.modelo, p.marca, d.precio_unitario, d.cantidad, pe.fecha, pe.id 
    FROM productos p INNER JOIN detalle_pedido d INNER JOIN pedidos pe ON d.pedido_id = pe.id 
    ON d.producto_id = p.id WHERE pe.cliente_id = ? ORDER BY pe.id DESC;";

$sentencia = $conn->prepare($sql);
$sentencia->execute([$_SESSION['id']]);
$pedidos = $sentencia->fetchAll();  

$pedidosSeparados = [];

$cont = 0;
foreach($pedidos as $pedido){
    if($pedido['id']){
        
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Tus pedidos</h1>
</body>
