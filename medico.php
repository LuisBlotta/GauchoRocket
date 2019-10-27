<?php
include("sesion.php");
include_once("conexion.php");

reservaMedico();
function reservaMedico()
{

    $nombre = $_POST['nombre'];
    $mail = $_POST['email'];
    $fecha = $_POST['fecha_turno'];
    $id_medico = $_GET['id_medico'];

    $conn = getConexion();


    echo "Ya estas cerca de reservar turno, trank";
    exit();


}