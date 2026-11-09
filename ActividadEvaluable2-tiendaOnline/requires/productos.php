<?php

require_once __DIR__ . "/../conexion/conexion.php";

function obtenerProductos(PDO $conn) : array{
    $sql = "SELECT p.modelo, p.precio, p.marca FROM productos p INNER JOIN categorias c ON c.id = p.categoria_id ORDER by p.modelo;";
    $sentencia = $conn->query($sql);
    $productos = $sentencia->fetchAll();

    return $productos;
}
//DEBERIA TRAER EL ID PARA EN ENLACE DE COMPRA, MARCA Y STOCK

//PDO::FETCH_ASSOC para no duplicar columnas