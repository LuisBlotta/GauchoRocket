<?php
include("condicional_sesion.php");
include_once("conexion.php");
$conn=getConexion();
$nro_reserva=$_GET['nro_reserva'];
$numeros= array();
foreach ($asientosReservados as $asiento_reservado){
    $numeros[] = $asiento_reservado['numero_asiento'];
}
$i=1;

//----Valida que haya pagado
$sql="SELECT fk_estado_reserva FROM reserva WHERE nro_reserva=$nro_reserva";
$result = mysqli_query($conn, $sql);
$estado_reserva=mysqli_fetch_row($result);

if ($estado_reserva!=3){
    if ($estado_reserva==1){
        header("location:consultar_reservas?check_in_realizado=true");
    }
    header("location:consultar_reservas?requiere_pago=true");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Check In</title>
    <?php include("head.php");?>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-index.css">
</head>
<body>
    <main>
        <?php
        echo "<form action='check_in?nro_reserva=".$nro_reserva."' method='post'>";
                while ($i <= $datos['capacidad']) {
                    if (in_array($i, $numeros)){
                        echo "<label><img src='public/img/lugar_ocupado.png'> 
                        <input type='checkbox' name='asiento[]' value='$i' disabled></label>";
                        echo $i;
                    }else{
                        echo "<label> <img src='public/img/lugar_libre.png'>
                            <input type='checkbox' name='asiento[]' value='$i'> </label>";
                        echo $i;
                    }
                    $i++;
                }
        ?>
            <button class="btn btn-info">Confirmar</button>
        </form>
        <?php
            if(!empty($_GET['fallo'])==true){
                echo "<script>alert('Hubo un error con la cantidad de asientos ingresados, inténtelo nuevamente')</script>";
            }
        ?>
    </main>
</body>
