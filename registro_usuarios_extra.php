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
    $password = md5($_POST["password"]);
    $passwordConfirmada = md5($_POST["passwordConfirmada"]);
    $conn = getConexion();
    $cantidadPasajeros = $_GET['cantidadPasajeros'];
    $id_vuelo = $_GET['id_vuelo'];
    $nro_reserva = $_GET['nro_reserva'];

//Confirma igualdad de passwords
if ($password == $passwordConfirmada){

//Confirma que no hayan usuarios con el mismo nombre
$buscarUsuario = "SELECT * FROM login
 		WHERE nick = '$nick' ";
$result = $conn->query($buscarUsuario);
$count = mysqli_num_rows($result);

if ($count == 1) {
    echo "<br />". "El Nombre de Usuario ya a sido tomado." . "<br />";
    echo "<a href='registrar_usuarios_extra.php'>Por favor escoga otro Nombre</a>";
}else{
    //Inserto datos en la tabla login
    $query = "INSERT INTO login (userConfirmado, hashConfirmacion, nick, password)
 			VALUES ('$userConfirmado','$hashConfirmacion','$nick','$password')";
             $result = mysqli_query($conn, $query);

    //traigo el ID del usuario
    $queryConsulta ="SELECT id_login FROM login WHERE nick='$nick'";

    $result = mysqli_query($conn, $queryConsulta);
    $dato=mysqli_fetch_row($result);


    $sqlAddUser ="INSERT INTO usuario (nombre, mail, rol, fk_login) values ('$nick', '$mail',1,'$dato[0]')";
    $result1 = mysqli_query($conn, $sqlAddUser);

    $sqlAddReserva = "insert INTO reserva (nro_reserva, fk_vuelo, fk_login) values ($nro_reserva,$id_vuelo,'$dato[0]')";


    $result2 = mysqli_query($conn, $sqlAddReserva);
}
    $cantidadPasajeros=$cantidadPasajeros-1;
    header("location:registrar_usuarios_extra.php?cantidadLugares=$cantidadPasajeros&id_vuelo=$id_vuelo&nro_reserva=$nro_reserva");
}
else{
    header("location:registrar_usuarios_extra.php?falloPass=true&cantidadLugares=$cantidadPasajeros&id_vuelo=$id_vuelo&nro_reserva=$nro_reserva");
}

}
?>