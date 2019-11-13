<?php
include ("modelo/modelo_fecha_actual.php");
    function fecha_actual_index(){}
include ("modelo/modelo_hora_actual.php");
    function hora_actual_index(){}
    
include("modelo/modelo_validar_fecha_check_in.php");
    function validar_fecha_check_in_index(){} 

$puede_hacer_checkIn=validar_fecha();
if ($puede_hacer_checkIn==true) {    

include("modelo/modelo_info_check_in.php");

$asientosReservados = traerAsientosReservados();
$datos= traeDatosCabina();
function form_check_in_index(){}
include("vista/vista_form_check_in.php");
}else{
	header("location:gauchorocket");
}

?>
