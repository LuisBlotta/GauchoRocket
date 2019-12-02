<?php
include_once("conexion.php");

registrar_transaccion();
function registrar_transaccion(){
    $fecha=getFechaCompleta();
    $hora=getHoraCompleta();
    $zona_horaria=date_default_timezone_get();

    $conn = getConexion();
    $nro_reserva=$_GET['nro_reserva'];
    $nro_tarjeta=$_POST['numero_tarjeta'];
    $nick=$_COOKIE["login"];
    $estado_pago=cobrar();

    $tarjeta_md5=md5($nro_tarjeta);
    $hoy=getdate();
    $cod_transaccion=hash('ripemd160', $hoy['seconds'].$hoy['minutes'].$hoy['hours'].$tarjeta_md5);

    //-----Trae id_usuario
    $traeIdUsuario="SELECT id_login FROM login
                    WHERE login.nick = '$nick'";
    $resultUsuario = mysqli_query($conn, $traeIdUsuario);
    $id_usuario=mysqli_fetch_row($resultUsuario);
    $id_usuario=$id_usuario[0];

    //------Guarda los útimos números de la tarjeta
    $nro_tarjeta= str_replace( " ", "", $nro_tarjeta);
    $array_numero=str_split($nro_tarjeta);

    $ult_nro_tarjeta=$array_numero[12].$array_numero[13].$array_numero[14].$array_numero[15];

    //------Tipo de tarjeta
    if ($array_numero[0]==3){
        $tipo_tajeta="Amex";
    }elseif ($array_numero[0]==4){
        $tipo_tajeta="Visa";
    }elseif ($array_numero[0]==5){
        $tipo_tajeta="Mastercard";
    }

    $sql = "INSERT INTO transaccion (cod_transaccion, fk_login, fk_estado_transaccion, fecha, hora, zona_horaria, nro_reserva, nro_tarjeta, tipo_tarjeta) 
            VALUES ('$cod_transaccion', $id_usuario, $estado_pago, '$fecha', '$hora','$zona_horaria', $nro_reserva, $ult_nro_tarjeta, '$tipo_tajeta')";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    if ($estado_pago==1){
        header('location:factura?cod_transaccion='.$cod_transaccion);
    }elseif ($estado_pago==0){
        header('location:consultar_reservas?nro_reserva='.$nro_reserva.'&fallo_datos=1');
    }


}