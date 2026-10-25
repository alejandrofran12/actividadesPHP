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
    $sql = "SELECT DISTINCT marca, modelo, motorizacion, transmicion, clase, precio FROM vehiculos v WHERE NOT EXISTS 
    (SELECT 1 FROM cierrevehiculo c WHERE c.matricula_id = v.matricula AND 
    (c.fechaCierre BETWEEN ? AND ? OR c.fechaApertura BETWEEN ? AND ?));";

    $result = $conn->prepare($sql);
    $result->execute([$fechaRecogida, $fechaDevolucion, $fechaRecogida, $fechaDevolucion]);
    $rows = $result->fetchAll();

    //comprobar descuento al cliente
    $recogida   = new DateTime($fechaRecogida);     
    $devolucion = new DateTime($fechaDevolucion);   

    $dias = $recogida->diff($devolucion)->days + 1;
    

    //comprobar si hay clases A
    $hayclaseA = in_array('A', array_column($rows, 'clase'), true);

    if ($hayclaseA) {
        echo "CLASE A";
        echo "<table><tr><th>Marca</th></tr>";
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
                }
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
                if($dias > 4 && $dias <= 9){
                    $descuentoPorDiasExtras = ($row['precio']) - $row['precio'] * 0.05;
                    echo "<td>" . $descuentoPorDiasExtras . "</td>";
                }elseif($dias > 9){
                    $descuentoPorDiasExtras = ($row['precio']) - $row['precio'] * 0.10;
                    echo "<td>" . $descuentoPorDiasExtras . "</td>";
                }else{
                    echo "<td>" . $row['precio'] . "</td>";
                }
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
                if($dias > 4 && $dias <= 9){
                    $descuentoPorDiasExtras = ($row['precio']) - $row['precio'] * 0.05;
                    echo "<td>" . $descuentoPorDiasExtras . "</td>";
                }elseif($dias > 9){
                    $descuentoPorDiasExtras = ($row['precio']) - $row['precio'] * 0.10;
                    echo "<td>" . $descuentoPorDiasExtras . "</td>";
                }else{
                    echo "<td>" . $row['precio'] . "</td>";
                }
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