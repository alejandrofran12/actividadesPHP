<?php
session_start();
include ("conexion.php");

if(!isset($_SESSION['dniAdmin'])){
    header('location: login.php');
    exit;
}

?>
<DOCTYPE html>
<html>
    <head>
        <body>
            <h1>BIENVENIDO . <?php echo $_SESSION['nombre'] ?> </h1>
            <h2>INTRODUCIR UN NUEVO VEHICULO</h2>
            <form action="comprobacionVehiculoRegistro.php" method="POST" enctype="multipart/form-data">
                Matricula: <input type="text" name="matricula"><br>
                Marca: <input type="text" name="marca"><br>
                Modelo: <input type="text" name="modelo"><br>
                Color: <input type="text" name="color"><br>
                Puertas: <input type="int" name="puertas"><br>
                Asientos: <input type="int" name="asientos"><br>
                <label for="transmision">Transmisión</label>
                <select name="transmision" id="transmision" required>
                    <option value="">-- Selecciona --</option>
                    <option value="manual">Manual</option>
                    <option value="automatica">Automática</option>
                </select><br>
                <label for="motorizacion">Motorización</label>
                <select name="motorizacion" id="motorizacion" required>
                    <option value="">-- Selecciona --</option>
                    <option value="gasolina">Gasolina</option>
                    <option value="diesel">Diésel</option>
                    <option value="hibrido">Híbrido</option>
                    <option value="electrico">Eléctrico</option>
                    <option value="gas">Gas</option>
                </select><br>
                <label for="clase">Clase</label>
                <select name="clase" id="clase" required>
                    <option value="">-- Selecciona --</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    <option value="F">F</option>
                </select><br>
                Precio: <input type="number" name="precio">
                <button type="submit">Registrar vehículo</button>
            </form>
            <?php


            if(!isset($_SESSION['errores'])){
                $_SESSION['errores'] = null;
            }
            
            if($_SESSION['errores'] != NULL){
                echo "<p style='color: red;'>" . $_SESSION['errores'] . "</p>";
            }

            $_SESSION['errores'] = null;

            $sql = "SELECT matricula FROM vehiculos";
            $resultado1 = $conn->query($sql);

            ?>

            <h2>Añadir/Cerrar Vehiculo</h2>
            <form action="comprobacionBajaVehiculo.php" method="POST">
                <select name="matricula">
                    <?php
                        echo "<option value=''>-- Selecciona --</option>";
                        while($row = $resultado1->fetch()){
                            echo "<option value = " . $row['matricula'] . ">" . $row['matricula'] . "</option>";
                        }
                    ?>
                </select>
                Fecha baja: <input type="date" name="fechaBaja">
                Fecha alta: <input type="date" name="fechaAlta">
                <button type="submit">Dar de baja</button>
            </form>
            <?php
                $sql="SELECT matricula_id FROM cierreVehiculo";
                $resultado2 = $conn->query($sql);
            ?>

            <form action="comprobacionAltaVehiculo.php" method="POST">
                <select name="matricula">
                    <?php
                        echo "<option value=''>-- Selecciona --</option>";
                        while($row = $resultado2->fetch()){
                            echo "<option value = " . $row['matricula_id'] . ">" . $row['matricula_id'] . "</option>";
                        }
                    ?>
                </select>
                <button type="submit">Dar de Alta</button>
            </form>
        </body>
    </head>
</html>