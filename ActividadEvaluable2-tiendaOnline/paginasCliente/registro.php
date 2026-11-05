<?php
session_start();
?>

<DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/estilo.css">
    </head>
        <body>
            <h1>Registro</h1>
            <form action="../comprobacionesCliente/comprobacionRegistro.php" method="POST">
                <p>Nombre: <input type="text" name="nombre" required></p>
                <p>Telefono: <input type="text" name="telefono"></p>
                <p>Email: <input type="email" name="email" required></p>
                <p>Usuario: <input type="date" name="usuario" required></p>
                <p>Contraseña: <input type="password" name="contrasena" required></p>
                <button type="submit">Registrarse</button>
            </form>
            <?php
            if(!isset($_SESSION['errores'])){
                $_SESSION['errores'] = null;
            }
            
            if($_SESSION['errores'] != NULL){
                echo "<p style='color: red;'>" . $_SESSION['errores'] . "</p>";
            }

            $_SESSION['errores'] = null;
            ?>
        </body>
</html>
<!-- COMPROBAR VARIABLES SESSIONS        