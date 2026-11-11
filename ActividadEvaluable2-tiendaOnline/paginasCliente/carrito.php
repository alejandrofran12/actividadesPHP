<?php
session_start();
require "../requires/productos.php";

$carrito = array();
$total = 0;
$ids = array();
$precios = array();

if(isset($_COOKIE['carrito' . $_SESSION['id']])){
    $carrito = json_decode($_COOKIE['carrito' . $_SESSION['id']], true);

    foreach($carrito as $id){
        $ids[] = $id['id'];
    }
}

$precios = obtenerProductosPrecio($conn, $ids);

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
    <h1>Carrito</h1>
    <p>Elementos del carrito: </p>
    <?php if (!isset($_COOKIE['carrito' . $_SESSION['id']])) {?>
        <p>Carrito vacío</p>
    <?php }else{ $cont = 0; foreach($carrito as $producto){ ?>
        <article class="producto">
            <h2><?php echo $producto['marca']; ?> <?php echo $producto['modelo']; ?></h2>
            <p>Precio: <?php echo $precios[$cont]['precio']; $total += $precios[$cont]['precio'] * $producto['cantidad']; $cont++;?> €</p>

            <form action="../carrito/añadirCarrito.php" method="post">
                <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                <input type="hidden" name="accion" value="mas">
                <button type="submit">+</button>
            </form>

            <form action="../carrito/añadirCarrito.php" method="post">
                <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                <input type="hidden" name="accion" value="menos">
                <button type="submit">-</button>
            </form>

            <p>Cantidad del producto: <?php echo $producto['cantidad']?></p>
        </article>
    <?php }} ?>
    <strong><p>Total: <?php echo $total?></p></strong>
    <form action="../comprobacionesCliente/comprobacionPedido.php" method="POST">
        <button type="submit" name="comprar">Comprar</button>
    </form>
</body>