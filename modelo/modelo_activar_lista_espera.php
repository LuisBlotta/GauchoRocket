<?php
include_once("conexion.php");

activar_lista_espera();
function activar_lista_espera(){
    $fecha_actual = getFechaConGuiones();
    $hora_actual = getHora();
    $hora_actual=$hora_actual['hora'];

    $conn = getConexion();

    $sqlListaEspera="SELECT lista_espera.id_lista_espera id_lista_espera, lista_espera.fk_reserva fk_reserva, reserva.nro_reserva nro_reserva, reserva.cantidad_lugares cantidad_lugares
                     FROM lista_espera
                     JOIN reserva ON lista_espera.fk_reserva = reserva.id_reserva
                     JOIN vuelo_trayecto ON reserva.fk_id_vuelo_trayecto = vuelo_trayecto.id_vuelo_trayecto
                     JOIN vuelo ON vuelo_trayecto.fk_vuelo = vuelo.id_vuelo
                     WHERE vuelo.dia_partida='$fecha_actual' AND vuelo.hora_partida-$hora_actual BETWEEN 0 AND 2";

    $resultListaEspera = mysqli_query($conn, $sqlListaEspera);

    $datosListaEspera = Array();
    if (mysqli_num_rows($resultListaEspera) > 0) {
        while($row = mysqli_fetch_assoc($resultListaEspera)) {
            $lista_espera = Array();
            $lista_espera['id_lista_espera'] =  $row["id_lista_espera"];
            $lista_espera['fk_reserva'] =  $row["fk_reserva"];
            $lista_espera['nro_reserva'] =  $row["nro_reserva"];
            $lista_espera['cantidad_lugares'] =  $row["cantidad_lugares"];
            $datosListaEspera[] = $lista_espera;
        }
    }

    /*----------Trae datos----------*/
    foreach ($datosListaEspera as $lista_espera) {
        $nro_reserva = $lista_espera['nro_reserva'];

        $datos_cabina = traeDatosCabina($nro_reserva);
        $capacidad_cabina = $datos_cabina['capacidad'];

        $asientos_reservados = traerAsientosReservados($nro_reserva);
        $cantidad_asientos_reservados = count($asientos_reservados);

        $asientos_libres = $capacidad_cabina - $cantidad_asientos_reservados;
    }

    /*----------Usa datos----------*/
    foreach ($datosListaEspera as $lista_espera){
        if ($asientos_libres>=$lista_espera['cantidad_lugares']){
            echo "id: ".$lista_espera['id_lista_espera']." puede entrar<br>";
            echo "cantidad de lugares: ".$lista_espera['cantidad_lugares']."<br>";
            $asientos_libres=$asientos_libres-$lista_espera['cantidad_lugares'];
        }else{
            $lista_espera['id_lista_espera']."no puede entrar<br>";
        }
        echo "asientos libres: ".$asientos_libres."<br><br>";

        foreach($asientos_reservados as $asiento_reservado){
            $numero_asiento=$asiento_reservado['numero_asiento'];
        }

    }
    exit();
}
