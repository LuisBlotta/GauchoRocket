<?php
include("modelo/modelo_info_check_in.php");

$asientosReservados = traerAsientosReservados();
$datos= traeDatosCabina();
function form_check_in_index(){}
include("vista/vista_form_check_in.php");

?>
