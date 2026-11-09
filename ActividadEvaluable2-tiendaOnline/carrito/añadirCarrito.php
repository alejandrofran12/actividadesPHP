<?php

$carrito = array();

if(isset($_COOKIE['carrito'])){
    
}

if(isset($_POST['id']) && isset($_POST['marca']) && isset($_POST['modelo']) && isset($_POST['precio'])){
    $producto = array(
        'id' => $_POST['id'],
        'marca' => $_POST['marca'],
        'modelo' => $_POST['modelo'],
        'precio' => $_POST['precio']
    );

    $carrito[] = $producto;

    setcookie('carrito', serialize($carrito), time() + (86400 * 1), "/");
    
}