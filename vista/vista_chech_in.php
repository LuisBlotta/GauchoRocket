<?php
include("head.php");?>
<link rel="stylesheet" type="text/css" href="public/css/estilos-index.css">
<?php
    $numeros= array();
foreach ($asientosReservados as $asiento_reservado){
    $numeros[] = $asiento_reservado['numero_asiento'];
}

$i=1;
while ($i < $datos['capacidad']) {

    if (in_array($i, $numeros)){
        echo "<label><img src='public/img/lugar_ocupado.png'> 
        <input type='checkbox' id='$i' value='asiento'></label>";

    }else{
        echo "<label> <img src='public/img/lugar_libre.png'>
            <input type='checkbox' id='$i' value='asiento'> </label>";

    }

    $i++;

}
?>