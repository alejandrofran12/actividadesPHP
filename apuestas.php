<?php

session_start();

$_SESSION['dinero'] = 1000;
$_SESSION['apuestasEnCurso'] = [];
$_SESSION['historialDeApuestas'] = [];

$opcion = (int) $_POST['opcion'] ?? 0;
    switch($opcion){
        case 1:
            $numeroApostado = apostarPorNumero();
            $cantidad = apuesta($dinero);
            $dinero = gestionarSaldo($dinero, $cantidad);
            $apuestaEnCurso[] = [
            "tipo" => "numero",
            "valor" => $numeroApostado,
            "cantidad" => $cantidad
            ];
            break;
        case 2:
            $color = apostarPorColor();
            $cantidad = apuesta($dinero);
            $dinero = gestionarSaldo($dinero, $cantidad);
            $apuestaEnCurso[] = [
            "tipo" => "color",
            "valor" => $color,
            "cantidad" => $cantidad
            ];
            break;
        case 3:
            $parImpar = apostarPorParImpar();
            $cantidad = apuesta($dinero);
            $dinero = gestionarSaldo($dinero, $cantidad);
            $apuestaEnCurso[] = [
            "tipo" => "parImpar",
            "valor" => $parImpar,
            "cantidad" => $cantidad
            ];
            break;
        case 4:
            $historialApuestas[] = tirarBola($apuestaEnCurso);
            $apuestaEnCurso = [];
            $dinero += $historialApuestas[count($historialApuestas) - 1]["premio"];
            break; 
        case 5:
            echo "\n---Historial de apuestas---\n";
            historialApuesta($historialApuestas);
            break;
        case 6:
            $docena = apostarPorDocenas();
            $cantidad = apuesta($dinero);
            $dinero = gestionarSaldo($dinero, $cantidad);
            $apuestaEnCurso[] = [
            "tipo" => "docena",
            "valor" => $docena,
            "cantidad" => $cantidad
            ];
            break;          
        case 7:
            $bajoAlto = apostarPorBajoAlto();
            $cantidad = apuesta($dinero);
            $dinero = gestionarSaldo($dinero, $cantidad);
            $apuestaEnCurso[] = [
            "tipo" => "bajoAlto",
            "valor" => $bajoAlto,
            "cantidad" => $cantidad
            ];
            break;
        case 8:
            echo "Has elegido salir\n";
            break;
        default:
            echo "Opción no válida\n";
    }

function tirarBola($apuestaEnCurso){

$resultadoFinal = [];
$premio = 0;
$ganado = null;
$informacionApuesta = [];

echo "\n---Girando Ruleta---";
echo "\n----------------------";
$numeroSalido = random_int(0, 36);
echo "\nNumero salido: " . $numeroSalido;
echo "\nColor salido: " . obtenerColor($numeroSalido);
echo "\nParidad: " . obtenerParidad($numeroSalido);

    foreach($apuestaEnCurso as $valor){
        switch($valor["tipo"]){
            case "numero":
                if($valor["valor"] == $numeroSalido){
                    $premio += $valor["cantidad"] * 36;
                    $resultadoFinal[] = "Numero: " . $valor["valor"] . " -> Ganador";
                }else{
                    $premio -= $valor["cantidad"];
                    $resultadoFinal[] = "Numero: " . $valor["valor"] . " -> Perdedor";
                }
                break;
            case "color":
                if($valor["valor"] == obtenerColor($numeroSalido)){
                    $premio += $valor["cantidad"] * 2;
                    $resultadoFinal[] = "Color: " . obtenerColor($numeroSalido) . " -> Ganador";
                }else{
                    $premio -= $valor["cantidad"];
                    $resultadoFinal[] = "Color: " . obtenerColor($numeroSalido) . " -> Perdedor";
                }
                break;
            case "parImpar":
                if($valor["valor"] == obtenerParidad($numeroSalido)){
                    $premio += $valor["cantidad"] * 2;
                    $resultadoFinal[] = "Par/Impar: " . obtenerParidad($numeroSalido) . " -> Ganador";
                }else{
                    $premio -= $valor["cantidad"];
                    $resultadoFinal[] = "Par/Impar: " . obtenerParidad($numeroSalido) . " -> Perdedor";
                }
                break;
            case "docena":    
                if($valor["valor"] == obtenerDocena($numeroSalido)){
                    $premio += $valor["cantidad"] * 3;
                    $resultadoFinal[] = "Docena: " . obtenerDocena($numeroSalido) . " -> Ganador";
                }else{
                    $premio -= $valor["cantidad"];
                    $resultadoFinal[] = "Docena: " . obtenerDocena($numeroSalido) . " -> Perdedor";
                }
                break;
            case "bajoAlto":
                if($valor["valor"] == obtenerAltoBajo($numeroSalido)){
                    $premio += $valor["cantidad"] * 2;
                    $resultadoFinal[] = "Bajo/Alto: " . obtenerAltoBajo($numeroSalido) . " -> Ganador";
                }else{
                    $premio -= $valor["cantidad"];
                    $resultadoFinal[] = "Bajo/Alto: " . obtenerAltoBajo($numeroSalido) . " -> Perdedor";
                }
                break;
        }
    }
    
    if($premio < 0){
        echo "\nHas perdido!";
        $ganado = "Perdida";
    }else{
        echo "\nHas ganado!";
        echo "\nTus ganancias han sido de: " . $premio . "€"; 
        $ganado = "Ganada";
    }
    
    $informacionApuesta = [
        "nDeApuestas" => count($apuestaEnCurso),
        "numeroSalido" => $numeroSalido,
        "colorSalido" => obtenerColor($numeroSalido),
        "parImpar" => obtenerParidad($numeroSalido),
        "docena" => obtenerDocena($numeroSalido),
        "bajoAlto" => obtenerAltoBajo($numeroSalido),
        "premio" => $premio,
        "ganado" => $ganado
    ];
    echo "\n----------------------";
    echo "\nResultado de las apuestas: \n";
    foreach($resultadoFinal as $apuesta){
        echo $apuesta . "\n";
    }
    echo "\n";
    return $informacionApuesta;
}

