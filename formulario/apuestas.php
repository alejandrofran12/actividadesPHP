<?php

session_start();

include "header.php";

isset($_SESSION['historialDeApuestas']) ? $_SESSION['historialDeApuestas'] : $_SESSION['historialDeApuestas'] = [];
isset($_SESSION['dinero']) ? $_SESSION['dinero'] : $_SESSION['dinero'] = 1000;
isset($_SESSION['apuestasEnCurso']) ? $_SESSION['apuestasEnCurso'] : $_SESSION['apuestasEnCurso'] = [];
$errores = [];


$opcion = $_POST['opcion'] ?? null;

    switch($opcion){
        case 1:
            $numeroApostado = apostarPorNumero($errores);
            $cantidad = apuesta($_SESSION['dinero'], $errores);
            if($cantidad != null && $numeroApostado != -1){
            $_SESSION['dinero'] = gestionarSaldo($_SESSION['dinero'], $cantidad);
            $_SESSION['apuestasEnCurso'][] = [
            "tipo" => "numero",
            "valor" => $numeroApostado,
            "cantidad" => $cantidad
            ];
            }
            break;
        case 2:
            $color = apostarPorColor($errores);
            $cantidad = apuesta($_SESSION['dinero'], $errores);
            if($cantidad != null && $color != null){
            $_SESSION['dinero']= gestionarSaldo($_SESSION['dinero'], $cantidad);
            $_SESSION['apuestasEnCurso'][] = [
            "tipo" => "color",
            "valor" => $color,
            "cantidad" => $cantidad
            ];
            }
            break;
        case 3:
            $parImpar = apostarPorParImpar($errores);
            $cantidad = apuesta($_SESSION['dinero'], $errores);
            if($cantidad != null && $parImpar != null){
            $_SESSION['dinero'] = gestionarSaldo($_SESSION['dinero'], $cantidad);
            $_SESSION['apuestasEnCurso'][] = [
            "tipo" => "parImpar",
            "valor" => $parImpar,
            "cantidad" => $cantidad
            ];
            }
            break;
        case 4:
            tirarBola($_SESSION['apuestasEnCurso']);
            $_SESSION['dinero'] += $_SESSION['historialDeApuestas'][count($_SESSION['historialDeApuestas']) - 1]["premio"];
            header("Location: tirarBola.php");
            break; 
        case 5:
            echo "---Historial de apuestas---";
            historialApuesta($_SESSION['historialDeApuestas']); //MOVERLO
            break;
        case 6:
            $docena = apostarPorDocenas($errores);
            $cantidad = apuesta($_SESSION['dinero'], $errores);
            if($cantidad != null && $docena != -1){
            $_SESSION['dinero']= gestionarSaldo($_SESSION['dinero'], $cantidad);
            $_SESSION['apuestasEnCurso'][] = [
            "tipo" => "docena",
            "valor" => $docena,
            "cantidad" => $cantidad
            ];
            }
            break;          
        case 7:
            $bajoAlto = apostarPorBajoAlto($errores);
            $cantidad = apuesta($_SESSION['dinero'], $errores);
            if($cantidad != null && $bajoAlto != null){
            $_SESSION['dinero']= gestionarSaldo($_SESSION['dinero'], $cantidad);
            $_SESSION['apuestasEnCurso'][] = [
            "tipo" => "bajoAlto",
            "valor" => $bajoAlto,
            "cantidad" => $cantidad
            ];
            }
            break;
        case 9:

    }

function comprobarArchivo($errores){
    $directorio = "uploads/";
    $rutaArchivo = $directorio . basename($_FILES['fileToUpload']['name']);
    $archivoEnMinuscula = strtolower(pathinfo($rutaArchivo, PATHINFO_EXTENSION));
    if(isset($_POST['submit'])){
            if($_POST['opcion']){
                
            }
    }        
}
    
