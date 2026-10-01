<?php

session_start();

?>
<!DOCTYPE html>
<html>
    <body>
        <h1>Resultados: </h1>
        <h2>Numero salido: <?= $_SESSION['numeroSalido'] ?></h2>
        <h2>Color: <?= $_SESSION['color'] ?></h2>
        <h2>Premio <?= $_SESSION['premio'] ?></h2>
        <h2>Paridad <?= $_SESSION['paridad'] ?></h2>   
    </body>
</html>