<?php
include("modelo/modelo_buscar_vuelos.php");
$vuelos = getVuelos();
include("vista/vista_resultado_busqueda.php");
