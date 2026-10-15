<?php
session_start();
include("conexion.php");
?>

<DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
        <div>
            <form action="comprobacionLogin.php" method="POST">
                DNI:<input type="text" name="dni">
                Contraseña:<input type="password" name="contrasena">
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
        </div> 
    </body>   
</html>    
