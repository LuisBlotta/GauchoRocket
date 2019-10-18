<?php
include("conexion.php");

function getVuelos(){

    $conn = getConexion();

    $sql = "SELECT trayecto.dia_partida fecha_ida, d1.descripcion origen, d0.descripcion destino FROM trayecto 
            JOIN destino d0 on trayecto.punto_llegada = d0.id
            JOIN destino d1 on trayecto.punto_partida = d1.id GROUP BY trayecto.dia_partida";
    $result = mysqli_query($conn, $sql);

    $pokemons = Array();
    $vuelos = Array();
    if (mysqli_num_rows($result) > 0) {        
        while($row = mysqli_fetch_assoc($result)) {
            $vuelo = Array();
            $vuelo['fecha_ida'] =  $row["fecha_ida"];
            $vuelo['origen'] =  $row["origen"];
            $vuelo['destino'] =  $row["destino"];            
            $vuelos[] = $vuelo;            
        }
    }
    mysqli_close($conn);
    return $vuelos;
}

$vuelos = getVuelos();

?>