<?php
include("condicional_sesion.php");
include_once("conexion.php");
$conn=getConexion();
$nro_reserva=$_GET['nro_reserva'];
$i=1;

$numeros= array();
foreach ($asientosReservados as $asiento_reservado){
    $numeros[] = $asiento_reservado['numero_asiento'];
}

//----Valida que haya pagado
$sql="SELECT fk_estado_reserva FROM reserva WHERE nro_reserva=$nro_reserva";
$result = mysqli_query($conn, $sql);
$estado_reserva=mysqli_fetch_row($result);

if ($estado_reserva[0]!=3){
    if ($estado_reserva[0]==1){
        header("location:consultar_reservas?check_in_realizado=true");
    }
    header("location:consultar_reservas?requiere_pago=true");
}
if(!empty($_GET['fallo'])==true){
    echo '<div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          Hubo un error con la cantidad de asientos ingresados, inténtelo nuevamente
                      </div>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Check In</title>
    <?php// include("head.php");?>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-index.css">
    <link rel="stylesheet" type="text/css" href="public/css/estilos-check_in.css">
</head>
<body>
<main>
<?php
    echo"
        
        <form class='form-check-in' action='check_in?nro_reserva=".$nro_reserva."' method='post'> 
        <h3>Seleccione los asientos</h3>           
            <div class='asientos'>";
            while ($i <= $datos['capacidad']) {
                    if (in_array($i, $numeros)){
                        echo "<input type='checkbox' name='asiento[]' value='$i' id='asiento_$i' disabled> 
                              <label class='asiento-ocupado' for='asiento_$i'></label>";
                        //echo $i;
                    }else{
                        echo "<input type='checkbox' name='asiento[]' value='$i' id='asiento_$i'>
                              <label class='asiento-libre' for='asiento_$i'></label>";
                        //echo $i;
                    }
                    $i++;
            }
        echo"</div>";
?>
            <button class="btn-confirmar btn btn-info">Confirmar</button>
        </form>
    </main>
</body>
