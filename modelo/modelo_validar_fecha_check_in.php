<?php
include_once("conexion.php");

validar_fecha();
function validar_fecha(){
    $fecha_actual = getFechaConGuiones();
    $hora_actual = getHora();
    $nro_reserva = $_GET['nro_reserva'];
    $conn = getConexion();


    //-----Trae la fecha y hora del vuelo
    $sqlFechaReserva = "SELECT vuelo.dia_partida fecha_partida, vuelo.hora_partida hora_partida FROM vuelo
                      JOIN vuelo_trayecto ON vuelo_trayecto.fk_vuelo = vuelo.id_vuelo
                      JOIN reserva ON reserva.fk_id_vuelo_trayecto = vuelo_trayecto.id_vuelo_trayecto
                      WHERE reserva.nro_reserva = $nro_reserva";

    $resultFecha = mysqli_query($conn, $sqlFechaReserva);

    if (mysqli_num_rows($resultFecha) > 0) {
        while ($row = mysqli_fetch_assoc($resultFecha)) {
            $reserva = Array();
            $reserva['fecha_partida'] = $row["fecha_partida"];
            $reserva['hora_partida'] = $row["hora_partida"];
        }
    }

    //-----Da la diferencia de días entre las fechas
    $datetime1 = new DateTime($fecha_actual);
    $datetime2 = new DateTime($reserva['fecha_partida']);
    $interval = $datetime1->diff($datetime2);
    $interval->format('%a');
    


    if(($interval->format('%a'))>2){
        header("location:consultar_reservas?fallo_fecha_check_in=true");
    }elseif(($interval->format('%a'))<=2){
        if(($interval->format('%a'))==0 && $reserva['hora_partida']-$hora_actual['hora']<=2){
            header("location:lista_espera?nro_reserva=".$nro_reserva);
        }else{
            header("location:form_check_in?nro_reserva=".$nro_reserva);
        }
    }

}