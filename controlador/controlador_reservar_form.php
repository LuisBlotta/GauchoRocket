<?php
include_once("modelo/modelo_tiene_nivel.php");
include("modelo/modelo_validar_nivel.php");
    $resultado = validarNivel();

include("vista/vista_reserva_form.php");
function reservar_form_index(){}


