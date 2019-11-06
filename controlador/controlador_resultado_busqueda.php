<?php
include("modelo/modelo_buscar_vuelos.php");

function resultado_busqueda_index(){}

$vuelos = getVuelos();
include("vista/vista_resultado_busqueda.php");
