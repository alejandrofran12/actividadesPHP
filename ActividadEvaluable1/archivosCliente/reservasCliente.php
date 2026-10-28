<?php
session_start();
include("conexion.php");

$sql = "SELECT v.marca, v.modelo, v.color, v.puertas, v.asientos, v.transmicion, v.motorizacion, v.clase 
        r.fecha_reserva, r.fecha_devolucion, r.precio_real, r.precio_descuento, r.cancelada
        FROM vehiculos 
        INNER JOIN reservas
        on v.matricula = r.matricula_coche";

$resultado = $conn->query($sql);

?>
<DOCTYPE html>
    <html>
        <head>
            <body>
                <h1><?php $_SESSION['nombre']?> ,estas son tus reservas!</h1>
            </body>
        </head>
    </html>
</DOCTYPE>