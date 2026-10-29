<?php
session_start();
include("conexion.php");

if(!isset($_SESSION['dni'])){
    header('location: login.php');
    exit;
}

$fechaRecogida = $_POST['fechaRecogida'];
$fechaDevolucion = $_POST['fechaDevolucion'];

?>
<DOCTYPE html>
    <body>
        <head>
            <link rel="stylesheet" href="../css/estilo.css">
        </head>
        <h1>Coches disponibles para esa fecha</h1>
<?php

try {
    $sql = "SELECT matricula, marca, modelo, motorizacion, transmicion, clase, precio FROM vehiculos v WHERE NOT EXISTS 
    (SELECT 1 FROM cierrevehiculo c WHERE c.matricula_id = v.matricula AND 
    (? BETWEEN c.fechaCierre AND c.fechaApertura OR ? BETWEEN c.fechaCierre AND c.fechaApertura OR (fechaCierre > ? AND fechaApertura < ?)))

    AND NOT EXISTS (SELECT 1 FROM reservas r WHERE r.matricula_coche = v.matricula AND 
    (? BETWEEN fecha_reserva AND fecha_devolucion OR ? BETWEEN fecha_reserva AND fecha_devolucion OR
    (fecha_reserva > ? AND fecha_devolucion < ?))) GROUP BY marca, modelo, motorizacion, transmicion, clase, precio ORDER BY precio;";
    

    $result = $conn->prepare($sql);
    $result->execute([
    $fechaRecogida, $fechaDevolucion, $fechaRecogida, $fechaDevolucion, 
    $fechaRecogida, $fechaDevolucion, $fechaRecogida, $fechaDevolucion   
    ]);
    $rows = $result->fetchAll();

    //comprobar descuento al cliente
    $recogida   = new DateTime($fechaRecogida);     
    $devolucion = new DateTime($fechaDevolucion);   

    $dias = $recogida->diff($devolucion)->days + 1;
    

    //comprobar si hay clases A
    $hayclaseA = in_array('A', array_column($rows, 'clase'), true);

    if ($hayclaseA) {
        echo "CLASE A";
        echo "<table cellpadding= '8'>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Motorización</th>
                    <th>Transmición</th>
                    <th>Precio</th>
                </tr>";
        foreach ($rows as $row) {
            if ($row['clase'] === 'A' ) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['marca']) . "</td>";
                echo "<td>" . htmlspecialchars($row['modelo']) . "</td>";
                echo "<td>" . htmlspecialchars($row['motorizacion']) . "</td>";
                echo "<td>" . htmlspecialchars($row['transmicion']) . "</td>";
                if($dias > 4 && $dias <= 9){
                    $descuentoPorDiasExtras = ($row['precio']) - $row['precio'] * 0.05;
                    echo "<td>" . $descuentoPorDiasExtras . "</td>";
                }elseif($dias > 9){
                    $descuentoPorDiasExtras = ($row['precio']) - $row['precio'] * 0.10;
                    echo "<td>" . $descuentoPorDiasExtras . "</td>";
                }else{
                    echo "<td>" . $row['precio'] . "</td>";
                    $descuentoPorDiasExtras = '';
                }
                echo "<td>
                    <form action='reservaVehiculo.php' method='POST'>
                    <input type='hidden' name='matricula' value='" . htmlspecialchars($row['matricula']) . "'>
                    <input type='hidden' name='fechaRecogida' value='" . htmlspecialchars($fechaRecogida) . "'>
                    <input type='hidden' name='fechaDevolucion' value='" . htmlspecialchars($fechaDevolucion) . "'>
                    <input type='hidden' name='precioOriginal' value='" . $row['precio'] . "'>
                    <input type='hidden' name='descuentoPorDiasExtras' value='" . $descuentoPorDiasExtras . "'>
                    <button type='submit'>Reservar</button>
                    </form>
                </td>";
                echo "</tr>";
            }
        }
    echo "</table>";
    echo "<br>";
    }

    ?>

    <?php
    //comprobar si hay clases B
    $hayclaseB = in_array('B', array_column($rows, 'clase'), true);
    
    if ($hayclaseB) {
        echo "CLASE B";
        echo "<table cellpadding= '8'>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Motorización</th>
                    <th>Transmición</th>
                    <th>Precio</th>
                </tr>";
        foreach ($rows as $row) {
            if ($row['clase'] === 'B') {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['marca']) . "</td>";
                echo "<td>" . htmlspecialchars($row['modelo']) . "</td>";
                echo "<td>" . htmlspecialchars($row['motorizacion']) . "</td>";
                echo "<td>" . htmlspecialchars($row['transmicion']) . "</td>";
                if($dias > 4 && $dias <= 9){
                    $descuentoPorDiasExtras = ($row['precio']) - $row['precio'] * 0.05;
                    echo "<td>" . $descuentoPorDiasExtras . "</td>";
                }elseif($dias > 9){
                    $descuentoPorDiasExtras = ($row['precio']) - $row['precio'] * 0.10;
                    echo "<td>" . $descuentoPorDiasExtras . "</td>";
                }else{
                    echo "<td>" . $row['precio'] . "</td>";
                }
                echo "<td>
                    <form action='reservaVehiculo.php' method='POST'>
                    <input type='hidden' name='matricula' value='" . htmlspecialchars($row['matricula']) . "'>
                    <input type='hidden' name='fechaRecogida' value='" . htmlspecialchars($fechaRecogida) . "'>
                    <input type='hidden' name='fechaDevolucion' value='" . htmlspecialchars($fechaDevolucion) . "'>
                    <input type='hidden' name='precioOriginal' value='" . $row['precio'] . "'>
                    <input type='hidden' name='descuentoPorDiasExtras' value='" . $descuentoPorDiasExtras . "'>
                    <button type='submit'>Reservar</button>
                    </form>
                </td>";
                echo "</tr>";
            }
        }
    echo "</table>";
    echo "<br>";
    }

    $hayclaseC = in_array('C', array_column($rows, 'clase'), true);
    
    if ($hayclaseC) {
        echo "CLASE C";
        echo "<table cellpadding= '8'>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Motorización</th>
                    <th>Transmición</th>
                    <th>Precio</th>
                </tr>";
        foreach ($rows as $row) {
            if ($row['clase'] === 'C') {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['marca']) . "</td>";
                echo "<td>" . htmlspecialchars($row['modelo']) . "</td>";
                echo "<td>" . htmlspecialchars($row['motorizacion']) . "</td>";
                echo "<td>" . htmlspecialchars($row['transmicion']) . "</td>";
                if($dias > 4 && $dias <= 9){
                    $descuentoPorDiasExtras = ($row['precio']) - $row['precio'] * 0.05;
                    echo "<td>" . $descuentoPorDiasExtras . "</td>";
                }elseif($dias > 9){
                    $descuentoPorDiasExtras = ($row['precio']) - $row['precio'] * 0.10;
                    echo "<td>" . $descuentoPorDiasExtras . "</td>";
                }else{
                    echo "<td>" . $row['precio'] . "</td>";
                }
                echo "<td>
                    <form action='reservaVehiculo.php' method='POST'>
                    <input type='hidden' name='matricula' value='" . htmlspecialchars($row['matricula']) . "'>
                    <input type='hidden' name='fechaRecogida' value='" . htmlspecialchars($fechaRecogida) . "'>
                    <input type='hidden' name='fechaDevolucion' value='" . htmlspecialchars($fechaDevolucion) . "'>
                    <input type='hidden' name='precioOriginal' value='" . $row['precio'] . "'>
                    <input type='hidden' name='descuentoPorDiasExtras' value='" . $descuentoPorDiasExtras . "'>
                    <button type='submit'>Reservar</button>
                    </form>
                </td>";
                echo "</tr>";
            }
        }
    echo "</table>";
    }

    unset($result);
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

?>
        <a href="../cerrarSesion.php">Cerrar Sesión</a>
        <a href="principal.php">Inicio</a>
        
    </body>
</DOCTYPE>