function apostarPorNumero(){
    $numeroApostado = readline("Dime el numero que quieres apostar(0, 36): ");
    if($numeroApostado >= 0 && $numeroApostado <= 36){
        return $numeroApostado;    
    }else{
        echo "Número no válido\n";
    }
}

function apostarPorColor(){
    $color = readline("Dime el color que quieres apostar(rojo/negro): ");
    if($color == "rojo" || $color == "negro"){
        return $color;
    }else{
        echo "Color no válido\n";
    }

}

function obtenerColor($numero){
    $rojo = [1,3,5,7,9,12,14,16,18,19,21,23,25,27,30,32,34,36];
    if(in_array($numero, $rojo)){
        return "rojo";
    } else {
        return "negro";
    }
}

function apostarPorParImpar(){
    $parImpar = readline("Dime si quieres apostar por par o impar: ");
    if($parImpar == "par" || $parImpar == "impar"){
        return $parImpar;
    }else{
        echo "Opción no válida\n";
    }
}

function obtenerParidad($numero){
    if($numero % 2 == 0){
        return "par";
    } else {
        return "impar";
    }
}

function apostarPorDocenas(){
    echo "DOCENAS: 1-12, 13-24, 25-36\n";
    $docena = readline("Dime la docena que quieres apostar(1, 2 o 3): ");
    if($docena >= 1 && $docena <= 3){
        return $docena;
    }else{
        echo "Docena no válida\n";
    }
}

function obtenerDocena($numero){
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

function apostarPorBajoAlto(){
    $bajoAlto = readline("Dime si quieres apostar por bajo(1-18) o alto(19-36): ");
    if($bajoAlto == "bajo" || $bajoAlto == "alto"){
        return $bajoAlto;
    }else{
        echo "Opción no válida\n";
    }
}

function obtenerAltoBajo($bajoAlto){
    if($bajoAlto >= 1 && $bajoAlto <= 18){
        return "bajo";
    } elseif($bajoAlto >= 19 && $bajoAlto <= 36){
        return "alto";
    }else{
        return "ninguno";
    }
}

function apuesta($dinero){
    $apostar = trim(readline("Cuanto quieres apostar €?: "));
    if($dinero >= $apostar){
        return $apostar;
    }else{
        echo "No tienes suficiente saldo";
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

function historialApuesta($historial){
    foreach($historial as $apuestas){
        foreach($apuestas as $key =>$apuesta){
            echo "\n". $key . ": " . $apuesta;
        }
        echo "\n";
    }
}

?>
<!DOCTYPE html>
<html>
    <body>
        <h1>RULETA</h1>
        <h2>Saldo disponible <?php echo $_SESSION['dinero']?></h2>
        <h3>Realiza una apuesta</h3>
        <form action="apuestas.php" method="post">
            <select name="opcion">
                <option value="1">Apostar por numero (0-36)</option>
                <option value="2">Apostar por color(rojo/negro)</option>
                <option value="3">Apostar por par o impar</option>
                <option value="4">Apostar por docenas (1, 2, 3)</option>
                <option value="5">Apostar por alto  bajo(1-18, 19-36)</option>
            </select>
            <h4>Apostar valor: </h4>
            <input type="number" name="apuesta">
            <input type="submit" name="enviar">
        </form>
        
        <h3>Apuestas en curso</h3>
        <?php foreach($_SESSION['historialDeApuestas'] as $apuesta){
            echo ''. $apuesta .'';
        }
        ?> 
    </body>
</html>