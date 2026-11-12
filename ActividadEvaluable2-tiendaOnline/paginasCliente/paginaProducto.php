<?php 
session_start();
require "../requires/productos.php";

$id = $_POST['id'];
$producto = obtenerProducto($conn, $id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style.css"> 
</head>
<body>
    <article>
        <header>
            <p> Categoria: <?= $producto['nombre'] ?></p>
            <h1><?= $producto['marca'] ?> <?= $producto['modelo'] ?></h1>
        </header>

        <p> <?= $producto['descripcion'] ?? 'Sin descripción disponible.' ?></p>

        <footer>
            <p><strong><?= number_format($producto['precio'], 2, ',', '.') ?> €</strong></p>
        </footer>
    </article>

    <a href="../index.php">Volver al listado</a>
    <form action="../carrito/añadirCarrito.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $producto['id']; ?> ">
            <input type="hidden" name="marca" value="<?php echo $producto['marca']; ?> ">
            <input type="hidden" name="modelo" value="<?php echo $producto['modelo']; ?> ">
        <p><button type="submit">Añadir al carrito</button></p>
    </form>
</body>
</html>