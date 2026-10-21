<?php
include ("conexion.php");

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header ("Location: registro.php");
    exit;
}

$matricula = $_POST['matricula'];

try{
    $sql = "DELETE FROM cierreVehiculo WHERE matricula_id = ?";
    $resultado = $conn->prepare($sql);
    $resultado->execute([$matricula]);
}catch(PDOException $e){
    echo $e->getMessage();
}
?>