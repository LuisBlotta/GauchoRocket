<?php
include("modelo/modelo_reserva_medico.php");

function reserva_medico_index(){}

$medicos = getMedicos();
include("vista/vista_reserva_medico.php");