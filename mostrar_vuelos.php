<?php
include_once("conexion.php");

function getVuelos(){

    $conn = getConexion();

    $sql = "SELECT vuelo.id_vuelo id_vuelo, vuelo.dia_partida fecha_ida, d1.descripcion origen, d0.descripcion destino, tipo_viaje.descripcion tipo_viaje FROM vuelo JOIN trayecto ON vuelo.fk_trayecto = trayecto.id_trayecto 
            JOIN destino d0 on trayecto.fk_punto_llegada = d0.id_destino
            JOIN destino d1 on trayecto.fk_punto_partida = d1.id_destino
            JOIN tipo_viaje on vuelo.fk_tipo_viaje = tipo_viaje.id_tipo_viaje";

    //Para info_vuelo.php
    if(isset($_GET['id_vuelo'])){
        $id_vuelo=$_GET['id_vuelo'];
        $sql.=" WHERE vuelo.id_vuelo ='$id_vuelo'";
    }
    //-------------------
    $result = mysqli_query($conn, $sql);

    $vuelos = Array();
    if (mysqli_num_rows($result) > 0) {        
        while($row = mysqli_fetch_assoc($result)) {
            $vuelo = Array();
            $vuelo['id_vuelo'] =  $row["id_vuelo"];
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