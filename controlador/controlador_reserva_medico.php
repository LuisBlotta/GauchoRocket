<?php
include("modelo/modelo_reserva_medico.php");

$medicos = getMedicos();

include("vista/vista_reserva_medico.php");