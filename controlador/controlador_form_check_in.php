<?php
    include_once("modelo/modelo_info_check_in.php");
        $nro_reserva = $_GET['nro_reserva'];

        $asientosReservados = traerAsientosReservados($nro_reserva);
        $datos= traeDatosCabina($nro_reserva);
        function form_check_in_index(){}

    include("vista/vista_form_check_in.php");
?>
