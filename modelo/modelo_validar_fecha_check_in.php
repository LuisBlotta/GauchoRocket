<?php
include_once("conexion.php");

validar_fecha();
function validar_fecha(){
    $fecha_actual = getFecha();
    $hora_actual = getHora();
    $nro_reserva = $_GET['nro_reserva'];
    $conn = getConexion();


    $sqlFechaReserva = "SELECT vuelo.dia_partida fecha_partida, vuelo.hora_partida hora_partida, reserva.id_reserva id_reserva FROM vuelo
                      JOIN vuelo_trayecto ON vuelo_trayecto.fk_vuelo = vuelo.id_vuelo
                      JOIN reserva ON reserva.fk_id_vuelo_trayecto = vuelo_trayecto.id_vuelo_trayecto
                      WHERE reserva.nro_reserva = $nro_reserva";

    $resultFecha = mysqli_query($conn, $sqlFechaReserva);

    if (mysqli_num_rows($resultFecha) > 0) {
        while ($row = mysqli_fetch_assoc($resultFecha)) {
            $reserva = Array();
            $reserva['fecha_partida'] = $row["fecha_partida"];
            $reserva['hora_partida'] = $row["hora_partida"];
            $reserva['id_reserva'] = $row["id_reserva"];
        }
    }


    //-----Divide la fecha de partida en Año, Mes y Dia
    $fechaEnteraReserva = strtotime($reserva['fecha_partida']);

    $año_partida = date("Y", $fechaEnteraReserva);
    $mes_partida = date("m", $fechaEnteraReserva);
    $dia_partida = date("d", $fechaEnteraReserva);

    //$puede_realizar_checkIn=true;

    if ($fecha_actual['año'] == $año_partida) {
        if ($mes_partida == $fecha_actual['mes']) {
            if ($dia_partida-$fecha_actual['dia']<2){
                if($hora_actual['hora']-$reserva['hora_partida']<2){

                    $sqlListaEspera="INSERT INTO lista_espera (fk_reserva)
                                 VALUES (".$reserva['id_reserva'].")";

                    $sqlEstadoReserva="UPDATE reserva 
                                        SET fk_estado_reserva = 5
                                        WHERE nro_reserva = $nro_reserva"; //Estado -> En lista de espera
                    $resultsEstadoReserva = mysqli_query($conn, $sqlEstadoReserva);
                    //$puede_realizar_checkIn=false;

                    header("location:consultar_reservas?lista_espera=true");
                }
            }
        }
    }

    /*else{
        header("location:modelo/modelo_cancelar_vuelo.php");
    }*/

    //return $puede_realizar_checkIn;

}