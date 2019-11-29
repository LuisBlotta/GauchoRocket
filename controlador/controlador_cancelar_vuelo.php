<?php
    include_once("modelo/modelo_cancelar_vuelo.php");
    $nro_reserva = $_GET['nro_reserva'];
    cancelar_vuelo($nro_reserva);
    function cancelar_vuelo_index(){}

    header("location:consultar_reservas");