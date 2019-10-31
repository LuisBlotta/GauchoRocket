<?php
include_once("conexion.php");

function getVuelos(){

    $id_vuelo=$_GET['id_vuelo'];
    $id_trayecto=$_GET['id_trayecto'];
    $conn = getConexion();

    $sql = "SELECT trayecto.id_trayecto, vuelo.id_vuelo id_vuelo, vuelo.dia_partida fecha_ida, d1.descripcion origen, d0.descripcion destino, d0.id_destino id_destino, tipo_viaje.descripcion tipo_viaje, nivel_pasajero.id_numero nivel_pasajero, trayecto.precio precio         
            FROM vuelo JOIN trayecto ON vuelo.id_vuelo = trayecto.fk_id_vuelo
                       JOIN destino d0 ON trayecto.fk_punto_llegada = d0.id_destino
                       JOIN destino d1 ON trayecto.fk_punto_partida = d1.id_destino
                       JOIN tipo_viaje ON vuelo.fk_tipo_viaje = tipo_viaje.id_tipo_viaje
                       JOIN equipo ON vuelo.fk_equipo = equipo.id_equipo
                       JOIN modelo ON equipo.fk_modelo = modelo.id_modelo
                       JOIN nivel_pasajero ON nivel_pasajero.fk_id_modelo = modelo.id_modelo
            WHERE vuelo.id_vuelo ='$id_vuelo' AND trayecto.id_trayecto = $id_trayecto";

    $result = mysqli_query($conn, $sql);

    $vuelos = Array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $vuelo = Array();
            $vuelo['id_destino'] =  $row["id_destino"];
            $vuelo['id_trayecto'] =  $row["id_trayecto"];
            $vuelo['id_vuelo'] =  $row["id_vuelo"];
            $vuelo['fecha_ida'] =  $row["fecha_ida"];
            $vuelo['origen'] =  $row["origen"];
            $vuelo['destino'] =  $row["destino"];
            $vuelo['tipo_viaje'] =  $row["tipo_viaje"];
            $vuelo['nivel_pasajero'] = $row["nivel_pasajero"];
            $vuelo['precio'] =  $row["precio"];
            $vuelos[] = $vuelo;
        }
    }
    mysqli_close($conn);
    return $vuelos;
}