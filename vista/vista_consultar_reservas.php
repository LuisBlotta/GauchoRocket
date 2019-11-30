<?php include("condicional_sesion.php");?>
<?php
if (!empty($_GET['fallo_datos'])==true){
    echo '<div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              Hubo un error en pago de la reserva N°'.$_GET['nro_reserva'].', por favor intentelo nuevamente
          </div>';
}
if (!empty($_GET['check_in_exitoso'])==true){
    echo '<div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              Se ha realizado el Check-In correctamente
          </div>';
}
if (!empty($_GET['check_in_realizado'])==true){
    echo '<div class="alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              El Check-In ya fue realizado
          </div>';
}
if (!empty($_GET['requiere_pago'])==true){
    echo '<div class="alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              Debe abonar su reserva para realizar el Check-In
          </div>';
}
if (!empty($_GET['lista_espera'])==true){
    echo '<div class="alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              Usted ha sido ingresado a la lista de espera
          </div>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reservas</title>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-info_vuelo.css">
    <link rel="stylesheet" type="text/css" href="public/css/estilos-reservas.css">
</head>
<body>

<main>
    <section class="cont-info">
        <?php
        $fecha_actual=getFechaConGuiones();

        if($reservas[0] == 1){
            echo "<h2 style='color:#17a2b8; text-align:center;'>No posee reservas</h2>";
        }else{
            foreach ($reservas as $reserva) {
                //-----Da la diferencia de días entre las fechas
                $datetime1 = new DateTime($reserva['fecha_ida']);
                $datetime2 = new DateTime($fecha_actual);
                $interval = $datetime1->diff($datetime2);
             $interval->format('%R%a');

                if(($interval->format('%R%a'))<2){
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
                                    
                                    <p>Cantidad de pasajeros: " . $reserva['cantidad_lugares'] . "</p>";
                            foreach ($reserva['acompañantes'] as $acompañante){
                                echo"<br><p>Acompañantes:</p>                                     
                                     <p>• ".$acompañante['nick']."<span class='num-nivel'>".$acompañante['nivel']."</span></p><br>";
                            }
                               echo "<p>Precio unitario: $".$reserva['precio'].".-</p>
                                    <h4>Total: $".$reserva['precio_total'].".-</h4><br>
                           
                                    <div class='botones'>";
                                if ($reserva['estado_reserva']==2) {
                                    include('vista_modal_pagar.php');
                                    echo"<button type='button' class='btn-action btn btn-info' data-toggle='modal' data-target='#myModal".$reserva['nro_reserva']."'>Pagar</button>";
                                }elseif ($reserva['estado_reserva']==3){
                                    if ($reserva['tiene_nivel']==true){
                                        echo "<a href='validar_fecha_check_in?nro_reserva=".$reserva['nro_reserva']."' class='btn-action btn btn-success'>Check-In</a>";
                                    }
                                }elseif($reserva['estado_reserva']==4){
                                    echo "<a disabled class='btn-action btn btn-danger' style='color: white;'>Cancelada</a>";
                                }

                                if(is_null($reserva['turno_existente'])&&$reserva['tiene_nivel']==false){
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
            echo "<h3 class='antiguas'>Reservas Antiguas</h3>
                    <div class='container card'>
                        <table class='table'>
                                <tbody>
                                    <tr>
                                        <th>Número</th>
                                        <th>Fecha</th>
                                        <th>Origen</th>
                                        <th>Destino</th>
                                        <th>Cantidad de Pasajeros</th>
                                        <th>Precio Total</th>
                                    </tr>";

            foreach ($reservas as $reserva){
                //-----Da la diferencia de días entre las fechas
                $datetime1 = new DateTime($reserva['fecha_ida']);
                $datetime2 = new DateTime($fecha_actual);
                $interval = $datetime1->diff($datetime2);
                $interval->format('%R%a');

                if(($interval->format('%R%a'))>=2) {
                    echo "  <tr>
                                <td>".$reserva['nro_reserva']."</td>
                                <td>".$reserva['fecha_ida']."</td>
                                <td>".$reserva['origen']."</td>
                                <td>".$reserva['destino']."</td>
                                <td>".$reserva['cantidad_lugares']."</td>
                                <td>".$reserva['precio_total']."</td>
                            </tr>";
                }
            }
                echo "    </tbody>
                      </table>
                  </div>";
        }
        ?>
    </section>
</main>
</body>
</html>