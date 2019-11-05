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

    $conn = getConexion();

    $sql = "SELECT turno.fecha fecha, medico.nombre centro_medico
            FROM turno JOIN medico ON medico.id_medico = turno.fk_medico
            WHERE medico.id_medico = '$id_medico' AND turno.fecha = '$fecha_turno'";

    $result = mysqli_query($conn, $sql);

    $queryConsulta ="SELECT id_login FROM login WHERE nick='$nick'";

    $resultlogin = mysqli_query($conn, $queryConsulta);
    $dato=mysqli_fetch_row($resultlogin);

    /* ---------- id_medico ----------
                Buenos Aires N° 1 - 300 turnos x dia
                Shanghai N° 2 - 210 turnos x dia
                Ankara N° 3 - 200 turnos x dia           */

    if ($id_medico == 1) {
        if (mysqli_num_rows($result) < 3) {
            $sqlInsert = "INSERT INTO turno (fecha, nick, fk_medico, fk_login)
                            values ('$fecha_turno', '$nick', '$id_medico', $dato[0])";

            mysqli_query($conn, $sqlInsert);
            mysqli_close($conn);
            echo ("Reserva exitosa!");
            /*echo $sqlInsert;
            exit();*/
        } else
            echo("Los turnos para el día seleccionado están llenos");

    } elseif ($id_medico == 2) {

        if (mysqli_num_rows($result) < 2) {
            $sqlInsert = "INSERT INTO turno (fecha, nick, fk_medico, fk_login)
                            values ('$fecha_turno', '$nick', '$id_medico', $dato[0])";

            mysqli_query($conn, $sqlInsert);
            mysqli_close($conn);
            echo ("Reserva exitosa!");
            /*echo $sqlInsert;
            exit();*/
        } else
            echo("Los turnos para el día seleccionado están llenos");
    } else

        if (mysqli_num_rows($result) < 2) {
            $sqlInsert = "INSERT INTO turno (fecha, nick, fk_medico, fk_login)
                            values ('$fecha_turno', '$nick', '$id_medico', $dato[0])";

            mysqli_query($conn, $sqlInsert);
            mysqli_close($conn);
            echo ("Reserva exitosa!");
            /*echo $sqlInsert;
            exit();*/

        } else
            echo("Los turnos para el día seleccionado están llenos");

}

?>