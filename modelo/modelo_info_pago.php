<?php
include_once("conexion.php");

function getInfoPago(){

    $nick=$_COOKIE["login"];
    $nro_reserva=$_GET['nro_reserva'];
    $conn = getConexion();

    $sql = "SELECT reserva.nro_reserva nro_reserva, reserva.cantidad_lugares cantidad_lugares, vuelo.hora_partida hora_partida, vuelo.dia_partida fecha_ida, d1.descripcion origen, d0.descripcion destino, trayecto.precio precio, estado_reserva.descripcion estado_reserva
            FROM reserva
            JOIN estado_reserva ON reserva.fk_estado_reserva = estado_reserva.id_estado_reserva
            JOIN login ON reserva.fk_login = login.id_login
            JOIN vuelo_trayecto ON reserva.fk_id_vuelo_trayecto = vuelo_trayecto.id_vuelo_trayecto
            JOIN vuelo on  vuelo_trayecto.fk_vuelo = vuelo.id_vuelo
            JOIN trayecto ON vuelo_trayecto.fk_trayecto = trayecto.id_trayecto 
            JOIN destino d0 on trayecto.fk_punto_llegada = d0.id_destino
            JOIN destino d1 on trayecto.fk_punto_partida = d1.id_destino
            WHERE login.nick ='$nick' AND reserva.nro_reserva = $nro_reserva";

    $result = mysqli_query($conn, $sql);

    $datos = Array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $dato = Array();
            $dato['nro_reserva'] =  $row["nro_reserva"];                     
            $dato['fecha_ida'] =  $row["fecha_ida"]; 
            $dato['hora_partida'] =  $row["hora_partida"];           
            $dato['origen'] =  $row["origen"];
            $dato['destino'] =  $row["destino"];           
            $dato['precio'] =  $row["precio"];
            $dato['cantidad_lugares'] =  $row["cantidad_lugares"];

                $precio_total=$dato['precio']*$dato['cantidad_lugares'];
                $dato['precio_total']=$precio_total;

            $dato['estado_reserva'] =  $row["estado_reserva"];
            $datos[] = $dato;
        }
    }
    mysqli_close($conn);
    return $datos;
}