<?php
session_start();
include("conexion.php");

$sql = "SELECT v.marca, v.modelo, v.color, v.puertas, v.asientos, v.transmicion, v.motorizacion, v.clase, 
        r.fecha_reserva, r.fecha_devolucion, r.precio_real, r.precio_descuento, r.matricula_coche
        FROM vehiculos AS v
        INNER JOIN reservas AS r
        on v.matricula = r.matricula_coche Where r.id_cliente = ?;";

$resultado = $conn->prepare($sql);
$resultado->execute([$_SESSION['dni']]);
$filas = $resultado->fetchAll();

?>
<DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" href="../css/estilo.css">
            <body>
                <h1><?php echo $_SESSION['nombre']?>, estas son tus reservas!</h1>
                <?php
                echo "<table cellpadding= '8'>";
                    echo "<tr>";
                    echo "<th>Marca</th>";
                    echo "<th>Modelo</th>";
                    echo "<th>Color</th>";
                    echo "<th>Puertas</th>";
                    echo "<th>Asientos</th>";
                    echo "<th>Transmicion</th>";
                    echo "<th>Motorizacion</th>";
                    echo "<th>Fecha de Reserva</th>";
                    echo "<th>Fecha de devolucion</th>";
                    echo "<th>Modelo</th>";
                    echo "<th>Descuento</th>";
                    echo "<th>Cancelar</th>";
                    echo "</tr>";
                    foreach($filas as $row){
                        echo "<tr>";
                        echo "<td>" . $row['marca'] . "</td>";
                        echo "<td>" . $row['modelo'] . "</td>";
                        echo "<td>" . $row['color'] . "</td>";
                        echo "<td>" . $row['puertas'] . "</td>";
                        echo "<td>" . $row['asientos'] . "</td>";
                        echo "<td>" . $row['transmicion'] . "</td>";
                        echo "<td>" . $row['motorizacion'] . "</td>";
                        echo "<td>" . $row['fecha_reserva'] . "</td>";
                        echo "<td>" . $row['fecha_devolucion'] . "</td>";
                        echo "<td>" . $row['precio_real'] . "</td>";
                        echo "<td>" . $row['precio_descuento'] . "</td>";
                        echo "<td>
                                    <form action='cancelarReserva' method='POST'>
                                        <input name='matricula' value='" . $row['matricula_id'] . "'>
                                    </form>
                              </td>";
                        echo "</tr>";
                    }
                echo "</table>";    
                ?>
                <button><a href="principal.php">Volver</a></button>
            </body>
        </head>
    </html>
</DOCTYPE>