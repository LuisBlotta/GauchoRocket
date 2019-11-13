<?php include("condicional_sesion.php");?>
<!DOCTYPE html>
<html>
<head>
    <title>Reservas</title>
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
                                <p>Estado: ".$reserva['descripcion_estado']."</p><br> 
                                <h2>" . $reserva['destino'] . "</h2>
                                <p>Origen: " . $reserva['origen'] . "</p> 
                                <p>Tipo de viaje: " . $reserva['tipo_viaje'] . "</p><br>
                                
                                <h4><img src='public/img/calendar.png'> " . $reserva['fecha_ida'] . "</h4>
                                <h4><img src='public/img/clock.png'> " . $reserva['hora_partida'] . ":00</h4><br> 
                                
                                <p>Cantidad de pasajeros: " . $reserva['cantidad_lugares'] . "</p>   
                                <p>Precio unitario: $".$reserva['precio'].".-</p>
                                <h4>Total: $".$reserva['precio_total'].".-</h4><br>
                       
                                <div class='botones'>";
                            if ($reserva['estado_reserva']==2) {
                                include('vista_modal_pagar.php');
                                echo"<button type='button' class='btn-action btn btn-info' data-toggle='modal' data-target='#myModal".$reserva['nro_reserva']."'>Pagar</button>";
                            }elseif ($reserva['estado_reserva']==3){
                                if (!is_null($reserva['turno_existente'])){
                                    echo "<a href='form_check_in?nro_reserva=".$reserva['nro_reserva']."' class='btn-action btn btn-success'>Check-In</a>";
                                }
                            }elseif($reserva['estado_reserva']==4){
                                echo "<p>Cancelada</p>";
                            }

                            if(is_null($reserva['turno_existente'])){
                                echo"<a href='centro_medico?nro_reserva=".$reserva['nro_reserva']."' class='btn-action btn btn-info'>Sacar Turno</a>";
                            }

                            if ($reserva['estado_reserva']!=4){
                                echo"<a href='cancelar_vuelo?nro_reserva=".$reserva['nro_reserva']."' class='btn-action btn btn-danger'>Cancelar</a>";
                            }

                        echo"   </div>
                            </div>
                        </article>";
            }
        }
        ?>
    </section>
    <?php
    if (!empty($_GET['pago_exitoso'])==true){
        echo "<script>alert('El pago ha sido realizado');</script>";
    }
    if (!empty($_GET['fallo_datos'])==true){
        echo "<script>alert('Hubo un error en pago de la reserva N°".$_GET['nro_reserva'].", por favor intentelo nuevamente');</script>";
    }
    if (!empty($_GET['check_in_exitoso'])==true){
        echo "<script>alert('Se ha realizado el Check-In correctamente');</script>";
    }
    if (!empty($_GET['check_in_realizado'])==true){
        echo "<script>alert('El Check-In ya fue realizado ');</script>";
    }
    if (!empty($_GET['requiere_pago'])==true){
        echo "<script>alert('Debe abonar su reserva para realizar el Check-In');</script>";
    }
    if (!empty($_GET['lista_espera'])==true){
        echo "<script>alert('Usted ha sido ingresado a la lista de espera');</script>";
    }
    ?>
</main>
</body>
</html>