<?php
include_once("conexion.php");
include("head.php");
registrar_transaccion();
function registrar_transaccion(){
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    $zona_horaria=date_default_timezone_get();
    $conn = getConexion();
    $nro_reserva=$_GET['nro_reserva'];
    $nro_tarjeta=$_POST['numero_tarjeta'];
    $nick=$_COOKIE["login"];
    $estado_pago=cobrar();

    $tarjeta_md5=md5($nro_tarjeta);
    $hoy=getdate();
    $cod_transaccion=hash('ripemd160', $hoy['seconds'].$hoy['minutes'].$hoy['hours'].$tarjeta_md5);

    $mes=$hoy['mon'];
    if ($mes<10){
        $mes='0'.$mes;
    }

    $dia=$hoy['mday'];
    if ($dia<10){
        $dia='0'.$dia;
    }

    $hora=$hoy['hours'];
    if ($hora<10){
        $hora='0'.$hora;
    }

    $minutos=$hoy['minutes'];
    if ($minutos<10){
        $minutos='0'.$minutos;
    }

    $segundos=$hoy['seconds'];
    if ($segundos<10){
        $segundos='0'.$segundos;
    }

    $fecha=$hoy['year'].$mes.$dia;
    $hora=$hora.$minutos.$segundos;


    //-----Trae id_usuario
    $traeIdUsuario="SELECT id_usuario FROM usuario
                    JOIN login ON login.id_login = usuario.fk_login
                    WHERE login.nick = '$nick'";
    $resultUsuario = mysqli_query($conn, $traeIdUsuario);
    $id_usuario=mysqli_fetch_row($resultUsuario);
    $id_usuario=$id_usuario[0];
    //--------------------

    $sql = "INSERT INTO transaccion (cod_transaccion, fk_usuario, fk_estado_transaccion, fecha, hora, zona_horaria, nro_reserva) 
            VALUES ('$cod_transaccion', $id_usuario, $estado_pago, '$fecha', '$hora','$zona_horaria', $nro_reserva)";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    if ($estado_pago==1){
        header('location:consultar_reservas?estado_pago=1');
    }elseif ($estado_pago==0){
        header('location:consultar_reservas?nro_reserva='.$nro_reserva.'&fallo_datos=1');
    }


}