<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="estilo.css">
    </head>
    <body>
        <?php 
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] :''; 
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : '';
            $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
        ?>

        <form action="primerFormulario.php" method="post" >
            Nombre: <input type="text" name="nombre" value ="<?php echo htmlspecialchars($nombre); ?>"><br>
            Apellidos: <input type="text" name="apellidos" value ="<?php echo htmlspecialchars($apellidos); ?>"><br>
            Email: <input type="email" name="correo" value ="<?php echo htmlspecialchars($correo); ?>"><br>
            edad: <input type="date" name="edad"><br>
            Contraseña: <input type="password" name="contraseña"><br>
            Repita contraseña: <input type="password" name="contraseña2"><br>
            Terminos y condiciones: <input type="checkbox" name="intereses"><br>
            <input type="submit" value="enviar">
        </form>

        <?php
            $camposObligatorios = ['nombre', 'apellidos', 'correo', 'contraseña', 'contraseña2', 'edad'];
            $errores = [];
            
            

            if(!empty($_POST)){
                foreach($camposObligatorios as $campo){
                    if(empty($_POST[$campo])){
                    $errores [] = "el campo " . $campo . " es obligatorio";
                    }
                }

                if($_POST['contraseña'] != $_POST['contraseña2']){
                    $errores [] = "Las contraseñas no coinciden";
                }
                
                $fechaActual = new DateTime();
                $fechaUsuario = new DateTime($_POST['edad']);
                $diferencia = $fechaUsuario->diff($fechaActual);

                if($diferencia -> y < 14){
                    $errores [] = "debe ser mayor de edad";
                }

                if(!isset($_POST['intereses'])){
                    $errores [] = "debes marcar la casilla de terminos y condiciones";
                }

                if(count($errores) > 0){
                    foreach($errores as $error){
                        echo $error . "<br>";
                    }
                }else{
                    echo "REGISTRADO\n";
                    echo "Datos introducidos: " . "<br>";
                    echo "Nombre: " . $_POST['nombre'] . "<br>";
                    echo "Apellidos: " . $_POST['apellidos'] . "<br>";
                    echo "Email: " . $_POST['correo'] . "<br>";
                    echo "Contraseña: " . $_POST['contraseña'] . "<br>";
                }
            }
            
        ?>
    </body>
</html>    