<?php
include_once("conexion.php");

lista_espera();
function lista_espera(){
    $nro_reserva=$_GET['nro_reserva'];
    $conn=getConexion();

    $sqlIdReserva = "SELECT reserva.id_reserva id_reserva FROM reserva WHERE reserva.nro_reserva = $nro_reserva";
    $resultId = mysqli_query($conn, $sqlIdReserva);
    $id_reserva=mysqli_fetch_row($resultId);

    $id_reserva=$id_reserva[0];

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



?>