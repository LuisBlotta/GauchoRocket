<?php
include("conexion.php");
validar_reserva();
function validar_reserva(){
    $nro_reserva = $_POST['nro_reserva'];
    $nick = $_COOKIE["login"];


    $conn = getConexion();

    $sqlValidarReserva="SELECT * FROM reserva join login on reserva.fk_login = login.id_login 
                       WHERE reserva.nro_reserva = $nro_reserva AND login.nick = '$nick'";

    $result = mysqli_query($conn, $sqlValidarReserva);


    if (mysqli_num_rows($result)>0) {
        header('location:form_check_in?nro_reserva='.$nro_reserva.'');
     

    } else {
    header('location:form_ingreso_check_in?fallo=true');

    }

}