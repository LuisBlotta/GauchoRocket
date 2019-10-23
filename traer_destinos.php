<?php
include_once("conexion.php");

function getDestinos(){

    $conn = getConexion();

    $sql = "SELECT * from destino";
    $result = mysqli_query($conn, $sql);


    $destinos = Array();
    if (mysqli_num_rows($result) > 0) {        
        while($row = mysqli_fetch_assoc($result)) {
            $destino = Array();
            $destino['id_destino'] =  $row["id_destino"];
            $destino['descripcion'] =  $row["descripcion"];

            $destinos[] = $destino;
        }
    }
    mysqli_close($conn);
    return $destinos;
}

$destinos = getDestinos();

?>