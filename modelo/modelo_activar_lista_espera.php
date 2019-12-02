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

    foreach ($datosListaEspera as $lista_espera) {
        /*--------------------Trae datos--------------------*/
        $nro_reserva = $lista_espera['nro_reserva'];

        $datos_cabina = traeDatosCabina($nro_reserva);
        $capacidad_cabina = $datos_cabina['capacidad'];

        $asientos_reservados = traerAsientosReservados($nro_reserva);


        /*--------------------Usa datos--------------------*/

        //-----Total asientos
        $asientos_totales = Array();
        $i=1;
        while($i<=$capacidad_cabina){
            $asientos_totales[$i]=$i;
            $i++;
        }

        //-----Asientos ocupados
        $asientos_ocupados = Array();
        foreach($asientos_reservados as $asiento_reservado){
            $asientos_ocupados[] = $asiento_reservado['numero_asiento'];
        }

        //-----Asientos libres
        $asientos_libres = array_diff($asientos_totales, $asientos_ocupados);

        //-----Inserts
        if (sizeof($asientos_libres)>=$lista_espera['cantidad_lugares']){
            $cant_insert=0;
            $i=array_key_first($asientos_libres);

            while($cant_insert < $lista_espera['cantidad_lugares']) {
                $sqlAsientosReservados = "INSERT INTO asientos_reservados (numero_asiento, numero_reserva)
                                        VALUES ( " . $asientos_libres[$i] . ", " . $lista_espera['nro_reserva'] . ")";
                $resultAsientosReservados = mysqli_query($conn, $sqlAsientosReservados);

                //echo $sqlAsientosReservados . "<br><br>";
                $cant_insert++;
                $i++;
            }

           //-----Trae los id's
            $sqlIDasientos = "SELECT id_asientos_reservados FROM asientos_reservados WHERE numero_reserva=" . $lista_espera['nro_reserva'];
            $resultIDasientos = mysqli_query($conn, $sqlIDasientos);

            $j = 0;
            $id_asientos = Array();
            while ($row = mysqli_fetch_assoc($resultIDasientos)) {
                $id_asientos[$j] = $row['id_asientos_reservados'];
                $j++;
            }

            //-----Insert en la tabla de asientos_reserva
            $j = 0;
            while ($j < sizeof($id_asientos)) {
                $sqlAsientosReserva = "INSERT INTO asientos_reserva (fk_asientos_reservados, fk_reserva)
                         VALUES ($id_asientos[$j], " . $lista_espera['fk_reserva'] . ")";
                $result = mysqli_query($conn, $sqlAsientosReserva);
                $j++;
               // echo $sqlAsientosReserva . "<br><br>";
            }

            //------Update estado de reserva
            $sqlEstadoReserva="UPDATE reserva SET fk_estado_reserva=1 WHERE nro_reserva=" . $lista_espera['nro_reserva'];
            $resultEstadoReserva = mysqli_query($conn, $sqlEstadoReserva);

            //------Delete de lista de espera
            $sqlBorraDeLista="DELETE FROM lista_espera WHERE fk_reserva=" . $lista_espera['fk_reserva'];
            $resultBorraDeLista = mysqli_query($conn, $sqlBorraDeLista);

        }else{
            $lista_espera['id_lista_espera']."no puede entrar<br>";
        }
    }
}
