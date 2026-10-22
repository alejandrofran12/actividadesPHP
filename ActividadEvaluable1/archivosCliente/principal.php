<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <h1>BIENVENIDO . <?php echo $_SESSION['nombre'] ?> </h1>
        <form action="panel.php" method="POST">
            Fecha recogida: <input type="date" name="fechaRecogida">
            Fecha devolucion: <input type="date" name="fechaDevolucion">
        </form>
    </body>
</html>