<?php
session_start();
include ("conexion.php");

if(!isset($_SESSION['dniAdmin'])){
    header('location: login.php');
    exit;
}
$sql = "SELECT matricula, marca, modelo, motorizacion, transmicion, clase, precio FROM vehiculos";
$result = $conn->prepare($sql);
$result->execute();
$rows = $result->fetchAll();

?>
<DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/estilo.css">
    </head>
        <body>
            <h1>BIENVENIDO . <?php echo $_SESSION['nombre'] ?> </h1>
            <h2>VEHICULOS DADOS DE ALTA</h2>
            <table border="1" cellpadding= '8'>
                <tr>
                    <th>Matrícula</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Motorización</th>
                    <th>Transmisión</th>
                    <th>Clase</th>
                    <th>Precio</th>
                    <th>Eliminar</th>
                </tr>

            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td><?php echo $row['matricula']; ?></td>
                    <td><?php echo $row['marca']; ?></td>
                    <td><?php echo $row['modelo']; ?></td>
                    <td><?php echo $row['motorizacion']; ?></td>
                    <td><?php echo $row['transmicion']; ?></td>
                    <td><?php echo $row['clase']; ?></td>
                    <td><?php echo $row['precio']; ?></td>
                    <td><?php 
                        echo "<form action='eliminarVehiculo.php' method='POST'>
                            <button name='matricula' value='" . $row['matricula'] . "'>eliminar</button>
                        </form>";
                        ?>
                    </td>
                </tr>
            <?php } ?>
            </table>

<!-- ///////////////////////////////////////////////////////////////////////////// -->

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
            
            if($_SESSION['errores'] != NULL && $_SESSION['errores']['destino'] === 'comprobacionVehiculoRegistro.php'){
                echo "<p style='color: red;'>" . $_SESSION['errores']['mensaje'] . "</p>";
            }

            $sql = "SELECT matricula, marca, modelo FROM vehiculos";
            $result = $conn->prepare($sql);
            $result->execute();
            $matriculas = $result->fetchAll();
            ?>

<!-- ///////////////////////////////////////////////////////////////////////////// -->

            <h2>MODIFICAR VEHICULO</h2>
            <form action="modificarVehiculo.php" method="POST">
 
            <p>
                Matrícula:
                <select name="matricula">
                    <?php foreach ($matriculas as $fila) { ?>
                        <option value="<?php echo $fila['matricula'];?>">
                            <?php echo $fila['matricula'] . ", "; ?>
                            <?php echo $fila['marca']. ", "; ?>
                            <?php echo $fila['modelo']; ?>
                        </option>
                    <?php } ?>
                </select>
            </p>
 
            <p>Marca: <input type="text" name="marca"></p>
            <p>Modelo: <input type="text" name="modelo"></p>
            <p>Color: <input type="text" name="color"></p>
            <p>Puertas: <input type="number" name="puertas"></p>
            <p>Asientos: <input type="number" name="asientos"></p>
 
            <p>
                Transmisión:
                <select name="transmicion">
                    <option value="manual">manual</option>
                    <option value="automatica">automatica</option>
                </select>
            </p>
 
            <p>
                Motorización:
                <select name="motorizacion">
                    <option value="gasolina">gasolina</option>
                    <option value="diesel">diesel</option>
                    <option value="hibrido">hibrido</option>
                    <option value="electrico">electrico</option>
                </select>
            </p>
 
            <p>
                Clase:
                <select name="clase">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
            </p>
 
            <p>Precio: <input type="number" name="precio"></p>
 
            <button type="submit">Modificar</button>
        </form>

<!-- ///////////////////////////////////////////////////////////////////////////// -->

            <?php
            $sql = "SELECT matricula, marca, modelo FROM vehiculos";
            $resultado1 = $conn->query($sql);

            ?>
            
            <h2>Añadir/Cerrar Vehiculo</h2>
            <form action="comprobacionBajaVehiculo.php" method="POST">
                <select name="matricula">
                    <?php
                        echo "<option value=''>-- Selecciona --</option>";
                        while($row = $resultado1->fetch()){
                            echo "<option value = " . $row['matricula'] . ">" . $row['matricula'] . ", ".  $row['marca'] . ", " . $row['modelo'] . "</option>";
                        }
                    ?>
                </select>
                Fecha baja: <input type="date" name="fechaBaja">
                Fecha alta: <input type="date" name="fechaAlta">
                <button type="submit">Dar de baja</button>
            </form>

<!-- ///////////////////////////////////////////////////////////////////////////// -->

            <?php
                $sql="SELECT matricula_id FROM cierrevehiculo";
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
            <?php

                if($_SESSION['errores'] != NULL && $_SESSION['errores']['destino'] === 'comprobacionBajaVehiculo.php'){
                echo "<p style='color: red;'>" . $_SESSION['errores']['mensaje'] . "</p>";
                }
                $_SESSION['errores'] = null;
            ?>
            <button><a href="..cerrarSesion.php">Cerrar sesion</button>
        </body>
</html>