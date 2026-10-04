<?php

session_start();

?>
<!DOCTYPE html>
<html>
    <body>
        <h1>Resultados: </h1>
        <h2>Numero salido: <?= $_SESSION['numeroSalido'] ?></h2>
        <h2>Color: <?= $_SESSION['color'] ?></h2>
        <h2>Paridad: <?= $_SESSION['paridad'] ?></h2>
        <?php
            if($_SESSION['premio'] < 0){
                echo "<h2>" . "\nHas perdido!" . "</h2>";
                $_SESSION['ganada'] = "Perdida";
            }else{
                echo "<h2>" . "Has ganado!" . "</h2>";
                echo "Tus ganancias han sido de: " . $_SESSION['premio'] . "€"; 
                $_SESSION['ganada'] = "Ganada";
            }
        ?>   
        <h3>Apuestas realizadas</h3>
        <?php 
        foreach ($_SESSION['apuestasEnCurso'] as $apuesta) {
            echo $apuesta['tipo'] . "<br>";
            echo $apuesta['valor'] . "<br>";
            echo $apuesta['cantidad'] . "<br>";
        }
        $_SESSION['apuestasEnCurso'] = [];
        ?>
        <a href="apuestas.php"><button type="button">Volver</button></a>
    </body>
</html>