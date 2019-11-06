<?php
include("modelo/modelo_mostrar_info_vuelo.php");

function info_vuelo_index(){}

$vuelos = getVuelos();
include("vista/vista_info_vuelos.php");

