<html>
<head>
    <title>Form reportes</title>
    <?php include("head.php");
    include("charts/lib/inc/chartphp_dist.php");
    $torta = new chartphp();
    $torta->data = array(array(
        array('Familiar',$datosCabina[0]),
        array('General',$datosCabina[1]),
        array('Suite',$datosCabina[2])
    ));
    $torta->chart_type = "donut";
    $out = $torta->render("c1");

    $barrasEquipo = new chartphp();
    $barrasEquipo->data = array(
        array(
            array($equipos[0],$cantidadXCabina[0]),
            array($equipos[1],$cantidadXCabina[1]),
            array($equipos[2],$cantidadXCabina[2]),
            array($equipos[3],$cantidadXCabina[3]),
            array($equipos[4],$cantidadXCabina[4]),
            array($equipos[5],$cantidadXCabina[5]),
            array($equipos[6],$cantidadXCabina[6]),
            array($equipos[7],$cantidadXCabina[7]),
            array($equipos[8],$cantidadXCabina[8]),
            array($equipos[9],$cantidadXCabina[9]))
    );
    $barrasEquipo->chart_type = "bar";
    $out2 = $barrasEquipo->render("c1");
    ?>

    <link rel="stylesheet" href="charts/lib/js/chartphp.css">
    <script src="charts/lib/js/jquery.min.js"></script>
    <script src="charts/lib/js/chartphp.js"></script>
    <link rel="stylesheet" href="public/css/estilos-reportes.css">
</head>

<body>
<h1 class="titulo">Reportes</h1>

<section class="container card reportes">
    <h3>Facturación mes actual:</h3>
    <h4> $<?=  $facturacionMensual[0] ?></h4>
    <a href="form_facturacion_meses_anteriores">Consultar meses anteriores
    </a>

</section>

<br><br>


<section class="container card reportes">
    <h3>Facturación por cliente</h3>
<form action="facturacion_cliente" method="post">
    <label for="">Clientes:</label>
    <select name="cliente" class="custom-select mr-sm-2">
        <?php

        foreach ($clientes as $cliente){
            echo"<option value=".$cliente['id_login'].">".$cliente['nick']."</option> ";
        }
        ?>

    </select>

    <br><br><button type="submit" class="btn btn-info">Buscar</button>

</form>

</section>
<br><br>
<section class="container card reportes">
    <h3 for="">Reporte mensual por equipo:</h3>
    <?php echo "$out2"; ?>
    <h3 style="margin-top: -10px;">Promedio por Cabina:</h3>

    <?php echo "$out"; ?>

</section>



</body>
</html>