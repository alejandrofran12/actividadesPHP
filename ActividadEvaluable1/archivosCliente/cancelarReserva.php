<?php
session_start();
include("conexion.php");

$matricula = $_POST['matricula'];

try{
    $sql = "UPDATE reservas 
    SET cancelada = 1; 
    WHERE matricula_coche = $matricula";

    $conn->query($sql);
    header('Location: reservasCliente.php');
    
}catch(PDOException $e){
    $e->getMessage();
}