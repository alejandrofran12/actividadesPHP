<?php

require __DIR__ . "/../conexion/conexion.php";

function obtenerProductos(PDO $conn) : array{
    $sql = "SELECT p.modelo, p.precio, p.marca, p.id FROM productos p INNER JOIN categorias c ON c.id = p.categoria_id ORDER by p.modelo;";
    $sentencia = $conn->query($sql);
    $productos = $sentencia->fetchAll();

    return $productos;
}

function obtenerProducto(PDO $conn, int $id) : array{
    $sql = "SELECT p.marca, p.modelo, p.precio, p.descripcion, c.nombre, p.id  
            FROM productos p
            INNER JOIN categorias c ON c.id = p.categoria_id
            WHERE p.id = :id";

    $sentencia = $conn->prepare($sql);
    $sentencia->execute([':id' => $id]);
    $producto = $sentencia->fetch();

    return $producto;
}

function obtenerProductosPrecio(PDO $conn, array $ids){

    $precios = [];

    foreach($ids as $id){
        $sql = "SELECT precio FROM productos where id = ?";
        $sentencia = $conn->prepare($sql);
        $sentencia->execute([$id]);
        $precio = $sentencia->fetch();

        $precios[] = $precio;
    }

    return $precios;
}

//DEBERIA TRAER EL ID PARA EN ENLACE DE COMPRA, MARCA Y STOCK

//PDO::FETCH_ASSOC para no duplicar columnas