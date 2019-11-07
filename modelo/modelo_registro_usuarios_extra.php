<?php
include("sesion.php");
include_once("conexion.php");
registrar_usuarios_extra();
function registrar_usuarios_extra(){
    $userConfirmado = true;
    $hoy = getdate();
    $hashConfirmacion =hash('ripemd160', $hoy['seconds'].$hoy['minutes'].$hoy['hours']);
    $nick = $_POST["nick"];
    $mail = $_POST['mail'];
    $password = md5('gauchorocket');
    $conn = getConexion();
    $cantidadPasajeros = $_GET['cantidadPasajeros'];
    $id_vuelo = $_GET['id_vuelo'];
    $nro_reserva = $_GET['nro_reserva'];
    $id_destino = $_GET['id_destino'];
    $id_vuelo_trayecto = $_GET['id_vuelo_trayecto'];
    $estado_reserva_default=2;

    //Busca si hay usuarios con el mismo nombre

    $buscarUsuario = "SELECT * FROM login
    WHERE nick = '$nick' ";
    $result = $conn->query($buscarUsuario);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $queryConsulta ="SELECT id_login FROM login WHERE nick='$nick'";

        $result = mysqli_query($conn, $queryConsulta);
        $dato=mysqli_fetch_row($result);

        $sqlAddReserva = "INSERT INTO reserva (nro_reserva, fk_estado_reserva, fk_id_vuelo_trayecto, fk_login) 
                          VALUES ($nro_reserva, $estado_reserva_default,$id_vuelo_trayecto,'$dato[0]')";
        $result2 = mysqli_query($conn, $sqlAddReserva);

    }else{
        //Inserto datos en la tabla login

        $query = "INSERT INTO login (userConfirmado, hashConfirmacion, nick, password)
                  VALUES ('$userConfirmado','$hashConfirmacion','$nick','$password')";
        $result = mysqli_query($conn, $query);

        //Traigo el ID del usuario
        $queryConsulta ="SELECT id_login FROM login WHERE nick='$nick'";

        $result = mysqli_query($conn, $queryConsulta);
        $dato=mysqli_fetch_row($result);

        $sqlAddUser ="INSERT INTO usuario (nombre, mail, rol, fk_login) values ('$nick', '$mail',1,'$dato[0]')";
        $result1 = mysqli_query($conn, $sqlAddUser);

        $sqlAddReserva = "INSERT INTO reserva (nro_reserva, fk_estado_reserva,fk_id_vuelo_trayecto, fk_login) 
                          VALUES ($nro_reserva, $estado_reserva_default,$id_vuelo_trayecto,$dato[0])";

        $result2 = mysqli_query($conn, $sqlAddReserva);
    }

    $cantidadPasajeros=$cantidadPasajeros-1;

    header("location:registrar_usuarios_extra?cantidadPasajeros=$cantidadPasajeros&id_vuelo=$id_vuelo&nro_reserva=$nro_reserva&id_vuelo_trayecto=$id_vuelo_trayecto&id_destino=$id_destino");

}