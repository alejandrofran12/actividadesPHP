<?php
session_start();
require("../conexion/conexion.php");

$carrito = json_decode($_COOKIE['carrito' . $_SESSION['id']], true);

$ids = array();

foreach ($carrito as $producto) {
    $ids[] = $producto['id'];
}

$precios = obtenerProductosPrecio($conn, $ids);

if(isset($_POST['comprar'])){

    $sql = "INSERT INTO pedidos (cliente_id) VALUES (?);";
    $sentencia = $conn->prepare($sql);
    $sentencia->execute([$_SESSION['id']]);

    $idPedido = $conn->lastInsertId(); 

    $sql = "INSERT INTO detalle_pedido VALUES (?,?,?,?);";
    $cont = 0;
    foreach($carrito as $producto){
        $sentencia = $conn->prepare($sql);
        $sentencia->execute([$idPedido, $producto['id'], $producto['cantidad'], $precios[$cont]['precio'] * $producto['cantidad']]);
        $cont++;
    }

    $_SESSION['informacion'] = "Pedido realizado";
}

header('Location: ../paginasCliente/carrito.php');