function tirarBola($apuestaEnCurso){

isset($_SESSION['$resultadoFinal']) ? $_SESSION['$resultadoFinal'] : $_SESSION['$resultadoFinal'] = [];
$ganado = null;
$informacionApuesta = [];
$_SESSION['premio'] = 0;

$numeroSalido = random_int(0, 36);

    foreach($apuestaEnCurso as $valor){
        switch($valor["tipo"]){
            case "numero":
                if($valor["valor"] === $numeroSalido){
                    $_SESSION['premio'] += $valor["cantidad"] * 36;
                    $_SESSION['$resultadoFinal'][] = "Numero: " . $valor["valor"] . " -> Ganador";
                }
                break;
            case "color":
                if($valor["valor"] === obtenerColor($numeroSalido)){
                    $_SESSION['premio'] += $valor["cantidad"] * 2;
                    $_SESSION['$resultadoFinal'][] = "Color: " . obtenerColor($numeroSalido) . " -> Ganador";
                }
                break;
            case "parImpar":
                if($valor["valor"] === obtenerParidad($numeroSalido)){
                    $_SESSION['premio'] += $valor["cantidad"] * 2;
                    $_SESSION['$resultadoFinal'][] = "Par/Impar: " . obtenerParidad($numeroSalido) . " -> Ganador";
                }
                break;
            case "docena":    
                if($valor["valor"] === obtenerDocena($numeroSalido)){
                    $_SESSION['premio'] += $valor["cantidad"] * 3;
                    $_SESSION['$resultadoFinal'][] = "Docena: " . obtenerDocena($numeroSalido) . " -> Ganador";
                }
                break;
            case "bajoAlto":
                if($valor["valor"] === obtenerAltoBajo($numeroSalido)){
                    $_SESSION['premio'] += $valor["cantidad"] * 2;
                    $_SESSION['$resultadoFinal'][] = "Bajo/Alto: " . obtenerAltoBajo($numeroSalido) . " -> Ganador";
                }
                break;
        }
    }

    $_SESSION['numeroSalido'] = $numeroSalido;  
    $_SESSION['color'] = obtenerColor($numeroSalido);
    $_SESSION['paridad'] = obtenerParidad($numeroSalido);            
     
    if($_SESSION['premio'] > 0) {$ganado = "ganaste";}
    else {$ganado = "perdiste";}

    $informacionApuesta = [
    "nDeApuestas" => count($apuestaEnCurso),
    "numeroSalido" => $numeroSalido,
    "colorSalido" => obtenerColor($numeroSalido),
    "parImpar" => obtenerParidad($numeroSalido),
    "docena" => obtenerDocena($numeroSalido),
    "bajoAlto" => obtenerAltoBajo($numeroSalido),
    "premio" => $_SESSION['premio'],
    "ganado" => $ganado
    ];
    
    
    $_SESSION['historialDeApuestas'][] = $informacionApuesta;
    
}

function apostarPorNumero(array &$errores) : int{
    $numeroApostado = $_POST['valor'];
    if($numeroApostado >= 0 && $numeroApostado <= 36){
        return $numeroApostado;    
    }else{
        $errores[] = "El número debe ser del 0 al 36";
        return -1;
    }
}

function apostarPorColor(array &$errores){
    $color = $_POST['valor'];
    if($color == "rojo" || $color == "negro"){
        return $color;
    }else{
        $errores[] = "El color debe ser rojo o negro";
        return null;
    }

}

function obtenerColor(int $numero) : String{
    $rojo = [1,3,5,7,9,12,14,16,18,19,21,23,25,27,30,32,34,36];
    if(in_array($numero, $rojo)){
        return "rojo";
    } else {
        return "negro";
    }
}

function apostarPorParImpar(array &$errores){
    $parImpar = $_POST['valor'];
    if($parImpar == "par" || $parImpar == "impar"){
        return $parImpar;
    }else{
        $errores[] = "Debes elegir entre par o impar";
        return null;
    }
}

