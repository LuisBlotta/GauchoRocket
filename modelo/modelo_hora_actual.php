<?php

getHora();
getHoraCompleta();
function getHora(){
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    $zona_horaria=date_default_timezone_get();

    $fecha=getdate();

    $hora=$fecha['hours'];
    if ($hora<10){
        $hora='0'.$hora;
    }

    $minutos=$fecha['minutes'];
    if ($minutos<10){
        $minutos='0'.$minutos;
    }

    $segundos=$fecha['seconds'];
    if ($segundos<10){
        $segundos='0'.$segundos;
    }

    $horario=Array();
    $horario['hora']=$hora;
    $horario['minutos']=$minutos;
    $horario['segundos']=$segundos;

    return $horario;
}

function getHoraCompleta(){
    $hora=getHora();
    $hora_completa=$hora['hora'].$hora['minutos'].$hora['segundos'];
    return $hora_completa;
}