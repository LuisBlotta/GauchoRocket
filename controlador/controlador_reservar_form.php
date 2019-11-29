<?php
include_once("modelo/modelo_tiene_nivel.php");
include_once("modelo/modelo_validar_nivel.php");
    $id_vuelo=$_GET['id_vuelo'];
    $nick = $_COOKIE["login"];
    $resultado = validarNivel($id_vuelo, $nick);

include("vista/vista_reserva_form.php");
function reservar_form_index(){}


