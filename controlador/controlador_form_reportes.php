<?php

include("modelo/modelo_form_reportes.php");
function form_reportes_index(){}
$facturacionMensual = facturacionMensual();
$cabinaMasVendida=cabinaMasVendida();
$datosCabina=cantidadPasajeroscabina();
$cantidadXCabina=cantidadXCabina();
$equipos = listarModelos();
include("vista/vista_form_reportes.php");

