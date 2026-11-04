<?php
session_start();
include("conexion.php");

$matricula = $_POST['matricula'];

try{
    $sql = "UPDATE reservas 
    SET cancelada = 1 
    WHERE matricula_coche = '".$matricula."'" 
    . "AND fecha_reserva = '". $_POST['fecha_reserva']. "'"
    . "AND fecha_devolucion = '" . $_POST['fecha_devolucion'] . "';";

    $conn->query($sql);
    header('Location: reservasCliente.php');
    exit;
}catch(PDOException $e){
    echo $e->getMessage();
}

