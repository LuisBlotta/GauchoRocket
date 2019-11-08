<?php
include("conexion.php");

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
     $datos=mysqli_fetch_assoc($result);
     /*print_r($datos);
     exit();*/

     mysqli_close($conn);

     return $datos;
}
traerAsientosReservados();
function traerAsientosReservados(){
    $conn = getConexion();
    $nro_reserva = $_GET['nro_reserva'];

        $sqlTraerAsientosReservados = "select asientos_reservados.numero_asiento numero_asiento from asientos_reserva 
                                        join asientos_reservados on asientos_reserva.fk_asientos_reservados  = asientos_reservados.id_asientos_reservados
                                        join reserva on asientos_reserva.fk_reserva = reserva.id_reserva Where reserva.nro_reserva =$nro_reserva";

    $result2 = mysqli_query($conn, $sqlTraerAsientosReservados);

    $asientosReservados = Array();
    if (mysqli_num_rows($result2) > 0) {
        while($row = mysqli_fetch_assoc($result2)) {
            $asiento_reservado = Array();
            $asiento_reservado['numero_asiento'] =  $row["numero_asiento"];
            $asientosReservados[] = $asiento_reservado;
        }
    }

  return $asientosReservados;
}





 ?>


