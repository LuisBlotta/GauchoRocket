<?php
include("modelo/modelo_check_in.php");

$asientosReservados = traerAsientosReservados();
$datos= chech_in();
function check_in_index(){}
include("vista/vista_chech_in.php");


?>
