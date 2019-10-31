<?php
include("modelo/modelo_mostrar_info_vuelo.php");

$vuelos = getVuelos();

include("vista/vista_info_vuelos.php");

