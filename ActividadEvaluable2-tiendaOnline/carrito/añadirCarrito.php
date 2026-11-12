<?php
session_start();

$carrito = array();

$id = $_POST['id'];
$accion = $_POST['accion'] ?? null;

//comprobar si existe el carrito

if(isset($_COOKIE['carrito' . $_SESSION['id']])){
    $carrito = json_decode($_COOKIE['carrito' . $_SESSION['id']], true) ;
    if(!is_array($carrito)){
        $carrito = array();
    }
}

if(isset($_POST['id'])){

    $indiceEncontrado  = null;

    foreach($carrito as $indice => $producto){
        if($producto['id'] == $id){
            $indiceEncontrado = $indice;
        }
    }

    if($accion == 'mas' && $indiceEncontrado !== null){
        $carrito[$indiceEncontrado]['cantidad']++;
    }elseif(isset($_POST['marca']) && isset($_POST['modelo']) && $indiceEncontrado === null){
        $carrito[] = array(
            'id' => $id,
            'marca' => $_POST['marca'],
            'modelo' => $_POST['modelo'],
            'cantidad' => 1
            );
    }

    if($accion == 'menos' && $indiceEncontrado !== null){
        $carrito[$indiceEncontrado]['cantidad']--;
        if($carrito[$indiceEncontrado]['cantidad'] <= 0){
            unset($carrito[$indiceEncontrado]);
        }
    }

    setcookie('carrito' . $_SESSION['id'], json_encode($carrito), time() + 86400, "/");
}

if($accion == 'mas' || $accion == 'menos'){
    header('Location: ../paginasCliente/carrito.php');
}else{
    header('Location: ../index.php');
}

exit;