<?php
include("modelo/modelo_info_pago.php");

function pago_index(){}

$datos = getInfoPago();
include("vista/vista_pago.php");
