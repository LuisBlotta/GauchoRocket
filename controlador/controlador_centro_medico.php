<?php
include("modelo/modelo_centro_medico.php");

function centro_medico_index(){}

$medicos = getCentroMedico();
include("vista/vista_centro-medico.php");