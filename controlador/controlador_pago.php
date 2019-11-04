<?php
include("modelo/modelo_info-pago.php");

$datos = getInfoPago();

include("vista/vista_pago.php");
