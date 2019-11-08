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
            echo "<h2 style='color:#17a2b8; text-align:center;'>No posee reservas</h2>";
        }else{
        
            foreach ($reservas as $reserva) {
                echo "
                        <article href='' class='card'>                        
                           <img class='card-img-top' src='public/img/".$reserva['destino'].".jpg' alt='reserva'>
                            <div class='card-body'>                                
                                <p>N° de reserva: " . $reserva['nro_reserva'] . "</p>  
                                <h2>" . $reserva['destino'] . "</h2>
                                <p>Origen: " . $reserva['origen'] . "</p> 
                                <p>Tipo de viaje: " . $reserva['tipo_viaje'] . "</p><br>
                                
                                <h4><img src='public/img/calendar.png'> " . $reserva['fecha_ida'] . "</h4>
                                <h4><img src='public/img/clock.png'> " . $reserva['hora_partida'] . ":00</h4><br> 
                                
                                <p>Cantidad de pasajeros: " . $reserva['cantidad_lugares'] . "</p>   
                                <p>Precio unitario: $".$reserva['precio'].".-</p>
                                <h4>Total: $".$reserva['precio_total'].".-</h4><br>";


                        if ($reserva['estado_reserva']==2) {
                            //echo"<a href='pago?nro_reserva=".$reserva['nro_reserva']."' class='btn-reservar btn btn-info'>Pagar</a>";
                            echo"<button type='button' class='btn btn-info' data-toggle='modal' data-target='#myModal".$reserva['nro_reserva']."'>Pagar</button>";
                                include('vista_modal_pagar.php');
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
    <?php
    if (!empty($_GET['estado_pago'])==1){
        echo "<script>alert('El pago ha sido realizado');</script>";
    }
    if (!empty($_GET['fallo_datos'])==1){
        echo "<script>alert('Hubo un error en pago de la reserva N°".$_GET['nro_reserva'].", por favor intentelo nuevamente');</script>";
    }
    ?>
</main>
</body>
</html>