<?php
include("modelo/modelo_consultar_reservas.php");

function consultar_reservas_index(){}

$reservas = getReservas();
include("vista/vista_consultar_reservas.php");