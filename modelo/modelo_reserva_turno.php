<?php

include("conexion.php");
include("head.php");
getTurnos();
function getTurnos()
{

    $id_medico = $_GET['id_medico'];
    $nombre = $_POST['nombre'];
    $nick = $_COOKIE["login"];
    $fecha_turno = $_POST['fecha_turno'];
    $nro_reserva=$_GET['nro_reserva'];


    $conn = getConexion();

    ## traigo id de pasajeros en base al nro de reserva ##
$queryConsultalogins ="SELECT fk_login fk_login FROM reserva WHERE nro_reserva=$nro_reserva";

    $resultlogin = mysqli_query($conn, $queryConsultalogins);
    $logins = Array();
    if (mysqli_num_rows($resultlogin) > 0) {
        while($row = mysqli_fetch_assoc($resultlogin)) {
            $login = Array();
            $login['fk_login'] =  $row["fk_login"];
            $logins[] = $login;
        }
    }


    foreach ($logins as $login){
        $ids[] = $login['fk_login'];
    }


    ## Cuadntos pasajeros tiene esa reserva ##
    $sqlTraerCantidadDePasajerosPorReserva="SELECT count(reserva.id_reserva) FROM reserva WHERE nro_reserva=$nro_reserva";

    $resultLugaresParaReservar = mysqli_query($conn, $sqlTraerCantidadDePasajerosPorReserva);
    $cantidadPasajerosPorReserva=mysqli_fetch_row($resultLugaresParaReservar);


    ## Turnos ocupados por dia##
    $sqlTraerTurnosOcupados = "SELECT count(turno.id_turno) cantidad_turnos_dados
            FROM turno JOIN medico ON medico.id_medico = turno.fk_medico
            WHERE medico.id_medico = '$id_medico' AND turno.fecha = '$fecha_turno'";

    $resultTraerTurnosOcupados = mysqli_query($conn, $sqlTraerTurnosOcupados);
    $datoTurnosOcupados=mysqli_fetch_row($resultTraerTurnosOcupados);


  echo $cantidadPasajerosPorReserva[0];

   /* echo "<br>";
    echo $datoTurnosOcupados[0];
    echo "<br>";
    exit();*/


  if (($datoTurnosOcupados[0] + $cantidadPasajerosPorReserva[0]) <= 10  ) {

      $i = 0;
      while ($i < $cantidadPasajerosPorReserva[0]){

    $sqlInsert = "INSERT INTO turno (fecha, nombre, fk_medico, fk_login)
                   values ('$fecha_turno', '$nombre', '$id_medico', $ids[$i])";

            mysqli_query($conn, $sqlInsert);
            $i++;
      }
            mysqli_close($conn);

            header("location:resultado_turno");
    
    } else
            header("location:form_turno?resultado=false&id_medico=$id_medico&nro_reserva=$nro_reserva");

}

?>