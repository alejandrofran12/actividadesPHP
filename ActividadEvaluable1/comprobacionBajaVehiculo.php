<?php
include ("conexion.php");

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header ("Location: registro.php");
    exit;
}

$matricula = $_POST['matricula'];
$fechaBaja = $_POST['fechaBaja'];
$fechaAlta = $_POST['fechaAlta'];

try{
    $sql = "INSERT INTO cierreVehiculo (fechaCierre, fechaApertura, matricula_id) VALUES (?, ?, ?)";
    $resultado = $conn->prepare($sql);
    $resultado->execute([$fechaBaja, $fechaAlta, $matricula]);
}catch(PDOException $e){
    echo $e->getMessage();
}
?>
