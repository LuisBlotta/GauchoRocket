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

        if($reservas[0] == 1){
            echo "<h2 style='color:#17a2b8; text-align:center;'>No posee estilos-reservas</h2>";
        }else{
        
            foreach ($reservas as $reserva) {
                echo "
                        <article href='' class='card'>                        
                           <img class='card-img-top' src='public/img/".$reserva['destino'].".jpg' alt='reserva'>
                            <div class='card-body'>                                
                                <p>N° de reserva: " . $reserva['nro_reserva'] . "</p>  
                                <h2>" . $reserva['destino'] . "</h2>
                                <p>Origen: " . $reserva['origen'] . "</p> <br>
                                
                                <h4><img src='public/img/calendar.png'> " . $reserva['fecha_ida'] . "</h4>
                                <h4>Hora: " . $reserva['hora_partida'] . ":00 AM</h4><br>                                
                                
                                <p>" . $reserva['tipo_viaje'] . "</p>";


                        if ($reserva['estado_reserva']==2) {
                            echo"<a href='index.php?pag=pago&nro_reserva=".$reserva['nro_reserva']."' class='btn-reservar btn btn-info'>Pagar</a>";
                        }elseif ($reserva['estado_reserva']!=4) {
                           echo"<a href='#' class='btn-reservar btn btn-danger'>Cancelar</a>";
                        }else{
                            echo "<p>Cancelada</p>";
                        }                            
                        echo"</div>
                        </article>";
            }
        }
        ?>
    </section>
</main>
</body>
</html>