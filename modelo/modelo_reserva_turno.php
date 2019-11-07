<?php



    /* ---------- id_medico ----------
                Buenos Aires N° 1 - 10 turnos x dia
                Shanghai N° 2 - 10 turnos x dia
                Ankara N° 3 - 10 turnos x dia           */


include("conexion.php");
include("head.php");
getTurnos();
function getTurnos()
{

    $id_medico = $_GET['id_medico'];
    $nombre = $_POST['nombre'];
    $nick = $_COOKIE["login"];
    $fecha_turno = $_POST['fecha_turno'];

    $conn = getConexion();


    $sqlTraerTurnosOcupados = "SELECT count(turno.id_turno) cantidad_turnos_dados
            FROM turno JOIN medico ON medico.id_medico = turno.fk_medico
            WHERE medico.id_medico = '$id_medico' AND turno.fecha = '$fecha_turno'";



    $resultTraerTurnosOcupados = mysqli_query($conn, $sqlTraerTurnosOcupados);
    $datoTurnosOcupados=mysqli_fetch_row($resultTraerTurnosOcupados);

  if ($datoTurnosOcupados[0] < 3  ) {
    
    $queryConsulta ="SELECT id_login FROM login WHERE nick='$nick'";

    $resultlogin = mysqli_query($conn, $queryConsulta);
    $dato=mysqli_fetch_row($resultlogin);

    $sqlInsert = "INSERT INTO turno (fecha, nombre, fk_medico, fk_login)
                   values ('$fecha_turno', '$nombre', '$id_medico', $dato[0])";

            mysqli_query($conn, $sqlInsert);
            mysqli_close($conn);

            header("location:resultado_turno?resultado=true");
    
    } else
            header("location:resultado_turno?resultado=false");

}

?>