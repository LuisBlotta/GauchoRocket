<?php include_once("conexion.php");
include("condicional_sesion.php"); ?>
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
        foreach ($datos as $dato) {
            echo "
                        <article class='card'>
                            <div class='card-body'>                                
                                <p>N° de reserva: " . $dato['nro_reserva'] . "</p>  
                                <h2>" . $dato['destino'] . "</h2>
                                <p>Origen: " . $dato['origen'] . "</p><br>

                                <p>
                                    <span>
                                        <img src='public/img/calendar.png'> ".$dato['fecha_ida']."
                                    </span>
                                    <span>
                                        Hora: " . $dato['hora_partida'] . ":00 AM
                                    </span><br>                              
                                
                                <h3>$" . $dato['precio_total'] . ".-</h3><br>                            
                                                                
                                <a class='btn-reservar btn btn-info' href='index.php?pag=reservar-form'>Pagar</a>
                            </div>                            
                        </article>";           
        }
        ?>
    </section>
</main>
</body>
</html>