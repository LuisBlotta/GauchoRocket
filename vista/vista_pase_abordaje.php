<?php
include ("condicional_sesion.php");
	$qr=getQR();
	$datos_pasaje=getInfoPaseAbordaje();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pase de Abordaje</title>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-pase_abordaje.css">
</head>
<body>
<main>
<?php
    foreach ($datos_pasaje as $dato){
        $i=0;
        $asiento=$dato['asientos'];
        while ($i<$dato['cantidad_lugares']){
            echo "<section class='container card'>
                        <article class='info-pase'>";
                            if ($dato['tipo_viaje']=="Entre destinos"){
                                echo"<h4>" . $dato['destino'] . "</h4>";
                            }elseif ($dato['tipo_viaje']=="Tour"){
                                echo "<h4>Tour</h4>";
                            }elseif ($dato['tipo_viaje']=="Suborbital"){
                                echo "<h4>Vuelo Suborbital</h4>";
                            }
                            echo"<p>Origen: " . $dato['origen'] . "</p>
                                 <p>
                                    <span><img src='public/img/calendar.png'> ".$dato['fecha_ida']."</span>
                                    <span><img src='public/img/clock.png'> ".$dato['hora_partida'].":00</span>
                                  </p>";
                                echo "<p>
                                        <span>Asiento: <span class='num-cabina'>".$asiento[$i]."</span></span>
                                        <span>Cabina: <span class='num-cabina'>".$dato['tipo_cabina']."</span></span>
                                      </p>";
                   echo"</article>";
                echo '<img src="'.$qr.'">';
            echo "</section>";
            $i++;
        }
    }
?>

</main>
</body>
</html>