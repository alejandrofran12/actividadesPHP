<?php
session_start();
require "../conexion/conexion.php";

$sql = "SELECT p.modelo, p.marca, d.precio_unitario, d.cantidad, pe.fecha, pe.id 
    FROM productos p INNER JOIN detalle_pedido d INNER JOIN pedidos pe ON d.pedido_id = pe.id 
    ON d.producto_id = p.id WHERE pe.cliente_id = ? ORDER BY pe.id ASC;";

$sentencia = $conn->prepare($sql);
$sentencia->execute([$_SESSION['id']]);
$pedidos = $sentencia->fetchAll();  

//funcion para obtener todos los subarrays en uno solo
$todosLosRegistros = array_merge($pedidos);

//extraemos unicamente el id
$todosLosIds = array_column($todosLosRegistros, 'id');

//eliminamos los duplicados y contamos cuantos quedan;
$cantidadIdsDistintos = count(array_unique($todosLosIds));

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
    <h1>Tus pedidos</h1>
    <a href="../index.php">Inicio</a>
        <?php for($cont = 1; $cont<= $cantidadIdsDistintos; $cont++) {?>
        <br><br><br><br>
        <details>    
        <h1>Pedido <?php echo $cont?></h1>
        <?php foreach($pedidos as $pedido) {?>
            <?php if($pedido['id'] == $cont){?>
                    <h2><?php echo $pedido['marca']; ?> <?php echo $pedido['modelo']; ?></h2>
            <?php }?>
        <?php } echo "</details>"; } ?>
</body>
