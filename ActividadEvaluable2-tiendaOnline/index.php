<?php
require __DIR__ . "/requires/productos.php";
$productos = obtenerProductos($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <h1>TIENDA ONLINE HARDWARE</h1>

    <table cellpadding= '8'>
        <tr>
            <th>Marca</th><th>Modelo</th><th>Precio</th>
            <?php foreach($productos as $producto) {?>
            <tr>
                <td><?php echo $producto['marca']; ?></td>
                <td><?php echo $producto['modelo']; ?></td>
                <td><?php echo $producto['precio']; ?></td>
                <td></td>
            </tr>
        </tr>
        <?php } ?>
    </table>

    <p><a href="paginasCliente/iniciarSesion.php">Iniciar sesión</a></p>
    <p><a href="paginasCliente/registro.php">Registrarse</a></p>
</body>
</html>
