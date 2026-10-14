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
                Contraseña:<input type="text" name="contrasena">
                <button type="submit">Iniciar Sesión</button>
            </form> 
        </div> 
    </body>   
</html>    
