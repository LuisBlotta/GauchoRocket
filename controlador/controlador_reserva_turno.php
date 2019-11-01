<?php
include("modelo/modelo_reserva_turno.php");

$medicos = getTurnos();

include("vista/vista_reserva_turno.php");