<?php

include("modelo/modelo_form_reportes.php");
function form_reportes_index(){}
$clientes=getClientes();
$facturacionMensual = facturacionMensual();
$cabinaMasVendida=cabinaMasVendida();
$datosCabina=cantidadPasajeroscabina();
include("vista/vista_form_reportes.php");

