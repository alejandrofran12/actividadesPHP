<?php

include 'conexion.php';

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header ("Location: registro.php");
    exit;
}

$matricula = $_POST['matricula'];
$fechaBaja = $_POST['fechaBaja'];
$fechaAlta = $_POST['fechaAlta'];

var_dump($matricula);
try{
    $sql = "UPDATE cierreVehiculo set fechaCierre = ?, fechaApertura = ? WHERE matricula_id = ?;";
    $resultado = $conn->prepare($sql);
    $resultado->execute([$fechaBaja, $fechaAlta, $matricula]);
    header('Location: panelAdmin.php');
}catch(PDOException $e){
    echo $e->getMessage();
}