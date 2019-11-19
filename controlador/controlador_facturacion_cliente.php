<?php

include("modelo/modelo_facturacion_cliente.php");
function facturacion_cliente_index(){}
$transacciones=getFacturacion();
include("vista/vista_facturacion_cliente.php");


