<?php
session_start();
function sistemaRecomendaciones($id){

    $id = (int)$id;

    $recomendaciones = [];

    $encontrado = false;

    if(isset($_COOKIE['recomendaciones' . $_SESSION['id']])){
        $recomendaciones = json_decode($_COOKIE['recomendaciones' . $_SESSION['id']], true);

        foreach($recomendaciones as $idR){
            if($id == $idR){
                $encontrado = true;
            }
        }
    }


    if(!$encontrado){
    $recomendaciones[] = $id;
    }

    setcookie('recomendaciones' . $_SESSION['id'], json_encode($recomendaciones), time() + 86400, "/");
}