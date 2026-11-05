<?php
include ("conexion.php");

$matricula = $_POST['matricula'];

try{
    $sql = "DELETE FROM vehiculos WHERE matricula = ?";
    $sentencia = $conn->prepare($sql);
    $sentencia->execute([$matricula]);
    header('Location: panelAdmin.php');
}catch(PDOException $e){
    $e->getMessage();
}