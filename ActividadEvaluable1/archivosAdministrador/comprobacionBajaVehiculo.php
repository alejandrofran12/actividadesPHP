<?php
include ("conexion.php");
session_start();

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header ("Location: registro.php");
    exit;
}

$matricula = $_POST['matricula'];
$fechaBaja = $_POST['fechaBaja'];
$fechaAlta = $_POST['fechaAlta'];



if($fechaBaja < date('Y-m-d')){
    $_SESSION['errores'] = [
        'destino' => 'comprobacionBajaVehiculo.php',
        'mensaje' => 'fecha menor a la actual',
    ];
    header('Location: panelAdmin.php');
    exit;
}

if($fechaAlta < $fechaBaja){
    $_SESSION['errores'] = [
        'destino' => 'comprobacionBajaVehiculo.php',
        'mensaje' => 'fecha menor a la fecha de baja',
    ];
}

try{
    $sql = "INSERT INTO cierreVehiculo (fechaCierre, fechaApertura, matricula_id) VALUES (?, ?, ?)";
    $resultado = $conn->prepare($sql);
    $resultado->execute([$fechaBaja, $fechaAlta, $matricula]);
    header('Location: panelAdmin.php');
}catch(PDOException $e){
    echo $e->getMessage();
}

