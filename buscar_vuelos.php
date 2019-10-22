<?php
include("conexion.php");

function getVuelos(){
    $conn = getConexion();    

    $fecha_ida=$_POST['fecha_ida'];
    $origen=$_POST['origen'];
    $destino=$_POST['destino'];

    $fechaSinGuiones=str_replace("-", "", $fecha_ida);

    switch ($origen) {
        case 'Buenos Aires':
            $origen='BA';
            break;
        
        case 'Ankara':
            $origen='AK';
            break;

        case 'Estación Espacial Internacional':
            $origen='EEI';
            break;

        case 'Titán':
            $origen='Titan';
            break;
    }

    switch ($destino) {
        case 'Buenos Aires':
            $destino='BA';
            break;
        
        case 'Ankara':
            $destino='AK';
            break;

        case 'Estación Espacial Internacional':
            $destino='EEI';
            break;

        case 'Titán':
            $destino='Titan';
            break;
    }

    $sql="SELECT vuelo.dia_partida fecha_ida, d1.descripcion origen, d0.descripcion destino, tipo_viaje.descripcion tipo_viaje FROM vuelo JOIN trayecto ON vuelo.trayecto = trayecto.id 
            JOIN destino d0 on trayecto.punto_llegada = d0.id
            JOIN destino d1 on trayecto.punto_partida = d1.id
            JOIN tipo_viaje on vuelo.tipo_viaje = tipo_viaje.id
            WHERE d1.descripcion='$origen' AND d0.descripcion='$destino' AND vuelo.dia_partida='$fecha_ida'";
    $result = mysqli_query($conn, $sql);

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
    }else{           
        echo "<h2 class='error-busqueda col-sm-12' >Vuelo no encontrado</h2>";
        $sql = "SELECT trayecto.dia_partida fecha_ida, d1.descripcion origen, d0.descripcion destino, tipo_viaje.descripcion tipo_viaje FROM trayecto 
            JOIN destino d0 on trayecto.punto_llegada = d0.id
            JOIN destino d1 on trayecto.punto_partida = d1.id 
            JOIN tipo_viaje on trayecto.tipo_viaje = tipo_viaje.id
            GROUP BY trayecto.dia_partida";
        $result = mysqli_query($conn, $sql);


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
    }
    mysqli_close($conn);
    return $vuelos;   
}
$vuelos = getVuelos();
?>