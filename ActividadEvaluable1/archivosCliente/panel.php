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
        <h1>Coches disponibles para esa fecha</h1>
<?php
try {
    $sql = "SELECT DISTINCT marca, modelo, motorizacion, transmicion, clase FROM vehiculos v WHERE NOT EXISTS 
    (SELECT 1 FROM vehiculos WHERE fechaCierre < $fechaRecogida AND fechaApertura > $fechaDevolucion); ";

    $result = $conn->query($sql);
    $rows = $result->fetchAll();

    //comprobar si hay clases A
    $hayclaseA = in_array('A', array_column($rows, 'clase'), true);

    if ($hayclaseA) {
        echo "<table><tr><th>CLASE A</th></tr>";
        foreach ($rows as $row) {
            if ($row['clase'] === 'A' ) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['marca']) . "</td>";
                echo "<td>" . htmlspecialchars($row['modelo']) . "</td>";
                echo "<td>" . htmlspecialchars($row['motorizacion']) . "</td>";
                echo "<td>" . htmlspecialchars($row['transmicion']) . "</td>";
                echo "</tr>";
            }
        }
    echo "</table>";
    }

    ?>

    <?php
    //comprobar si hay clases B
    $hayclaseB = in_array('B', array_column($rows, 'clase'), true);
    
    if ($hayclaseB) {
        echo "<table><tr><th>CLASE B</th></tr>";
        foreach ($rows as $row) {
            if ($row['clase'] === 'B') {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['marca']) . "</td>";
                echo "<td>" . htmlspecialchars($row['modelo']) . "</td>";
                echo "<td>" . htmlspecialchars($row['motorizacion']) . "</td>";
                echo "<td>" . htmlspecialchars($row['transmicion']) . "</td>";
                echo "</tr>";
            }
        }
    echo "</table>";
    }

    $hayclaseC = in_array('B', array_column($rows, 'clase'), true);
    
    if ($hayclaseC) {
        echo "<table><tr><th>CLASE C</th></tr>";
        foreach ($rows as $row) {
            if ($row['clase'] === 'C') {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['marca']) . "</td>";
                echo "<td>" . htmlspecialchars($row['modelo']) . "</td>";
                echo "<td>" . htmlspecialchars($row['motorizacion']) . "</td>";
                echo "<td>" . htmlspecialchars($row['transmicion']) . "</td>";
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
        <a href="cerrarSesion.php">Cerrar Sesión</a>
    </body>
</DOCTYPE>