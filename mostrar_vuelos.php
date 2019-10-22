<?php
include("conexion.php");

function getVuelos(){

    $conn = getConexion();

    $sql = "SELECT vuelo.dia_partida fecha_ida, d1.descripcion origen, d0.descripcion destino, tipo_viaje.descripcion tipo_viaje FROM vuelo JOIN trayecto ON vuelo.trayecto = trayecto.id 
            JOIN destino d0 on trayecto.punto_llegada = d0.id
            JOIN destino d1 on trayecto.punto_partida = d1.id
<<<<<<< HEAD
            JOIN tipo_viaje on vuelo.tipo_viaje = tipo_viaje.id;";
=======
            JOIN tipo_viaje on trayecto.tipo_viaje = tipo_viaje.id";
>>>>>>> 9d45ecedebfc0cb0a90a2457578652fab0c3bb96
    $result = mysqli_query($conn, $sql);

    $pokemons = Array();
    $vuelos = Array();
    if (mysqli_num_rows($result) > 0) {        
        while($row = mysqli_fetch_assoc($result)) {
            $vuelo = Array();
            $vuelo['fecha_ida'] =  $row["fecha_ida"];
            $vuelo['origen'] =  $row["origen"];
            $vuelo['destino'] =  $row["destino"];
            $vuelo['tipo_viaje'] =  $row["tipo_viaje"];
            $vuelos[] = $vuelo;
        }
    }
    mysqli_close($conn);
    return $vuelos;
}

$vuelos = getVuelos();

?>