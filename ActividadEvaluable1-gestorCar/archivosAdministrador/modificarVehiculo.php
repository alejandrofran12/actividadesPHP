<?php

include 'conexion.php';

try{
     $sql = "UPDATE vehiculos
            SET marca = COALESCE(NULLIF(?, ''), marca),
            modelo = COALESCE(NULLIF(?, ''), modelo),
            color = COALESCE(NULLIF(?, ''), color),
            puertas = COALESCE(NULLIF(?, ''), puertas),
            asientos = COALESCE(NULLIF(?, ''), asientos),
            transmicion = COALESCE(NULLIF(?, ''), transmicion),
            motorizacion = COALESCE(NULLIF(?, ''), motorizacion),
            clase = COALESCE(NULLIF(?, ''), clase),
            precio = COALESCE(NULLIF(?, ''), precio)
            WHERE matricula = ?";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$_POST['marca'], $_POST['modelo'], $_POST['color'], $_POST['puertas'], $_POST['asientos'],
        $_POST['transmicion'], $_POST['motorizacion'], $_POST['clase'], $_POST['precio'], $_POST['matricula']
    ]);

    header("Location: panelAdmin.php");
    exit;
}catch(PDOException $e){
    $e->getMessage();
}