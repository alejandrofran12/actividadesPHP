<?php
session_start();
require "../requires/productos.php";

$carrito = json_decode($_COOKIE['carrito' . $_SESSION['id']], true);

$ids = array();

foreach ($carrito as $producto) {
    $ids[] = $producto['id'];
}

$precios = obtenerProductosPrecio($conn, $ids);
//$stock = obtenerProductosStock($conn, $ids);

if(isset($_POST['comprar'])){

    if(!comprobarStock($conn, $ids, $carrito)){
        header('Location: ../paginasCliente/carrito.php');
        exit;
    }

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

    foreach($carrito as $producto){
    restarStock($conn, $producto['id'], $producto['cantidad']);
}
    

    $_SESSION['informacion'] = "Pedido realizado";
}

header('Location: ../paginasCliente/carrito.php');

function comprobarStock($conn, $ids, $carrito){

    $cont = 0;

    foreach($ids as $id){
    $sql = "SELECT stock, modelo FROM productos WHERE id = ?;";
    $sentencia = $conn->prepare($sql);
    $sentencia->execute([$id]);
    $resultado = $sentencia->fetch();

    if($resultado['stock'] < $carrito[$cont]['cantidad']){
        $_SESSION['errores'] = 'Artículo ' . $resultado['modelo'] . ' tiene solo ' . $resultado['stock'];
        return false;
    }
    $cont++;
    }

    return true;
}

function restarStock(PDO $conn, int $id, int $cantidad){
    $sql = "UPDATE productos SET stock = stock - ? WHERE id = ? AND stock >= ?";
    $sentencia = $conn->prepare($sql);
    $sentencia->execute([$cantidad, $id, $cantidad]);
}