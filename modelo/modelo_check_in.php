<?php
include("conexion.php");
chech_in();
 function chech_in(){
     $conn = getConexion();
     $nro_reserva = $_GET['nro_reserva'];

    ### Trae capacidad de de la cabina ###


    $sqlTraeCapacidad="select cabina.capacidad, vuelo.dia_partida, vuelo.hora_partida from reserva join vuelo_trayecto on reserva.fk_id_vuelo_trayecto = vuelo_trayecto.id_vuelo_trayecto 
						join vuelo on vuelo.id_vuelo = vuelo_trayecto.fk_vuelo
                        join equipo on equipo.id_equipo = vuelo.fk_equipo
                        join modelo on modelo.id_modelo = equipo.fk_modelo
                        join cabina on cabina.fk_id_modelo = modelo.id_modelo
                        where reserva.nro_reserva = $nro_reserva AND cabina.descripcion = (SELECT reserva.tipo_cabina FROM reserva  
																							WHERE reserva.nro_reserva  =$nro_reserva);";

     $result = mysqli_query($conn, $sqlTraeCapacidad);
     $dato=mysqli_fetch_assoc($result);
     /*print_r($dato);
     exit();*/


}



?>