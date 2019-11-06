<?php
include("modelo/modelo_gauchorocket.php");
include("modelo/modelo_traer_destinos.php");

function gauchorocket_index(){}
$vuelos = getVuelos();
$destinos = getDestinos();
include("vista/vista_gauchorocket.php");

