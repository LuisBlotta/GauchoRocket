<?php include("condicional_sesion.php");?>
<!DOCTYPE html>
<html>
<head>
    <title>Gaucho Rocket</title>
    <?php include("head.php") ?>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-info_vuelo.css">
    <link rel="stylesheet" type="text/css" href="public/css/estilos-reservas.css">
</head>
<body>

<main>
    <section class="cont-info">
        <?php
        foreach ($reservas as $reserva) {
            echo "
                        <article href='' class='card'>                        
                           <img class='card-img-top' src='public/img/".$reserva['destino'].".jpg' alt='reserva'>
                            <div class='card-body'>                                
                                <p>N° de reserva: " . $reserva['nro_reserva'] . "</p>  
                                <h2>" . $reserva['destino'] . "</h2><br>

                                <h4><img src='public/img/calendar.png'> " . $reserva['fecha_ida'] . "</h4>
                                <h4>Hora: " . $reserva['hora_partida'] . ":00 AM</h4><br>                                
                                
                                <p>" . $reserva['tipo_viaje'] . "</p>
                                <p>Origen: " . $reserva['origen'] . "</p> 

                                <a href='index.php?pag=pago&nro_reserva=".$reserva['nro_reserva']."' class='btn-reservar btn btn-info'>Pagar</a>
                            </div>
                        </article>";
            
        }
        ?>
    </section>
</main>
</body>
</html>