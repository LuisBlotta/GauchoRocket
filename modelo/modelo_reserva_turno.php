<?php
include("conexion.php");
include("head.php");
getTurnos();
function getTurnos()
{

    $id_medico = $_GET['id_medico'];
    $nombre = $_POST['nombre'];
    $fecha_turno = $_POST['fecha_turno'];
    //$nick = $_COOKIE["login"];

    $conn = getConexion();

    /*traigo los turnos x fecha y centro medico*/

    $sql = "SELECT turno.fecha fecha, turno.fk_login usuario, medico.nombre centro_medico
            FROM turno JOIN medico ON medico.id_medico = turno.fk_medico
            WHERE medico.id_medico = '$id_medico' AND turno.fecha = '$fecha_turno'";

    $result = mysqli_query($conn, $sql);
    /* ---------- id_medico ----------
                Buenos Aires N° - 1 300 turnos x dia
                Shanghai N° 2 - 210 turnos x dia
                Ankara N° 3 - 200 turnos x dia           */

    if ($id_medico === 1) {
        if (mysqli_num_rows($result) < 3) {
            $sqlInsert = "INSERT INTO turno (fecha, fk_medico, fk_login)
                            values ('$fecha_turno', '$id_medico', 1)";

            $resultado = mysqli_query($conn, $sqlInsert);
            mysqli_close($conn);
            echo $sqlInsert;
            exit();

        } else
            echo("Los turnos para el día seleccionado están llenos");
    } elseif ($id_medico === 2) {
        if (mysqli_num_rows($result) < 2) {
            $sqlInsert = "INSERT INTO turno (fecha, fk_medico, fk_login)
                            values ('$fecha_turno', '$id_medico', 1)";

            $resultado = mysqli_query($conn, $sqlInsert);
            mysqli_close($conn);
            echo $sqlInsert;
            exit();

        } else
            echo("Los turnos para el día seleccionado están llenos");
    } else
        if (mysqli_num_rows($result) < 2) {
            $sqlInsert = "INSERT INTO turno (fecha, fk_medico, fk_login)
                            values ('$fecha_turno', '$id_medico', 1)";

            $resultado = mysqli_query($conn, $sqlInsert);
            mysqli_close($conn);
            echo $sqlInsert;
            exit();

        } else
            echo("Los turnos para el día seleccionado están llenos");

}

?>