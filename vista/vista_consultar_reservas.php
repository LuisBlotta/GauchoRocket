<?php include("condicional_sesion.php");?>
<!DOCTYPE html>
<html>
<head>
    <title>Gaucho Rocket</title>
    <?php include("head.php") ?>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-info_vuelo.css">
</head>
<body>

<main>
    <section class="cont-info">
        <?php
        foreach ($reservas as $reserva) {
            echo "
                        <article class='card'>                        
                           <img class='card-img-top' src='public/img/".$reserva['destino'].".jpg' alt='reserva'>
                            <div class='card-body'>                                
                                <h2>" . $reserva['nro_reserva'] . "</h2>  
                                <h4>" . $reserva['fecha_ida'] . "</h4><br>                                       
                                <h3>" . $reserva['hora_partida'] . "</h3>
                                <h3>" . $reserva['origen'] . "</h3>
                                <h3>" . $reserva['destino'] . "</h3>
                                <h3>" . $reserva['tipo_viaje'] . "</h3>
                                <p>Origen: " . $reserva['origen'] . "</p>
                                <p><img src='public/img/calendar.png'> " . $reserva['fecha_ida'] . "</p>
                                            
                            </div>                            
                        </article>";
         
        }
        ?>
    </section>
</main>
</body>
</html>