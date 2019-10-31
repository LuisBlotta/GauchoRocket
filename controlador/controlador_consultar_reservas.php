<?php
include("modelo/modelo_consultar_reservas.php");

$reservas = getReservas();

include("vista/vista_consultar_reservas.php");