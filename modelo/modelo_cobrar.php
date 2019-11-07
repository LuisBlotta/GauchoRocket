<?php
include_once("conexion.php");
include("head.php");
cobrar();
function cobrar(){ 
    
    $nick=$_COOKIE["login"];
    $nro_reserva=$_GET['nro_reserva'];

    $validez_numero1=$_POST['validez_numero'];
    $validez_cvv=$_POST['validez_cvv'];
    $validez_fecha1=$_POST['validez_fecha'];

    $nro_tarjeta=$_POST['numero_tarjeta'];
    $nro_tarjeta= str_replace( " ", "", $nro_tarjeta);
    $array_numero=str_split($nro_tarjeta);

    $mes=$_POST['mes'];
    $año=$_POST['año'];


    //$cod_transaccion=hash('',);

    $conn = getConexion();

    //-----Valida número de tarjeta

    $nro_tarjeta=Array();
    $suma = Array();

    for($i = 0; $i <= 15; $i++){
        $nro_tarjeta[$i+1]=$array_numero[$i];
    }

    for ($i = 1; $i <= 16; $i++) {
        if ($i % 2==0) {
            $suma[$i] = $nro_tarjeta[$i];
        }else{
            $suma[$i] = 2 * $nro_tarjeta[$i]; //los números en posiciones impares y multiplicarlos por 2
            if($suma[$i]>=10){
                $divide_num=str_split($suma[$i]);   //divide el numerode dos digitos para poder sumarlos y formar uno de un digito
                $suma[$i]=$divide_num[0]+$divide_num[1];
            }
        }
    }

    $suma=array_sum($suma);

    if ($suma % 10 == 0 && $suma < 150) {
        $validez_numero2= true;
    }else{
        $validez_numero2= false;
    }

    //-----Valida fecha
        $hoy = getdate();
        if ($año>=$hoy['year']){
            if ($año==$hoy['year']){
                if ($mes>$hoy['mon']){
                    $validez_fecha2=true;
                }else{
                    $validez_fecha2=false;
                }
            }
            $validez_fecha2=true;
        }else{
            $validez_fecha2=false;
        }
    //------------------------------

    if($validez_numero1 && $validez_numero2 && $validez_cvv && $validez_fecha1 && $validez_fecha2 == true){
        $sql = "UPDATE reserva 
            SET fk_estado_reserva = 3
            WHERE nro_reserva = $nro_reserva";

        $result = mysqli_query($conn, $sql);

        header('location:consultar_reservas');
    }else{
        header('location:pago?nro_reserva='.$nro_reserva.'&fallo_datos=1');
    }

    mysqli_close($conn);   
}