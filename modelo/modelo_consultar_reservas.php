<?php
include_once("conexion.php");

function getReservas(){

    $nick = $_COOKIE["login"];
    $conn = getConexion();

    $sql = "SELECT reserva.nro_reserva nro_reserva,vuelo.dia_partida fecha_ida, vuelo.hora_partida hora_partida, d1.descripcion origen, d0.descripcion destino, tipo_viaje.descripcion tipo_viaje  FROM reserva 
    JOIN login ON reserva.fk_login = login.id_login                
    JOIN trayecto on reserva.id_reserva = trayecto.id_trayecto 
    JOIN vuelo on trayecto.fk_id_vuelo = vuelo.id_vuelo
    JOIN destino d0 ON trayecto.fk_punto_llegada = d0.id_destino
    JOIN destino d1 ON trayecto.fk_punto_partida = d1.id_destino
    JOIN tipo_viaje ON vuelo.fk_tipo_viaje = tipo_viaje.id_tipo_viaje
    WHERE login.nick ='$nick'";

    $result = mysqli_query($conn, $sql);

    $reservas = Array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $reserva = Array();
            $reserva['nro_reserva'] =  $row["nro_reserva"];
            $reserva['fecha_ida'] =  $row["fecha_ida"];
            $reserva['hora_partida'] =  $row["hora_partida"];
            $reserva['origen'] = $row["origen"];
            $reserva['destino'] =  $row["destino"];
            $reserva['tipo_viaje'] =  $row["tipo_viaje"];
            $reservas[] = $reserva;
        }
    }
    mysqli_close($conn);
    return $reservas;
}