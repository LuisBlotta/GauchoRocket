<?php
include("modelo/modelo_info_medico.php");

function form_turno_index(){}

$medicos = getMedicos();
include("vista/vista_form_turno.php");