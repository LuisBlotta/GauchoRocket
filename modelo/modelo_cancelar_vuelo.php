<?php
include_once("conexion.php");

function cancelar_vuelo($nro_reserva){
    $conn=getConexion();

    $sqlTraeIdReserva="SELECT reserva.id_reserva FROM reserva
                       WHERE nro_reserva=$nro_reserva";
    $resultIdReserva = mysqli_query($conn, $sqlTraeIdReserva); 

    $id_reserva=mysqli_fetch_row($resultIdReserva);
    $id_reserva=$id_reserva[0];

    $sqlInsertCancelados="INSERT INTO reserva_cancelada (fk_reserva) VALUES ($id_reserva)";

    $resultInsertCancelados = mysqli_query($conn, $sqlInsertCancelados);

    $sqlEstadoReserva="UPDATE reserva SET fk_estado_reserva = 4 WHERE nro_reserva=$nro_reserva";
    $resultEstadoReserva = mysqli_query($conn, $sqlEstadoReserva);

    mysqli_close($conn);
}
