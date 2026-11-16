<?php

require "../requires/productos.php";

$texto = $_GET['q'] ?? '';



$resultados = buscarProductos($conn, $texto);

if(empty($resultados)){
    echo "<p>No se han encontrado productos</p>";
}

foreach($resultados as $producto){ ?>
    <p>
        <a href="/paginas/ActividadEvaluable2-tiendaOnline/paginasCliente/paginaProducto.php?id=<?php echo $producto['id']; ?>">
            <?php echo $producto['marca'] . ' ' . $producto['modelo'] ?>;
        </a>
    </p>

<?php } ?>