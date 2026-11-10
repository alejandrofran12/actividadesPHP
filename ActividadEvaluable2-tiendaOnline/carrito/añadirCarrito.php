<?php
session_start();

$carrito = array();

if(isset($_COOKIE['carrito' . $_SESSION['id']])){
    $carrito = json_decode($_COOKIE['carrito' . $_SESSION['id']], true) ;
    if(!is_array($carrito)){
        $carrito = array();
    }
}

if(isset($_POST['id']) && isset($_POST['marca']) && isset($_POST['modelo'])){
    $producto = array(
        'id' => $_POST['id'],
        'marca' => $_POST['marca'],
        'modelo' => $_POST['modelo']
    );

    $carrito[] = $producto;

    setcookie('carrito' . $_SESSION['id'], json_encode($carrito), time() + 86400, "/");

}
header('Location: ../index.php');
exit;