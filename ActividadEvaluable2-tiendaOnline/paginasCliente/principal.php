<?php
session_start();
?>

<DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/estilo.css">
    </head>
    <body>
        <div>
            <form action="comprobacionLogin.php" method="POST">
                <p>Usuario: <input type="text" name="dni"></p>
                <p>Contraseña: <input type="password" name="contrasena"></p>
                <button type="submit">Iniciar Sesión</button>
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
            
            <a href="archivosCliente/registro.php">Registrarse</a>
        </div> 
    </body>   
</html>    

<!-- COMPROBAR VARIABLE SESSIONs --> 