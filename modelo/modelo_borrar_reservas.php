<?php
include_once("conexion.php");

borrar_reservas();
function borrar_reservas(){
    /*$fecha_actual=getFechaConGuiones();
    $hora_actual=getHora();
    $hora_actual=$hora_actual['hora'];
    $conn=getConexion();

    $sqlListaCancelacion="SELECT reserva_cancelada.fk_reserva id_reserva, reserva.nro_reserva nro_reserva, vuelo.dia_partida fecha_partida, vuelo.hora_partida hora_partida
                          FROM reserva_cancelada 
                                JOIN reserva ON reserva.id_reserva = reserva_cancelada.fk_reserva
                                JOIN vuelo_trayecto ON reserva.fk_id_vuelo_trayecto = vuelo_trayecto.id_vuelo_trayecto
                                JOIN vuelo ON vuelo_trayecto.fk_vuelo = vuelo.id_vuelo";
    $resultListaCancelacion = mysqli_query($conn, $sqlListaCancelacion);

    $reservas_a_borrar=Array();
    if (mysqli_num_rows($resultListaCancelacion) > 0) {
        while($row = mysqli_fetch_assoc($resultListaCancelacion)) {
            $reserva = Array();
            $reserva['id_reserva'] =  $row["id_reserva"];
            $reserva['fecha_partida'] =  $row["fecha_partida"];
            $reserva['hora_partida'] =  $row["hora_partida"];
            $reserva['nro_reserva'] =  $row["nro_reserva"];
            $reservas_a_borrar[]=$reserva;
        }
    }

    $sqlReservasAntiguas="SELECT reserva.id_reserva id_reserva, reserva.nro_reserva nro_reserva, vuelo.dia_partida fecha_partida, vuelo.hora_partida hora_partida
                          FROM reserva
                                JOIN vuelo_trayecto ON reserva.fk_id_vuelo_trayecto = vuelo_trayecto.id_vuelo_trayecto
                                JOIN vuelo ON vuelo_trayecto.fk_vuelo = vuelo.id_vuelo
                          WHERE vuelo.dia_partida <= '$fecha_actual'";
    $resultReservasAntiguas = mysqli_query($conn, $sqlReservasAntiguas);

    if (mysqli_num_rows($resultReservasAntiguas) > 0) {
        while($row = mysqli_fetch_assoc($resultReservasAntiguas)) {
            $reserva = Array();
            $reserva['id_reserva'] =  $row["id_reserva"];
            $reserva['fecha_partida'] =  $row["fecha_partida"];
            $reserva['hora_partida'] =  $row["hora_partida"];
            $reserva['nro_reserva'] =  $row["nro_reserva"];
            $reservas_a_borrar[]=$reserva;
        }
    }


    foreach ($reservas_a_borrar as $reserva){
        if($reserva['fecha_partida']<$fecha_actual||($reserva['fecha_partida']==$fecha_actual&&$reserva['hora_partida']+2==$hora_actual)){
            $sqlTieneAsientos="SELECT asientos_reserva.fk_reserva FROM asientos_reserva
                               WHERE asientos_reserva.fk_reserva =".$reserva['id_reserva'];
            $resultTieneAsientos = mysqli_query($conn, $sqlTieneAsientos);

            if (mysqli_num_rows($resultTieneAsientos) > 0) {
                $sqlIds="SELECT asientos_reserva.fk_asientos_reservados id_asientos_reservados, asientos_reserva.id_asientos_reserva id_asientos_reserva, reserva.id_reserva id_reserva 
                                  FROM asientos_reservados
                                  JOIN asientos_reserva ON asientos_reserva.fk_asientos_reservados = asientos_reservados.id_asientos_reservados
                                  JOIN reserva ON asientos_reserva.fk_reserva = reserva.id_reserva
                                  WHERE reserva.nro_reserva=".$reserva['nro_reserva'];

                $resultId = mysqli_query($conn, $sqlIds);

                if (mysqli_num_rows($resultId) > 0) {
                    while($row = mysqli_fetch_assoc($resultId)) {
                        $id = Array();
                        $id['id_asientos_reservados'] =  $row["id_asientos_reservados"];
                        $id['id_asientos_reserva'] =  $row["id_asientos_reserva"];
                        $id['id_reserva'] =  $row["id_reserva"];
                    }
                }

                $sqlDelAsientosReserva="DELETE FROM asientos_reserva WHERE id_asientos_reserva = " . $id['id_asientos_reserva'];
                $sqlDelAsientosReservados="DELETE FROM asientos_reservados WHERE id_asientos_reservados = " . $id['id_asientos_reservados'];

                $resultDelAsientosReserva = mysqli_query($conn, $sqlDelAsientosReserva);
                $resultDelAsientosReservados = mysqli_query($conn, $sqlDelAsientosReservados);
            }

            $sqlDelReservasCanceladas="DELETE FROM reserva_cancelada WHERE fk_reserva=".$reserva['id_reserva'];
            $resultDelReservasCanceladas = mysqli_query($conn, $sqlDelReservasCanceladas);

            $sqlDelReserva="DELETE FROM reserva WHERE id_reserva =".$reserva['id_reserva'];

            //echo $sqlDelAsientosReserva."<br>";
            //echo $sqlDelAsientosReservados."<br>";
            //echo $sqlDelReservasCanceladas."<br>";
            //echo $sqlDelReserva."<br>";
            //exit();

            $resultDelReserva = mysqli_query($conn, $sqlDelReserva);
        }
    }
    mysqli_close($conn);*/
}