function obtenerParidad(int $numero) : String{
    if($numero % 2 == 0){
        return "par";
    } else {
        return "impar";
    }
}

function apostarPorDocenas(array &$errores) : int{
    $docena = $_POST['valor'];
    if($docena >= 1 && $docena <= 3){
        return $docena;
    }else{
        $errores[] = "Debes elegir la docena correcta (1, 2 o 3)";
        return -1;
    }
}

function obtenerDocena(int $numero){
    if($numero >= 1 && $numero <= 12){
        return 1;
    } elseif($numero >= 13 && $numero <= 24){
        return 2;
    } elseif($numero >= 25 && $numero <= 36) {
        return 3;
    }else{
        return "ninguno";
    }
}

function apostarPorBajoAlto(array &$errores){
    $bajoAlto = $_POST['valor'];
    if($bajoAlto == "bajo" || $bajoAlto == "alto"){
        return $bajoAlto;
    }else{
        $errores[] = "El color debe ser rojo o negro";
        return null;
    }
}

function obtenerAltoBajo($bajoAlto) : String{
    if($bajoAlto >= 1 && $bajoAlto <= 18){
        return "bajo";
    } elseif($bajoAlto >= 19 && $bajoAlto <= 36){
        return "alto";
    }else{
        return "ninguno";
    }
}

function apuesta(int $dinero, array &$errores){
    $apostar = $_POST['cantidad'];
    if($dinero >= $apostar){
        return $apostar;
    }else{
        $errores[] = "No tienes suficiente saldo";
    }
}

function gestionarSaldo($dinero, $apostar){
    return $dinero - $apostar;
}

function mostrarApuesta($apuestaEnCurso){
    foreach($apuestaEnCurso as $apuestas){
        foreach($apuestas as $apuesta){
                echo "\n". $apuesta;
        }
        echo "\n";
    }
    echo "\n";
}

function historialApuesta(array $historial){
    echo "<br>";
    foreach($historial as $apuestas){
        
        foreach($apuestas as $key =>$apuesta){
            echo $key . ": " . $apuesta . "<br>";
        }
        echo "<br>";
    }
}

?>
<!DOCTYPE html>
<html>
    <body>
        <h2>Saldo disponible: <?php echo $_SESSION['dinero']?></h2>
        <h3>Realiza una apuesta:</h3>
        <form action="apuestas.php" method="post">
            <select name="opcion">
                <option value="1">Apostar por numero (0-36)</option>
                <option value="2">Apostar por color(rojo/negro)</option>
                <option value="3">Apostar por par o impar</option>
                <option value="6">Apostar por docenas (1, 2, 3)</option>
                <option value="7">Apostar por alto  bajo(1-18, 19-36)</option>
            </select>
            <h4>Valor apostado: </h4>
            <input type="text" name="valor">
            <h4>Apostar cantidad de dinero: </h4>
            <input type="number" name="cantidad">
            <input type="submit" name="enviar">
        </form>
        <form method="post">
            <button name="opcion" value="4">Girar ruleta</button>
        </form>
        <form method="post">
            <button name="opcion" value="5">Visualizar historial</button>
        </form>
        
        Subir archivo comprobante de tu banco:
        <form method="post" enctype="multipart/form-data">
              <input type="file" name="fileToUpload">
              <input type="submit" name="opcion" value="8">Retirar Dinero</input>              
        </form><br>
        

        <h3>Apuestas en curso:</h3>
        <?php
        if(count($errores) > 0){
            "<h3>Ha fallado algo</h3>";
            foreach($errores as $error){
                echo $error . "<br>";
            }
        }
        
        foreach ($_SESSION['apuestasEnCurso'] as $apuesta) {
            echo $apuesta['tipo'] . "<br>";
            echo $apuesta['valor'] . "<br>";
            echo $apuesta['cantidad'] . "<br>";
        }    
        ?>   
    </body>
</html>
<?php include "footer.php";  ?> 