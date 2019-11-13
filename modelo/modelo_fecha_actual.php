<?php

getFecha();
getFechaCompleta();
function getFecha(){
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    $zona_horaria=date_default_timezone_get();

    $fecha=getdate();

    $mes=$fecha['mon'];
    if ($mes<10){
        $mes='0'.$mes;
    }

    $dia=$fecha['mday'];
    if ($dia<10){
        $dia='0'.$dia;
    }

    $fecha['año']=$fecha['year'];
    $fecha['mes']=$mes;
    $fecha['dia']=$dia;

    return $fecha;
}

function getFechaCompleta(){
    $fecha=getFecha();
    $fecha_completa=$fecha['año'].$fecha['mes'].$fecha['dia'];
    return $fecha_completa;
}

function getFechaConGuiones(){
    $fecha=getFecha();
    $fecha_guiones=$fecha['año']."-".$fecha['mes']."-".$fecha['dia'];
    return $fecha_guiones;
}

