<?php

include("modelo/modelo_facturacion_meses_anteriores.php");
function facturacion_meses_anteriores_index(){}
$resultado=facturacionMesesAnteriores();
include("vista/vista_facturacion_meses_anteriores.php");





