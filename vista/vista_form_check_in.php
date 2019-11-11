<?php
include("condicional_sesion.php");
$nro_reserva=$_GET['nro_reserva'];
$numeros= array();
foreach ($asientosReservados as $asiento_reservado){
    $numeros[] = $asiento_reservado['numero_asiento'];
}
$i=1;

?>
<!DOCTYPE html>
<html>
<head>
    <title>Check In</title>
    <?php include("head.php");?>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-index.css">
</head>
<body>
    <main>
        <?php
        echo "<form action='check_in?nro_reserva=".$nro_reserva."' method='post'>";
                while ($i <= $datos['capacidad']) {
                    if (in_array($i, $numeros)){
                        echo "<label><img src='public/img/lugar_ocupado.png'> 
                        <input type='checkbox' name='asiento[]' value='$i'></label>";

                    }else{
                        echo "<label> <img src='public/img/lugar_libre.png'>
                            <input type='checkbox' name='asiento[]' value='$i'> </label>";
                        echo $i;

                    }
                    $i++;
                }
        ?>
            <button class="btn btn-info">Confirmar</button>
        </form>
    </main>
</body>
