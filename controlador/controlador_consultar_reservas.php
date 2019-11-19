<?php
include_once("modelo/modelo_tiene_nivel.php");
include("modelo/modelo_consultar_reservas.php");

function consultar_reservas_index(){}

$reservas = getReservas();
include("vista/vista_consultar_reservas.php");