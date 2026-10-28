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
            <button type="submit">Buscar vehiculos</button>
        </form>
        <button><a href="../cerrarSesion.php">Cerrar sesión</a></button>
         <button><a href="../reservasCliente.php">Mis reservas</a></button>
    </body>
</html>