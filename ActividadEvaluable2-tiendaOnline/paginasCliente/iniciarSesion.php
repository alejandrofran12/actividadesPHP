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
            <form action="../comprobacionesCliente/comprobacionLogin.php" method="POST">
                <p>Usuario: <input type="text" name="usuario"></p>
                <p>Contraseña: <input type="password" name="contrasena"></p>
                <button type="submit">Iniciar Sesión</button>
            </form>
            <?php
            if(!isset($_SESSION['errores'])){
                $_SESSION['errores'] = null;
            }

            if(!isset($_SESSION['informacion'])){
                $_SESSION['informacion'] = null;
            }
            
            if($_SESSION['errores'] != NULL){
                echo "<p style='color: red;'>" . $_SESSION['errores'] . "</p>";
            }

            if($_SESSION['informacion'] != NULL){
                echo "<p style='color: green;'>" . $_SESSION['informacion'] . "</p>";
            }

            $_SESSION['errores'] = null;
            $_SESSION['informacion'] = null;
            ?>
            
            <a href="registro.php">Registrarse</a>
        </div> 
    </body>   
</html>    

<!-- COMPROBAR VARIABLE SESSIONs --> 