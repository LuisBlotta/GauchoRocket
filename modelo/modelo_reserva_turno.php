<?php
include("conexion.php");
include("head.php");
getTurnos();
function getTurnos(){

    $id_medico=$_GET['id_medico'];
    $nombre = $_POST['nombre'];
    $fecha_turno = $_POST['fecha_turno'];
    $nick = $_COOKIE["login"];

    $conn = getConexion();
    /*traigo los turnos x fecha y centro medico*/
    $sql = "SELECT turno_ocupado.fk_turno turno, turno.fecha fecha, turno_ocupado.fk_login usuario, medico.nombre centro_medico
            FROM turno_ocupado JOIN turno ON turno_ocupado.fk_turno = turno.id_turno JOIN medico ON medico.id_medico = turno_ocupado.fk_medico
            WHERE turno.fecha = '$fecha_turno' AND medico.id_medico = '$id_medico'";

    $result = mysqli_query($conn, $sql);


}

?>