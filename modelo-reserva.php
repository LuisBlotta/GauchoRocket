<?php
include("sesion.php");
include_once("conexion.php");

reserva();
function reserva(){

    $cant_pasajeros = $_POST['cant_pasajeros'];
    $nombre = $_POST['nombre'];
    $mail = $_POST['mail'];
    $cabina = $_POST['cabina'];
    $nick = $_COOKIE["login"];
    $id_vuelo= $_GET['id_vuelo'];
    $nro_reserva =  rand() ;



    $conn = getConexion();

    //traigo el ID del usuario creado
    $queryConsulta ="SELECT id_login FROM login WHERE nick='$nick'";

    $result = mysqli_query($conn, $queryConsulta);
    $dato=mysqli_fetch_row($result);



    $sql = "insert INTO reserva (nro_reserva, fk_vuelo, fk_usuario, tipo_cabina, cantidad_lugares) values ($nro_reserva,$id_vuelo,'$dato[0]','$cabina',$cant_pasajeros)";

  
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    echo "hola".$nombre;
}



?>