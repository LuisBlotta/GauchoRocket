<?php
    include_once("modelo/modelo_validar_nivel.php");
    include_once("modelo/modelo_cancelar_vuelo.php");
    include("modelo/modelo_validar_reserva_nivel.php");
        function validar_reserva_nivel_index(){}
        $html=validarReservaNivel();
        echo $html;
?>