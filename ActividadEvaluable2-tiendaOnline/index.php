<?php
session_start();
require "requires/productos.php";
$productos = obtenerProductos($conn);

$logueado = isset($_SESSION['nombre']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>TIENDA ONLINE HARDWARE</h1>
    
    <?php if ($logueado) {?>
        <h2>Bienvenido <?php echo $_SESSION['nombre']; ?> </h2>
        <p><a href="cerrarSesion/cerrarSesion.php">Cerrar sesion</a></p>
        <p><a href="paginasCliente/carrito.php">Carrito</a></p>
        <p><a href="paginasCliente/pedidos.php">Pedidos</a></p>
    <?php } else { ?>
        <p><a href="paginasCliente/iniciarSesion.php">Iniciar sesión</a></p>
        <p><a href="paginasCliente/registro.php">Registrarse</a></p>
    <?php } ?>

    <div class="productos">
    <?php foreach($productos as $producto) { ?>
    <article class="producto">
        <h2><?php echo $producto['marca']; ?> <?php echo $producto['modelo']; ?></h2>
        <p>Precio: <?php echo $producto['precio']; ?> €</p>

        <form action="paginasCliente/paginaProducto.php" method="post">
            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
            <button type="submit">Ver producto</button>
        </form>

        <?php if ($logueado) {?>
            <form action="carrito/añadirCarrito.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $producto['id']; ?> ">
                <input type="hidden" name="marca" value="<?php echo $producto['marca']; ?> ">
                <input type="hidden" name="modelo" value="<?php echo $producto['modelo']; ?> ">
                <p><button type="submit">Añadir al carrito</button></p>
            </form>
        <?php } ?>
    </article>
    
    <?php } ?>
    </div>

</body>
</html>
