<?php
include_once("conexion.php");

function validar_fecha(){
    $fecha_actual = getFechaConGuiones();
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

    $id_reserva=$reserva['id_reserva'];

  

   
    //$puede_realizar_checkIn=true;

    $datetime1 = new DateTime($fecha_actual);
    $datetime2 = new DateTime($reserva['fecha_partida']);
    $interval = $datetime1->diff($datetime2);
    $interval->format('%a');
    


    if(($interval->format('%a'))>2){
        header("location:consultar_reservas");
    }

    elseif(($interval->format('%a'))<=2){        
        if($reserva['hora_partida']-$hora_actual['hora']>=2){
            $puede_realizar_checkIn=true;
            return $puede_realizar_checkIn;
        }else{
            $sqlListaEspera="INSERT INTO lista_espera (fk_reserva)
                            VALUES ($id_reserva)";
            $resultListaEspera = mysqli_query($conn, $sqlListaEspera);

            $sqlEstadoReserva="UPDATE reserva 
                                SET fk_estado_reserva = 5
                                WHERE nro_reserva = $nro_reserva"; //Estado -> En lista de espera
            $resultEstadoReserva = mysqli_query($conn, $sqlEstadoReserva);
            //$puede_realizar_checkIn=false;

            header("location:consultar_reservas?lista_espera=true");
        }
    }
       

    /*else{
        header("location:modelo/modelo_cancelar_vuelo.php");
    }*/

    //return $puede_realizar_checkIn;

}