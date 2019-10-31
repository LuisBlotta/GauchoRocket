<?php
include("modelo/modelo_gauchorocket.php");
include("modelo/modelo_traer_destinos.php");

$vuelos = getVuelos();
$destinos = getDestinos();
include("vista/vista_gauchorocket.php");

