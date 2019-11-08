<?php
include("head.php");?>
<link rel="stylesheet" type="text/css" href="public/css/estilos-index.css">
<?php
    $numeros= array();
foreach ($asientosReservados as $asiento_reservado){
    $numeros = $asiento_reservado;

}

$i=1;
while ($i < $datos['capacidad']) {

    if (in_array($i, $numeros)){
        echo "<img src='public/img/lugar_ocupado.png'> ";

    }else{
        echo "<img src='public/img/lugar_libre.png'> ";

    }

    $i++;

}
?>