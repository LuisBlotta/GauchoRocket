<?php
include("modelo/modelo_centroMedico.php");

$medicos = getCentroMedico();

include("vista/vista_centro-medico.php");