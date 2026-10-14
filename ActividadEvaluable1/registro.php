<?php
session_start();
include("conexion.php");
?>

<DOCTYPE html>
<html>
    <head>
        <body>
            <h1>Registro</h1>
            <form action="comprobacionRegistro.php" method="POST" enctype="multipart/form-data">
                Nombre: <input type="text" name="nombre"><br>
                Apellidos: <input type="text" name="apellidos"><br>
                DNI:<input type="text" name="dni"><br>
                Contraseña:<input type="text" name="contrasena"><br>
                Fecha de nacimiento:<input type="date" name="fecha_nacimiento"><br>
                Subir foto dni:<input type="file" name="archivoUsuario"><br>
                <button type="submit">Registrarse</button>
            </form>
            <?php
            if($_SESSION['errores'] != NULL){
                echo "<p style='color: red;'>" . $_SESSION['errores'] . "</p>";
            }

            $_SESSION['errores'] = null;
            ?>
        </body>
    </head>
</html>
        